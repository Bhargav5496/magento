<?php

class Bhargav_Eavmgmt_Adminhtml_EavmgmtController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('eavmgmt/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->__("eavmgmt Grid"));
        $this->_addContent($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt'));
        $this->renderLayout();
    }


    public function newAction() {
        $this->_forward('edit');
    }   

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        if (!$model1 = Mage::getModel('eavmgmt/eavmgmt')->load($id)){
            $model1 = Mage::getModel('eavmgmt/eavmgmt');
        }

        if ($model1->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model1->setData($data);
        }

        Mage::register('eavmgmt_data', $model1);
        $this->loadLayout();
        $this->_setActiveMenu('eavmgmt/items');
        $this->_addContent($this->getLayout()->createBlock(' eavmgmt/adminhtml_eavmgmt_edit'))
            ->_addLeft($this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_edit_tabs'));
        $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('eavmgmt')->__('Eavmgmt does not exist'));
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
            $eavmgmt = $data['eavmgmt'];
            $model = Mage::getModel('eavmgmt/eavmgmt');
            $model->setData($eavmgmt)->setId($this->getRequest()->getParam('id'));
            

            try {
                if ($model->eavmgmt_id != null) {
                    $model->updated_at = date('Y-m-d H:i:s');
                    $model->save();
                } else {
                    $model->created_at = date('Y-m-d H:i:s');
                    $model->save();
                }
           
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('eavmgmt')->__('Eavmgmt was successfully saved'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                 
                if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($eavmgmt);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('eavmgmt')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
    }


    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('eavmgmt/eavmgmt');
                 
                $model->setId($this->getRequest()->getParam('id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Eavmgmt was successfully deleted'));
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
        $fileName   = 'eavmgmts.csv';
        $content    = $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'eavmgmts.xml';
        $content    = $this->getLayout()->createBlock('eavmgmt/adminhtml_eavmgmt_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }


    public function massDeleteAction()
    {
        $eavmgmtIDs = $this->getRequest()->getParam('eavmgmt_id');
        if(!is_array($eavmgmtIDs)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select eavmgmt(s).'));
        } else {
            try {
                $eavmgmt = Mage::getModel('eavmgmt/eavmgmt');
                foreach ($eavmgmtIDs as $eavmgmtId) {
                    $eavmgmt->reset()
                        ->load($eavmgmtId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($eavmgmtIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}