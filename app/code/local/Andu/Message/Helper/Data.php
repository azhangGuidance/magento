<?php
class Andu_Message_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getUnreadMessageCount(){
        $customer = $this->getCustomer();
        $messages = Mage::getModel('message/message')->getCollection()
            ->addFieldToFilter('to',$customer->getId())
            ->addStatusToFilter('status',0);
        return $messages->count();

    }
    public function getCustomer(){
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}
	 