<?php

class Bhargav_Brand_Adminhtml_BrandController extends Mage_Adminhtml_Controller_Action
{
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('brand/manage');
    }

    public function preDispatch()
    {
        $this->_setForcedFormKeyActions(array('delete', 'massDelete'));
        return parent::preDispatch();
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_title($this->__("brand Grid"));
        $this->_setActiveMenu('brand/manage');
        $this->_addContent($this->getLayout()->createBlock('brand/adminhtml_brand'));
        $this->renderLayout();
    }


    public function newAction() {
        $this->_forward('edit');
    }   

    public function editAction() {
        $id = $this->getRequest()->getParam('id');
        if (!$model1 = Mage::getModel('brand/brand')->load($id)){
            $model1 = Mage::getModel('brand/brand');
        }
        

        if ($model1->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model1->setData($data);
        }
        
        Mage::register('brand_data', $model1);
        $this->loadLayout();
        $this->_setActiveMenu('brand/items');
        $this->_addContent($this->getLayout()->createBlock(' brand/adminhtml_brand_edit'))
            ->_addLeft($this->getLayout()->createBlock('brand/adminhtml_brand_edit_tabs'));
        $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brand')->__('Brand does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function saveAction()
    {
        try{

            if ($this->getRequest()->getParam('back')) {
                $this->_redirect('*/*/edit', array('id' => $model->getId()));
                return;
            }

            if ($data = $this->getRequest()->getPost()) {
                $brand = $data['brand'];
                $model = Mage::getModel('brand/brand');
                $model->setData($brand)
                    ->setId($this->getRequest()->getParam('id'))
                    ->saveImage('image', Mage::getBaseDir('media') . DS . 'brand')
                    ->saveImage('banner_image', Mage::getBaseDir('media') . DS . 'brand' . DS . 'banner')
                    ->addData(['url_key' => strtolower(str_replace(' ','-',$brand['name']))]);


                    if ($model->brand_id) {
                        $model->updated_at = date('Y-m-d H:i:s');
                    } else {
                        $model->created_at = date('Y-m-d H:i:s');
                    }
                    $model->save();
                // echo "<pre>";print_r($model);die;
                    
                    if ($model->brand_id) {
                        $model->saveRewriteUrlKey();
                    }
                    
                    Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('brand')->__('Brand was successfully saved'));
                    Mage::getSingleton('adminhtml/session')->setFormData(false);
                     
                    if ($this->getRequest()->getParam('back')) {
                        $this->_redirect('*/*/edit', array('id' => $model->getId()));
                        return;
                    }

                    $this->_redirect('*/*/');
                    return;
                }
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($brand);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('brand')->__('Unable to find item to save'));
        $this->_redirect('*/*/');
        }
    


    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('brand/brand');
                 
                $model->setId($this->getRequest()->getParam('id'))
                ->delete();
                 
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Brand was successfully deleted'));
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
        $fileName   = 'brands.csv';
        $content    = $this->getLayout()->createBlock('brand/adminhtml_brand_grid')
            ->getCsvFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    public function exportXmlAction()
    {
        $fileName   = 'brands.xml';
        $content    = $this->getLayout()->createBlock('brand/adminhtml_brand_grid')
            ->getExcelFile();

        $this->_prepareDownloadResponse($fileName, $content);
    }


    public function massDeleteAction()
    {
        $brandIDs = $this->getRequest()->getParam('brand_id');
        if(!is_array($brandIDs)) {
             Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select brand(s).'));
        } else {
            try {
                $brand = Mage::getModel('brand/brand');
                foreach ($brandIDs as $brandId) {
                    $brand->reset()
                        ->load($brandId)
                        ->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Total of %d record(s) were deleted.', count($brandIDs))
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }

        $this->_redirect('*/*/index');
    }

}