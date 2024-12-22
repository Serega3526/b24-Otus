<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

//ПОЛУЧЕНИЕ ДАННЫХ ПО СДЕЛКЕ D7
/*
if (!Loader::includeModule('crm')) {
    return;
}
$dealOrder = [
    'TITLE' => 'ASC',
];
$dealFilterFields = [];
$dealSelectFields = [
    'ID',
    'TITLE',
];
$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
//Чтобы получить данные по смарту нужно вместо  (\CCrmOwnerType::Deal) поставить id из урла сделки
$dealItems = $dealFactory->getItems([
    'filter' => $dealFilterFields,
    'order' => $dealOrder,
    'select' => $dealSelectFields,
]);

echo '<pre>';
foreach ($dealItems as $dealItem) {
    var_dump($dealItem['ID']); # 1
    var_dump($dealItem['TITLE']);
    var_dump($dealItem->get('ID')); # 2
    var_dump($dealItem->get('TITLE'));
    var_dump($dealItem->getId()); # 3
    var_dump($dealItem->getTitle());
}
echo '</pre>';
*/


//CREATE сделки d7
/*
if (!Loader::includeModule('crm')) {
    return;
}

$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
$newDealItem = $dealFactory->createItem();
$newDealItem->set('TITLE', 'Тестовая сделка D7 - ' . date('d-m-Y-H-i-s'));

//$res =  $newDealItem->save(); # Выполнит сохранение сразу без проверки прав доступа и без запуска обработчиков событий
//var_dump($res);
$dealAddOperation = $dealFactory->getAddOperation($newDealItem);

$addResult = $dealAddOperation->launch();
echo '<pre>';
var_dump($addResult);
echo '</pre>';
*/

//UPDATE сделки d7
/*
if (!Loader::includeModule('crm')) {
    return;
}

$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
$dealId = 18;
$newDealItem = $dealFactory->getItem($dealId);
$newDealItem->set('TITLE', 'Тестовая сделка D7 - UPDATE' . date('d-m-Y-H-i-s'));

//$res =  $newDealItem->save(); # Выполнит сохранение сразу без проверки прав доступа и без запуска обработчиков событий
//var_dump($res);
$dealUpdateOperation = $dealFactory->getUpdateOperation($newDealItem);

$addResult = $dealUpdateOperation->launch();
echo '<pre>';
var_dump($addResult);
echo '</pre>';
*/


//DELETE сделки d7
if (!Loader::includeModule('crm')) {
    return;
}

$dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
$dealIdDelete = 18;
$dealItem = $dealFactory->getItem($dealIdDelete);

//$res =  $newDealItem->save(); # Выполнит сохранение сразу без проверки прав доступа и без запуска обработчиков событий
//var_dump($res);
$dealUpdateOperation = $dealFactory->getDeleteOperation($dealItem);

$deleteResult = $dealUpdateOperation->launch();
echo '<pre>';
var_dump($deleteResult->isSuccess());
echo '</pre>';

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';