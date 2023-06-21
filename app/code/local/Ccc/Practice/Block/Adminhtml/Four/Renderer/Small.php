<?php
class Ccc_Practice_Block_Adminhtml_Four_Renderer_Small extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract     
{
    
    function render($row)
    {
        $fileName = $row->getSmallImage();
        $filePath = Mage::getBaseUrl('media').'catalog/product'.$fileName;
        return "<img src='$filePath' alt='img' width='50' height='60'>";
    }
}