<?php


class Andu_Friend_Block_Adminhtml_Invite extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_invite";
	$this->_blockGroup = "friend";
	$this->_headerText = Mage::helper("friend")->__("Invite Manager");
	$this->_addButtonLabel = Mage::helper("friend")->__("Add New Item");
	parent::__construct();
	
	}

}