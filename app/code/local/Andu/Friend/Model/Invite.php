<?php

class Andu_Friend_Model_Invite extends Mage_Core_Model_Abstract
{
    protected function _construct(){

       $this->_init("friend/invite");

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
	 