<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Six extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/sixQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customer/customer')->getCollection();
        $collection->getSelect()
            ->joinLeft(
                array('o' => $collection->getTable('sales/order')),
                'e.entity_id = o.customer_id',
                array('order_count' => 'COUNT(o.entity_id)')
            )
            ->group('e.entity_id')
            ->order('order_count DESC');

        $collection->addAttributeToSelect('firstname');
        $collection->addAttributeToSelect('lastname');
        $collection->addAttributeToSelect('email');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }
    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
            'header'=> $this->__('Customer Id'),
            'index' => 'entity_id'
        ));
         
        $this->addColumn('firstname', array(
            'header'=> $this->__('Name'),
            'index' => 'firstname'
        ));   

        $this->addColumn('email', array(
            'header'=> $this->__('Email'),
            'index' => 'email',
        ));    

        $this->addColumn('order_count', array(
            'header' => Mage::helper('catalog')->__('Order Count'),
            'index' => 'order_count',
        ));

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}