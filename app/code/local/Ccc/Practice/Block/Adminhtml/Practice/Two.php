<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Two extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/twoQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
     protected function _prepareCollection()
    {
       $attributeCollection = Mage::getResourceModel('eav/entity_attribute_collection');

        $attributeOptionCollection = Mage::getResourceModel('eav/entity_attribute_option_collection');

        $attributeOptionCollection->getSelect()
            ->join(
                array('attribute' => $attributeCollection->getTable('eav/attribute')),
                'attribute.attribute_id = main_table.attribute_id',
                array('attribute_code' => 'attribute.attribute_code')
            );

        $attributeOptionCollection->getSelect()->columns(array(
            'attribute_id' => 'main_table.attribute_id',
            'attribute_code' => 'attribute.attribute_code',
            'option_id' => 'main_table.option_id',
        ));



        $this->setCollection($attributeOptionCollection);

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
        // echo '<pre>';print_r($attributeOptionCollection);die;
         
        $this->addColumn('attribute_code',
            array(
                'header'=> $this->__('Attribute Code'),
                'index' => 'attribute_code'
            )
        );   

        $this->addColumn('option_id',
            array(
                'header'=> $this->__('Option Id'),
                'index' => 'option_id'
            )
        );    

        $this->addColumn('option_name', array(
            'header' => Mage::helper('catalog')->__('Option Value'),
            'index' => 'option_name',
            'renderer' => 'Ccc_Practice_Block_Adminhtml_Two_Renderer_Value'
        ));

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}