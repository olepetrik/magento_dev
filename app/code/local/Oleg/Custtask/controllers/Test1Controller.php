<?php
class Oleg_Custtask_Test1Controller extends Mage_Core_Controller_Front_Action {

    public function renamedAction()
    {
        $enabled = Mage::getStoreConfig('custtask/settings/enabled');
        $count = Mage::getStoreConfig('custtask/settings/blocks_count');
        $text = Mage::getStoreConfig('custtask/settings/raw_text');
        Mage::app()->getConfig()->saveConfig('custtask/settings/enabled','0');

        var_dump($enabled);
        die('test');
    }
}