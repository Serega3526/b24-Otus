<?php
namespace otus\currencies;
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
/**
 * @var CMain $APPLICATION
 */
$APPLICATION->setTitle('Список валют');


$APPLICATION->includeComponent(
    "otus:currencies.change",
    "list",
    array(
        "COMPONENT_TEMPLATE" => "list",
        "CURRENCIES" => "RUB"
    ),
    false
);
?>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';