<?php
class Andu_Setup_Block_Review_Customer_List extends Mage_Review_Block_Customer_List
{
    /**
     * Initializes collection
     */
    protected function _construct()
    {
        if ($customerId = $this->getRequest()->getParam('profile_id')){
            $customer = Mage::getModel('customer/customer')->load($customerId);
        }else{
            $customer = Mage::getSingleton('customer/session')->getCustomer();
        }
        $this->_collection = Mage::getModel('review/review')->getProductCollection();
        $this->_collection
            ->addStoreFilter(Mage::app()->getStore()->getId())
            ->addCustomerFilter($customer->getId())
            ->setDateOrder();
    }
}
			