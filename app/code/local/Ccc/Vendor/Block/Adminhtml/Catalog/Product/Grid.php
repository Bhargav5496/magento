<?php

class Ccc_Vendor_Block_Adminhtml_Catalog_Product_Grid extends Mage_Adminhtml_Block_Catalog_Product_Grid
{
    
    protected function _prepareColumns()
    {

        $columns = parent::_prepareColumns();

        $this->removeColumn('name');

        return $columns;
    }
}
