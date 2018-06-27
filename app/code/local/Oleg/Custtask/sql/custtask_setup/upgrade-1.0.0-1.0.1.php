<?php
/** @var Mage_Core_Model_Resource_Setup */

$installer = $this;

$installer->startSetup();

$installer->run("

ALTER TABLE `{$this->getTable('custtask/block')}` ADD `custom_content` VARCHAR(50) NOT NULL;
");

$installer->endSetup();
