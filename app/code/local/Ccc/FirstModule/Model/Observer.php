<?php 

class Ccc_FirstModule_Model_Observer{
	
	public function logUpdate(Varient_Event_Observer $observer)
	{
		$product = $observer->getEvent()->getProduct();
		$name = $product->getName();
		$sku = $product->getSku();

		Mage::log(
		"{$name} ({$sku}) updated",
		null, 
		'product-updates.log'
		);
	}
}

?>