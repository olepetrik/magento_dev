<?php
class Oleg_Custtask_Model_Observer
    /**
     * @param $observer Varien_Event_Observer
     */
{

//    First Module for Custom Grid
//
//    public function coreBlockAbstractToHtmlBefore(Varien_Event_Observer $observer)
//    {
//        $grid = $observer->getBlock();
//
//        /**
//         * Oleg_Custtask_Block_Adminhtml_Custtask_Grid
//         */
//        if($grid instanceof Oleg_Custtask_Block_Adminhtml_Custtask_Grid) {
//            $grid->addColumnAfter('custom_content',
//                array(
//                    'header' => Mage::helper('custtask')->__('Custom_Content'),
//                    'index' => 'custom_content'
//                ),
//                'block_status');
//        }
//    }
//
//    public function eavCollectionAbstractLoadBefore(Varien_Event_Observer $observer)
//    {
//        $collection = $observer->getCollection();
//        if (!isset($collection)) {
//            return;
//        }
//
//        /**
//         * Oleg_Custtask_Model_Resource_Block_Collection
//         */
//
//        if ($collection instanceof Oleg_Custtask_Model_Resource_Block_Collection)
//            /* @var $collection Oleg_Custtask_Model_Resource_Block_Collection */
//            $collection->addAttributeToSelect('custom_content');
//    }
//
//    public function addFiledToCustomForm(Varien_Event_Observer $observer)
//    {
//
//        $custfield = $observer->getFieldset();
//
//        $custfield->addField('custom_content', 'textarea', array(
//            'name'      => 'custom_content',
//            'label'     => Mage::helper('custtask')->__('Custom Content'),
//            'title'     => Mage::helper('custtask')->__('Custom Content'),
//            'style'     => 'height:36em',
//            'required'  => true,
//
//        ));
//    }


//    Second Module for Customer Grid

    public function beforeBlockToHtml(Varien_Event_Observer $observer)
    {
        $grid = $observer->getBlock();

        /**
         * Mage_Adminhtml_Block_Customer_Grid
         */
        if ($grid instanceof Mage_Adminhtml_Block_Customer_Grid){
            $grid->addColumnAfter(
                'company',
                array(
                    'header' => Mage::helper('customer')->__('Company Name'),
                    'index' => 'company',
                    'filter_condition_callback' => array($this, 'customFilter'),
                ), 'group'
            );
        }
    }

    public function beforeCollectionLoad(Varien_Event_Observer $observer)
    {
        $collection = $observer->getCollection();
        if (!isset($collection)) {
            return $this;
        }

        /**
         * Mage_Customer_Model_Resource_Customer_Collection
         */
        if ($collection instanceof Mage_Customer_Model_Resource_Customer_Collection){
            /* @var $collection Mage_Customer_Model_Resource_Customer_Collection */
            $collection->joinAttribute('company', 'customer_address/company', 'default_billing', null, 'left');
        }
    }

    public function customFilter($collection, $column)
    {

        $filterValue = $column->getFilter()->getValue();

        Mage::log($filterValue,null,'mylog.log');

        if(!is_null($filterValue)){
            $collection->getSelect()->where('`at_company`.`value` LIKE "%' . $filterValue . '%"');

        }

        return $this;

    }


}