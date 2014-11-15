<?php
class Andu_Message_Model_Mysql4_Message extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("message/message", "mesage_id");
    }
}