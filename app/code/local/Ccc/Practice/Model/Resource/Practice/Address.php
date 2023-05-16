<?php

class Ccc_Practice_Model_Resource_Practice_Address extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {  
        $this->_init('practice/practice_address', 'address_id');
    }  
}