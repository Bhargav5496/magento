<?php

class Ccc_Test_Adminhtml_TestController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('test/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('test');
        return $this;
    }

    public function indexAction()
    {
        try {
            $this->_initAction();
            $this->_title($this->__("Test"));
            $this->_addContent($this->getLayout()->createBlock('test/adminhtml_test'));
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
            $model = Mage::getModel('test/test');
            if ($id) {
                $model->load($id);
                if (!$model->getId()) {
                    Mage::getSingleton('adminhtml/session')->addError(
                        Mage::helper('test')->__('This page no longer exists.'));
                    $this->_redirect('*/*/');
                    return;
                }
            }
            $this->_title($model->getId() ? $this->__('Edit Test') : $this->__('New Test'));
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }
            Mage::register('model_data', $model);

            $inputPracticeId    = $model->getInputPracticeId();
            $inputPracticeModel = Mage::getModel('test/input_practice')->load($inputPracticeId);
            Mage::register('input_practice_data', $inputPracticeModel);

            $this->_initAction();
            $this->_addContent($this->getLayout()->createBlock('test/adminhtml_test_edit'))
                ->_addLeft($this->getLayout()->createBlock('test/adminhtml_test_edit_tabs'));
            $this->renderLayout();
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try {

        } catch (Exception $e) {

        }

    }

    public function deleteAction()
    {
        if ($this->getRequest()->getParam('id') > 0) {
            try {
                $model = Mage::getModel('test/test');

                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Tests was successfully deleted'));
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
        $fileName = 'tests.csv';
        $content  = $this->getLayout()->createBlock('test/adminhtml_test_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName = 'tests.xml';
        $content  = $this->getLayout()->createBlock('test/adminhtml_test_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function massDeleteAction()
    {
        $testIDs = $this->getRequest()->getParam('test_id');
        if (!is_array($testIDs)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select test(s).'));
        } else {
            try {
                $test = Mage::getModel('test/test');
                foreach ($testIDs as $testId) {
                    $test->reset()
                        ->load($testId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($testIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    public function massStatusAction()
    {
        $testIDs = $this->getRequest()->getParam('test_id');
        if (!is_array($testIDs)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select test(s).'));
        } else {
            try {
                $test = Mage::getModel('test/test');
                $statusId = $this->getRequest()->getPost('status');
                foreach ($testIDs as $testId) {
                    $test = $test->reset()->load($testId);
                    $test->status = $statusId;
                    $test->save();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were status changed.', count($testIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
}
