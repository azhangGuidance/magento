<?php

class Andu_Search_Block_Result extends Mage_Core_Block_Template
{
    public function getResultCount(){
        return true;
    }

    public function getProductListHtml()
    {
        return $this->getChildHtml('search_result_list');
    }

}
