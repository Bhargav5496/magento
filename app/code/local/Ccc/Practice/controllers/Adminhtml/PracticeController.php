<?php

class Ccc_Practice_Adminhtml_PracticeController extends Mage_Adminhtml_Controller_Action
{

    protected function _initAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('practice');
        $this->_title($this->__('Practice'));
        return $this;
    }

    public function oneAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('One Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_one'));
            // $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function oneQueryAction()
    {
        try{
            echo "<pre>";
            echo "1. Need a list of product with these columns product name, sku, cost, price, color.<br><br>";

            echo "<b>Core Query</b> : 

SELECT cp.entity_id, cpv.value AS name, cp.sku, cpc.value AS cost, cpd.value AS price, 
(SELECT value FROM eav_attribute_option_value WHERE option_id = cpi.value) as color
FROM catalog_product_entity AS cp 
LEFT JOIN catalog_product_entity_varchar AS cpv 
ON cp.entity_id = cpv.entity_id 
AND cpv.attribute_id = (SELECT e.attribute_id FROM eav_attribute AS e WHERE e.attribute_code = 'name' AND e.entity_type_id = (SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'))
LEFT JOIN catalog_product_entity_decimal AS cpd 
ON cp.entity_id = cpd.entity_id 
AND cpd.attribute_id = (SELECT e.attribute_id FROM eav_attribute AS e WHERE e.attribute_code = 'price' AND e.entity_type_id = (SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'))
LEFT JOIN catalog_product_entity_varchar AS cpc 
ON cp.entity_id = cpc.entity_id 
AND cpc.attribute_id = (SELECT e.attribute_id FROM eav_attribute AS e WHERE e.attribute_code = 'cost' AND e.entity_type_id = (SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'))
LEFT JOIN catalog_product_entity_int AS cpi 
ON cp.entity_id = cpi.entity_id 
AND cpi.attribute_id = (SELECT e.attribute_id FROM eav_attribute AS e WHERE e.attribute_code = 'color' AND e.entity_type_id = (SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'))
ORDER BY cp.entity_id;<br><br>";

            echo '<strong>core query in magento syntex: </strong>

            $resource = Mage::getSingleton("core/resource");
            $readConnection = $resource->getConnection("core_read");

            $tableName = $resource->getTableName("catalog/product");
            $select = $readConnection->select()
                ->from(array("p" => $tableName), array(
                    "sku" => "p.sku",
                    "name" => "pv.value",
                    "cost" => "pdc.value",
                    "price" => "pdp.value",
                    "color" => "pi.value",
                ))
                ->joinLeft(
                    array("pv" => $resource->getTableName("catalog_product_entity_varchar")),
                    "pv.entity_id = p.entity_id AND pv.attribute_id = 73",
                    array()
                )
                ->joinLeft(
                    array("pdc" => $resource->getTableName("catalog_product_entity_decimal")),
                    "pdc.entity_id = p.entity_id AND pdc.attribute_id = 182",
                    array()
                )
                ->joinLeft(
                    array("pdp" => $resource->getTableName("catalog_product_entity_decimal")),
                    "pdp.entity_id = p.entity_id AND pdp.attribute_id = 77",
                    array()
                )
                ->joinLeft(
                    array("pi" => $resource->getTableName("catalog_product_entity_int")),
                    "pi.entity_id = p.entity_id AND pi.attribute_id = 94",
                    array()
                )';

            echo "<br><br><b>Magento Query :</b> <br><br>";
            echo '$collection = Mage::getModel("catalog/product")->getCollection();<br>
        $collection->addAttributeToSelect("name")
            ->addAttributeToSelect("sku")
            ->addAttributeToSelect("cost")
            ->addAttributeToSelect("price")
            ->addAttributeToSelect("color");';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function twoAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Two Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_two'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function twoQueryAction()
    {
        try{
            echo "2. Need a list of attribute & options. return an array with attribute id, attribute code, option Id, option name.<br><br>";

            echo "Core Query : <br><br>";
            echo "SELECT a.attribute_id, a.attribute_code, ao.option_id, aov.value FROM eav_attribute AS a LEFT JOIN eav_attribute_option AS ao ON a.attribute_id = ao.attribute_id LEFT JOIN eav_attribute_option_value AS aov ON ao.option_id = aov.option_id WHERE a.entity_type_id = ( SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product' ) AND ao.option_id IS NOT NUll";

            echo "<br><br>Magento Query : <br><br>";
            print_r('$attributeCollection = Mage::getResourceModel("eav/entity_attribute_collection");
        <br>

        $attributeOptionCollection = Mage::getResourceModel("eav/entity_attribute_option_collection");
        <br>
        $attributeOptionCollection->getSelect()
            ->join(
                array("attribute" => $attributeCollection->getTable("eav/attribute")),
                "attribute.attribute_id = main_table.attribute_id",
                array("attribute_code" => "attribute.attribute_code")
            )
            ->join(
                array("option_value" => $attributeCollection->getTable("eav/attribute_option_value")),
                "option_value.option_id = main_table.option_id",
                array("value")
            );
        <br>

        $attributeOptionCollection->getSelect()->columns(array(
            "attribute_id" => "main_table.attribute_id",
            "attribute_code" => "attribute.attribute_code",
            "option_id" => "main_table.option_id",
        ));');


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function threeAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Three Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_three'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function threeQueryAction()
    {
        try{
            echo "3. Need a list of attribute having options count greater than 10. return array with attribute id, attribute code, option count. make query based on magento syntex wise and core query<br><br>";

            echo "Core Query : <br><br>";

            $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $subquery = $readConnection->select()
            ->from(
                array('opt' => $resource->getTableName('eav/attribute_option')),
                array('attribute_id', 'option_count' => new Zend_Db_Expr('COUNT(opt.option_id)'))
            )
            ->group('opt.attribute_id')
            ->having('option_count > ?', 10);

            $query = $readConnection->select()
            ->from(
                array('main_table' => $resource->getTableName('eav/entity_attribute')),
                array('attribute_id')
            )
            ->join(
                array('attr' => $resource->getTableName('eav/attribute')),
                'attr.attribute_id = main_table.attribute_id',
                array('attribute_code')
            )
            ->joinLeft(
                array('sub' => new Zend_Db_Expr('(' . $subquery . ')')),
                'sub.attribute_id = main_table.attribute_id',
                array('option_count' => 'sub.option_count')
            )
            ->where('sub.option_count > 10');

            echo $query->__toString();

            echo "<br><br>Magento Query : <br><br>";
            print_r('$attributeOptionCollection = Mage::getResourceModel("eav/entity_attribute_option_collection")
            ->addFieldToFilter("option_id", array("gt" => 0))
            ->getSelect()
            ->join(
                array("attribute" => Mage::getSingleton("core/resource")->getTableName("eav/attribute")),
                "attribute.attribute_id = main_table.attribute_id",
                array("attribute_code" => "attribute.attribute_code")
            )
            ->columns(array("option_count" => new Zend_Db_Expr("COUNT(main_table.option_id)")))
            ->group("main_table.attribute_id")
            ->having("option_count > ?", 10);<br>

            $resultCollection = Mage::getModel("eav/entity_attribute")->getCollection();<br>
            $resultCollection->getSelect()->reset()->from(array("main_table" => $attributeOptionCollection));');


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function fourAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Four Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_four'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function fourQueryAction()
    {
        try{
            echo "<pre>";
            echo "4. Need list of product with assigned images. return an array with product Id, sku, base image, thumb image, small image.<br><br>";

            echo "Core Query : SELECT 
                p.entity_id AS product_id,
                p.sku,
                i1.value AS base_image,
                i2.value AS thumb_image,
                i3.value AS small_image
            FROM 
                catalog_product_entity AS p
            LEFT JOIN 
                catalog_product_entity_varchar AS i1 ON (p.entity_id = i1.entity_id AND i1.attribute_id = (
                    SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'image' AND entity_type_id = (
                        SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'
                    )
                ))
            LEFT JOIN 
                catalog_product_entity_varchar AS i2 ON (p.entity_id = i2.entity_id AND i2.attribute_id = (
                    SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'thumbnail' AND entity_type_id = (
                        SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'
                    )
                ))
            LEFT JOIN 
                catalog_product_entity_varchar AS i3 ON (p.entity_id = i3.entity_id AND i3.attribute_id = (
                    SELECT attribute_id FROM eav_attribute WHERE attribute_code = 'small_image' AND entity_type_id = (
                        SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'
                    )
                ));
<br><br>";

            echo "<br><br>Magento Query : <br><br>";
            echo '$collection = Mage::getModel("catalog/product")->getCollection();
$collection->addAttributeToSelect("entity_id")
    ->addAttributeToSelect("sku")
    ->addAttributeToSelect("image")
    ->addAttributeToSelect("thumbnail")
    ->addAttributeToSelect("small_image")
    ->addAttributeToFilter("image", array("notnull" => true));
            ';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function fiveAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Five Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_five'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function fiveQueryAction()
    {
        try{
            echo "<pre>";
            echo "5. Need list of product with gallery image count. return an array with product sku, gallery images count, without consideration of thumb, small, base.<br><br>";

            echo "Core Query : SELECT 
                e.sku AS product_sku,
                COUNT(g.value_id) AS gallery_image_count
            FROM
                catalog_product_entity AS e
            LEFT JOIN
                catalog_product_entity_media_gallery AS g ON e.entity_id = g.entity_id
            GROUP BY
                e.entity_id;
<br><br>";

            echo "Magento Query : <br><br>";
            echo '$collection = Mage::getResourceModel("catalog/product_collection");
        $collection->getSelect()
        ->joinLeft(
            array("g" => $collection->getTable("catalog/product_attribute_media_gallery")),
            "e.entity_id = g.entity_id",
            array("gallery_image_count" => "COUNT(g.value_id)")
        )
        ->group("e.entity_id");
        $collection->addAttributeToSelect("sku");';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }
    public function sixAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Six Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_six'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function sixQueryAction()
    {
        try{
            echo "<pre>";
            echo "6. Need list of top to bottom customers with their total order counts. return an array with customer id, customer name, customer email, order count.<br><br>";

            echo "Core Query : SELECT c.entity_id, c.email, cv.value, COUNT(og.entity_id) AS count FROM customer_entity AS c 
LEFT JOIN customer_entity_varchar as cv ON cv.attribute_id = 5 AND cv.entity_id = c.entity_id
LEFT JOIN sales_flat_order_grid as og ON og.customer_id = c.entity_id
GROUP BY c.entity_id 
ORDER BY count DESC;<br><br>";

            echo "Magento Query : <br><br>";
            echo '$collection = Mage::getModel("customer/customer")->getCollection();
        $collection->getSelect()
            ->joinLeft(
                array("o" => $collection->getTable("sales/order")),
                "e.entity_id = o.customer_id",
                array("order_count" => "COUNT(o.entity_id)")
            )
            ->group("e.entity_id")
            ->order("order_count DESC");

        $collection->addAttributeToSelect("firstname");
        $collection->addAttributeToSelect("email");';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }
    public function sevenAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Seven Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_seven'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function sevenQueryAction()
    {
        try{
            echo "<pre>";
            echo "7. Need list of top to bottom customers with their total order counts, order status wise. return an array with customer id, customer name, customer email, status, order count.<br><br>";

            echo "Core Query : SELECT c.entity_id, cv.value, c.email, og.status, COUNT(og.entity_id) AS count 
FROM customer_entity AS c 
LEFT JOIN customer_entity_varchar as cv ON cv.attribute_id = (SELECT e.attribute_id FROM eav_attribute AS e WHERE e.attribute_code = 'firstname' AND e.entity_type_id = (SELECT et.entity_type_id FROM eav_entity_type AS et WHERE et.entity_type_code = 'catalog_product')) AND cv.entity_id = c.entity_id
LEFT JOIN sales_flat_order_grid as og ON og.customer_id = c.entity_id
GROUP BY c.entity_id
ORDER BY count DESC;;<br><br>";

            echo "Magento Query : <br><br>";
            echo '$collection = Mage::getModel("customer/customer")->getCollection()
            ->addAttributeToSelect("email");

        $collection->getSelect()
            ->joinLeft(
                array("cv" => Mage::getSingleton("core/resource")->getTableName("customer_entity_varchar")),
                "cv.attribute_id = 5 AND cv.entity_id = e.entity_id",
                array("firstname" => "cv.value")
            )
            ->joinLeft(
                array("og" => Mage::getSingleton("core/resource")->getTableName("sales_flat_order_grid")),
                "og.customer_id = e.entity_id",
                array("status" => "og.status", "count" => "COUNT(og.entity_id)")
            )
            ->group("e.entity_id")
            ->order("count DESC");';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }
    public function eightAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Eight Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_eight'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function eightQueryAction()
    {
        try{
            echo "<pre>";
            echo "8. Need list product with number of quantity sold till now for each. return an array with product id, sku, sold quantity.<br><br>";

            echo "Core Query : <br><br>";
            echo " SELECT p.entity_id, p.sku, o.qty_ordered 
FROM `catalog_product_entity` as p
LEFT JOIN sales_flat_order_item as o on o.product_id = p.entity_id 
WHERE o.qty_ordered IS NOT NULL;<br><br>";

            echo "Magento Query : <br><br>";
            echo '$collection = Mage::getResourceModel("sales/order_item_collection")
            ->addFieldToSelect(array("product_id", "sku"));

        $collection->getSelect()
            ->columns(array("sold_quantity" => "SUM(qty_ordered)"))
            ->group(array("product_id", "sku"));

        $this->setCollection($collection);';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function nineAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Nine Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_nine'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function nineQueryAction()
    {
        try{
            echo "<pre>";
            echo "9. Need list of those attributes for whose value is not assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code<br><br>";

            echo "Core Query : <br><br>";
            echo "SELECT
    e.entity_id AS product_id,
    e.sku AS sku,
    a.attribute_id,
    a.attribute_code
FROM
    eav_attribute AS a
CROSS JOIN
    catalog_product_entity AS e
LEFT JOIN
    catalog_product_entity_varchar AS v
    ON v.attribute_id = a.attribute_id
    AND v.entity_id = e.entity_id
LEFT JOIN
    catalog_product_entity_int AS i
    ON i.attribute_id = a.attribute_id
    AND i.entity_id = e.entity_id
LEFT JOIN
    catalog_product_entity_decimal AS d
    ON d.attribute_id = a.attribute_id
    AND d.entity_id = e.entity_id
LEFT JOIN
    catalog_product_entity_text AS t
    ON t.attribute_id = a.attribute_id
    AND t.entity_id = e.entity_id
WHERE
    (v.value IS NULL OR v.value = '')
    AND (i.value IS NULL OR i.value = '')
    AND (d.value IS NULL OR d.value = '')
    AND (t.value IS NULL OR t.value = '')
    AND a.entity_type_id = (
        SELECT entity_type_id FROM eav_entity_type WHERE entity_type_code = 'catalog_product'
    )
    AND a.is_user_defined = 1;<br><br>";

            echo "Magento Query : <br><br>";
            echo '$collection = Mage::getResourceModel("catalog/product_collection")
            ->addAttributeToSelect("sku");

       $attributes = Mage::getResourceModel("catalog/product_attribute_collection")
            ->addFieldToFilter("is_user_defined", 1)
            ->getItems();

        foreach ($attributes as $attribute) {
            $attributeCodes[] = $attribute->getAttributeCode();
        }

        $unassignedAttributes = array();

        $products = Mage::getModel("catalog/product")->getCollection()
            ->addAttributeToSelect("sku");


        foreach ($products as $product) {
            $productId = $product->getId();
            $sku = $product->getSku();

            foreach ($attributeCodes as $attributeCode) {
                $attribute = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attributeCode);
                $attributeId = $attribute->getId();

                $resource = Mage::getResourceModel("catalog/product");
                $value = $resource->getAttributeRawValue($productId, $attributeCode, Mage::app()->getStore());

                if ($value === false || $value === null) {
                    $unassignedAttributes[] = array(
                        "product_id" => $productId,
                        "sku" => $sku,
                        "attribute_id" => $attributeId,
                        "attribute_code" => $attributeCode
                    );
                }
            }
        }

        $collection = new Varien_Data_Collection();

        foreach ($unassignedAttributes as $data) {
            $item = new Varien_Object($data);
            $collection->addItem($item);
        }';
        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }


    public function tenAction()
    {
        try{
            $this->_initAction();
            $this->_title($this->__('Ten Query'));
            $this->_addContent($this->getLayout()->createBlock('practice/adminhtml_practice_ten'));
            $this->renderLayout();
        }catch(Exception $e){
             Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

    public function tenQueryAction()
    {
        try{
            echo "<pre>";
            echo "10. Need list of those attributes for whose value is assigned to product. return an array result product wise with these columns product Id, sku, attribute Id, attribute code, value.<br><br>";

            echo "Core Query : <br><br>";
            echo "SELECT cpe.entity_id AS product_id,
                cpe.sku,
                eav.attribute_id,
                eav.attribute_code,
                IF(eav.backend_type = 'int' OR eav.backend_type = 'decimal', eav_int.value, eav_varchar.value) AS value
            FROM
                catalog_product_entity AS cpe
            INNER JOIN
                eav_entity_type AS et ON et.entity_type_code = 'catalog_product' AND et.entity_type_id = cpe.entity_type_id
            INNER JOIN
                eav_attribute AS eav ON eav.entity_type_id = et.entity_type_id AND eav.is_user_defined = 1
            LEFT JOIN
                catalog_product_entity_int AS eav_int ON eav_int.attribute_id = eav.attribute_id AND eav_int.entity_id = cpe.entity_id
            LEFT JOIN
                catalog_product_entity_varchar AS eav_varchar ON eav_varchar.attribute_id = eav.attribute_id AND eav_varchar.entity_id = cpe.entity_id
            WHERE
                (eav_int.value IS NOT NULL OR eav_varchar.value IS NOT NULL);<br><br>";

            echo "Magento Query : <br><br>";
            echo '$attributes = Mage::getResourceModel("catalog/product_attribute_collection")
            ->addFieldToFilter("is_user_defined", 1)
            ->getItems();

        foreach ($attributes as $attribute) {
            $attributeCodes[] = $attribute->getAttributeCode();
        }


        $unassignedAttributes = array();

        $products = Mage::getModel("catalog/product")->getCollection();

        foreach ($products as $product) {
            $productId = $product->getId();
            $sku = $product->getSku();

            // echo "<pre>";print_r($products->getData());die;

            foreach ($attributeCodes as $attributeCode) {
                $attribute = Mage::getSingleton("eav/config")->getAttribute("catalog_product", $attributeCode);
                $attributeId = $attribute->getId();
                $value = $attribute->getSource()->getOptionText($product->getData($attributeCode));
                $resource = Mage::getResourceModel("catalog/product");
                $value = $resource->getAttributeRawValue($productId, $attributeCode, Mage::app()->getStore());

                if ($value) {
                    $unassignedAttributes[] = array(
                        "product_id" => $productId,
                        "sku" => $sku,
                        "attribute_id" => $attributeId,
                        "attribute_code" => $attributeCode,
                        "value" => $value
                    );
                }
            }
        }

        $collection = new Varien_Data_Collection();

        foreach ($unassignedAttributes as $data) {
            $item = new Varien_Object($data);
            $collection->addItem($item);
        }
';


        }catch(Exception $e){
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
    }

}