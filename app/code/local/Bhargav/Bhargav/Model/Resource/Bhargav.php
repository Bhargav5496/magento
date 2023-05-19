<?php

class Bhargav_Bhargav_Model_Resource_Bhargav extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {  
        $this->_init('bhargav/bhargav', 'entity_id');
    }  
}