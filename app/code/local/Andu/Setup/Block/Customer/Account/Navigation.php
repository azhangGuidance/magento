<?php
class Andu_Setup_Block_Customer_Account_Navigation extends Mage_Customer_Block_Account_Navigation
{
    public function removeLinkByName($name){
        unset($this->_links[$name]);
        return $this;
    }
    public function updateLinkLabel($name,$label){
        if($this->_links[$name]){
            $this->_links[$name]->setLabel($label);
        }
    }
}
			