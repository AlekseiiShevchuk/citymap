@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.languages.title')</h3>
    
    {!! Form::model($language, ['method' => 'PUT', 'route' => ['languages.update', $language->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_active_for_admin', 'Is active for admin', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_active_for_admin', 0) !!}
                    {!! Form::checkbox('is_active_for_admin', 1, old('is_active_for_admin')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_active_for_admin'))
                        <p class="help-block">
                            {{ $errors->first('is_active_for_admin') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('is_active_for_users', 'Is active for users*', ['class' => 'control-label']) !!}
                    {!! Form::hidden('is_active_for_users', 0) !!}
                    {!! Form::checkbox('is_active_for_users', 1, old('is_active_for_users')) !!}
                    <p class="help-block"></p>
                    @if($errors->has('is_active_for_users'))
                        <p class="help-block">
                            {{ $errors->first('is_active_for_users') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

