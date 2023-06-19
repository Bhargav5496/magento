<?php 

class Ccc_Practice_Block_Adminhtml_One extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct()
    {
        parent::__construct();
        $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->addAttributeToSelect('name')
            ->addAttributeToSelect('sku')
            ->addAttributeToSelect('cost')
            ->addAttributeToSelect('price')
            ->addAttributeToSelect('color');

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('name',
            array(
                'header'=> $this->__('Product Name'),
                'index' => 'name'
            )
        );
         
        $this->addColumn('sku',
            array(
                'header'=> $this->__('SKU'),
                'index' => 'sku'
            )
        );   

        $this->addColumn('cost',
            array(
                'header'=> $this->__('Cost'),
                'index' => 'cost'
            )
        );    

        $this->addColumn('price', array(
            'header' => Mage::helper('catalog')->__('Price'),
            'index' => 'price',
        ));

        $this->addColumn('color', array(
            'header' => Mage::helper('catalog')->__('Color'),
            'index' => 'color',
        ));

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}