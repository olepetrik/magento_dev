<?php

class Oleg_Custtask_Block_Adminhtml_Custtask_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('cmsBlockGrid');
        $this->setDefaultSort('block_identifier');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('custtask/block')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Block_Collection */
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('title', array(
            'header'    => Mage::helper('custtask')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));

        $this->addColumn('block_status', array(
            'header'    => Mage::helper('custtask')->__('Status'),
            'align'     => 'left',
            'type'      => 'options',
            'options'   => Mage::getModel('custtask/source_status')->toArray(),
            'index'     => 'block_status'
        ));


        $this->addColumn('created_at', array(
            'header'    => Mage::helper('custtask')->__('Created At'),
            'index'     => 'created_at',
            'type'      => 'date',

        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('block_id');
        $this->getMassactionBlock()->setIdFieldName('block_id');
        $this->getMassactionBlock()
            ->addItem('delete',
                array(
                    'label' => Mage::helper('custtask')->__('Delete'),
                    'url' => $this->getUrl('*/*/massDelete'),
                    'confirm' => Mage::helper('custtask')->__('Are you sure?')
                )
            )
            ->addItem('status',
                array(
                    'label' => Mage::helper('custtask')->__('Update status'),
                    'url' => $this->getUrl('*/*/massStatus'),
                    'additional' =>
                        array('block_status'=>
                        array(
                            'name' => 'block_status',
                            'type' => 'select',
                            'class' => 'required-entry',
                            'label' => Mage::helper('custtask')->__('Status'),
                            'values' => Mage::getModel('custtask/source_status')->toOptionArray()
                        )
                    )
                )
            );

        return $this;
    }

    /**
     * Row click url
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('block_id' => $row->getId()));
    }

}
