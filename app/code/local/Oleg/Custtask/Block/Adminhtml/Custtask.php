<?php

class Oleg_Custtask_Block_Adminhtml_Custtask extends Mage_Adminhtml_Block_Widget_Grid_Container
{

    public function __construct()
    {
        $this->_controller = 'adminhtml_custtask';
        $this->_blockGroup = 'custtask';
        $this->_headerText = Mage::helper('custtask')->__('custtask');
        $this->_addButtonLabel = Mage::helper('custtask')->__('Add New Block');
        parent::__construct();
    }

}
