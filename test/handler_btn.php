<?
// это подключаем если код ниже будет исполняться в отдельном файле php
global $USER;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST;
    pr($name);
//    BX.addCustomEvent($name,'onTimeManDataRecieved', function() {
//
//    });

//    echo json_encode(['status' => 'success', 'message' => 'Данные успешно отправлены']);
//    exit;
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");