<?php
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\FloatField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\TextField;

/**
 * Class ElementPropS44Table
 *
 * Fields:
 * <ul>
 * <li> IBLOCK_ELEMENT_ID int mandatory
 * <li> PROPERTY_91 double optional
 * <li> PROPERTY_93 text optional
 * <li> PROPERTY_94 text optional
 * <li> PROPERTY_96 double optional
 * </ul>
 *
 * @package Bitrix\Iblock
 **/

class TestTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_iblock_element_prop_s44';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            'IBLOCK_ELEMENT_ID' => (new IntegerField('IBLOCK_ELEMENT_ID',
                []
            ))->configureTitle(Loc::getMessage('ELEMENT_PROP_S44_ENTITY_IBLOCK_ELEMENT_ID_FIELD'))
                ->configurePrimary(true)
            ,
            'PROPERTY_91' => (new FloatField('PROPERTY_91',
                []
            ))->configureTitle(Loc::getMessage('ELEMENT_PROP_S44_ENTITY_PROPERTY_91_FIELD'))
            ,
            'PROPERTY_93' => (new TextField('PROPERTY_93',
                []
            ))->configureTitle(Loc::getMessage('ELEMENT_PROP_S44_ENTITY_PROPERTY_93_FIELD'))
            ,
            'PROPERTY_94' => (new TextField('PROPERTY_94',
                []
            ))->configureTitle(Loc::getMessage('ELEMENT_PROP_S44_ENTITY_PROPERTY_94_FIELD'))
            ,
            'PROPERTY_96' => (new FloatField('PROPERTY_96',
                []
            ))->configureTitle(Loc::getMessage('ELEMENT_PROP_S44_ENTITY_PROPERTY_96_FIELD'))
            ,
        ];
    }
}