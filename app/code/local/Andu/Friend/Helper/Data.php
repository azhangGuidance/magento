<?php
class Andu_Friend_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getGridStatusArray(){
        return array(
            0 => 'Pending',
            1 => 'Accepted',
            2 => 'Declined'
        );
    }
    public function getFormStatusArray(){
        return array(
            array('label' => 'Pending', 'value' => 0),
            array('label' => 'Accepted', 'value' => 1),
            array('label' => 'Declined', 'value' => 2)
        );
    }
    public function isFriend($friend){
        $customer = $this->getCustomer();
        if($customer && $customer->getId()){
            $relation = Mage::getModel('friend/relation')->getCollection()
                ->addFieldToFilter('inviter_id',$customer->getId())
                ->addFieldToFilter('target_id',$friend->getId())
                ->getFirstItem();
            if($relation && $relation->getStatus()==1){
                return true;
            }
        }
        return false;

    }
    public function getCustomer(){
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}
	 