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
        $this->loadLayout();
        $this->_title($this->__("idx Grid"));
        $this->_setActiveMenu('idx/manage');
        $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx'));
        $this->renderLayout();
    }


    public function brandAction()
    {
        try{
            if(Mage::getModel('idx/idx')->updateTableColumn(Mage::getModel('brand/brand'), 'brand')){
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Brand successfully added.'));
            }else{
                throw new Exception("Brand Already exists.", 1);
            }
        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }

    public function collectionAction()
    {
        try{
            echo "<pre>";
            print_r(Mage::getModel('idx/idx_collection')->getCollection());
            die;
            if(Mage::getModel('idx/idx')->updateTableColumn(Mage::getModel('brand/brand'), 'brand')){
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Brand successfully added.'));
            }else{
                throw new Exception("Brand Already exists.", 1);
            }
        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/index');
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

    public function massDeleteAction()
    {
        $idxIDs = $this->getRequest()->getParam('idx');
        if(!is_array($idxIDs)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select idx(s).'));
        } else {
            try {
                $idx = Mage::getModel('idx/idx');
                foreach ($idxIDs as $idxId) {
                    $idx->load($idxId)->delete();
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