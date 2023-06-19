<?php

class Bhargav_Brand_Block_Adminhtml_Brand_Edit_Tab_Renderer_File extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $html = "<input type='file'>";

        return $html;
    }
}
