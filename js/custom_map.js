ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [58.521650, 31.292765],
            zoom: 16,
            controls: ['zoomControl', 'typeSelector',  'fullscreenControl', 'routeButtonControl']
        }, {
            searchControlProvider: 'yandex#search'
        }),

        // Создаём макет содержимого.
        MyIconContentLayout = ymaps.templateLayoutFactory.createClass(
            '<div style="color: #FFFFFF; font-weight: bold;">$[properties.iconContent]</div>'
        ),

        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: '',
            balloonContent: '<strong>ГОКУ "ОАЦ"</strong><br>ул. Славная, 55А'
        }, {
            // Опции.
            // Необходимо указать данный тип макета.
            iconLayout: 'default#image',
            // Своё изображение иконки метки.
            iconImageHref: '/wp-content/themes/oac/images/mapicon.svg',
            // Размеры метки.
            iconImageSize: [60, 68],
            // Смещение левого верхнего угла иконки относительно
            // её "ножки" (точки привязки).
            iconImageOffset: [-20, -60]
        });

        myMap.behaviors.disable(['rightMouseButtonMagnifier', 'scrollZoom']);
      	myMap.geoObjects.add(myPlacemark);
      });
