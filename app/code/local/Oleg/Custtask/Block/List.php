<?php
class Oleg_Custtask_Block_List extends Mage_Core_Block_Template {

    public function getBlocks()
    {
        //return Mage::getResourceModel('custtask/block_collection');
        return Mage::getModel('custtask/block')->getCollection()
            ->addFieldToFilter('block_status',array('eq'=>Oleg_Custtask_Model_Source_Status::ENABLED));
    }
}