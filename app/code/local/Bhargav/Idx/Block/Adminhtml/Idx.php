<?php
 
class Bhargav_Idx_Block_Adminhtml_Idx extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'idx';
        $this->_controller = 'adminhtml_idx';
        $this->_headerText = Mage::helper('idx')->__('Manage Idxs');

        $this->_addButton('importCsv',array(
            'label' => Mage::helper('idx')->__('Import Csv'),
            'onclick' => "setLocation('{$this->getUrl('*/*/edit')}')",
            'class' => 'import'
        ));


        $this->_addButton('brand',array(
            'label' => Mage::helper('idx')->__('Brand'),
            'onclick' => "location.href='".$this->getUrl("*/*/brand")."'"
        ));


        $this->_addButton('collection',array(
            'label' => Mage::helper('idx')->__('Collection'),
            'onclick' => "location.href='".$this->getUrl("*/*/collection")."'"
        ));


        $this->_addButtonLabel = Mage::helper('idx')->__('Product');
        parent::__construct();
    }
}