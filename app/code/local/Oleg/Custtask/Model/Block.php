<?php
class Oleg_Custtask_Model_Block extends Mage_Core_Model_Abstract {

    public function _construct()
    {
        parent::_construct();
        $this->_init('custtask/block');
    }
}
