<?php
class Andu_Setup_Block_Customer_Wishlist extends Mage_Wishlist_Block_Customer_Wishlist
{

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $headBlock = $this->getLayout()->getBlock('head');
        if ($headBlock) {
            $headBlock->setTitle($this->__('Profile View'));
        }
    }
}
			