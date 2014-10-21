<?php


class Andu_Search_ResultController extends Mage_Core_Controller_Front_Action
{

    public function indexAction(){
        $query = $this->getRequest()->getParams();
        if(isset($query['category_id']) && $query['category_id'] && isset($query['location']) && $query['location']){
            $category = Mage::getModel('catalog/category')->load($query['category_id']);
            if(Mage::registry('current_category')){
                Mage::unregister('current_category');
            }
            Mage::register('current_category',$category);
            if(Mage::registry('search_query')){
                Mage::unregister('search_query');
            }
            Mage::register('search_query',$query);
            if($category && $category->getId()){
                $this->loadLayout();
                $this->_initLayoutMessages('catalog/session');
                $this->_initLayoutMessages('checkout/session');
                $this->renderLayout();
            }
        }else{
            Mage::getSingleton('catalog/session')->addError($this->__('Location is not valid!'));
            $this->_redirectReferer();
        }
    }
}
