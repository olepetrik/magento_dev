<?php
class Oleg_Custom_Model_Resource_Block extends Mage_Core_Model_Mysql4_Abstract {

    public function _construct()
    {
        $this->_init('custom/block','custom_id');
    }


}