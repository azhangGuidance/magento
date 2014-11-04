<?php

class Andu_Friend_Block_Adminhtml_Invite_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId("inviteGrid");
        $this->setDefaultSort("friend_invite_id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel("friend/invite")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn("friend_invite_id", array(
            "header" => Mage::helper("friend")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "friend_invite_id",
        ));
        $this->addColumn('created_at', array(
            'header' => Mage::helper("friend")->__('Created At'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'created_at',
            'type' => 'datetime',
            'gmtoffset' => true
        ));
        $this->addColumn('updated_at', array(
            'header' => Mage::helper("friend")->__('Updated At'),
            'align' => 'center',
            'width' => '100px',
            'index' => 'updated_at',
            'type' => 'datetime',
            'gmtoffset' => true
        ));
        $this->addColumn("inviter_id", array(
            "header" => Mage::helper("friend")->__("Inviter"),
            "index" => "inviter_id",
        ));
        $this->addColumn("target_id", array(
            "header" => Mage::helper("friend")->__("Target"),
            "index" => "target_id",
        ));
        $this->addColumn("status", array(
            "header" => Mage::helper("friend")->__("Status"),
            "index" => 'status',
            'type' => 'options',
            "options"=> Mage::helper('friend')->getGridStatusArray()
        ));
        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }


    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('friend_invite_id');
        $this->getMassactionBlock()->setFormFieldName('friend_invite_ids');
        $this->getMassactionBlock()->setUseSelectAll(true);
        $this->getMassactionBlock()->addItem('remove_invite', array(
            'label' => Mage::helper('friend')->__('Remove Invite'),
            'url' => $this->getUrl('*/adminhtml_invite/massRemove'),
            'confirm' => Mage::helper('friend')->__('Are you sure?')
        ));
        return $this;
    }


}