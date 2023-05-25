<?php
class Bhargav_Bhargav_Model_Resource_Bhargav_Collection extends Mage_Catalog_Model_Resource_Collection_Abstract
{
	public function __construct()
	{
		$this->setEntity('bhargav');
		parent::__construct();	
	}
}