<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Bizproc\Activity\BaseActivity;
use Bitrix\Bizproc\FieldType;
use Bitrix\Main\ErrorCollection;
use Bitrix\Main\Localization\Loc;
use Bitrix\Bizproc\Activity\PropertiesDialog;
class CBPSearchByInnActivity extends BaseActivity
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
            'Inn' => '',

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

        $token = "1351c7d5a05d454f056fa8b5570a668b8a63819d";
        $secret = "ad46e4cf4129a2cccf92dce8f9af4ace68dc746b";
        
        $dadata = new Dadata($token, $secret);
        $dadata->init();

        $fields = array("query" => $this->Inn, "count" => 5);
        $response = $dadata->suggest("party", $fields);
        
        $companyName = 'Компания не найдена!';
        if(!empty($response['suggestions'])){ // если копания найдена
           // по ИНН возвращается массив в котором может бытьнесколько элементов (компаний)
           $companyName = $response['suggestions'][0]['value']; // получаем имя компании из первого элемента  
        }  

        $this->preparedProperties['Text'] = $companyName;
        $this->log($this->preparedProperties['Text']);

        /*создаем компанию*/
        $arNewCompany = array(
            "TITLE" => $companyName,
            "OPENED" => "Y",
            "COMPANY_TYPE" => "CUSTOMER"
        );
        $company = new CCrmCompany(false);
        $companyID = $company->Add($arNewCompany);

        $this->preparedProperties['id_test'] = $companyID;
        $this->log($this->preparedProperties['id_test']);

        $rootActivity = $this->GetRootActivity();
        $rootActivity->SetVariable("Variable1", $companyID);

        /* 
        $rootActivity = $this->GetRootActivity(); // получаем объект активити
        // сохранение полученных результатов работы активити в переменную бизнес процесса
        // $rootActivity->SetVariable("TEST", $this->preparedProperties['Text']); 

        // получение значения полей документа в активити        
        $documentType = $rootActivity->getDocumentType();
        $documentId = $rootActivity->getDocumentId();
        $documentService = CBPRuntime::GetRuntime(true)->getDocumentService();

        // поля документа
        $documentFields =  $documentService->GetDocumentFields($documentType); 
        foreach ($documentFields as $key => $value) {
            if($key == 'UF_CRM_1718872462762'){ // поле номер ИНН
                $fieldValue = $documentService->getFieldValue($documentId, $key, $documentType);
                $this->log('значение поля Инн:'.' '.$fieldValue);
            }

            if($key == 'UF_CRM_TEST'){ // поле TEST
                $fieldValue = $documentService->getFieldValue($documentId, $key, $documentType);
                $this->log('значение поля TEST:'.' '.$fieldValue);
            }
        }*/
      
        return $errors;
    }

    /**
     * @param PropertiesDialog|null $dialog
     * @return array[]
     */
    public static function getPropertiesDialogMap(?PropertiesDialog $dialog = null): array
    {
        $map = [
            'Inn' => [
                'Name' => Loc::getMessage('SEARCHBYINN_ACTIVITY_FIELD_SUBJECT'),
                'FieldName' => 'inn',
                'Type' => FieldType::STRING,
                'Required' => true,
                'Options' => [],
            ],
        ];
        return $map;
    }




}