<?php
class Oleg_Custom_Model_Method extends Mage_Checkout_Model_Cart
{
    protected $_code = 'custom';
    protected $_formBlockType = 'custom/form';

    public function validate()
    {
        $code = Mage::app()->getRequest()->getParam('secret_code');
        if($code != $this->getConfigData('secret_code')) {
            Mage::throwException(Mage::helper('custom')->__("This is wrong"));
        }

        return $this;
    }
}