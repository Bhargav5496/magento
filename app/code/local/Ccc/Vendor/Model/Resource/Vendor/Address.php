<?php

class Ccc_Vendor_Model_Resource_Vendor_Address extends Mage_Core_Model_Resource_Db_Abstract
{
    protected $primaryKey = 'vendor_id';

    protected function _construct()
    {  
        $this->_init('vendor/vendor_address', $this->primaryKey);
    }  

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
        $this->_init('vendor/vendor_address', $primaryKey);
        return $this;
    }
}