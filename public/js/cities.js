function initMap()
{
    var cities = [];

    $.ajax({
        url: '/api/v1/cities',
        headers: {
            'device-id':1
        },
        processData: false,
        success: function (data) {
            for (i = 0; i < data.length; i++) {
                var city = [];
                var citiesToGo = [];

                city.push(data[i].name_en);
                city.push(data[i].latitude);
                city.push(data[i].longitude);

                var dataCitiesToGo = data[i].possible_cities_to_go;
                for (j = 0; j < dataCitiesToGo.length; j++) {
                    citiesToGo.push(dataCitiesToGo[j].name_en);
                }

                city.push(citiesToGo);
                cities.push(city);
            }

            var infowindow = new google.maps.InfoWindow();

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2,
                center: {lat: 75.363, lng: 185.044}
            });

            for (i = 0; i < cities.length; i++) {
                var marker = new google.maps.Marker({
                    position: {lat: cities[i][1], lng: cities[i][2]},
                    map: map
                });

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent('Cities to go: ' + ' ' + cities[i][3].join(', '));
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    });
}