<?php

class Bhargav_Eavmgmt_Block_Adminhtml_eavmgmt_Grid extends Mage_Eav_Block_Adminhtml_Attribute_Grid_Abstract
{
  
   protected function _prepareCollection()
    {
        $this->setId('eavmgmtAdminhtmleavmgmtGrid');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('ASC');
        $collection = Mage::getResourceModel('eavmgmt/eavmgmt_collection');
        $this->setCollection($collection);
        return parent::_prepareCollection();

    }

    protected function _prepareColumns()
    {
        // echo "<pre>";
        // print_r(Mage::getModel('eav/entity_attribute')->getCollection()->getData);
        // echo Mage::getModel('eav/entity_attribute')
        //                     ->getCollection()
        //                     ->addFieldToFilter('frontend_input', 'select');
        // die;
        $this->addColumn('attribute_id', array(
            'header'=>Mage::helper('eavmgmt')->__('Attribute Id'),
            'index'=>'attribute_id',
        ));

        $this->addColumn('entity_type_code', array(
            'header'=>Mage::helper('eavmgmt')->__('Entity Type'),
            'index'=>'entity_type_code',
        ));        

        parent::_prepareColumns();


        $baseUrl = $this->getUrl();


         $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('eavmgmt')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'renderer'  => 'Bhargav_Eavmgmt_Block_Adminhtml_eavmgmt_Grid_Renderer_ShowOption',
                // 'actions'   => array(
                //     array(
                //         'caption'   => Mage::helper('eavmgmt')->__('show options'),
                //         'url'       => array('base'=> '*/*/showoption'),
                //         'field'     => 'eavmgmt_id',
                //         // 'ifconfig'  => $this->getStatus()
                //     )
                // ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));

        return $this;

    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('eavmgmt_id' => $row->getId()));
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('attribute_id');
        $this->getMassactionBlock()->setFormFieldName('attribute_id');
        $this->getMassactionBlock()->addItem('import_attribute', array(
             'label'    => Mage::helper('eavmgmt')->__('Export Attributes'),
             'url'      => $this->getUrl('*/*/selectedExport'),
             'confirm'  => Mage::helper('eavmgmt')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('import_attribute_options', array(
             'label'    => Mage::helper('eavmgmt')->__('Export Options'),
             'url'      => $this->getUrl('*/*/selectedExportOptions'),
             'confirm'  => Mage::helper('eavmgmt')->__('Are you sure?')
        ));
        return $this;
    }  
   
}