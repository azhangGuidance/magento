<?php

require_once("Mage/Customer/controllers/AccountController.php");
class Andu_Customer_AccountController extends Mage_Customer_AccountController
{

    public function profileAction(){
        $profileId = $this->getRequest()->getParam('profile_id');
        $profile = Mage::getModel('customer/customer')->load($profileId);
        if(!$profile || !$profile->getId()){
            $this->_redirect('*/*/index');
        }
        if(Mage::registry('current_profile')){
            Mage::unregistry('current_profile');
        }
        Mage::register('current_profile',$profile);
        $this->loadLayout();
        $this->renderLayout();
    }
}
