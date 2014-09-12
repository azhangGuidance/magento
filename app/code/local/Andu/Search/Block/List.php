<?php

class Andu_Search_Block_List extends Mage_Catalog_Block_Product_List
{
    protected $_productCollection;

    protected function _getProductCollection()
    {
        if (is_null($this->_productCollection)) {
            $layer = $this->getLayer();
            /* @var $layer Mage_Catalog_Model_Layer */
            if ($this->getShowRootCategory()) {
                $this->setCategoryId(Mage::app()->getStore()->getRootCategoryId());
            }
            $origCategory = null;
            if ($this->getCategoryId()) {
                $category = Mage::getModel('catalog/category')->load($this->getCategoryId());
                if ($category->getId()) {
                    $origCategory = $layer->getCurrentCategory();
                    $layer->setCurrentCategory($category);
                    $this->addModelTags($category);
                }
            }
            $this->_productCollection = $layer->getProductCollection();

            $this->prepareSortableFieldsByCategory($layer->getCurrentCategory());

            if ($origCategory) {
                $layer->setCurrentCategory($origCategory);
            };
            if($search = Mage::registry('search_query')){
                $loc = Mage::helper('setup')->fetchLocationCoordinates($search['location']);
                $radius = $search['distance']?$search['distance']:50;
                if(isset($loc['lat']) && isset($loc['lng'])){
                    $this->addAreaFilterWithOrder($loc['lat'],$loc['lng'],$radius);
                }
            }
        }
        return $this->_productCollection;
    }
    public function addAreaFilterWithOrder($center_lat, $center_lng, $radius)
    {
        //todo: fix distance filter and order
        $this->joinAttributeToSelect($this->_productCollection->getSelect(),'latitude');
        $this->joinAttributeToSelect($this->_productCollection->getSelect(),'longitude');
        $dist = sprintf(
            "(%s*acos(cos(radians(%s))*cos(radians(latitude.value))*cos(radians(longitude.value)-radians(%s))+sin(radians(%s))*sin(radians(latitude.value))))",
            3959,
            (float)$center_lat,
            (float)$center_lng,
            (float)$center_lat
        );
        $this->_productCollection->getSelect()->where($dist.'<=?', (float)$radius)
                                              ->order($dist,asc);
        return $this->_productCollection;
    }
    protected function joinAttributeToSelect($select, $attrCode)
    {
        $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attrCode);
        $attrId = $attribute->getAttributeId();
        $select->joinLeft(
            array($attrCode => $attribute->getBackendTable()),
            '(' . $attrCode . '.entity_id = e.entity_id) AND (' . $attrId . ' = ' . $attrCode . '.attribute_id)',
            array($attrCode => $attrCode . '.value')
        );
        return $select;
    }
}