<?php


class Oleg_Custtask_Block_Adminhtml_Custtomer extends Mage_Adminhtml_Block_Widget_Grid
{

    public function render(Varien_Object $row)
    {
        $value =  $row->getData($this->getColumn()->getIndex());

        return $value;
    }
}