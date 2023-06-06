<?php
class Bhargav_Banner_Model_Banner extends Mage_Core_Model_Abstract
{
	function __construct()
	{
		$this->_init('banner/banner');
	}

	public function getGroupKey()
	{
		$group = Mage::getModel('banner/group')->load($this->group_id);
		return $group->group_key;
	}

	public function getHeight()
	{
		$grp = Mage::getModel('banner/group')->load($this->group_id);
		if($grp->height < 100){
			return 100;
		}
		return $grp->height;
	}


	public function getWidth()
	{
		$grp = Mage::getModel('banner/group')->load($this->group_id);
		if($grp->width < 200){
			return 200;
		}
		return $grp->height;
	}

}	