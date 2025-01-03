<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

use Bitrix\Main\Type;


use Models\Lists\CurrenciesTable as Currencies;
$allParameters = [];

$collection = Currencies::getList([
    'select' => [
        'CURRENCY',
        'AMOUNT'
    ]
])->fetchCollection();

foreach ($collection as $key => $item) {
    $allParameters[] = $item['AMOUNT'];
}
?>
<h1>Курс выбранной в параметрах валюты: <?=$allParameters[$arParams['CURRENCIES']]; ?></h1>
<?php
