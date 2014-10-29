<?php

class Andu_Setup_Model_Rewrite_Resource_Product_Collection extends Mage_Catalog_Model_Resource_Product_Collection
{
    public function getSelectCountSql()
    {
        $this->_renderFilters();

        $countSelect = clone $this->getSelect();
        $countSelect->reset(Zend_Db_Select::ORDER);
        $countSelect->reset(Zend_Db_Select::LIMIT_COUNT);
        $countSelect->reset(Zend_Db_Select::LIMIT_OFFSET);
        //$countSelect->reset(Zend_Db_Select::COLUMNS);//comment this line

        $countSelect->columns('COUNT(*)');

        return $countSelect;
    }
}
