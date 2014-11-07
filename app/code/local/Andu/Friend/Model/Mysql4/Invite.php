<?php
class Andu_Friend_Model_Mysql4_Invite extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("friend/invite", "friend_invite_id");
    }
}