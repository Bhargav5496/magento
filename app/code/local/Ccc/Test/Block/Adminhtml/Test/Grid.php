<?php

class Ccc_Test_Block_Adminhtml_Test_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('test_id');
        $this->setId('adminhtmlTestGrid');
        // $this->setUseAjax(true);
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('test/test')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('test_id',
            array(
                'header' => $this->__('Test Id'),
                'index'  => 'test_id',
            )
        );

        $this->addColumn('title',
            array(
                'header' => $this->__('Title'),
                'index'  => 'title',
                'type'   => 'text',
            )
        );

        $this->addColumn('status', array(
            'header'  => $this->__('Status'),
            'index'   => 'status',
            'type'    => 'options',
            'options' => ['1' => "Active", '0' => 'Inactive'],
        ));

        $this->addColumn('price',
            array(
                'header' => $this->__('Price'),
                'index'  => 'price',
                'type'   => 'number',
            )
        );

        $this->addColumn('created_at',
            array(
                'header' => $this->__('Created At'),
                'index'  => 'created_at',
                'type'   => 'datetime',
            )
        );

        $this->addExportType('*/*/exportCsv', Mage::helper('test')->__('CSV'));
        $this->addExportType('*/*/exportXml', Mage::helper('test')->__('Excel XML'));
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('test_id');
        $this->getMassactionBlock()->setFormFieldName('test_id');

        $this->getMassactionBlock()->addItem('delete', array(
            'label'   => Mage::helper('catalog')->__('Delete'),
            'url'     => $this->getUrl('*/*/massDelete'),
            'confirm' => Mage::helper('catalog')->__('Are you sure?'),
        ));

        $this->getMassactionBlock()->addItem('status', array(
            'label'      => Mage::helper('catalog')->__('Change Status'),
            'url'        => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'confirm'    => Mage::helper('catalog')->__('Are you sure?'),
            'additional' => array(
                'status' => array(
                    'name'   => 'status',
                    'type'   => 'select',
                    'class'  => 'required-entry',
                    'label'  => Mage::helper('catalog')->__('Status'),
                    'values' => array(
                        array(
                            'value' => 1,
                            'label' => Mage::helper('catalog')->__('Active'),
                        ),
                        array(
                            'value' => 0,
                            'label' => Mage::helper('catalog')->__('Inactive'),
                        ),
                    ),
                ),
            ),
        ));

        return parent::_prepareMassaction();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
