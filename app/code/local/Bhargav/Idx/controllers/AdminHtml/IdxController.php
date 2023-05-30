<?php

class Bhargav_Idx_Adminhtml_IdxController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('idx/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    public function indexAction()
    {
        // echo '<pre>';
        // $model = Mage::getModel('idx/idx')->load(2);
        // $model->name = 'vijay thakor';
        // $model->email = 'v@gmial.com';
        // $model->save();
        // print_r($model->getCollection()->toArray());
        // die();
        $this->loadLayout();
        $this->_title($this->__("idx Grid"));
        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx'));
        $this->renderLayout();
    }


    public function newAction() {
        $this->_forward('edit');
    }   

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        if (!$model1 = Mage::getModel('idx/idx')->load($id)){
            $model1 = Mage::getModel('idx/idx');
        }
        if (!$model2 = Mage::getModel('idx/idx_address')->load($id)){
            $model2 = Mage::getModel('idx/idx_address');
        }

        if ($model1->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model1->setData($data);
        }

        if ($model2->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        }
        if (!empty($data)) {
            $model2->setData($data);
        }
        Mage::register('idx_data', $model1);
        Mage::register('idx_address_data', $model2);
        $this->loadLayout();
        $this->_setActiveMenu('idx/items');
        $this->_addContent($this->getLayout()->createBlock(' idx/adminhtml_idx_edit'))
            ->_addLeft($this->getLayout()->createBlock('idx/adminhtml_idx_edit_tabs'));
        $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('idx')->__('Idx does not exist'));
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
            $idx = $data['idx'];
            $address = $data['address'];
            $model = Mage::getModel('idx/idx');
            $addressModel = Mage::getModel('idx/idx_address');
            $model->setData($idx)->setId($this->getRequest()->getParam('id'));
            

            $addressModel->setData($address);
            try {
                if ($model->idx != null) {
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->save();
                    $addressModel->idx = $model->idx;
                } else {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->save();
                    $addressModel->idx = $model->idx;
                    $addressModel->getResource()->setPrimaryKey('address_id');
                }


                $addressModel->save();
           
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('Idx was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                 
                if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($idx);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('idx')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }


    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('idx/idx');
                 
                $model->setId($this->getRequest()->getParam('id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Idx was successfully deleted'));
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
        $fileName   = 'idxs.csv';
        $content    = $this->getLayout()->createBlock('idx/adminhtml_idx_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'idxs.xml';
        $content    = $this->getLayout()->createBlock('idx/adminhtml_idx_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }


    public function massDeleteAction()
    {
        $idxIDs = $this->getRequest()->getParam('idx');
        if(!is_array($idxIDs)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select idx(s).'));
        } else {
            try {
                $idx = Mage::getModel('idx/idx');
                foreach ($idxIDs as $idxId) {
                    $idx->reset()
                        ->load($idxId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($idxIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}