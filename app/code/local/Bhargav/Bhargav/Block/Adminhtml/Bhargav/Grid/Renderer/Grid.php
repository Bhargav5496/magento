<?php 

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Grid_Renderer_Grid extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
    {
        if($row->gender == 3){
            return 'Male';
        }else if($row->gender == 4){
            return 'Female';
        }else{
            return null;
        }
    }
}