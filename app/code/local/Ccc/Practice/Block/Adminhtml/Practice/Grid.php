<?php
 
class Ccc_Practice_Block_Adminhtml_Practice_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setDefaultSort('practice_id');
        $this->setId('adminhtmlPracticeGrid');
        $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _getCollectionClass()
    {
        return 'practice/practice_collection';
    }
     
    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
         
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('practice_id',
            array(
                'header'=> $this->__('practice_id'),
                'align' =>'right',
                'width' => '50px',
                'index' => 'practice_id'
            )
        );
         
        $this->addColumn('first_name',
            array(
                'header'=> $this->__('First Name'),
                'index' => 'first_name'
            )
        );    

        $this->addColumn('last_name',
            array(
                'header'=> $this->__('Last Name'),
                'index' => 'last_name'
            )
        );       

        $this->addColumn('email',
            array(
                'header'=> $this->__('Email'),
                'index' => 'email'
            )
        );         

        $this->addColumn('gender',
            array(
                'header'=> $this->__('Gender'),
                'index' => 'gender'
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
                'index' => 'status'
            )
        );

        $this->addColumn('company',
            array(
                'header'=> $this->__('Company'),
                'index' => 'company'
            )
        );

        $this->addColumn('created_at',
            array(
                'header'=> $this->__('Created Date'),
                'index' => 'created_at'
            )
        );

        $this->addColumn('updated_at',
            array(
                'header'=> $this->__('Updated Date'),
                'index' => 'updated_at'
            )
        );

        // $this->addColumn('action',
        //     array(
        //         'header'    =>  Mage::helper('vendor')->__('Action'),
        //         'width'     => '100',
        //         'type'      => 'action',
        //         'getter'    => 'getId',
        //         'actions'   => array(
        //             array(
        //                 'caption'   => Mage::helper('vendor')->__('Edit'),
        //                 'url'       => array('base'=> '*/*/edit'),
        //                 'field'     => 'id'
        //             )
        //         ),
        //         'filter'    => false,
        //         'sortable'  => false,
        //         'index'     => 'stores',
        //         'is_system' => true,
        // ));

        // $this->addExportType('*/*/exportCsv', Mage::helper('vendor')->__('CSV'));
        // $this->addExportType('*/*/exportXml', Mage::helper('vendor')->__('Excel XML'));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('practice_id');
        $this->getMassactionBlock()->setFormFieldName('practice_id');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('practice')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('practice')->__('Are you sure?')
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