<?php 

class Ccc_Test_Model_Test extends Mage_Core_Model_Abstract
{
	protected function _construct()
    {  
        $this->_init('test/test');
    }  

    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
}