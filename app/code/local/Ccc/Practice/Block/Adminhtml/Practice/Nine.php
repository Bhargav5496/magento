<?php 
class Ccc_Practice_Block_Adminhtml_Practice_Nine extends Mage_Adminhtml_Block_Widget_Grid
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
        return $this->getUrl('*/*/nineQuery');
    }

    public function getMainButtonsHtml()
    {
        return $this->getChildHtml('add_button').parent::getMainButtonsHtml();
    }

   
    protected function _prepareCollection()
    {
       $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect('sku');

       $attributes = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('is_user_defined', 1)
            ->getItems();

        foreach ($attributes as $attribute) {
            $attributeCodes[] = $attribute->getAttributeCode();
        }

        $unassignedAttributes = array();

        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku');


        foreach ($products as $product) {
            $productId = $product->getId();
            $sku = $product->getSku();

            foreach ($attributeCodes as $attributeCode) {
                $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
                $attributeId = $attribute->getId();

                $resource = Mage::getResourceModel('catalog/product');
                $value = $resource->getAttributeRawValue($productId, $attributeCode, Mage::app()->getStore());

                if ($value === false || $value === null) {
                    $unassignedAttributes[] = array(
                        'product_id' => $productId,
                        'sku' => $sku,
                        'attribute_id' => $attributeId,
                        'attribute_code' => $attributeCode
                    );
                }
            }
        }

        $collection = new Varien_Data_Collection();

        foreach ($unassignedAttributes as $data) {
            $item = new Varien_Object($data);
            $collection->addItem($item);
        }

        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('product_id', array(
            'header'=> $this->__('Product Id'),
            'index' => 'product_id'
        ));
         
        $this->addColumn('sku', array(
            'header'=> $this->__('SKU'),
            'index' => 'sku'
        ));   

        $this->addColumn('attribute_id', array(
            'header'=> $this->__('Attribute Id'),
            'index' => 'attribute_id',
        ));    


        $this->addColumn('attribute_code', array(
            'header'=> $this->__('Attribute Code'),
            'index' => 'attribute_code',
        ));    

        return parent::_prepareColumns();
    }

    

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id'=>$row->getId()));
    }
}