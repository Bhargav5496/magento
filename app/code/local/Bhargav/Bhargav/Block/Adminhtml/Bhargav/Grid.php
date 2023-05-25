<?php 

class Bhargav_Bhargav_Block_Adminhtml_Bhargav_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	public function __construct(){
		parent::__construct();
		$this->setId('bhargavId');
		$this->setDefaultSort('entity_Id');
		$this->setDeafultDir('DESC');
		$this->setSaveParametersInSession(true);
		$this->setVarNameFilter('bhargav_filter');
	}

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('bhargav/bhargav')->getCollection()
            ->addAttributeToSelect('firstname')
            ->addAttributeToSelect('lastname')
            ->addAttributeToSelect('email')
            ->addAttributeToSelect('phoneNo')
            ->addAttributeToSelect('gender')
            ->addAttributeToSelect('price_attribute');

        $adminStore = Mage_Core_Model_App::ADMIN_STORE_ID;
       
        $collection->joinAttribute(
            'id',
            'bhargav/entity_id',
            'entity_id',
            null,
            'inner',
            $adminStore
        );

        $this->setCollection($collection);
        parent::_prepareCollection();
        return $this;
    }

	protected function _prepareColumns()
    {
        $this->addColumn('id',
            array(
                'header' => Mage::helper('bhargav')->__('id'),
                'width'  => '50px',
                'index'  => 'id',
            ));
        $this->addColumn('firstname',
            array(
                'header' => Mage::helper('bhargav')->__('First Name'),
                'width'  => '50px',
                'index'  => 'firstname',
            ));

        $this->addColumn('lastname',
            array(
                'header' => Mage::helper('bhargav')->__('Last Name'),
                'width'  => '50px',
                'index'  => 'lastname',
            ));

        $this->addColumn('email',
            array(
                'header' => Mage::helper('bhargav')->__('Email'),
                'width'  => '50px',
                'index'  => 'email',
            ));

        $this->addColumn('gender',
            array(
                'header' => Mage::helper('bhargav')->__('Gender'),
                'width'  => '50px',
                'index'  => 'gender',
                'renderer'  => 'Bhargav_Bhargav_Block_Adminhtml_Bhargav_Grid_Renderer_Grid',
            ));
        
        parent::_prepareColumns();
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array(
            'id'    => $row->getId())
        );
    }
}