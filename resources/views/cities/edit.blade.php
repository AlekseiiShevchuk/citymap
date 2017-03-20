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
                    {!! Form::label('cities_to_go', 'Cities to go', ['class' => 'control-label']) !!}
                    @foreach($city->cities_to_go as $city_to_go)
                        <hr>
                        <h3>{{$city_to_go->name_en}}</h3>
                        {!! Form::label('select weight', 'Select weight:', ['class' => 'control-label']) !!}
                        {!! Form::number('cities_to_go[' . $city_to_go->id . '][' . 'weight]', $city_to_go->weight, ['class' => 'form-control', 'placeholder' => 'weight']) !!}
                        {!! Form::label('is possible to get', 'Is it possible to get ' . $city_to_go->name_en  .' from ' . $city->name_en, ['class' => 'control-label']) !!}
                        {!! Form::checkbox('cities_to_go[' . $city_to_go->id . '][' . 'is_possible_to_get]', 1, $city_to_go->is_possible_to_get) !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

