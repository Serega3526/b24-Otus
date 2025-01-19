<?
// это подключаем если код ниже будет исполняться в отдельном файле php
global $USER;
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $proc = $_POST['proc'] ?? '';
    $date = $_POST['date'] ?? '';

    $el = new CIBlockElement;
    $PROP = array();
    $PROP["FIO"] = $name;
    $PROP["PROTSEDURA"] = $proc;
    $PROP["VREMYA_ZAPISI"] = $date;
    $arLoadProductArray = array(
        "ACTIVE_FROM" => date('d.m.Y H:i:s'),
        "MODIFIED_BY" => $USER->GetID(),
        "IBLOCK_SECTION_ID" => 164,
        "IBLOCK_ID" => 42,
        "NAME" => "Название элемента",
        "PREVIEW_TEXT" => "Превью описание элемента",
        "DETAIL_TEXT" => "Детальный текст",
        "ACTIVE" => "Y",
        "CODE" => "test",
        "PROPERTY_VALUES" => $PROP,
        "SORT" => 100,
    );

    if ($newElement = $el->Add($arLoadProductArray)) {
        echo "ID нового элемента: " . $newElement;
    } else {
        echo "Error: " . $el->LAST_ERROR;
    }
    echo json_encode(['status' => 'success', 'message' => 'Данные успешно отправлены']);
    exit;
}

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");