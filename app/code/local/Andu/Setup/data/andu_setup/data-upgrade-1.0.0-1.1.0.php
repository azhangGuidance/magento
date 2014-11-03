<?php
$installer = $this;
$installer->startSetup();

$entityTypeId = $installer->getEntityTypeId(Mage_Catalog_Model_Product::ENTITY);
$defaultAttributeSetId = $installer->getDefaultAttributeSetId($entityTypeId);
$attributes = array(
    'cash_only' => array (
        'entity_type_id'	=> $entityTypeId,
        'type'              => 'int',
        'frontend'          => '',
        'label'             => 'Cash Only',
        'input'             => 'select',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => 1,
        'required'          => 0,
        'user_defined'      => 0,
        'default'           => '',
        'searchable'        => 0,
        'filterable'        => 1,
        'comparable'        => 0,
        'visible_on_front'  => 1,
        'unique'            => 0,
        'source'             => 'eav/entity_attribute_source_boolean'
    ),
    'wifi' => array (
        'entity_type_id'	=> $entityTypeId,
        'type'              => 'int',
        'frontend'          => '',
        'label'             => 'Wifi',
        'input'             => 'select',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => 1,
        'required'          => 0,
        'user_defined'      => 0,
        'default'           => '',
        'searchable'        => 0,
        'filterable'        => 1,
        'comparable'        => 0,
        'visible_on_front'  => 1,
        'unique'            => 0,
        'source'             => 'eav/entity_attribute_source_boolean'
    ),
    'price_range' => array (
        'entity_type_id'	=> $entityTypeId,
        'type'              => 'int',
        'frontend'          => '',
        'label'             => 'Price Range',
        'input'             => 'select',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => 1,
        'required'          => 0,
        'user_defined'      => 0,
        'default'           => '',
        'searchable'        => 0,
        'filterable'        => 1,
        'comparable'        => 0,
        'visible_on_front'  => 1,
        'unique'            => 0
    ),
    'flavor'=>array(
        'entity_type_id'	=> $entityTypeId,
        'type'              => 'int',
        'frontend'          => '',
        'label'             => 'Flavor',
        'input'             => 'multiselect',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => 1,
        'required'          => 0,
        'user_defined'      => 0,
        'default'           => '',
        'searchable'        => 1,
        'filterable'        => 1,
        'comparable'        => 0,
        'visible_on_front'  => 1,
        'unique'            => 0
    )
);
Mage::app()->cleanCache(array(Mage_Core_Model_Translate::CACHE_TAG));
foreach ($attributes as $code => $attribute) {
    $installer->removeAttribute($entityTypeId, $code);
    $installer->addAttribute($entityTypeId, $code, $attribute);
}
$installer->addAttributeOption(
    array(
        'attribute_id' => $installer->getAttributeId( $entityTypeId, 'price_range'),
        'values' => array(
            0 => '$',
            1 => '$$',
            2 => '$$$',
            3 => '$$$$',
            4 => '$$$$$'
        )
    ));
$installer->addAttributeOption(
    array(
        'attribute_id' => $installer->getAttributeId( $entityTypeId, 'flavor'),
        'values' => array(
            0 => 'Chinese',
            1 => 'American',
            2 => 'Japanese',
            3 => 'Korean',
            4 => 'Mexico',
            5 => 'French',
            6 => 'Italian'
        )
    ));

$installer->addAttributeToGroup('catalog_product', "Default", "General", 'cash_only');
$installer->addAttributeToGroup('catalog_product', "Default", "General", 'wifi');
$installer->addAttributeToGroup('catalog_product', "Default", "General", 'price_range');
$installer->addAttributeToGroup('catalog_product', "Default", "General", 'flavor');

$installer->endSetup();
	 