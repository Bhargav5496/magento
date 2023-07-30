<?php

class Ccc_Category_Block_Adminhtml_Category_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        return $row->getStatus() == '0' ? 'Inactive' : 'Active';
    }
}
