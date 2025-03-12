<?php
namespace Bitrix\Timeman;
namespace Models;

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\BooleanField;
use Bitrix\Main\ORM\Fields\DatetimeField;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\TextField;
use Bitrix\Main\Type\DateTime;

/**
 * Class ReportFullTable
 *
 * Fields:
 * <ul>
 * <li> ID int mandatory
 * <li> TIMESTAMP_X datetime optional default current datetime
 * <li> ACTIVE bool ('N', 'Y') optional default 'Y'
 * <li> USER_ID int mandatory
 * <li> REPORT_DATE datetime optional
 * <li> DATE_FROM datetime optional
 * <li> DATE_TO datetime optional
 * <li> TASKS text optional
 * <li> EVENTS text optional
 * <li> FILES text optional
 * <li> REPORT text optional
 * <li> PLANS text optional
 * <li> MARK bool ('N', 'Y') optional default 'N'
 * <li> APPROVE bool ('N', 'Y') optional default 'N'
 * <li> APPROVE_DATE datetime optional
 * <li> APPROVER int optional
 * <li> FORUM_TOPIC_ID int optional default 0
 * </ul>
 *
 * @package Bitrix\Timeman
 **/

class ReportFullTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'b_timeman_report_full';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            'ID' => (new IntegerField('ID',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true)
            ,
            'TIMESTAMP_X' => (new DatetimeField('TIMESTAMP_X',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_TIMESTAMP_X_FIELD'))
                ->configureDefaultValue(function()
                {
                    return new DateTime();
                })
            ,
            'ACTIVE' => (new BooleanField('ACTIVE',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_ACTIVE_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('Y')
            ,
            'USER_ID' => (new IntegerField('USER_ID',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_USER_ID_FIELD'))
                ->configureRequired(true)
            ,
            'REPORT_DATE' => (new DatetimeField('REPORT_DATE',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_REPORT_DATE_FIELD'))
            ,
            'DATE_FROM' => (new DatetimeField('DATE_FROM',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_DATE_FROM_FIELD'))
            ,
            'DATE_TO' => (new DatetimeField('DATE_TO',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_DATE_TO_FIELD'))
            ,
            'TASKS' => (new TextField('TASKS',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_TASKS_FIELD'))
            ,
            'EVENTS' => (new TextField('EVENTS',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_EVENTS_FIELD'))
            ,
            'FILES' => (new TextField('FILES',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_FILES_FIELD'))
            ,
            'REPORT' => (new TextField('REPORT',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_REPORT_FIELD'))
            ,
            'PLANS' => (new TextField('PLANS',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_PLANS_FIELD'))
            ,
            'MARK' => (new BooleanField('MARK',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_MARK_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('N')
            ,
            'APPROVE' => (new BooleanField('APPROVE',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_APPROVE_FIELD'))
                ->configureValues('N', 'Y')
                ->configureDefaultValue('N')
            ,
            'APPROVE_DATE' => (new DatetimeField('APPROVE_DATE',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_APPROVE_DATE_FIELD'))
            ,
            'APPROVER' => (new IntegerField('APPROVER',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_APPROVER_FIELD'))
            ,
            'FORUM_TOPIC_ID' => (new IntegerField('FORUM_TOPIC_ID',
                []
            ))->configureTitle(Loc::getMessage('REPORT_FULL_ENTITY_FORUM_TOPIC_ID_FIELD'))
                ->configureDefaultValue(0)
            ,
        ];
    }
    public static function onAfterAdd(Event $event)
    {
        \Bitrix\Main\Diag\Debug::writeToFile($event, 'Date', 'my-custom-log.php');
        $result = new EventResult();
        $data = $event->getParameter("fields");

        // Логика обработки после добавления элемента
        // Например, можно записать в лог или отправить уведомление
        AddMessage2Log("Добавлен новый элемент с ID: " . $data['ID']);

        return $result;
    }
}
