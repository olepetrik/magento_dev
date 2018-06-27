<?php
class Oleg_Custom_Block_Form extends Mage_Core_Block_Template
{
    public function getActionOfForm()
    {
      return $this->getUrl('custom/index/save');
    }

}