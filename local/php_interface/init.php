<?
// автолоадер проекта
include_once __DIR__ . '/../app/autoload.php';

include_once __DIR__ . '/classes/Dadata.php';

// вывод данных
function pr($var, $type = false) {
    echo '<pre style="font-size:10px; border:1px solid #000; background:#FFF; text-align:left; color:#000;">';
    if ($type)
        var_dump($var);
    else
        print_r($var);
    echo '</pre>';
}

use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();

$eventManager -> addEventHandler(
    "iblock",
    "onBeforeIBlockElementAdd",
    [
        'Events\IblockHandler',
        'onElementAfterAdd'
    ]);
$eventManager -> addEventHandler(
    "iblock",
    "onAfterIBlockElementUpdate",
    [
        'Events\IblockHandler',
        'onElementAfterUpdate'
    ]);
$eventManager -> addEventHandler(
    "crm",
    "OnAfterCrmDealUpdate",
    [
        'Events\IblockHandler',
        'onDealAfterUpdate'
    ]);
//    'OnIBlockPropertyBuildList',
//    [
//        'UserTypes\IBLink', // класс обработчик пользовательского типа свойства
//        'GetUserTypeDescription'
//    ]
//);
// кастомный тип для свойства инфоблока (мой)
//$eventManager->AddEventHandler(
//    'iblock',
//    'OnIBlockPropertyBuildList',
//    [
//        'UserTypes\IBCustom', // класс обработчик пользовательского типа свойства
//        'GetUserTypeDescription'
//    ]
//);

// пользовательский тип для UF поля
//$eventManager->AddEventHandler(
//    'main',
//    'OnUserTypeBuildList',
//    [
//        'UserTypes\FormatTelegramLink', // класс обработчик пользовательского типа UF поля
//        'GetUserTypeDescription'
//    ]
//);

Bitrix\Main\UI\Extension::load(['popup', 'timeman.custom']);