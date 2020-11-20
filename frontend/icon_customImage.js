window.onload = () => {

  ymaps.ready(function () {
    var myMap = new ymaps.Map('map', {
            center: [48.641869, 44.422696],
            zoom: 13,
        }, {
            searchControlProvider: 'yandex#search'
        }),
  
        myPlacemark = new ymaps.Placemark(myMap.getCenter(), {
            hintContent: 'Дом У Еды',
            balloonContent: 'Мы находимся здесь!'
        }, {
            iconLayout: 'default#image',
            iconImageHref: 'favicon-32x32.png',
            iconImageSize: [32, 32],
            iconImageOffset: [-5, -38]
        });

        // });
  
    myMap.geoObjects
        .add(myPlacemark);
  });
}