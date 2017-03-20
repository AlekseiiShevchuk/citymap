@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.players.title')</h3>
    
    {!! Form::model($player, ['method' => 'PUT', 'route' => ['players.update', $player->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('device_id', 'Device id*', ['class' => 'control-label']) !!}
                    {!! Form::text('device_id', old('device_id'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('device_id'))
                        <p class="help-block">
                            {{ $errors->first('device_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('nickname', 'Nickname*', ['class' => 'control-label']) !!}
                    {!! Form::text('nickname', old('nickname'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('nickname'))
                        <p class="help-block">
                            {{ $errors->first('nickname') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('language_id', 'Language*', ['class' => 'control-label']) !!}
                    {!! Form::select('language_id', $languages, old('language_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('language_id'))
                        <p class="help-block">
                            {{ $errors->first('language_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

