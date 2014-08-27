<?php
$installer = $this;

$installer->startSetup();
$installer->setConfigData('design/package/name', 'default', 'default', 0);
$installer->setConfigData('design/theme/default', 'f001', 'default', 0);

$installer->endSetup();