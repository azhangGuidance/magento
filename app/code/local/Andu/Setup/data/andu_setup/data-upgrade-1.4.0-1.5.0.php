<?php
$installer = $this;
$installer->startSetup();

$entityTypeId = $installer->getEntityTypeId(Mage_Catalog_Model_Product::ENTITY);
$defaultAttributeSetId = $installer->getDefaultAttributeSetId($entityTypeId);
$attributes = array(
    'latitude' => array (
        'entity_type_id'	=> $entityTypeId,
        'type'              => 'varchar',
        'frontend'          => '',
        'label'             => 'Latitude',
        'input'             => 'text',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => 1,
        'required'          => 0,
        'user_defined'      => 0,
        'default'           => '',
        'searchable'        => 0,
        'filterable'        => 0,
        'comparable'        => 0,
        'visible_on_front'  => 1,
        'unique'            => 0,
    ),
    'longitude' => array (
        'entity_type_id'	=> $entityTypeId,
        'type'              => 'varchar',
        'frontend'          => '',
        'label'             => 'Longitude',
        'input'             => 'text',
        'global'            => Mage_Catalog_Model_Resource_Eav_Attribute::SCOPE_GLOBAL,
        'visible'           => 1,
        'required'          => 0,
        'user_defined'      => 0,
        'default'           => '',
        'searchable'        => 0,
        'filterable'        => 0,
        'comparable'        => 0,
        'visible_on_front'  => 1,
        'unique'            => 0,
    )

);
Mage::app()->cleanCache(array(Mage_Core_Model_Translate::CACHE_TAG));
foreach ($attributes as $code => $attribute) {
    $installer->removeAttribute($entityTypeId, $code);
    $installer->addAttribute($entityTypeId, $code, $attribute);
    $installer->addAttributeToGroup('catalog_product', "Default", "General", $code);
}

$installer->endSetup();
	 