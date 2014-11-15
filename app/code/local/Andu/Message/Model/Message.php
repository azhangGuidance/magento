<?php

class Andu_Message_Model_Message extends Mage_Core_Model_Abstract
{
    protected function _construct(){

       $this->_init("message/message");

    }
    protected function _beforeSave()
    {
        parent::_beforeSave();
        if (!$this->getId() && !$this->getData('created_at')) {
            $this->setData('created_at', now());
        }
        return $this;
    }
}
	 