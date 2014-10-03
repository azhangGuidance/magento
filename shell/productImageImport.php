<?php
/**
 * Magento Enterprise Edition
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Magento Enterprise Edition License
 * that is bundled with this package in the file LICENSE_EE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.magentocommerce.com/license/enterprise-edition
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Shell
 * @copyright   Copyright (c) 2013 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://www.magentocommerce.com/license/enterprise-edition
 */

require_once 'abstract.php';

/**
 * Magento Log Shell Script
 *
 * @category    Mage
 * @package     Mage_Shell
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Shell_ProductImageImport extends Mage_Shell_Abstract
{
    public function run(){
        Mage::register('isSecureArea', 1);
        Mage::app()->setUpdateMode(false);
        Mage::app()->setCurrentStore(Mage_Core_Model_App::ADMIN_STORE_ID);
        $csvFile = 'Image_Mapping.csv';
        $handle = fopen($csvFile, "r");

        while (!feof($handle)) {
            while (($item = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if (isset($item[0]) && $item[0]) {
                    $product = Mage::getModel('catalog/product')
                        ->loadByAttribute('sku',$item[0]);
                    if ($product && $product->getId() && !$product->getImage()) {
                        if ($item[1]) {
                            $image = Mage::getBaseDir('media') . DS . 'import' . DS .'image'. DS . $item[1].'.jpg';
                            if (file_exists($image)) {
                                $product->addImageToMediaGallery($image, array('image', 'small_image', 'thumbnail'), false, false);
                            }
                        }
                        $product->save();
                    }
                }
            }
        }

        fclose($handle);
        Mage::unregister('isSecureArea');
    }
}

$shell = new Mage_Shell_ProductImageImport();
$shell->run();
