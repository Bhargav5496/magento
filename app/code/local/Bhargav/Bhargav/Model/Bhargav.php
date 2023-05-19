<?php 

/**
 * 
 */
class Bhargav_Bhargav_Model_Bhargav extends Mage_Core_Model_Abstract
{
    protected $attributes;
    const ENTITY = 'bhargav';
    
	protected function _construct()
    {  
        $this->_init('bhargav/bhargav');
    }  

    public function reset()
    {
        $this->setData(array());
        $this->setOrigData();
        $this->_attributes = null;

        return $this;
    }
}