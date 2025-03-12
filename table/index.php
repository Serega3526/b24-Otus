<?php
namespace table;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/** @global $APPLICATION */
$APPLICATION->SetTitle('Кастомная таблица');

use Models\ReportFullTable as Clients;


$test = Clients::getList([
    'select' => [
        'ID',
        'TIMESTAMP_X',
        'USER_ID',
        'REPORT_DATE',
        'REPORT'
    ],
    'limit' => 3,
]) -> fetchCollection();

foreach ($test as $client => $record) {
    pr('ID:'.$record->getId().';'."\n".'Фамилия, Имя:'.$record->getReport());
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");