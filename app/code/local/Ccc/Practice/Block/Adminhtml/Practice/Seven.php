<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Seven extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/sevenQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect('email');

        $collection->getSelect()
            ->joinLeft(
                array('cv' => Mage::getSingleton('core/resource')->getTableName('customer_entity_varchar')),
                'cv.attribute_id = 5 AND cv.entity_id = e.entity_id',
                array('firstname' => 'cv.value')
            )
            ->joinLeft(
                array('og' => Mage::getSingleton('core/resource')->getTableName('sales_flat_order_grid')),
                'og.customer_id = e.entity_id',
                array('status' => 'og.status', 'count' => 'COUNT(og.entity_id)')
            )
            ->group('e.entity_id')
            ->order('count DESC');

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
            'header'=> $this->__('Customer Name'),
            'index' => 'firstname'
        ));   

        $this->addColumn('email', array(
            'header'=> $this->__('Customer Email'),
            'index' => 'email',
        ));    

        $this->addColumn('status', array(
            'header' => Mage::helper('catalog')->__('Status'),
            'index' => 'status',
        ));

        $this->addColumn('count', array(
            'header' => Mage::helper('catalog')->__('Order Count'),
            'index' => 'count',
        ));

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}