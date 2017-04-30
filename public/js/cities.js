var cities = [];
var combineCities = [];
var markers = [];
var combineCitiesObjects = [];

function initMap()
{
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
                    citiesToAdd: [],
                    allCities: []
                };

                var dataCitiesToGo = data[i].cities_to_go;

                for (j = 0; j < dataCitiesToGo.length; j++) {
                    if (!dataCitiesToGo[j].is_possible_to_get) {
                        city.citiesToAdd.push({
                            id: dataCitiesToGo[j].id,
                            name: dataCitiesToGo[j].name_en,
                            getByCar: false,
                            getByTrain: false,
                            getByPlain: false
                        });
                    } else {
                        city.citiesToGo.push({
                            id: dataCitiesToGo[j].id,
                            name: dataCitiesToGo[j].name_en,
                            getByCar: dataCitiesToGo[j].is_possible_to_get_by_car,
                            getByTrain: dataCitiesToGo[j].is_possible_to_get_by_train,
                            getByPlain: dataCitiesToGo[j].is_possible_to_get_by_plane,
                            priceByCar: dataCitiesToGo[j].price_by_car,
                            priceByTrain: dataCitiesToGo[j].price_by_train,
                            priceByPlain: dataCitiesToGo[j].price_by_train
                        });
                    }
                    city.allCities.push({
                        id: dataCitiesToGo[j].id,
                        name: dataCitiesToGo[j].name_en,
                        priceByCar: dataCitiesToGo[j].price_by_car,
                        priceByTrain: dataCitiesToGo[j].price_by_train,
                        priceByPlain: dataCitiesToGo[j].price_by_train
                    });
                }

                cities.push(city);
            }

            infowindow = new google.maps.InfoWindow();

            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 4,
                center: {lat: 63.363, lng: 27.044}
            });

            var tBody = [];
            for (i = 0; i < cities.length; i++) {
                var marker = new google.maps.Marker({
                    position: {lat: cities[i].latitude, lng: cities[i].longitude},
                    map: map,
                    icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png'
                });

                var citiesToGo = cities[i].citiesToGo;

                tBody[i] = '';
                for (j = 0; j < citiesToGo.length; j++) {
                    var carIsChecked = citiesToGo[j].getByCar ? 'checked' : '';
                    var trainIsChecked = citiesToGo[j].getByTrain ? 'checked' : '';
                    var plainIsChecked = citiesToGo[j].getByPlain ? 'checked' : '';
                    var carCheckboxValue = citiesToGo[j].getByCar ? 0 : 1;
                    var trainCheckboxValue = citiesToGo[j].getByTrain ? 0 : 1;
                    var plainCheckboxValue = citiesToGo[j].getByPlain ? 0 : 1;

                    tBody[i] +=
                        '<tr data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'">' +
                        '<td>' +
                        citiesToGo[j].name +
                        '</td>' +
                        '<td>' +
                        citiesToGo[j].priceByCar +
                        '</td>' +
                        '<td>' +
                        '<input ' +
                        'class="city-to-go-checkbox" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="1" ' +
                        'value="' + carCheckboxValue +'" ' + carIsChecked +' type="checkbox">' +
                        '</td>' +
                        '<td>' +
                        citiesToGo[j].priceByTrain +
                        '</td>' +
                        '<td>' +
                        '<input ' +
                        'class="city-to-go-checkbox" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="2" ' +
                        'value="' + trainCheckboxValue +'" ' + trainIsChecked +' type="checkbox">' +
                        '</td>' +
                        '<td>' +
                        citiesToGo[j].priceByPlain +
                        '</td>' +
                        '<td>' +
                        '<input ' +
                        'class="city-to-go-checkbox" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="3" ' +
                        'value="' + plainCheckboxValue +'" ' + plainIsChecked +' type="checkbox">' +
                        '</td>' +
                        '<td>' +
                        '<span ' +
                        'class="badge city-to-go-remove-all" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'">' +
                        'X' +
                        '</span>' +
                        '</td>' +
                        '</tr>'
                    ;
                }

                google.maps.event.addListener(marker, 'click', (function(marker, i) {
                    return function() {
                        infowindow.setContent(
                            '<div id="content">'+
                            '<div id="bodyContent" class="table-scroll">'+
                            '<h2>' +
                            cities[i].name +
                            '</h2>' +
                            '<div id="citiesToGo">' +
                            '<h3>Cities to go: </h3>'+
                            '<table class="table" data-cityid="'+ cities[i].id +'">'+
                            '<thead>' +
                            '<th>Name</th>' +
                            '<th>Price by car</th>' +
                            '<th>Car</th>' +
                            '<th>Price by train</th>' +
                            '<th>Train</th>' +
                            '<th>Price by plain</th>' +
                            '<th>Plain</th>' +
                            '<th>Remove all</th>' +
                            '</thead>' +
                            '<tbody>' +
                            tBody[i]+
                            '</tbody>' +
                            '</table>'+
                            '</div>'+
                            '</div>'+
                            '</div>'
                        );
                        infowindow.open(map, marker);
                    }
                })(marker, i));

                google.maps.event.addListener(marker, 'rightclick', (function(marker, i) {
                    return function() {
                        combineCitiesObjects.push(cities[i]);
                        combineCities.push(cities[i].id);
                        markers.push(marker);
                        marker.setIcon('http://maps.google.com/mapfiles/ms/icons/green-dot.png');

                        if (combineCities.length > 2) {
                            markers[markers.length - 2].setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
                        }

                        if (combineCities.length > 1 && combineCities[0] != combineCities[1]) {
                            var relatedCity = combineCitiesObjects[0].citiesToGo.find(item => item.id === combineCitiesObjects[combineCitiesObjects.length - 1].id);
                            var getByCar = '';
                            var getByTrain = '';
                            var getByPlain = '';

                            if (relatedCity != undefined) {
                                getByCar = relatedCity.getByCar ? 'disabled' : '';
                                getByTrain = relatedCity.getByTrain ? 'disabled' : '';
                                getByPlain = relatedCity.getByPlain ? 'disabled' : '';
                            }

                            var cityPrices = combineCitiesObjects[0].allCities.find(item => item.id === combineCitiesObjects[combineCitiesObjects.length - 1].id);

                            infowindow.setContent(
                                '<div>' +
                                '<h2>' +
                                'Add ' + cities[i].name +
                                '</h2>' +
                                '<div id="addCityContent">' +
                                '<p>' +
                                '<input type="checkbox" name="car" ' + getByCar +' value="1">' +
                                'By car' + '(Price: ' + cityPrices.priceByCar + ')' +
                                '</p>' +
                                '<p>' +
                                '<input type="checkbox" name="train" ' + getByTrain +' value="2">' +
                                'By train' + '(Price: ' + cityPrices.priceByTrain + ')' +
                                '</p>' +
                                '<p>' +
                                '<input type="checkbox" name="plain" ' + getByPlain +' value="3">' +
                                'By plain' + '(Price: ' + cityPrices.priceByPlain + ')' +
                                '</p>' +
                                '<input type="hidden" name="city" value="' + combineCities[0] +'">' +
                                '<input type="hidden" name="cityToAdd" value="' + combineCities[1] +'">' +
                                '<input type="submit" class="btn btn default add-city" value="Add">' +
                                '</div>' +
                                '</div>'
                            );
                            infowindow.open(map, marker);
                        }

                        if (combineCities.length > 1 && combineCities[0] == combineCities[1]) {
                            combineCities = [];
                            marker.setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
                            markers = [];
                        }
                    }
                })(marker, i));

                google.maps.event.addListener(infowindow,'closeclick',function(){
                    combineCities = [];
                    combineCitiesObjects = [];
                    for (i = 0; i < markers.length; i++) {
                        markers[i].setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
                    }
                    markers = [];
                });
            }
        }
    });
}

$(document)
    .on('change', '.city-to-go-checkbox', function () {
        var item = $(this);
        var data = {
            cityId: item.attr('data-cityid'),
            cityToGo: item.attr('data-citytogo'),
            type: item.attr('data-type'),
            value: item.val()
        };

        $.ajax({
            url: '/ajax/add-or-remove-traffic-option',
            method: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                if (data.status) {
                    if (!data.isPossibleToGet) {
                        $(document)
                            .find('tr[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"]')
                            .remove();
                    } else {
                        $(document)
                            .find('input[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"][data-type="' + data.typeId + '"]')
                            .val(data.response_value);
                    }
                }
            }
        });
    })
    .on('dblclick', '.city-to-go-remove-all', function () {
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
                    $(document)
                        .find('tr[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"]')
                        .remove();
                }
            }
        });
    })
    .on('click', '.add-city', function () {
        var data = {
            city: $("input[name=city]").val(),
            cityToAdd: $("input[name=cityToAdd]").val(),
        };

        if ($('input[name=car]').prop('checked')) {
            data.car = 1;
        }
        if ($('input[name=train]').prop('checked')) {
            data.train = 1;
        }
        if ($('input[name=plain]').prop('checked')) {
            data.plain = 1;
        }

        $.ajax({
            url: '/ajax/add-city-to-go',
            method: "POST",
            data: data,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function (data) {
                if (data.status) {
                    infowindow.close();
                    combineCities = [];

                    for (i = 0; i < markers.length; i++) {
                        markers[i].setIcon('http://maps.google.com/mapfiles/ms/icons/red-dot.png');
                    }

                    $('#loader').toggleClass('display-none');
                    setTimeout(function () {
                        $('#loader').toggleClass('display-none');
                    }, 2500);
                    initMap(true);
                }
            }
        });
    })
;