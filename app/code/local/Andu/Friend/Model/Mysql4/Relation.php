<?php
class Andu_Friend_Model_Mysql4_Relation extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("friend/relation", "friend_relation_id");
    }
}