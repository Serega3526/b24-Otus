<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arCurrentValues */

if(!CModule::IncludeModule("iblock"))
    return;

use Models\Lists\CurrenciesTable as Currencies;

$arrCur = [];
$collection = Currencies::getList([
    'select' => [
        'CURRENCY'
    ]
])->fetchCollection();
foreach ($collection as $key => $item) {
    $arrCur[] = $item['CURRENCY'];
}

$arComponentParameters = array(
    "GROUPS" => array(
        "LIST"=>array(
            "NAME"=>GetMessage("GRID_PARAMETERS"),
            "SORT"=>"300"
        )
    ),
    "PARAMETERS" => array(
        "CURRENCIES" =>  array(
            "PARENT" => "LIST",
            "NAME"=>GetMessage("SHOW_ACTION_BTNS"),
            "TYPE" => "LIST",
            "VALUES" => $arrCur,
            "DEFAULT" => "EUR",
            "REFRESH" => "Y"
        ),
    )
);