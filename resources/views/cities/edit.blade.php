@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.cities.title')</h3>

    {!! Form::model($city, ['method' => 'PUT', 'route' => ['cities.update', $city->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name_en', 'Name (in English)*', ['class' => 'control-label']) !!}
                    {!! Form::text('name_en', old('name_en'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name_en'))
                        <p class="help-block">
                            {{ $errors->first('name_en') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('country_id', 'Country*', ['class' => 'control-label']) !!}
                    {!! Form::select('country_id', $countries, old('country_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('country_id'))
                        <p class="help-block">
                            {{ $errors->first('country_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('population', 'Population', ['class' => 'control-label']) !!}
                    {!! Form::number('population', old('population'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('population'))
                        <p class="help-block">
                            {{ $errors->first('population') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('year_of_foundation', 'Year of foundation', ['class' => 'control-label']) !!}
                    {!! Form::number('year_of_foundation', old('year_of_foundation'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('year_of_foundation'))
                        <p class="help-block">
                            {{ $errors->first('year_of_foundation') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('latitude', 'Latitude*', ['class' => 'control-label']) !!}
                    {!! Form::text('latitude', old('latitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('latitude'))
                        <p class="help-block">
                            {{ $errors->first('latitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('longitude', 'Longitude*', ['class' => 'control-label']) !!}
                    {!! Form::text('longitude', old('longitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('longitude'))
                        <p class="help-block">
                            {{ $errors->first('longitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cities_to_go_all', 'Select cities to interact with this city', ['class' => 'control-label']) !!}
                    {!! Form::select('cities_to_go_all[]', $cities_to_go, old('cities_to_go_all') ? old('cities_to_go_all') : $city->cities_to_go->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('cities_to_go_all'))
                        <p class="help-block">
                            {{ $errors->first('cities_to_go_all') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('cities_to_go', 'Possible cities to go', ['class' => 'control-label']) !!}

                    @foreach($city->cities_to_go as $city_to_go)
                        <hr>
                        <h3>{{$city_to_go->name_en}}</h3>
                        {{--{!! Form::label('Set Price', 'Set Price:', ['class' => 'control-label']) !!}--}}
                        {{--{!! Form::number('cities_to_go[' . $city_to_go->id . '][' . 'weight]', $city_to_go->weight, ['class' => 'form-control', 'placeholder' => 'weight','min' => '0' ]) !!}--}}
                        {{--{!! Form::label('is possible to get', 'Is it possible to get ' . $city_to_go->name_en  .' from ' . $city->name_en, ['class' => 'control-label']) !!}--}}
                        {{--{!! Form::checkbox('cities_to_go[' . $city_to_go->id . '][' . 'is_possible_to_get]', 1, $city_to_go->is_possible_to_get) !!}--}}

                        {!! Form::label('set price by car', 'Set Price by car:', ['class' => 'control-label']) !!}
                        {!! Form::number('cities_to_go[' . $city_to_go->id . '][' . 'price_by_car]', $city_to_go->price_by_car, ['class' => 'form-control', 'placeholder' => 'price by car','min' => '0' ]) !!}
                        {!! Form::label('is possible to get by car', 'Is it possible to get ' . $city_to_go->name_en  .' from ' . $city->name_en . ' by car', ['class' => 'control-label']) !!}
                        {!! Form::checkbox('cities_to_go[' . $city_to_go->id . '][' . 'is_possible_to_get_by_car]', 1, $city_to_go->is_possible_to_get_by_car) !!}
                        <br><hr>
                        {!! Form::label('set price by train', 'Set Price by train:', ['class' => 'control-label']) !!}
                        {!! Form::number('cities_to_go[' . $city_to_go->id . '][' . 'price_by_train]', $city_to_go->price_by_train, ['class' => 'form-control', 'placeholder' => 'price by train','min' => '0' ]) !!}
                        {!! Form::label('is possible to get by train', 'Is it possible to get ' . $city_to_go->name_en  .' from ' . $city->name_en . ' by train', ['class' => 'control-label']) !!}
                        {!! Form::checkbox('cities_to_go[' . $city_to_go->id . '][' . 'is_possible_to_get_by_train]', 1, $city_to_go->is_possible_to_get_by_train) !!}
                        <br><hr>
                        {!! Form::label('set price by plane', 'Set Price by plane:', ['class' => 'control-label']) !!}
                        {!! Form::number('cities_to_go[' . $city_to_go->id . '][' . 'price_by_plane]', $city_to_go->price_by_plane, ['class' => 'form-control', 'placeholder' => 'price by plane','min' => '0' ]) !!}
                        {!! Form::label('is possible to get by plane', 'Is it possible to get ' . $city_to_go->name_en  .' from ' . $city->name_en . ' by plane', ['class' => 'control-label']) !!}
                        {!! Form::checkbox('cities_to_go[' . $city_to_go->id . '][' . 'is_possible_to_get_by_plane]', 1, $city_to_go->is_possible_to_get_by_plane) !!}
                        <br>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

