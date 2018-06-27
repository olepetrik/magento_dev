<?php

class Oleg_Custtask_Block_Adminhtml_Custtask_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('block_form');
        $this->setTitle(Mage::helper('custtask')->__('Block Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('custtask_block');
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save',array('block_id'=>$this->getRequest()->getParam('block_id'))),
                'method' => 'post'
            )
        );

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('custtask')->__('General Information'), 'class' => 'fieldset-wide'));

        if ($model->getBlockId()) {
            $fieldset->addField('block_id', 'hidden', array(
                'name' => 'block_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('custtask')->__('Block Title'),
            'title'     => Mage::helper('custtask')->__('Block Title'),
            'required'  => true,
        ));


        $fieldset->addField('block_status', 'select', array(
            'label'     => Mage::helper('custtask')->__('Status'),
            'title'     => Mage::helper('custtask')->__('Status'),
            'name'      => 'block_status',
            'required'  => true,
            'options'   => Mage::getModel('custtask/source_status')->toArray(),
        ));


        $fieldset->addField('content', 'textarea', array(
            'name'      => 'content',
            'label'     => Mage::helper('custtask')->__('Content'),
            'title'     => Mage::helper('custtask')->__('Content'),
            'style'     => 'height:36em',
            'required'  => true,

        ));



//        $fieldset->addField('custom_content', 'textarea', array(
//            'name'      => 'custom_content',
//            'label'     => Mage::helper('custtask')->__('Custom Content'),
//            'title'     => Mage::helper('custtask')->__('Custom Content'),
//            'style'     => 'height:36em',
//            'required'  => true,
//
//        ));

        Mage::dispatchEvent('custtask_block_adminhtml_custtask_edit_form_after', array(
            'fieldset' => $fieldset,
        ));


        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
