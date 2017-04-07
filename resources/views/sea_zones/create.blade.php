@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.sea-zone.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['sea_zones.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_point_latitude', 'Start point latitude*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_point_latitude', old('start_point_latitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_point_latitude'))
                        <p class="help-block">
                            {{ $errors->first('start_point_latitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('start_point_longitude', 'Start point longitude*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_point_longitude', old('start_point_longitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('start_point_longitude'))
                        <p class="help-block">
                            {{ $errors->first('start_point_longitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('end_point_latitude', 'End point lalitude*', ['class' => 'control-label']) !!}
                    {!! Form::text('end_point_latitude', old('end_point_latitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_point_latitude'))
                        <p class="help-block">
                            {{ $errors->first('end_point_latitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('end_point_longitude', 'End point longitude', ['class' => 'control-label']) !!}
                    {!! Form::text('end_point_longitude', old('end_point_longitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('end_point_longitude'))
                        <p class="help-block">
                            {{ $errors->first('end_point_longitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('city_transfer_id', 'City transfer*', ['class' => 'control-label']) !!}
                    {!! Form::select('city_transfer_id', $city_transfers, old('city_transfer_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('city_transfer_id'))
                        <p class="help-block">
                            {{ $errors->first('city_transfer_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

