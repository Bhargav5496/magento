<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Four extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/fourQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
     protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('entity_id')
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('image')
            ->addAttributeToSelect('thumbnail')
            ->addAttributeToSelect('small_image')
            ->addAttributeToFilter('image', array('notnull' => true));

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'=> $this->__('Product Id'),
            'index' => 'entity_id'
        ));
         
        $this->addColumn('sku', array(
            'header'=> $this->__('SKU'),
            'index' => 'sku'
        ));   

        $this->addColumn('base_image', array(
            'header'=> $this->__('Base Image'),
            'index' => 'base_image',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Four_Renderer_Base'
        ));    

        $this->addColumn('thumb_image', array(
            'header' => Mage::helper('catalog')->__('Thumb Image'),
            'index' => 'thumb_image',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Four_Renderer_thumb'
        ));

        $this->addColumn('small_image', array(
            'header' => Mage::helper('catalog')->__('Small Image'),
            'index' => 'small_image',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Four_Renderer_small'
        ));

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}