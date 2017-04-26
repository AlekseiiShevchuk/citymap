function initMap()
{
    var cities = [];

    $.ajax({
        url: '/api/v1/map/cities',
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
                    citiesToGo: [],
                    citiesToAdd: []
                };

                var dataCitiesToGo = data[i].cities_to_go;

                for (j = 0; j < dataCitiesToGo.length; j++) {
                    if (!dataCitiesToGo[j].is_possible_to_get) {
                        city.citiesToAdd.push({
                            id: dataCitiesToGo[j].id,
                            name: dataCitiesToGo[j].name_en
                        });
                    } else {
                        city.citiesToGo.push({
                            id: dataCitiesToGo[j].id,
                            name: dataCitiesToGo[j].name_en
                        });
                    }
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
                        '<span class="badge" data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'">'
                        + citiesToGo[j].name
                        + '<span ' +
                        'class="glyphicon glyphicon-trash delete-city-to-go" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'"></span>'
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

$(document)
    .on('dblclick', '.delete-city-to-go', function () {
        var item = $(this);
        var data = {
            cityId: item.attr('data-cityid'),
            cityToGo: item.attr('data-citytogo')
        };

        $.ajax({
            url: '/ajax/delete-city-to-go',
            method: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                if (data.status) {
                    $(document).find('span[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"]').remove();
                }
            }
        });
    })
;