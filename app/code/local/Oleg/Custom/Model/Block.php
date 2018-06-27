<?php
class Oleg_Custom_Model_Block extends Mage_Core_Model_Abstract {

    public function _construct()
    {
        parent::_construct();

        $this->_init('custom/block');
    }

    function getValue($some_value){
        $collection = $this->getCollection();

        $collection->addFieldToFilter('custom_code', $some_value);


        return $collection->getFirstItem()->getCustomCode();
    }

    function compareValues($data){
        $session = Mage::getSingleton('core/session');
        $code = Mage::getModel('custom/block')->getValue($data);

        if($code != NULL){
            return true;
        }else{
            return false;
        }
    }
}
