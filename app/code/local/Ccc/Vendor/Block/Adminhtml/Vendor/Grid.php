<?php
 
class Ccc_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        $this->setDefaultSort('vendor_id');
        $this->setId('adminhtmlVendorGrid');
        $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

    }

    protected function _getCollectionClass()
    {
        return 'vendor/vendor_collection';
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('vendor_id',
            array(
                'header'=> $this->__('Vendor Id'),
                'index' => 'vendor_id'
            )
        );
         
        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );    

        $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'index' => 'email'
            )
        );       

        $this->addColumn('mobile',
            array(
                'header'=> $this->__('Mobile'),
                'index' => 'mobile'
            )
        );

        $this->addColumn('status',
            array(
                'header'=> $this->__('Status'),
                'index' => 'status',
                'renderer' => 'Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Renderer_Status'
            )
        );
        
        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created Date'),
                'index' => 'created_at',
            )
        );

        $this->addColumn('updated_at',
            array(
                'header'=> $this->__('Updated Date'),
                'index' => 'updated_at'
            )
        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('vendor')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('vendor')->__('Are you sure?')
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('vendor')->__('Update Status'),
            'url' => $this->getUrl('*/*/massStatus'),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('vendor')->__('Status'),
                    'values' => array(
                        array('value' => 1, 'label' => Mage::helper('vendor')->__('Active')),
                        array('value' => 0, 'label' => Mage::helper('vendor')->__('Not Active'))
                    )
                )
            )
        ));

        return $this;
    }





    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}