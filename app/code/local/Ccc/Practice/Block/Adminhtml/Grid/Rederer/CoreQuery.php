<?php 

class Practice_Block_Adminhtml_Grid_Renderer_CoreQuery extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	public function render(Varien_Object $row)
    {
        $productId = $row->getId();

        $url = $this->getUrl('practice/adminhtml_query/oneQuery', array('id' => $productId));
        $buttonHtml = '<button onclick="window.open(\'' . $url . '\', \'_blank\')">Core Query</button>';

        return $buttonHtml;
    }
}