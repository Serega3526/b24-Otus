


BX.addCustomEvent('onTimeManWindowOpen', function (obj){
    BX.addCustomEvent('onTimeManDataRecieved', function (obj2){
        console.log('222222',obj2)
        let par = document.createElement('div')
        var popup = BX.PopupWindowManager.create("popup-message", par, {
            content: 'Контент, отображаемый в теле окна',
            width: 400, // ширина окна
            height: 100, // высота окна
            zIndex: 100, // z-index
            closeIcon: {
                // объект со стилями для иконки закрытия, при null - иконки не будет
                opacity: 1
            },
            titleBar: 'Заголовок окна',
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
                    text: 'Сохранить', // текст кнопки
                    id: 'save-btn', // идентификатор
                    className: 'ui-btn ui-btn-success', // доп. классы
                    events: {
                        click: function() {
                            // Событие при клике на кнопку
                            console.log(obj2)
                            // BX.onCustomEvent('onTimeManDataRecieved',[window]);
                            // Событие при клике на кнопку

                            let data = JSON.stringify(obj2);
                            BX.ajax({
                                url: "/../../test/handler_btn.php",
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
                        }
                    }
                }),
                new BX.PopupWindowButton({
                    text: 'Копировать',
                    id: 'copy-btn',
                    className: 'ui-btn ui-btn-primary',
                    events: {
                        click: function() {

                        }
                    }
                })
            ],
            events: {
                onPopupShow: function() {
                    // Событие при показе окна
                },
                onPopupClose: function() {
                    // Событие при закрытии окна
                }
            }
        });

        popup.show();
    })
})