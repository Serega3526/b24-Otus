<?php
namespace Bitrix\Clients;
namespace Models;

use Bitrix\Main\Entity\Query\Join;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ORM\Data\DataManager;
use Bitrix\Main\ORM\Fields\IntegerField;
use Bitrix\Main\ORM\Fields\Relations\OneToMany;
use Bitrix\Main\ORM\Fields\Relations\Reference;
use Bitrix\Main\ORM\Fields\StringField;
use Bitrix\Main\ORM\Fields\Validators\LengthValidator;

/**
 * Class ClientsTable
 *
 * Fields:
 * <ul>
 * <li> id int mandatory
 * <li> first_name string(50) optional
 * <li> last_name string(50) optional
 * <li> age int optional
 * <li> doctor_id int optional
 * <li> procedure_id int optional
 * <li> contact_id int optional
 * </ul>
 *
 * @package Bitrix\Clients
 **/
use  Models\JobsTable as Jobs;
use  Models\ColorsTable as Colors;

class HospitalClientsTable extends DataManager
{
    /**
     * Returns DB table name for entity.
     *
     * @return string
     */
    public static function getTableName()
    {
        return 'hospital_clients';
    }

    /**
     * Returns entity map definition.
     *
     * @return array
     */
    public static function getMap()
    {
        return [
            'id' => (new IntegerField('id',
                []
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_ID_FIELD'))
                ->configurePrimary(true)
                ->configureAutocomplete(true)
            ,
            'first_name' => (new StringField('first_name',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_FIRST_NAME_FIELD'))
            ,
            'last_name' => (new StringField('last_name',
                [
                    'validation' => function()
                    {
                        return[
                            new LengthValidator(null, 50),
                        ];
                    },
                ]
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_LAST_NAME_FIELD'))
            ,
            'age' => (new IntegerField('age',
                []
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_AGE_FIELD'))
                ->configureSize(1)
            ,
            'doctor_id' => (new IntegerField('doctor_id',
                []
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_DOCTOR_ID_FIELD'))
                ->configureSize(1)
            ,
            'procedure_id' => (new IntegerField('procedure_id',
                []
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_PROCEDURE_ID_FIELD'))
                ->configureSize(1)
            ,
            'contact_id' => (new IntegerField('contact_id',
                []
            ))->configureTitle(Loc::getMessage('CLIENTS_ENTITY_CONTACT_ID_FIELD'))
            ,
            (new Reference('CONTACT', \Bitrix\CRM\ContactTable::class,
                Join::on('this.contact_id', 'ref.ID')))
                ->configureJoinType('inner'),
            (new Reference('JOB', Jobs::class,
                Join::on('this.doctor_id', 'ref.id')))
                ->configureJoinType('inner'),
            (new Reference('COLORS', Colors::class,
                Join::on('this.procedure_id', 'ref.id')))
                ->configureJoinType('inner'),
        ];
    }
}