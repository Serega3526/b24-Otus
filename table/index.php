<?php
namespace table;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
/** @global $APPLICATION */
$APPLICATION->SetTitle('Кастомная таблица');

use Models\HospitalClientsTable as Clients;

$test = Clients::getList([
    'select' => [
        'id',
        'first_name',
        'contact_id',
        'doctor_id',
        'CONTACT.*',
        'JOB.*',
        'COLORS.*'
    ],
    'limit' => 3,
]) -> fetchCollection();

foreach ($test as $client => $record) {
    pr('ID:'.$record->getId().';'."\n".'Фамилия, Имя:'.$record->getLastName().' '.$record->getFirstName().'; '."\n".'Должность (из контакта): '.$record->getContact()->getPost().'; '."\n".'Авто (из таблицы JOBS): '.$record->getJob()->getName().'; '."\n".'Любимый цвет(Из таблицы COLORS): '.$record->getColors()->getName().';');
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");