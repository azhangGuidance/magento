<?php
class Andu_Message_MessageController extends Mage_Core_Controller_Front_Action
{
    public function ajaxAction(){
        $to = $this->getRequest()->getParam('to');
        if($to){
            $html='<form id="send-meesage-form" method="post" action="';
            $html.= Mage::GetBaseUrl().'message/message/send';
            $html.='"><label><input type="hidden" name="to" value="'.$to.'">';
            $html.= $this->__('Title: ');
            $html.='</label><br/><input name="title" value="" type="text"/><br/><label>';
            $html.= $this->__('Content: ');
            $html.='<span style="color:red">*</span><br/>';
            $html.='</label><textarea class="required-entry" name="content" value="" rows="10">';
            $html.='</textarea></br>';
            $html.='<button type="button" class="button" onclick="sendMessageForm.submit()"><span><span>';
            $html.=$this->__("send");
            $html.='</span></span></button></form>';
            $html.='<script type="text/javascript"> var sendMessageForm = new VarienForm("send-meesage-form") </script>';
        }else{
            $html= $this->__('Can not send message to the person now, please try again later!');
        }
        echo $html;
    }
    public function sendAction(){
        $from = $this->getCustomer()->getId();
        $to = $this->getRequest()->getParam('to');
        $title = $this->getRequest()->getParam('title');
        $content = $this->getRequest()->getParam('content');
        if($from && $to && $content){
            $message= Mage::getModel('message/message')
                    ->setFrom($from)
                    ->setTo($to)
                    ->setStatus(0) // unread
                    ->setTitle($title)
                    ->setContent($content)
                    ->save();
            Mage::getSingleton('customer/session')->addSuccess($this->__('Message sent.'));
        }else{
            Mage::getSingleton('customer/session')->addError($this->__('There is some problem sending your message, please try again later!'));
        }
        $this->_redirectReferer();
    }
    public function getCustomer(){
        return Mage::getSingleton('customer/session')->getCustomer();
    }
    public function viewAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
    public function listAction(){
        $this->loadLayout();
        $this->renderLayout();
    }
}