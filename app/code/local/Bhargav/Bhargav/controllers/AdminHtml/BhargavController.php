<?php

class Bhargav_Bhargav_Adminhtml_BhargavController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('bhargav/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    public function indexAction()
    {
        // echo '<pre>';
        // $model = Mage::getModel('bhargav/bhargav')->load(2);
        // $model->name = 'vijay thakor';
        // $model->email = 'v@gmial.com';
        // $model->save();
        // print_r($model->getCollection()->toArray());
        // die();
        $this->loadLayout();
        $this->_title($this->__("bhargav Grid"));
        $this->_addContent($this->getLayout()->createBlock('bhargav/adminhtml_bhargav'));
        $this->renderLayout();
    }


    public function newAction() {
        $this->_forward('edit');
    }   

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        if (!$model1 = Mage::getModel('bhargav/bhargav')->load($id)){
            $model1 = Mage::getModel('bhargav/bhargav');
        }
       /* if (!$model2 = Mage::getModel('bhargav/bhargav_address')->load($id)){
            $model2 = Mage::getModel('bhargav/bhargav_address');
        }*/

        if ($model1->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model1->setData($data);
        }

        /*if ($model2->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        }
        if (!empty($data)) {
            $model2->setData($data);
        }*/
        Mage::register('bhargav_data', $model1);
        // Mage::register('bhargav_address_data', $model2);
        $this->loadLayout();
        $this->_setActiveMenu('bhargav/items');
        $this->_addContent($this->getLayout()->createBlock(' bhargav/adminhtml_bhargav_edit'))
            ->_addLeft($this->getLayout()->createBlock('bhargav/adminhtml_bhargav_edit_tabs'));
        $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bhargav')->__('bhargav does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        if ($this->getRequest()->getParam('back')) {
            $this->_redirect('*/*/edit', array('id' => $model->getId()));
            return;
        }

        if ($data = $this->getRequest()->getPost()) {
            $bhargav = $data['bhargav'];
            $model = Mage::getModel('bhargav/bhargav');
            $model->setData($bhargav)->setId($this->getRequest()->getParam('id'));
            try {
                if ($model->entity_id != null) {
                    $model->updated_at = date('Y-m-d H:i:s');
                } else {
                    $model->created_at = date('Y-m-d H:i:s');
                }
                
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('bhargav')->__('Categories was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                 
                if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($bhargav);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('bhargav')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }



    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('bhargav/bhargav');
                 
                $model->setId($this->getRequest()->getParam('id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('bhargav was successfully deleted'));
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
        $fileName   = 'bhargavs.csv';
        $content    = $this->getLayout()->createBlock('bhargav/adminhtml_bhargav_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'bhargavs.xml';
        $content    = $this->getLayout()->createBlock('bhargav/adminhtml_bhargav_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }


    public function massDeleteAction()
    {
        $bhargavIDs = $this->getRequest()->getParam('entity_id');
        if(!is_array($bhargavIDs)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select bhargav(s).'));
        } else {
            try {
                $bhargav = Mage::getModel('bhargav/bhargav');
                foreach ($bhargavIDs as $bhargavId) {
                    $bhargav->reset()
                        ->load($bhargavId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($bhargavIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}