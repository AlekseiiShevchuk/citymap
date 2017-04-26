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
                var city = {
                    id: data[i].id,
                    name: data[i].name_en,
                    latitude: data[i].latitude,
                    longitude: data[i].longitude,
                    citiesToGo: []
                };

                var dataCitiesToGo = data[i].possible_cities_to_go;

                for (j = 0; j < dataCitiesToGo.length; j++) {
                    city.citiesToGo.push({
                        id: dataCitiesToGo[j].id,
                        name: dataCitiesToGo[j].name_en
                    });
                }

                cities.push(city);
            }

            var infowindow = new google.maps.InfoWindow();

            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 2,
                center: {lat: 75.363, lng: 185.044}
            });

            var badges = [];
            for (i = 0; i < cities.length; i++) {
                var marker = new google.maps.Marker({
                    position: {lat: cities[i].latitude, lng: cities[i].longitude},
                    map: map
                });

                var citiesToGo = cities[i].citiesToGo;

                badges[i] = '';
                for (j = 0; j < citiesToGo.length; j++) {
                    badges[i] +=
                        '<span class="badge" data-citytogo="' + citiesToGo[j].id +'">'
                        + citiesToGo[j].name
                        + '</span>';
                }

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(
                            '<div id="content" data-city="'+ cities[i].id +'">'+
                            '<div id="bodyContent">'+
                            '<div id="citiesToGo">' +
                            '<h3>Cities to go: </h3>'+
                            '<div id="citiesToGoBadges">'+
                            badges[i]+
                            '</div>'+
                            '</div>'+
                            '</div>'+
                            '</div>'
                        );
                        infowindow.open(map, marker);
                    }
                })(marker, i));
            }
        }
    });
}