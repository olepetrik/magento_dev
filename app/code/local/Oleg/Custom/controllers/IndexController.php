<?php
class Oleg_Custom_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
        Zend_Debug::dump($this->getLayout()->getUpdate()->getHandles());
    }

    public function helloAction()
    {

        $this->loadLayout();
        $this->renderLayout();
        die('hello');
    }


    public function saveAction()
    {
        $key = true;
        $data = $this->getRequest()->getPost();

        $session = array();

        $custom = Mage::getModel('custom/block');
        $custom->setData('custom_code', $data['data']);

        $code = Mage::getModel('custom/block')->compareValues($data);

        if ($code != $key) {
            try {

                $custom->save();

                $session = 'Code: ('.$data['data'].') was successfully added';

            } catch (Exception $e) {
                $session = 'Error was made';
            }
        } else {
            $session = 'Code: ('.$data['data'].') already exist';
        }

        echo json_encode($session);
        exit;
    }
}