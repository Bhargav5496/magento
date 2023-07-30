<?php

class Ccc_Category_Model_Resource_Input_Practice extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {  
        $this->_init('category/input_practice', 'entity_id');
    }  
}