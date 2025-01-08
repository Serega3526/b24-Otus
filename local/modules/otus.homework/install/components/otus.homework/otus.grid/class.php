<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

/** @global CIntranetToolbar $INTRANET_TOOLBAR */

// global $INTRANET_TOOLBAR;
// use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Main\Context,
    Bitrix\Main\Application,
    Bitrix\Main\Type\DateTime,
    Bitrix\Main\Loader,
    Bitrix\Main\Localization\Loc,
    Bitrix\Main\Engine\Contract\Controllerable,
    Bitrix\Iblock;
use Bitrix\Main\Engine\Contract;
use Models\ClientsTable as Clients;
use Models\Lists\CurrencyTable as Currencies;



class TableViewsComponent extends \CBitrixComponent
{

    protected $request;

    /**
     * Подготовка параметров компонента
     * @param $arParams
     * @return mixed
     */
    public function onPrepareComponentParams($arParams) {
        // тут пишем логику обработки параметров, дополнение к параметрам по умолчанию
        return $arParams;
    }


    /**
     * Проверка наличия модулей требуемых для работы компонента
     * @return bool
     * @throws Exception
     */
    private function checkModules()
    {
        if(!Loader::includeModule('iblock') || !Loader::includeModule('crm')){
            throw new \Exception("Не загружены модули необходимые для работы компонента");
        }
        return true;
    }

    private function getGridColumns(): array
    {
        $columns = [
            [
                'id' => 'ID',
                'name' => 'ID',
                'sort' => 'ID',
                'default' => true
            ],
            [
                'id' => 'NAME',
                'name' => 'NAME',
                'sort' => 'NAME',
                'default' => true
            ],
            [
                'id' => 'CODE',
                'name' => 'CODE',
                'sort' => 'CODE',
                'default' => true
            ]
        ];

        return $columns;
    }
    private function getGridRows(): array
    {
        \Bitrix\Main\Loader::includeModule('iblock');
        $list = [];
        $data = \Bitrix\Iblock\Elements\ElementTestapiTable::getList([
            'select' => ['ID', 'NAME', 'CODE'],
            'order' => ['ID' => 'ASC'],
        ]);
        while ($item = $data->fetch()) {
            $list[] = array('data' => $item);
        }

        return $list;
    }

    /**
     * Точка входа в компонент
     * Должна содержать только последовательность вызовов вспомогательых ф-ий и минимум логики
     * всю логику стараемся разносить по классам и методам
     */
    public function executeComponent() {

        try
        {
            $this->checkModules(); // проверяем подключение модулей
            $this->arResult['COLUMNS'] = $this->getGridColumns();
            $this->arResult['ROWS'] = $this->getGridRows();
            $this->IncludeComponentTemplate();

        }
        catch (SystemException $e)
        {
            ShowError($e->getMessage());
        }

    }


}