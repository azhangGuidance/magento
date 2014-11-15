<?php

class Andu_Friend_Model_Relation extends Mage_Core_Model_Abstract
{
    const FRIEND_RELATION_STATUS_STRANGER = 0;
    const FRIEND_RELATION_STATUS_FRIEND = 1;
    const FRIEND_RELATION_STATUS_BLACK = 2;
    protected function _construct(){

       $this->_init("friend/relation");

    }
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if (!$this->getId() && !$this->getData('created_at')) {
            $this->setData('created_at', now());
        } else {
            $this->setData('updated_at', now());
        }
        return $this;
    }

}
	 