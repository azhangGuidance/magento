<?php
class Andu_Friend_Block_Adminhtml_Invite_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("friend_form", array("legend"=>Mage::helper("friend")->__("Item information")));

				
						$fieldset->addField("inviter_id", "text", array(
						"label" => Mage::helper("friend")->__("Inviter"),
						"class" => "required-entry",
						"required" => true,
						"name" => "inviter_id",
						));
					
						$fieldset->addField("target_id", "text", array(
						"label" => Mage::helper("friend")->__("Target"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "target_id",
						));
					
						$fieldset->addField("status", "select", array(
						"label" => Mage::helper("friend")->__("Status"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "status",
                        "values"=> Mage::helper("friend")->getFormStatusArray()
						));
					

				if (Mage::getSingleton("adminhtml/session")->getInviteData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getInviteData());
					Mage::getSingleton("adminhtml/session")->setInviteData(null);
				} 
				elseif(Mage::registry("invite_data")) {
				    $form->setValues(Mage::registry("invite_data")->getData());
				}
				return parent::_prepareForm();
		}
}
