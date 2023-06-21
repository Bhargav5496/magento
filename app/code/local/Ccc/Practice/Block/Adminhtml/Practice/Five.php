<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Five extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
    {
        parent::__construct();
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }
    
    public function _prepareLayout()
    {
        $this->setChild('add_button',
            $this->getLayout()->createBlock('adminhtml/widget_button')
                ->setData( array(
            'label'     => $this->__('Show Query'),
            'onclick'   => 'setLocation(\'' . $this->getCreateUrl() . '\')',
            'class'     => 'add_button',
            ))
        );
        return parent::_prepareLayout();
    }

    public function getCreateUrl()
    {
        return $this->getUrl('*/*/fiveQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
     protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('catalog/product_collection');
        $collection->getSelect()
        ->joinLeft(
            array('g' => $collection->getTable('catalog/product_attribute_media_gallery')),
            'e.entity_id = g.entity_id',
            array('gallery_image_count' => 'COUNT(g.value_id)')
        )
        ->group('e.entity_id');
        $collection->addAttributeToSelect('sku');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $this->addColumn('sku', array(
            'header'=> $this->__('SKU'),
            'index' => 'sku'
        ));   

        $this->addColumn('gallery_image_count', array(
            'header'=> $this->__('Count'),
            'index' => 'gallery_image_count',
        ));    

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}