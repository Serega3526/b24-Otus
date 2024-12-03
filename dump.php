<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Отладка');
$array = [
    1,
    2,
    3,
    4,
    5,
    6
];
\Bitrix\Main\Diag\Debug::dump($array);
\Bitrix\Main\Diag\Debug::writeToFile($array, 'myArray');

require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';