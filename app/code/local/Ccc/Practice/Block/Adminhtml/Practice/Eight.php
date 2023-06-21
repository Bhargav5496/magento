<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Eight extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/eightQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
     protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('sales/order_item_collection')
            ->addFieldToSelect(array('product_id', 'sku'));

        $collection->getSelect()
            ->columns(array('sold_quantity' => 'SUM(qty_ordered)'))
            ->group(array('product_id', 'sku'));

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $this->addColumn('product_id', array(
            'header'=> $this->__('Product Id'),
            'index' => 'product_id'
        ));
         
        $this->addColumn('sku', array(
            'header'=> $this->__('SKU'),
            'index' => 'sku'
        ));   

        $this->addColumn('sold_quantity', array(
            'header'=> $this->__('Sold Quantity'),
            'index' => 'sold_quantity',
        ));    

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}