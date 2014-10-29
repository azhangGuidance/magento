<?php
$installer = new Mage_Customer_Model_Entity_Setup('core_setup');
$installer->startSetup();


$installer->addAttribute("customer", "image",  array(
    "type"     => "varchar",
    "backend"  => "catalog/category_attribute_backend_image",
    "label"    => "Image",
    "input"    => "image",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

));

$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "image");


$used_in_forms=array();

$used_in_forms[]="customer_account_edit";
$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
;
$attribute->save();



$installer->endSetup();