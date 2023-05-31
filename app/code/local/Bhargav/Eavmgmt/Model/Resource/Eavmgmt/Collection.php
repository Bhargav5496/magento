<?php

class Bhargav_Eavmgmt_Model_Resource_Eavmgmt_Collection extends Mage_Eav_Model_Resource_Entity_Attribute_Collection
{
    
    protected function _initSelect()
    {
        $columns = $this->getConnection()->describeTable($this->getResource()->getMainTable());
        $retColumns = array();
        foreach ($columns as $labelColumn => $columnData) {
            $retColumns[$labelColumn] = $labelColumn;
            if ($columnData['DATA_TYPE'] == Varien_Db_Ddl_Table::TYPE_TEXT) {
                $retColumns[$labelColumn] = Mage::getResourceHelper('core')->castField('main_table.'.$labelColumn);
            }
        }

        $this->getSelect()
            ->from(array('main_table' => $this->getResource()->getMainTable()), $retColumns)
            ->joinLeft(
                array('eet'=>'eav_entity_type'),
                "eet.entity_type_id = main_table.entity_type_id"
            );
        return $this;
    }
}
