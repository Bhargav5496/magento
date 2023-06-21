<?php
class Ccc_Practice_Block_Adminhtml_Practice extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'practice';
        $this->_controller = 'adminhtml_practice';
        $this->_headerText = Mage::helper('practice')->__('Manage Practice');
        parent::__construct();
        $this->_removeButton('add');
    }

    protected function _prepareLayout()
    {
        $this->_addButton('query',array(
            'label' => Mage::helper('practice')->__('Query'),
            'onclick' => "setLocation('{$this->getUrl('*/*/one')}')",
        ));
    }
}