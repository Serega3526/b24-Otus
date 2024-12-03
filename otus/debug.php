<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Дата открытия файла');
$myDate = date("d-m-y h: i: s");

echo 'В файл my-custom-log.php записалось: ' . $myDate;
\Bitrix\Main\Diag\Debug::writeToFile($myDate, 'Date', 'my-custom-log.php');

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';