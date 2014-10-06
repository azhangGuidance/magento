<?php
$installer = $this;

$installer->startSetup();
$installer->setConfigData('design/package/name', 'default', 'default', 0);
$installer->setConfigData('design/theme/default', 'f001', 'default', 0);
$installer->setConfigData('cataloginventory/item_options/manage_stock', 0, 'default', 0);

$installer->endSetup();