<?php 
class Bhargav_Bhargav_Model_Resource_Bhargav extends Mage_Eav_Model_Entity_Abstract
{
	const ENTITY = 'bhargav';
	public function __construct()
	{
		$this->setType(self::ENTITY)
			 ->setConnection('core_read', 'core_write');
	   parent::__construct();
    }
}
