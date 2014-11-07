<?php
class Andu_Friend_Block_Adminhtml_Invite_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("invite_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("friend")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("friend")->__("Item Information"),
				"title" => Mage::helper("friend")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("friend/adminhtml_invite_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
