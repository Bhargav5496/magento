<?php

class Bhargav_Brand_Block_Adminhtml_Brand_Edit_Tab_Renderer_Brand extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        // echo "<pre>";
        // print_r($row->getData());die;
        $fileName = $row->image;

        $html = "<img src='http://127.0.0.1/2023/magento/magento-mirror/media/brand/".$fileName."' width=80 height=80>";

        return $html;
    }
}
