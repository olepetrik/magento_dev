<?php
/** @var Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$installer->run("
CREATE TABLE IF NOT EXISTS `{$this->getTable('custom/block')}` (
  `custom_id` int(11) NOT NULL AUTO_INCREMENT,
  `custom_code` text NOT NULL,
  `created_at` datetime NOT NULL,
  `block_status` int(11) NOT NULL,
  PRIMARY KEY (`custom_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
");

$installer->endSetup();
