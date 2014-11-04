<?php
	
class Andu_Friend_Block_Adminhtml_Invite_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "friend_invite_id";
				$this->_blockGroup = "friend";
				$this->_controller = "adminhtml_invite";
				$this->_updateButton("save", "label", Mage::helper("friend")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("friend")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("friend")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("invite_data") && Mage::registry("invite_data")->getId() ){

				    return Mage::helper("friend")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("invite_data")->getId()));

				} 
				else{

				     return Mage::helper("friend")->__("Add Item");

				}
		}
}