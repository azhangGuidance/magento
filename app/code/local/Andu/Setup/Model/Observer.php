<?php


class Andu_Setup_Model_Observer extends Varien_Object{

    public function updateProduct($observer) {
        $product = $observer->getEvent()->getProduct();
        if ($product->getSku()) {
            try {
                if(!$product->getLatitude() || !$product->getLongitude()){
                    Mage::helper('setup')->fetchProductCoordinates($product);
                }
                return true;
            } catch (Exception $e){
                Mage::logException($e);
                Mage::log($e->getMessage());
            }
        }
        return $this;
    }

}