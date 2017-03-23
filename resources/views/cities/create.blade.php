@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.cities.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['cities.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_create')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('name_en', 'Name (in English)*', ['class' => 'control-label']) !!}
                    {!! Form::text('name_en', $address['name'] ? $address['name']:old('name_en'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <button onclick="go();return false;">Fill</button>
                    <script>
                        function go() {
                            var name = $('[name="name_en"]').val();
                            var url = "{{route('cities.create')}}?address="+ name;
                            $(location).attr('href',url);
                        }
                    </script>
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
                    {!! Form::number('population', $address['population'] ? $address['population']:old('population'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::text('latitude', $address['lat'] ? $address['lat']:old('latitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
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
                    {!! Form::text('longitude', $address['lng'] ? $address['lng']:old('longitude'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('longitude'))
                        <p class="help-block">
                            {{ $errors->first('longitude') }}
                        </p>
                    @endif
                </div>
            </div>
            <hr>
            <h3>Section to add Localized City data</h3>
            <div class="alert-danger">All fields required</div>
            <hr>

            @foreach($languages as $language)
                <h4>{{$language->name}}*</h4>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('name', 'Localized Name for ' . $language->name.' language*', ['class' => 'control-label']) !!}
                        {!! Form::text('languages[' .$language->id . '][name]',
                        $address[$language->id]['name'] ? $address[$language->id]['name']:old('languages[' .$language->abbreviation . '][name]'),
                         ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('languages.' .$language->id . '.name'))
                            <p class="help-block">
                                {{ $errors->first('languages.' .$language->id . '.name') }}
                            </p>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 form-group">
                        {!! Form::label('description', 'Localized Description for ' . $language->name.' language*', ['class' => 'control-label']) !!}
                        {!! Form::textarea('languages[' .$language->id . '][description]',
                        $address[$language->id]['description'] ? $address[$language->id]['description']:old('languages[' .$language->abbreviation . '][description]'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('languages.' .$language->id . '.description'))
                            <p class="help-block">
                                {{ $errors->first('languages.' .$language->id . '.description') }}
                            </p>
                        @endif
                    </div>
                </div>
                <hr>
            @endforeach


            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

