<?php
class Ccc_Test_Block_View extends Mage_Core_Block_Template
{
    public function __construct()
    {
    }

    protected function getCollection()
    {
        return Mage::getModel('test/test')->getCollection();
    }

}
