<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php';
use Bitrix\Main\Loader;
use Bitrix\Crm\Service\Container;

// ДОБАВЛЕНИЕ ЛИДОВ

Loader::includeModule('crm');
$leads = [
  'TITLE' => 'test',
    'STATUS_ID' => 'IN_PROCESS',
];
$leadModel = new \CCrmLead;
$res = $leadModel->add($leads);
var_dump($res);

require_once $_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php';