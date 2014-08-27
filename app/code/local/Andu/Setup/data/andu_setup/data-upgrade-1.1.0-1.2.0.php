<?php
$installer = $this;
$installer->startSetup();

Mage::register('isSecureArea', 1);
Mage::app()->setUpdateMode(false);

$rootCategoryId = Mage::app()->getStore()->getRootCategoryId();
$rootCategory = Mage::getModel('catalog/category')->load($rootCategoryId);
$categories = array('Restaurant','Coffee Bar & Tea House','Bars','Rental');
$path = $rootCategory->getPath();
foreach($categories as $category){
    $category = Mage::getModel('catalog/category')
        ->setName($category)
        ->setIsActive(true)
        ->setPath($path)
        ->setIncludeInMenu(1)
        ->save();
}
Mage::unregister('isSecureArea');
$installer->endSetup();