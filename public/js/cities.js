var cities = [];
var combineCities = [];
var markers = [];
var combineCitiesObjects = [];
var isInputPriceReady = false;

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
                            getByPlain: false,
                            priceByCar: dataCitiesToGo[j].price_by_car,
                            priceByTrain: dataCitiesToGo[j].price_by_train,
                            priceByPlain: dataCitiesToGo[j].price_by_plane
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
                            priceByPlain: dataCitiesToGo[j].price_by_plane
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
            var selectOptions = [];
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

                    var carPriceValue = citiesToGo[j].getByCar ? citiesToGo[j].priceByCar : '-';
                    var trainPriceValue = citiesToGo[j].getByTrain ? citiesToGo[j].priceByTrain : '-';
                    var plainPriceValue = citiesToGo[j].getByPlain ? citiesToGo[j].priceByPlain : '-';

                    var carFixPriceClass = citiesToGo[j].getByCar ? 'city-to-go-fix-price' : 'city-to-go-fix-price-not-active';
                    var trainFixPriceClass  = citiesToGo[j].getByTrain ? 'city-to-go-fix-price' : 'city-to-go-fix-price-not-active';
                    var plainFixPriceClass  = citiesToGo[j].getByPlain ? 'city-to-go-fix-price' : 'city-to-go-fix-price-not-active';

                    tBody[i] +=
                        '<tr data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'">' +
                        '<td>' +
                        citiesToGo[j].name +
                        '</td>' +
                        '<td class="' + carFixPriceClass +'" data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="1">' +
                        carPriceValue +
                        '</td>' +
                        '<td>' +
                        '<input ' +
                        'class="city-to-go-checkbox" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="1" ' +
                        'value="' + carCheckboxValue +'" ' + carIsChecked +' type="checkbox">' +
                        '</td>' +
                        '<td class="' + trainFixPriceClass +'" data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="2">' +
                        trainPriceValue +
                        '</td>' +
                        '<td>' +
                        '<input ' +
                        'class="city-to-go-checkbox" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="2" ' +
                        'value="' + trainCheckboxValue +'" ' + trainIsChecked +' type="checkbox">' +
                        '</td>' +
                        '<td class="' + plainFixPriceClass +'" data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="3">' +
                        plainPriceValue +
                        '</td>' +
                        '<td>' +
                        '<input ' +
                        'class="city-to-go-checkbox" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'" data-type="3" ' +
                        'value="' + plainCheckboxValue +'" ' + plainIsChecked +' type="checkbox">' +
                        '</td>' +
                        '<td>' +
                        '<a href="#" ' +
                        'class="btn btn-danger btn-xs city-to-go-remove-all" ' +
                        'data-cityid="' + cities[i].id +'" data-citytogo="' + citiesToGo[j].id +'">' +
                        'Remove' +
                        '</a>' +
                        '</td>' +
                        '</tr>'
                    ;
                }

                var citiesToAdd = cities[i].citiesToAdd;

                selectOptions[i] = '';
                for (k = 0; k < citiesToAdd.length; k++) {
                    selectOptions[i] +=
                        '<option data-cityid="' + cities[i].id +'" data-citytoadd="' + citiesToAdd[k].id +'"' +
                        ' data-carprice="'+ citiesToAdd[k].priceByCar +'"' +
                        ' data-trainprice="'+ citiesToAdd[k].priceByTrain +'"' +
                        ' data-planeprice="'+ citiesToAdd[k].priceByPlain +'">' +
                        citiesToAdd[k].name +
                        '</option>'
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
                            '<div id="citiesToAdd">' +
                            '<h3>Cities to add</h3>' +
                            '<select class="form-control select-city-to-add">' +
                            '<option value="'+ null +'">-</option>' +
                             selectOptions[i] +
                            '</select>' +
                            '</div>' +
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
                            '<th>Options</th>' +
                            '</thead>' +
                            '<tbody data-cityid="'+ cities[i].id +'">' +
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
                        $(document)
                            .find('td[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"][data-type="' + data.typeId + '"]')
                            .toggleClass('city-to-go-fix-price')
                            .toggleClass('city-to-go-fix-price-not-active')
                            .html(data.price);
                    }
                }
            }
        });
    })
    .on('change', '.select-city-to-add', function () {
        $(document).find('.created-row').remove();
        $(document).find('option[value="'+ null +'"]').attr('selected', false);

        var item = $(this);
        var dataCityId = $('.select-city-to-add option:selected').attr('data-cityid');
        var dataCityToAdd = $('.select-city-to-add option:selected').attr('data-citytoadd');
        var carPrice = $('.select-city-to-add option:selected').attr('data-carprice');
        var trainPrice = $('.select-city-to-add option:selected').attr('data-trainprice');
        var planePrice = $('.select-city-to-add option:selected').attr('data-planeprice');
        var optionValue = item.val();

        $(document)
            .find('tbody[data-cityid="' + dataCityId + '"]')
            .prepend(
                '<tr data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToAdd +'" class="created-row">' +
                '<td>' +
                optionValue +
                '</td>' +
                '<td class="city-to-go-fix-price" data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToAdd +'" data-type="1">' +
                carPrice +
                '</td>' +
                '<td>' +
                '<input name="car" ' +
                'value="1" type="checkbox">' +
                '</td>' +
                '<td class="city-to-go-fix-price" data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToAdd +'" data-type="2">' +
                trainPrice +
                '</td>' +
                '<td>' +
                '<input name="train" ' +
                'value="2" type="checkbox">' +
                '</td>' +
                '<td class="city-to-go-fix-price" data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToAdd +'" data-type="3">' +
                planePrice +
                '</td>' +
                '<td>' +
                '<input name="plane" ' +
                'value="3" type="checkbox">' +
                '</td>' +
                '<td>' +
                '<a href="#" ' +
                'class="btn btn-success btn-xs city-to-go-remove-all" ' +
                'data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToAdd +'">' +
                'Add' +
                '</a>' + ' ' +
                '<a href="#" ' +
                'class="btn btn-danger btn-xs remove-raw" ' +
                'data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToAdd +'">' +
                'Remove' +
                '</a>' +
                '</td>' +
                '</tr>'
            );
    })
    .on('click', '.remove-raw', function () {
        var item = $(this);

        $(document)
            .find('tr[data-cityid="' + item.attr('data-cityid') + '"][data-citytogo="' + item.attr('data-citytogo') + '"]')
            .remove();

        $(document).find('option[value="'+ null +'"]').attr('selected', 'selected');
    })
    .on('click', '.city-to-go-remove-all', function () {
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
    .on('dblclick', '.city-to-go-fix-price', function () {
        $(document).find('.input-send-fixed-price').remove();
        $(document).find('.hidden-price').show().removeClass('hidden-price');

        var item = $(this);
        item.addClass('hidden-price');
        var dataCityId = item.attr('data-cityid');
        var dataCityToGo = item.attr('data-citytogo');
        var dataType = item.attr('data-type');
        var inputValue = item.html();
        var previousItem = item.prev();
        item.hide();
        previousItem.after(
            '<input type="text" data-cityid="' + dataCityId +'" data-citytogo="' + dataCityToGo +'"' +
            ' data-type="' + dataType +'" value="' + inputValue +'" class="input-send-fixed-price">'
        );
        isInputPriceReady = true;
    })
    .keypress(function(e) {
        if(e.which == 13 && isInputPriceReady) {
            var item = $(document)
                .find('input[class="input-send-fixed-price"][type=text]');
            var data = {
                cityId: item.attr('data-cityid'),
                cityToGo: item.attr('data-citytogo'),
                type: item.attr('data-type'),
                value: item.val()
            };

            $.ajax({
                url: '/ajax/change-price',
                method: "POST",
                data: data,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                },
                success: function (data) {
                    if (data.status) {
                        $(document)
                            .find('input[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"][data-type="' + data.typeId + '"][type=text]')
                            .remove();
                        $(document)
                            .find('td[data-cityid="' + data.city_id + '"][data-citytogo="' + data.city_to_go + '"][data-type="' + data.typeId + '"]')
                            .html(data.response_value)
                            .show();
                        isInputPriceReady = false;
                    }
                }
            });
        }
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
                    initMap();
                }
            }
        });
    })
;