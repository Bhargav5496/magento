<?php
 
class Bhargav_Brand_Block_Adminhtml_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
         
        $this->setDefaultSort('brand_id');
        $this->setId('adminhtmlBrandGrid');
        $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);

    }

    protected function _getCollectionClass()
    {
        return 'brand/brand_collection';
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('brand_id',
            array(
                'header'=> $this->__('Brand Id'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'brand_id'
            )
        );
         
        $this->addColumn('name',
            array(
                'header'=> $this->__('Name'),
                'index' => 'name'
            )
        );   

        $this->addColumn('url_key',
            array(
                'header'=> $this->__('Url Key'),
                'index' => 'url_key'
            )
        );    

        $this->addColumn('sort_order',
            array(
                'header'=> $this->__('Sort Order'),
                'index' => 'sort_order'
            )
        );    

        $this->addColumn('image',
            array(
                'header'=> $this->__('Image'),
                'index' => 'image',
                'renderer'  => 'Bhargav_Brand_Block_Adminhtml_Brand_Edit_Tab_Renderer_Brand'
            )
        );   

        $this->addColumn('description',
            array(
                'header'=> $this->__('Description'),
                'index' => 'description'
            )
        );       


        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created At'),
                'index' => 'created_at'
            )
        );

        $this->addColumn('updated_at',
            array(
                'header'=> $this->__('Updated At'),
                'index' => 'updated_at'
            )
        );

        

        // $this->addColumn('action',
        //     array(
        //         'header'    =>  Mage::helper('brand')->__('Action'),
        //         'width'     => '100',
        //         'type'      => 'action',
        //         'getter'    => 'getId',
        //         'actions'   => array(
        //             array(
        //                 'caption'   => Mage::helper('brand')->__('Edit'),
        //                 'url'       => array('base'=> '*/*/edit'),
        //                 'field'     => 'id'
        //             )
        //         ),
        //         'filter'    => false,
        //         'sortable'  => false,
        //         'index'     => 'stores',
        //         'is_system' => true,
        // ));

        // $this->addExportType('*/*/exportCsv', Mage::helper('brand')->__('CSV'));
        // $this->addExportType('*/*/exportXml', Mage::helper('brand')->__('Excel XML'));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('brand_id');
        $this->getMassactionBlock()->setFormFieldName('brand_id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('brand')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('brand')->__('Are you sure?')
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