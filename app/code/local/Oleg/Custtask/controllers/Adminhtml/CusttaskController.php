<?php
class Oleg_Custtask_Adminhtml_CusttaskController extends Mage_Adminhtml_Controller_Action {

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('custtask/adminhtml_custtask'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('block_id');
        Mage::register('custtask_block',Mage::getModel('custtask/block')->load($id));
        $blockObject = (array)Mage::getSingleton('adminhtml/session')->getBlockObject(true);
        if(count($blockObject)) {
            Mage::registry('custtask_block')->setData($blockObject);
        }
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('custtask/adminhtml_custtask_edit'));
        $this->renderLayout();
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('block_id');
            $block = Mage::getModel('custtask/block')->load($id);
            $block
                ->setData($this->getRequest()->getParams())
                ->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();

            if(!$block->getId()) {
                Mage::getSingleton('adminhtml/session')->addError('Cannot save the block');
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setBlockObject($block->getData());
            return  $this->_redirect('*/*/edit',array('block_id'=>$this->getRequest()->getParam('block_id')));
        }

        Mage::getSingleton('adminhtml/session')->addSuccess('Block was saved successfully!');

        $this->_redirect('*/*/'.$this->getRequest()->getParam('back','index'),array('block_id'=>$block->getId()));
    }


    public function deleteAction()
    {
        $block = Mage::getModel('custtask/block')
            ->setId($this->getRequest()->getParam('block_id'))
            ->delete();
        if($block->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess('Block was deleted successfully!');
        }
        $this->_redirect('*/*/');

    }


    public function massStatusAction()
    {
        $statuses = $this->getRequest()->getParams();
        try {
            $blocks= Mage::getModel('custtask/block')
                ->getCollection()
                ->addFieldToFilter('block_id',array('in'=>$statuses['massaction']));
            foreach($blocks as $block) {
                $block->setBlockStatus($statuses['block_status'])->save();
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Blocks were updated!');

        return $this->_redirect('*/*/');

    }

    public function massDeleteAction()
    {
        $blocks = $this->getRequest()->getParams();
        try {
            $blocks= Mage::getModel('custtask/block')
                ->getCollection()
                ->addFieldToFilter('block_id',array('in'=>$blocks['massaction']));
            foreach($blocks as $block) {
                $block->delete();
            }
        } catch(Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            return $this->_redirect('*/*/');
        }
        Mage::getSingleton('adminhtml/session')->addSuccess('Blocks were deleted!');

        return $this->_redirect('*/*/');

    }
}