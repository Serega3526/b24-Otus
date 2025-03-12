<?php

namespace Events;

use Bitrix\Crm\ItemIdentifier;
use Bitrix\Crm\Service\Container;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;
use Bitrix\Im\Chat;
use Models\ReportFullTable as Report;
/**
 * @var CMain $APPLICATION
 */

class IblockHandler
{
    public static function OnAfterFullReportAdd(&$arFields)
    {\Bitrix\Main\Diag\Debug::writeToFile($arFields, 'Date', 'my-custom-log.php');
//        if ($arFields["IBLOCK_ID"] != 44)
//            return $arFields;
        Loader::includeModule('iblock');
        $message = '';
        $elements = Report::getList([
            'select' => [
                'ID',
                'TIMESTAMP_X',
                'USER_ID',
                'REPORT_DATE',
                'REPORT'
            ],
            'limit' => 5,
        ]) -> fetchCollection();
//        $elements = \Bitrix\Iblock\Elements\ElementZayavkaTable::query()
//            ->addSelect('NAME')
//            ->addSelect('SDELKA')
//            ->addSelect('OTVETSTVENNYY')
//            ->addSelect('SUMMA2')
//            ->fetchCollection();
        foreach ($elements as $key => $item) {
                $message = '$arFields';
        }
        $reprot = "Отчет за ДАТА от USER: \n$message";
        if (!Loader::includeModule('crm')) {
            return;
        }
        if (\Bitrix\Main\Loader::includeModule('im'))
        {
            \CIMMessage::Add(array(
                'FROM_USER_ID' => 1,
                'TO_USER_ID' => 3,
                'MESSAGE' => $reprot,
            ));
        }
    }
}


//class IblockHandler
//{
//    protected static $handlerDisallow = false;
//
//    public static function onElementAfterAdd(&$arFields)
//    {
//        if (self::$handlerDisallow)
//            return;
//        self::$handlerDisallow = true;
//        if ($arFields["IBLOCK_ID"] != 44)
//            return $arFields;
//        Loader::includeModule('iblock');
//        $test = '';
//        $elements = \Bitrix\Iblock\Elements\ElementZayavkaTable::query()
//            ->addSelect('NAME')
//            ->addSelect('SDELKA')
//            ->addSelect('OTVETSTVENNYY')
//            ->addSelect('SUMMA2')
//            ->fetchCollection();
//        foreach ($elements as $key => $item) {
//            if ($arFields['NAME']){
//                $test = $arFields['NAME'];
//
//            }
////            $value = $item->getSdelka()->getValue();
////            if($value == $arFields['ID']) {
////                if($arFields['TITLE']){
////                    $item->setName($arFields['TITLE']);
////                    $item->save();
////                }
////                if($arFields['OPPORTUNITY']){
////                    $item->setSumma2($arFields['OPPORTUNITY']);
////                    $item->save();
////                }
////                if($arFields['ASSIGNED_BY_ID']){
////                    $item->setOtvetstvennyy($arFields['ASSIGNED_BY_ID']);
////                    $item->save();
////                }
////
////            }
//        }
//        $reprot = "Отчет за ДАТА от USER: \n$test";
//        if (!Loader::includeModule('crm')) {
//            return;
//        }
//        if (\Bitrix\Main\Loader::includeModule('im'))
//        {
//            \CIMMessage::Add(array(
//                'FROM_USER_ID' => 1,
//                'TO_USER_ID' => 3,
//                'MESSAGE' => $reprot,
//            ));
//        }
//
////        $dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
////        $newDealItem = $dealFactory->createItem();
////        $newDealItem->set('TITLE', $arFields['NAME']);
////        $newDealItem->set('CURRENCY_ID', 'RUB');
////        $newDealItem->set('OPPORTUNITY', (end($arFields['PROPERTY_VALUES']['96'])));
////        $newDealItem->set('ASSIGNED_BY_ID', $arFields['PROPERTY_VALUES']['93']);
////        $dealAddOperation = $dealFactory->getAddOperation($newDealItem);
////        $addResult = $dealAddOperation->launch();
////        $dealId = $addResult->getId();
////
////        $arFields['PROPERTY_VALUES']['91'] = $dealId;
//
//        self::$handlerDisallow = false;
//    }
//
//    public static function onElementAfterUpdate(&$arFields)
//    {
//        if (self::$handlerDisallow)
//            return;
//        self::$handlerDisallow = true;
//        if (!Loader::includeModule('crm')) {
//            return;
//        }
//
//        $dealId = (end($arFields['PROPERTY_VALUES']['91']));
//        $entityFields = [
//            'OPPORTUNITY'   => (end($arFields['PROPERTY_VALUES']['96'])),
//            'ASSIGNED_BY_ID' => $arFields['PROPERTY_VALUES']['93'],
//            'TITLE' => $arFields['NAME'],
//        ];
//        $entityObject = new \CCrmDeal();
//
//        $isUpdateSuccess = $entityObject->Update(
//            $dealId,
//            $entityFields,
//        );
//        self::$handlerDisallow = false;
//    }
//
//    public static function onDealAfterUpdate(&$arFields)
//    {
////        echo ''; print_r($arFields); echo ''; die();
//        if (self::$handlerDisallow)
//            return;
//        self::$handlerDisallow = true;
//        Loader::includeModule('iblock');
//        $elements = \Bitrix\Iblock\Elements\ElementZayavkaTable::query()
//            ->addSelect('NAME')
//            ->addSelect('SDELKA')
//            ->addSelect('OTVETSTVENNYY')
//            ->addSelect('SUMMA2')
//            ->fetchCollection();
//        foreach ($elements as $key => $item) {
//            if ($arFields['NAME']){
//
//            }
//            $value = $item->getSdelka()->getValue();
//            if($value == $arFields['ID']) {
//                if($arFields['TITLE']){
//                    $item->setName($arFields['TITLE']);
//                    $item->save();
//                }
//                if($arFields['OPPORTUNITY']){
//                    $item->setSumma2($arFields['OPPORTUNITY']);
//                    $item->save();
//                }
//                if($arFields['ASSIGNED_BY_ID']){
//                    $item->setOtvetstvennyy($arFields['ASSIGNED_BY_ID']);
//                    $item->save();
//                }
//
//            }
//        }
//        self::$handlerDisallow = false;
//    }
//}
