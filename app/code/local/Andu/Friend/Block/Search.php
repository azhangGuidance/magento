<?php


class Andu_Friend_Block_Search extends Mage_Core_Block_Template{

    public function getResultUrl(){
        return Mage::getBaseUrl().'friend/relation/result';
    }
    public function getRemoveFriendUrl(){
        return Mage::getBaseUrl().'friend/relation/result';
    }
    public function getAddFriendUrl(){
        return Mage::getBaseUrl().'friend/relation/result';
    }
    public function getFriends(){
        if(Mage::registry('current_friend_search_query')){
            $query = Mage::registry('current_friend_search_query');
            $friends = Mage::getModel('customer/customer')->getCollection()
                ->addAttributeToSelect('*')
                ->addAttributeToFilter(
                array(
                    array('attribute'=>'firstname','like'=>'%'.$query.'%'),
                    array('attribute'=>'lastname', 'like'=>'%'.$query.'%'),
                    array('attribute'=>'display_name', 'like'=>'%'.$query.'%')
                )
            )
                ->addAttributeToFilter('entity_id',array('neq'=>$this->getCustomer()->getId()));
            return $friends;
        }
        return null;
    }
    public function getCustomer(){
        return Mage::getSingleton('customer/session')->getCustomer();
    }

}