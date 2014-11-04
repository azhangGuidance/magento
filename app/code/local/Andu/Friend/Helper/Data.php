<?php
class Andu_Friend_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function getGridStatusArray(){
        return array(
            0 => 'Pending',
            1 => 'Accepted',
            2 => 'Declined'
        );
    }
    public function getFormStatusArray(){
        return array(
            array('label' => 'Pending', 'value' => 0),
            array('label' => 'Accepted', 'value' => 1),
            array('label' => 'Declined', 'value' => 2)
        );
    }
}
	 