<?php

class  Andu_Search_Block_List_Toolbar extends Mage_Catalog_Block_Product_List_Toolbar
{

    protected function _construct()
    {
        parent::_construct();
        $this->_availableMode = array('list' => $this->__('List'), 'map' => $this->__('Map'));
        $this->_availableOrder = array(
            'distance'=>'Distance',
            'price_range'=>'Price range'
        );
        $this->_orderField  = 'distance';
        $this->setTemplate('search/product/list/toolbar.phtml');
    }

}
