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

    public function editAction() {
        $id = $this->getRequest()->getParam('index');
            $this->loadLayout();
            $this->_setActiveMenu('idx/items');
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item Manager'), Mage::helper('adminhtml')->__('Item Manager'));
            $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Item News'), Mage::helper('adminhtml')->__('Item News'));
            $this->_addContent($this->getLayout()->createBlock('idx/adminhtml_idx_edit'))
                ->_addLeft($this->getLayout()
                    ->createBlock('idx/adminhtml_idx_edit_tabs'));
            $this->renderLayout();
    }

    public function importCsvAction()
    {
        try { 
            Mage::getModel('idx/idx')->truncate();
            $csvFile = $_FILES['import_options']['tmp_name'];
            $csvData = file_get_contents($csvFile);
            $csvData = array();

            if (($handle = fopen($csvFile, 'r')) !== false) {
                while (($data = fgetcsv($handle)) !== false) {
                    $row = array();
                    foreach ($data as $value) {
                        $row[] = $value;
                    }
                    $csvData[] = $row;
                }
                  fclose($handle);
            }

            $header = [];
            $idxModel = Mage::getModel('idx/idx');
            foreach ($csvData as $value)
            {
                if(!$header)
                {
                    $header = $value;
                }
                else
                {
                    $data = array_combine($header,$value);
                    $idxModel->insertOnDuplicate($data, array_keys($data));
                }
            }

            Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('idx')->__('Data Imported successfully.'));
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/adminhtml_idx/index'); 
    }



    public function brandAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');       
            $idxCollection = $idx->getCollection();
            $idxCollectionArray = $idx->getCollection()->getData();

            $idxBrandId = array_column($idxCollectionArray,'index');
            $idxBrandNames = array_column($idxCollectionArray,'brand');
            $idxBrandNames = array_combine($idxBrandId,$idxBrandNames);
            
            $newBrands = $idx->updateBrandTable(array_unique($idxBrandNames));
            $idxCollection = $idx->getCollection();
            foreach ($idxCollection as $idx) {
                if(!$idx->brand_id)
                {
                    $brand = Mage::getModel('brand/brand');
                    $brandCollection = Mage::getModel('brand/brand')->getCollection();
                    $brandCollection->getSelect()->where('main_table.name=?',$idx->brand);
                    $brandData = $brandCollection->getData();
                    $resource = Mage::getSingleton('core/resource');
                    $connection = $resource->getConnection('core_write');
                    $tableName = $resource->getTableName('import_product_idx');
                    $condition = '`index` = '.$idx->index;
                    $query = "UPDATE `{$tableName}` SET `brand_id` = {$brandData[0]['brand_id']} WHERE {$condition}";
                    $connection->query($query); 
                }
            }
            Mage::getSingleton('adminhtml/session')->addSuccess('Brand is fine now');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        $this->_redirect('*/*/index');
    }

    public function collectionAction()
    {
        try {
            $idx = Mage::getModel('idx/idx');  
            $idxCollection = $idx->getCollection();     
            $idxCollectionData = $idx->getCollection()->getData();

            $idxCollectionNames = array_column($idxCollectionData,'collection');
            $newCollections = $idx->updateCollectionOption(array_unique($idxCollectionNames));

            $resource = Mage::getSingleton('core/resource');
            $writeAdapter = $resource->getConnection('core_write');

            $idxTable = $resource->getTableName('idx/idx');
            $optionValueTable = $resource->getTableName('eav_attribute_option_value');

            $updateQuery = "
                UPDATE {$idxTable} p
                JOIN (
                    SELECT option_id,value
                    FROM {$optionValueTable}
                ) o ON p.`collection` = o.`value`
                SET p.`collection_id` = o.`option_id`
            ";

            $writeAdapter->query($updateQuery);
    
            Mage::getSingleton('adminhtml/session')->addSuccess('Collection is fine now');
        } catch (Exception $e) {
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
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