<?php

class Andu_Customer_Block_Profile extends Mage_Core_Block_Template
{
    public function getProfileCustomer(){
        if(Mage::registry('current_profile')){
            return Mage::registry('current_profile');
        }elseif($this->getRequest()->getParam('profile_id')){
            return Mage::getCustomer('customer/customer')->load($this->getRequest()->getParam('profile_id'));
        }

    }

    public function render(Mage_Customer_Model_Address_Abstract $address)
    {
        $html = '';
        if(is_array($address->getStreet()) && $address->getStreet()){
            foreach($address->getStreet() as $street){
                $html.=$street.'</br>';
            }
        }
        if($address->getCity()||$address->getRegion()||$address->getPostcode()){
            if($address->getCity()){
                $html.=$address->getCity().', ';
            }
            if($address->getRegion()){
                $html.=Mage::helper('directory')->__($address->getRegion()).', ';
            }
            if($address->getPostcode()){
                $html.=$address->getPostcode().', ';
            }
            $html=substr($html,0,-2).'</br>';
        }
        if($address->getCountry()){
            $html.=$address->getCountryModel()->getName().'</br>';
        }
        if($address->getTelephone){
            $html.='T: '.$address->getTelephone();
        }
        return $html;
    }

}