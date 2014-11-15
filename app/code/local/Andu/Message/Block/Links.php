<?php

class Andu_Message_Block_Links extends Mage_Page_Block_Template_Links_Block
{
    /**
     * Position in link list
     * @var int
     */
    protected $_position = 30;

    /**
     * @return string
     */
    protected function _toHtml()
    {
            $text = $this->_createLabel($this->_getItemCount());
            $this->_label = $text;
            $this->_title = $text;
            $this->_url = $this->getUrl('message/message/list');
            return parent::_toHtml();
    }

    /**
     * Define label, title and url for wishlist link
     *
     * @deprecated after 1.6.2.0
     */
    public function initLinkProperties()
    {
        $text = $this->_createLabel($this->_getItemCount());
        $this->_label = $text;
        $this->_title = $text;
        $this->_url = $this->getUrl('message/message/list');
    }

    /**
     * Count unread emails
     *
     * @return int
     */
    protected function _getItemCount()
    {
        return $this->helper('message')->getUnreadMessageCount();
    }

    /**
     * Create button label based on wishlist item quantity
     *
     * @param int $count
     * @return string
     */
    protected function _createLabel($count)
    {
        if ($count > 1) {
            return $this->__('My Messages (%d unread)', $count);
        } else if ($count == 1) {
            return $this->__('My Message (%d unread)', $count);
        } else {
            return $this->__('My Messages');
        }
    }

    /**
     * @deprecated after 1.4.2.0
     * @see Mage_Wishlist_Block_Links::__construct
     *
     * @return array
     */
    public function addMessageLink()
    {
        return $this;
    }


}
