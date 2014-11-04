<?php


class Andu_Friend_Block_List extends Mage_Core_Block_Template{

	public function getFriends()
	{
        $friends = array();
	    $customer = $this->getCustomer();
        if($customer && $customer->getId()){
            $relations = Mage::getModel('friend/relation')->getCollection()
                ->addFieldToFilter('status',1)
                ->addFieldToFilter('inviter_id',$customer->getId());
            if($relations->count()){
                foreach($relations as $relation){
                    $friends[]=$relation->getTargetId();
                }
            };
        }
        return $friends;
	}
    public function getCustomer(){
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}