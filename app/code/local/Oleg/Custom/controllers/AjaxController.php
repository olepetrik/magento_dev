<?php
class Oleg_Custom_AjaxController extends Mage_Core_Controller_Front_Action
{
    public function getdataAction(){
        $data = Mage::app()->getRequest()->getParams();

    }

    function indexAction(){
       $data = Mage::app()->getRequest()->getParams();
       $fdata = $data['code'];

       $payment = Mage::getModel('custom/form');

       var_dump($payment);
    }
    public function getdata1Action(){
        if($data = $this->getRequest()->getPost("key")){
            echo "data received !";
        }else{
            echo "unable to receive data !";
        }
        }

}