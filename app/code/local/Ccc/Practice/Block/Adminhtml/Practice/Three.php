<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Three extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/threeQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
    protected function _prepareCollection()
    {
       $attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection')
            ->addFieldToFilter('option_id', array('gt' => 0))
            ->getSelect()
            ->join(
                array('attribute' => Mage::getSingleton('core/resource')->getTableName('eav/attribute')),
                'attribute.attribute_id = main_table.attribute_id',
                array('attribute_code' => 'attribute.attribute_code')
            )
            ->columns(array('option_count' => new Zend_Db_Expr('COUNT(main_table.option_id)')))
            ->group('main_table.attribute_id')
            ->having('option_count > ?', 10);

        $resultCollection = Mage::getModel('eav/entity_attribute')->getCollection();
        $resultCollection->getSelect()->reset()->from(array('main_table' => $attributeOptionCollection));
        $this->setCollection($resultCollection);

        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {
        $this->addColumn('attribute_id',
            array(
                'header'=> $this->__('Attribute Id'),
                'index' => 'attribute_id'
            )
        );
         
        $this->addColumn('attribute_code',
            array(
                'header'=> $this->__('Attribute Code'),
                'index' => 'attribute_code'
            )
        );   

        $this->addColumn('option_count',
            array(
                'header'=> $this->__('Option Count'),
                'index' => 'option_count'
            )
        );    

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}