<?php
 
class Bhargav_Idx_Block_Adminhtml_Idx_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        $this->setDefaultSort(`index`);
        $this->setId('adminhtmlIdxGrid');
        $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

    }

    protected function _getCollectionClass()
    {
        return 'idx/idx_collection';
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('idx/idx')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();

    }

    protected function _prepareColumns()
    {
         $this->addColumn('index', array(
            'header'    => Mage::helper('idx')->__('Index'),
            'align'     => 'left',
            'index'     => 'index',
        ));

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('idx')->__('Product Id'),
            'align'     => 'left',
            'index'     => 'product_id'
        ));
        $this->addColumn('sku', array(
            'header'    => Mage::helper('idx')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('idx')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));
        $this->addColumn('price', array(
            'header'    => Mage::helper('idx')->__('Price'),
            'align'     => 'left',
            'index'     => 'price',
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('idx')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));
        $this->addColumn('quantity', array(
            'header'    => Mage::helper('idx')->__('Quantity'),
            'align'     => 'left',
            'index'     => 'quantity',
        ));

        $this->addColumn('brand', array(
            'header'    => Mage::helper('idx')->__('Brand'),
            'align'     => 'left',
            'index'     => 'brand'
        ));
          $this->addColumn('brand_id', array(
            'header'    => Mage::helper('idx')->__('Brand Id'),
            'align'     => 'left',
            'index'     => 'brand_id'
        ));
        $this->addColumn('collection', array(
            'header'    => Mage::helper('idx')->__('Collection'),
            'align'     => 'left',
            'index'     => 'collection',
        ));

        $this->addColumn('collection_id', array(
            'header'    => Mage::helper('idx')->__('Collection Id'),
            'align'     => 'left',
            'index'     => 'collection_id'
        ));
         $this->addColumn('description', array(
            'header'    => Mage::helper('idx')->__('Description'),
            'align'     => 'left',
            'index'     => 'description',
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('idx')->__('Status'),
            'align'     => 'left',
            'index'     => 'status'
        ));


        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('idx');
        $this->getMassactionBlock()->setFormFieldName('idx');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('idx')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('idx')->__('Are you sure?')
        ));

        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current'=> true));
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}