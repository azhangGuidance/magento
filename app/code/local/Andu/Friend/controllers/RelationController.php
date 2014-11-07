<?php
class Andu_Friend_RelationController extends Mage_Core_Controller_Front_Action
{
    public function removeAction()
    {
        $friendId = $this->getRequest()->getParam('friend');
        $q = $this->getRequest()->getParam('q');
        if($friendId){
            $friend = Mage::getModel('customer/customer')->load($friendId);
            if($friend && $friend->getid()){
                $relation = Mage::getModel('friend/relation')->getCollection()
                    ->addFieldToFilter('inviter_id',$this->getCustomer()->getId())
                    ->addFieldToFilter('target_id',$friendId)
                    ->getFirstItem();
                If($relation && $relation->getId()){
                    $relation->setStatus(0)->save();
                    Mage::getSingleton('customer/session')->addSuccess($this->__('Friend removed successfully!'));
                }
            }
        }
        Mage::getSingleton('customer/session')->addError($this->__('Failed to remove friend, please try again later!'));
        $this->_redirect('*/*/search',array('q'=>$q));
    }

    public function searchAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->_initLayoutMessages('core/session');
        $query = $this->getRequest()->getParam('q');
        if($query){
            if(Mage::registry('current_friend_search_query')){
                Mage::unregistry('current_friend_search_query');
            }
            Mage::register('current_friend_search_query',$query);
        }
        $this->renderLayout();
    }

    public function resultAction(){
        $html = '';
        $query = $this->getRequest()->getParam('q');
        if($query){
            if(Mage::registry('current_friend_search_query')){
                Mage::unregistry('current_friend_search_query');
            }
            Mage::register('current_friend_search_query',$query);
        }
        $customers = Mage::getModel('customer/customer')->getCollection()
            ->addAttributeToSelect('*')
            ->addAttributeToFilter(
                array(
                    array('attribute'=>'firstname','like'=>'%'.$query.'%'),
                    array('attribute'=>'lastname', 'like'=>'%'.$query.'%'),
                    array('attribute'=>'display_name', 'like'=>'%'.$query.'%')
                    )
            )
            ->addAttributeToFilter('entity_id',array('neq'=>$this->getCustomer()->getId()))
        ;
        if($customers->count()){
            $html.='<ul>';
            foreach($customers as $customer){
                $html.= $this->getFriendHtml($customer);
            }
            $html.='</ul>';
        }
        echo  $html;
    }

    public function inviteAction() {
        $friendId = $this->getRequest()->getParam('friend');
        $q = $this->getRequest()->getParam('q');
        $customer = $this->getCustomer();
        if($friendId && $customer && $customer->getId()){
            $invite = Mage::getModel('friend/invite')->getCollection()
                ->addFieldToFilter('inviter_id',$this->getCustomer()->getId())
                ->addFieldToFilter('target_id',$friendId)
                ->getFirstItem();
            if($invite && $invite->getId()){
                Mage::getSingleton('customer/session')->addSuccess($this->__('Invite has been sent before.'));
            }else{
                Mage::getModel('friend/invite')->setInviterId($customer->getId())
                    ->setTargetId($friendId)
                    ->setStatus(0)
                    ->save();
                Mage::getSingleton('customer/session')->addSuccess($this->__('Invite has been sent.'));

                //Send email notification
            }
        }else{
            Mage::getSingleton('customer/session')->addError($this->__('Failed to send invite, please try again later!'));
        }

        $this->_redirect('*/*/search',array('q'=>$q));
    }

    public function getCustomer(){
        return Mage::getSingleton('customer/session')->getCustomer();
    }

    public function getFriendHtml($friend){
        $src = Mage::getUrl('profileimage/customer/viewProfileimage',array('id'=>$friend->getId()));
        $profileUrl = "'".Mage::getUrl('customer/account/profile').'profile_id/'.$friend->getId()."'";
        $removeUrl = "'".Mage::getBaseUrl().'friend/relation/remove?friend='.$friend->getId().'&q='.Mage::registry('current_friend_search_query')."'";
        $inviteUrl = "'".Mage::getBaseUrl().'friend/relation/invite?friend='.$friend->getId().'&q='.Mage::registry('current_friend_search_query')."'";
        $html = '<li><img style= "width:20px;" src="'.$src.'"/>';
        if($friend->getDisplayName()){
            $html.= '<span class="display-name">'.$friend->getDisplayName().'</span>';
        }else{
            $html.= '<span class="display-name">'.$friend->getFirstname().'</span>';
        }
        $html.='<button class="button view-profile-button" onclick="window.location.href='.$profileUrl.'"><span><span>'.$this->__("View Profile").'</span></span></button>';
        if(Mage::helper('friend')->isFriend($friend)){
            $html.='<button onclick="window.location.href='.$removeUrl.'" class="remove-friend-button button"><span><span>'.$this->__("Remove this friend").'</span></span></button></li>';
        }else{
            $html.='<button onclick="window.location.href='.$inviteUrl.'" class="invite-friend-button button"><span><span>'.$this->__("Send friend invitation").'</span></span></button></li>';
        }
        return $html;
    }
}