<?php
class Oleg_Custtask_Model_Resource_Block extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct()
    {
        $this->_init('custtask/block','block_id');
    }

}