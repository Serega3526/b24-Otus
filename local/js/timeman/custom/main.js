


BX.addCustomEvent('onTimeManWindowOpen', function (res){
    // console.log('111',test['CREATE'])
    // console.log('11:',onTimeManWindowOpen)
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
                        BX.addCustomEvent('onTimeManDataRecieved', function (obj){
                            console.log(obj)
                            // res['DATA']['STATE'] = 'OPEN'
                        });
                        // console.log(res['ACTIONS']['OPEN'])
                        // res['ACTIONS']['OPEN']()
                        // BX.addCustomEvent('onTimeManWindowOpen', function (){
                        //     console.log(res)
                        // });
                        // BX.addCustomEvent('onTimeManDayOpen', function (){});
                        // BX.addCustomEvent('onTimeManWindowClose', function (){
                        //
                        // });
                        // popup.close();

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