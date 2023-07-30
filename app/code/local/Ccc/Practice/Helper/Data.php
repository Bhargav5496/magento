<?php

class Ccc_Practice_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function __construct()
    {
    }

    public function getColumns()
    {
        return Mage::getConfig()->getNode('export_ccc/columns')->asArray();
    }

    public function getFilters()
    {
        return Mage::getConfig()->getNode('export_ccc/filters')->asArray();
    }

    public function generateData()
    {
        $columns = $this->getColumns();

        $fields = [];
        foreach ($columns as $key => $value) {
            $fields[] = $key . " AS " . $value;
        }

        $filters   = $this->getFilters();
        $filterArr = [];
        foreach ($filters as $field => $value) {
            $filterArr[] = $field . ' ' . $value['operator'] . " '" . $value['value'] . "'";
        }

        $filterStr = implode($filterArr, " AND ");

        $collection = Mage::getModel('catalog/product')->getCollection();
        $collection->getSelect()
            ->reset(Varien_Db_Select::COLUMNS)
            ->columns($fields)->where($filterStr);
        return $collection->getData();
    }

    public function generateDataMethod2()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        $fields     = [];

        $columns = $this->getColumns();
        foreach ($columns as $key => $value) {
            $fields[] = $key;
        }

        $filters = $this->getFilters();
        foreach ($filters as $field => $arr) {
            $operator = $arr['operator'];
            $value    = $arr['value'];
            $collection->addFieldToFilter($field, [$operator => $value]);
        }
 
        $collection->getSelect()
            ->reset(Zend_Db_Select::COLUMNS)
            ->columns($fields);

        return $collection->getData();
        // echo '<pre>';print_r($collection->getData());die;
    }

    public function createCsv()
    {
        $data   = $this->generateData();
        $header = array_keys($data[0]);
        array_unshift($data, $header);

        $baseDir   = Mage::getBaseDir('var');
        $exportDir = $baseDir . '/export_ccc';
        $filePath  = $exportDir . '/export_css.csv';

        if (!is_dir($exportDir)) {
            mkdir($exportDir, 0777, true);
        }

        $csv = new Varien_File_Csv();
        $csv->saveData($filePath, $data);
        return true;
    }
}
