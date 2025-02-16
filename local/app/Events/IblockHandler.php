<?php

namespace Events;

use Bitrix\Crm\ItemIdentifier;
use Bitrix\Crm\Service\Container;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

class IblockHandler
{
    protected static $handlerDisallow = false;

    public static function onElementAfterAdd(&$arFields)
    {
        if (self::$handlerDisallow)
            return;
        self::$handlerDisallow = true;
        if ($arFields["IBLOCK_ID"] != 44)
            return $arFields;

        if (!Loader::includeModule('crm')) {
            return;
        }

        $dealFactory = Container::getInstance()->getFactory(\CCrmOwnerType::Deal);
        $newDealItem = $dealFactory->createItem();
        $newDealItem->set('TITLE', $arFields['NAME']);
        $newDealItem->set('CURRENCY_ID', 'RUB');
        $newDealItem->set('OPPORTUNITY', (end($arFields['PROPERTY_VALUES']['96'])));
        $newDealItem->set('ASSIGNED_BY_ID', $arFields['PROPERTY_VALUES']['93']);
        $dealAddOperation = $dealFactory->getAddOperation($newDealItem);
        $addResult = $dealAddOperation->launch();
        $dealId = $addResult->getId();

        $arFields['PROPERTY_VALUES']['91'] = $dealId;

        self::$handlerDisallow = false;
    }

    public static function onElementAfterUpdate(&$arFields)
    {
        if (self::$handlerDisallow)
            return;
        self::$handlerDisallow = true;
        if (!Loader::includeModule('crm')) {
            return;
        }

        $dealId = (end($arFields['PROPERTY_VALUES']['91']));
        $entityFields = [
            'OPPORTUNITY'   => (end($arFields['PROPERTY_VALUES']['96'])),
            'ASSIGNED_BY_ID' => $arFields['PROPERTY_VALUES']['93'],
            'TITLE' => $arFields['NAME'],
        ];
        $entityObject = new \CCrmDeal();

        $isUpdateSuccess = $entityObject->Update(
            $dealId,
            $entityFields,
        );
        self::$handlerDisallow = false;
    }

    public static function onDealAfterUpdate(&$arFields)
    {
//        echo ''; print_r($arFields); echo ''; die();
        if (self::$handlerDisallow)
            return;
        self::$handlerDisallow = true;
        Loader::includeModule('iblock');
        $elements = \Bitrix\Iblock\Elements\ElementZayavkaTable::query()
            ->addSelect('NAME')
            ->addSelect('SDELKA')
            ->addSelect('OTVETSTVENNYY')
            ->addSelect('SUMMA2')
            ->fetchCollection();
        foreach ($elements as $key => $item) {
            $value = $item->getSdelka()->getValue();
            if($value == $arFields['ID']) {
                if($arFields['TITLE']){
                    $item->setName($arFields['TITLE']);
                    $item->save();
                }
                if($arFields['OPPORTUNITY']){
                    $item->setSumma2($arFields['OPPORTUNITY']);
                    $item->save();
                }
                if($arFields['ASSIGNED_BY_ID']){
                    $item->setOtvetstvennyy($arFields['ASSIGNED_BY_ID']);
                    $item->save();
                }

            }
        }
        self::$handlerDisallow = false;
    }
}
