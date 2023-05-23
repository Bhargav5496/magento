<?php 

/**
 * 
 */
class Ccc_Vendor_Model_Observer extends Varien_Event_Observer
{
	protected function _construct()
    {  
    }  

    public function saveVendorObserver($observer)
    {
        $event = $observer->getEvent();    
        $model = $event->getModel();
        print_r($model->getData());
        die('test');
    }
}