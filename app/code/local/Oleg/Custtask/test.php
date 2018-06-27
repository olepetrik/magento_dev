<?php
//Загрузить объект из таблицы block_id = 1
$block = Mage::getModel('custtask/block')->load(1);

//Загрузить коллекцию блоков из таблицы
$blocks = Mage::getModel('custtask/block')->getCollection();

//Альтернативный способ загрузки коллекции
$blocks = Mage::getResourceModel('custtask/block_collection');

//Использование хелпера
Mage::helper('custtask');

include "app/Mage.php";
Mage::app();


$customerHelper = Mage::helper('customer/address');
var_dump(get_class($customerHelper));