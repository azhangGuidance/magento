<?php
$installer = $this;
$installer->startSetup();


$installer->addAttribute("catalog_category", "dummy",  array(
    "type"     => "varchar",
    "backend"  => "",
    "frontend" => "",
    "label"    => "dummy",
    "input"    => "text",
    "class"    => "",
    "source"   => "",
    "global"   => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
    "visible"  => true,
    "required" => false,
    "user_defined"  => false,
    "default" => "",
    "searchable" => false,
    "filterable" => false,
    "comparable" => false,
	
    "visible_on_front"  => false,
    "unique"     => false,
    "note"       => ""

	));
$installer->endSetup();
	 