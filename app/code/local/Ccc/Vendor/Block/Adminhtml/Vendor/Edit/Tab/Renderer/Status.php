<?php

class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Renderer_Status extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if($row->status == '1'){
            return 'Active';
        }else{
            return 'Not Active';
        }
    }
}
