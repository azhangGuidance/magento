<?php
$installer = new Mage_Customer_Model_Entity_Setup('core_setup');
$installer->startSetup();


$installer->addAttribute("customer", "display_name",  array(
    "type"     => "varchar",
    "backend"  => "",
    "label"    => "Display Name",
    "input"    => "text",
    "source"   => "",
    "visible"  => true,
    "required" => false,
    "default" => "",
    "frontend" => "",
    "unique"     => false,
    "note"       => ""

));

$attribute   = Mage::getSingleton("eav/config")->getAttribute("customer", "display_name");


$used_in_forms=array(
    "customer_account_edit",
    "adminhtml_customer"
);
$attribute->setData("used_in_forms", $used_in_forms)
    ->setData("is_used_for_customer_segment", true)
    ->setData("is_system", 0)
    ->setData("is_user_defined", 1)
    ->setData("is_visible", 1)
    ->setData("sort_order", 100)
;
$attribute->save();



$installer->endSetup();