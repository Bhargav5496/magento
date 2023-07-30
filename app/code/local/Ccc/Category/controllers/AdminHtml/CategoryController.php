<?php

class Ccc_Category_Adminhtml_CategoryController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('category/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('category');
        return $this;
    }

    public function indexAction()
    {
        try {
            $this->_initAction();
            $this->_title($this->__("Category"));
            $this->_addContent($this->getLayout()->createBlock('category/adminhtml_category'));
            $this->renderLayout();
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
    }

    public function newAction()
    {
        try {
            $this->_forward('edit');
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }
    }

    public function editAction()
    {
        try {
            $id    = $this->getRequest()->getParam('id');
            $model = Mage::getModel('category/category');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('category')->__('This page no longer exists.'));
                    $this->_redirect('*/*/');
                    return;
                }
            }
            $this->_title($model->getId() ? $this->__('Edit Category') : $this->__('New Category'));
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('model_data', $model);

            $inputPracticeId    = $model->getInputPracticeId();
            $inputPracticeModel = Mage::getModel('category/input_practice')->load($inputPracticeId);
            Mage::register('input_practice_data', $inputPracticeModel);

            $this->_initAction();
            $this->_addContent($this->getLayout()->createBlock('category/adminhtml_category_edit'))
                ->_addLeft($this->getLayout()->createBlock('category/adminhtml_category_edit_tabs'));
            $this->renderLayout();
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    protected function _saveInputPractice($data, $inputPracticeModel)
    {
        $inputPracticeModel->setData($data);
        $inputPracticeModel->formateBirthTime();
        $inputPracticeModel->save();
        $inputPracticeModel->saveImage();

        return $inputPracticeModel->getId();
    }

    public function _saveProgressFields($categories, $categoryModel)
    {
        $data = [];

        $overAll = 0;
        foreach ($categories as $categoryName => $category) {
            $count = 0;
            $total = count($category);
            foreach ($category as $key => $value) {
                if ($value) {
                    $count++;
                }
                $data[$key] = $value;
            }

            $percentage                          = ($count / $total) * 25;
            $data['percentage_' . $categoryName] = $percentage;
            $overAll += $percentage;
        }

        $data['percentage_overall'] = $overAll;

        return $categoryModel->setData($data)->save();
    }

    public function saveAction()
    {
        try {
            if ($data = $this->getRequest()->getPost()) {
                if ($categoryId = $this->getRequest()->getParam('id')) {
                    $categoryModel = Mage::getModel('category/category')->load($categoryId);
                } else {
                    $categoryModel = Mage::getModel('category/category');
                }

                $inputPracticeModel = Mage::getModel('category/input_practice')->load($categoryModel->input_practice_id);

                $inputPracticeId = $this->_saveInputPractice($data['input_practice'], $inputPracticeModel);

                $categoryModel = $this->_saveProgressFields($data['category'], $categoryModel);

                $categoryData['name']              = $data['name'];
                $categoryData['status']            = $data['status'];
                $categoryData['input_practice_id'] = $inputPracticeModel->getId();

                $categoryModel->setData($categoryData)->setId($this->getRequest()->getParam('id'));

                if ($categoryModel->category_id != null) {
                    $categoryModel->updated_at = date('Y-m-d H:i:s');
                } else {
                    $categoryModel->created_at = date('Y-m-d H:i:s');
                }

                $categoryModel->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('category')->__('Data saved successfully.'));
                Mage::getSingleton('adminhtml/session')->setFormData(true);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $categoryModel->getId()));
                    return;
                }
                $this->_redirect('*/*/edit', array('id' => $categoryModel->getId()));
                return;
            }
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Unable to find data to save'));
            $this->_redirect('*/*/');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setFormData($category);
            $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            return;
        }

    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('category/category');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Categories was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function exportCsvAction()
    {
        $fileName = 'categorys.csv';
        $content  = $this->getLayout()->createBlock('category/adminhtml_category_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'categorys.xml';
        $content  = $this->getLayout()->createBlock('category/adminhtml_category_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massDeleteAction()
    {
        $categoryIDs = $this->getRequest()->getParam('category_id');
        if (!is_array($categoryIDs)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select category(s).'));
        } else {
            try {
                $category = Mage::getModel('category/category');
                foreach ($categoryIDs as $categoryId) {
                    $category->reset()
                        ->load($categoryId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($categoryIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}
