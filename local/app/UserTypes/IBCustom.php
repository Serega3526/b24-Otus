<?php

namespace UserTypes;


class IBCustom
{
    public static function GetUserTypeDescription()
    {
        return array(
            'PROPERTY_TYPE'        => 'S', // тип поля
            'USER_TYPE'            => 'iblock_link', // код типа пользовательского свойства
            'DESCRIPTION'          => 'Кастомное поле', // название типа пользовательского свойства
            'GetPropertyFieldHtml' => array(self::class, 'GetPropertyFieldHtml'), // метод отображения свойства
            'GetSearchContent' => array(self::class, 'GetSearchContent'), // метод поиска
            'GetAdminListViewHTML' => array(self::class, 'GetAdminListViewHTML'),  // метод отображения значения в списке
            'GetPublicEditHTML' => array(self::class, 'GetPropertyFieldHtml'), // метод отображения значения в форме редактирования
            'GetPublicViewHTML' => array(self::class, 'GetPublicViewHTML'), // метод отображения значения
        );
    }


    public static function PrepareSettings($arFields)
    {
        // return array("_BLANK" => ($arFields["USER_TYPE_SETTINGS"]["_BLANK"] == "Y" ? "Y" : "N"));
        if(is_array($arFields["USER_TYPE_SETTINGS"]) && $arFields["USER_TYPE_SETTINGS"]["_BLANK"] == "Y"){
            return array("_BLANK" =>  "Y");
        }else{
            return array("_BLANK" =>  "N");
        }
    }

    public  static function Test()
    {
        Loader::includeModule('iblock');
        $elementData = [
            'NAME' => BX("modal_name").value,
            'FIO' => BX("modal_name").value,
            'VREMYA_ZAPISI' => BX("modal_date").value,
            'IBLOCK_ID' => 42,
            'ACTIVE' => 'Y',
        ];


        $result = ElementTable::add($elementData);
    }


    public static function GetPublicViewHTML($arProperty, $arValue, $strHTMLControlName)
    {
        $arSettings = self::PrepareSettings($arProperty);

        $arVals = array();
        if (!is_array($arProperty['VALUE'])) {
            $arProperty['VALUE'] = array($arProperty['VALUE']);
            $arProperty['DESCRIPTION'] = array($arProperty['DESCRIPTION']);
        }
        foreach ($arProperty['VALUE'] as $i => $value) {
            $arVals[$value] = $arProperty['DESCRIPTION'][$i];
        }
        $inpid = md5('link_' . rand(0, 999));
        $strResult = '';
        $strResult = '<a id="link' . $inpid . '" ' . ($arSettings["_BLANK"] == 'Y' ? 'target="_blank"' : '') . ' href="#">' . (trim($arVals[$arValue['VALUE']]) ? trim($arVals[$arValue['VALUE']]) : trim($arValue['VALUE'])) . '</a>';
        ?>
        <script>
            // BX.element - элемент, к которому будет привязано окно, если null – окно появится по центру экрана

            BX.ready(function () {
                let link = BX("link<?=$inpid?>")
                BX.bind(link, 'click', function (event){
                    let proc = event.target.textContent
                    var popup = BX.PopupWindowManager.create("popup-message", null, {
                        content: '<form id="modal">' +
                            '<input type="text" id="modal_name" name="name" placeholder="Введите ваше имя" style="margin-bottom: 10px;">' +
                            '<br>' +
                            `<input type="hidden" name="proc" id="modal_proc" value="">` +
                            '<br>' +
                            '<input id="modal_date" type="text" placeholder="Введите дату" name="date" onclick="BX.calendar({node: this, field: this, bTime: true, bHideTime: false});">' +
                            '</form>',
                        width: 500, // ширина окна
                        height: 250, // высота окна
                        zIndex: 100, // z-index
                        closeIcon: {
                            // объект со стилями для иконки закрытия, при null - иконки не будет
                            opacity: 1
                        },
                        titleBar: 'Запись на процедуру',
                        closeByEsc: true, // закрытие окна по esc
                        darkMode: false, // окно будет светлым или темным
                        autoHide: false, // закрытие при клике вне окна
                        draggable: true, // можно двигать или нет
                        resizable: true, // можно ресайзить
                        min_height: 100, // минимальная высота окна
                        min_width: 100, // минимальная ширина окна
                        lightShadow: true, // использовать светлую тень у окна
                        angle: true, // появится уголок
                        overlay: {
                            // объект со стилями фона
                            backgroundColor: 'black',
                            opacity: 500
                        },
                        buttons: [
                            new BX.PopupWindowButton({
                                text: 'Записаться', // текст кнопки
                                id: 'save-btn', // идентификатор
                                className: 'ui-btn ui-btn-success', // доп. классы
                                events: {
                                    click: function() {
                                        // Событие при клике на кнопку
                                        BX("modal_proc").value = proc

                                        let customForm = BX("modal");
                                        let data = new FormData(customForm);
                                        BX.ajax({
                                            url: "../../../../../test/handler_proc.php",
                                            data: data,
                                            method: "POST",
                                            dataType: "json",
                                            processData: false,
                                            preparePost: false,
                                            // действия в случаи успеха
                                            onsuccess: function (data) {
                                                console.log('1111');
                                            },
                                            // действия в случаи ошибки
                                            onfailure: function () {
                                                console.log("error");
                                            },
                                        });

                                        window.location.href = 'https://cs28277.tw1.ru/services/lists/42/view/0/?list_section_id='
                                    }
                                }
                            }),
                        ],
                        events: {
                            onPopupShow: function() {
                                // Событие при показе окна
                            },
                            onPopupClose: function() {
                                // Событие при закрытии окна
                                let modal = BX("modal")
                                modal.reset()
                            }
                        }
                    });

                    popup.show();

                })
            });
        </script>
        <?php
        return $strResult;
    }


    public static function GetAdminListViewHTML($arProperty, $arValue, $strHTMLControlName)
    {
        $arSettings = self::PrepareSettings($arProperty);

        $strResult = '';
        $strResult = '<a ' . ($arSettings["_BLANK"] == 'Y' ? 'target="_blank"' : '') . ' href="#">' . (trim($arValue['DESCRIPTION']) ? trim($arValue['DESCRIPTION']) : trim($arValue['VALUE'])) . '</a>';
        return $strResult;
    }


    public static function GetSearchContent($arProperty, $value, $strHTMLControlName)
    {
        if (trim($value['VALUE']) != '') {
            return $value['VALUE'] . ' ' . $value['DESCRIPTION'];
        }

        return '';
    }

    public static function GetPropertyFieldHtml($arProperty, $arValue, $strHTMLControlName)
    {
        $html = '<input type="hidden" value="" name="'.$strHTMLControlName["VALUE"].'">';
        $html .= '<input type="text" size="'.$arProperty['COL_COUNT'].'" value="1" name="'.$strHTMLControlName["VALUE"].'"'.'>';

        return $html;
    }
}

