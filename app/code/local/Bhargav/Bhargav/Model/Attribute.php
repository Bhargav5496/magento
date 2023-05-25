<?php

class Bhargav_Bhargav_Model_Attribute extends Mage_Eav_Model_Attribute
{
    const MODULE_NAME = 'Bhargav_Bhargav';
    protected $_eventObject = 'attribute';

    protected function _construct()
    {
        $this->_init('bhargav/attribute');
    }
}