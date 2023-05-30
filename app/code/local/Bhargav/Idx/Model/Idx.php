<?php 

/**
 * 
 */
class Bhargav_Idx_Model_Idx extends Mage_Core_Model_Abstract
{
	protected function _construct()
    {  
        $this->_init('idx/idx');
    }  

    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
}