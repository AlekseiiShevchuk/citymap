@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.city-steps.title')</h3>
    
    {!! Form::model($city_step, ['method' => 'PUT', 'route' => ['city_steps.update', $city_step->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('by_player_id', 'By player*', ['class' => 'control-label']) !!}
                    {!! Form::select('by_player_id', $by_players, old('by_player_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('by_player_id'))
                        <p class="help-block">
                            {{ $errors->first('by_player_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('to_city_id', 'To city*', ['class' => 'control-label']) !!}
                    {!! Form::select('to_city_id', $to_cities, old('to_city_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('to_city_id'))
                        <p class="help-block">
                            {{ $errors->first('to_city_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

