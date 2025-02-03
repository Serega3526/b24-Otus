<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Bizproc\Activity\BaseActivity;
use Bitrix\Bizproc\FieldType;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Localization\Loc;
use Bitrix\Bizproc\Activity\PropertiesDialog;
use Bitrix\Im\Chat;
class CBPMessageActivity extends BaseActivity
{
    // protected static $requiredModules = ["crm"];
    
    /**
     * @see parent::_construct()
     * @param $name string Activity name
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->arProperties = [
            'id' => '',

            // return
            'Text' => null,
        ];

        $this->SetPropertiesTypes([
            'Text' => ['Type' => FieldType::STRING],
        ]);
    }

    /**
     * Return activity file path
     * @return string
     */
    protected static function getFileName(): string
    {
        return __FILE__;
    }

    /**
     * @return ErrorCollection
     */
    protected function internalExecute(): ErrorCollection 
    {
        $errors = parent::internalExecute();


        CModule::IncludeModule('im');

        $messageId = 15;

        $delete_message = \Bitrix\Im\Model\MessageTable::delete($messageId);

      
        return $errors;
    }

    /**
     * @param PropertiesDialog|null $dialog
     * @return array[]
     */
    public static function getPropertiesDialogMap(?PropertiesDialog $dialog = null): array
    {
        $map = [
            'id' => [
                'Name' => Loc::getMessage('MESSAGE_ACTIVITY_FIELD_SUBJECT'),
                'FieldName' => 'id',
                'Type' => FieldType::STRING,
                'Required' => true,
                'Options' => [],
            ],
        ];
        return $map;
    }




}