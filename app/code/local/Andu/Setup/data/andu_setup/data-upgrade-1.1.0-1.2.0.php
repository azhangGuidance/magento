<?php
$installer = $this;
$installer->startSetup();

Mage::register('isSecureArea', 1);
Mage::app()->setUpdateMode(false);
Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
$rootCategoryId = Mage::app()->getStore()->getRootCategoryId();
$rootCategory = Mage::getModel('catalog/category')->load($rootCategoryId);
$categories = array('Restaurant','Coffee Bar & Tea House','Bars','Rental');
$path = $rootCategory->getPath();
$store = Mage::getModel('core/store')->load('default', 'code');
if($store && $store->getId()){
    foreach($categories as $category){
        $category = Mage::getModel('catalog/category')->setStoreId($store->getId())
            ->setName($category)
            ->setIsActive(true)
            ->setPath($path)
            ->setIncludeInMenu(1)
            ->save();
    }
}
Mage::unregister('isSecureArea');
$installer->endSetup();