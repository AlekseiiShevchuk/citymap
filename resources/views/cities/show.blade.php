@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.cities.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.cities.fields.name-en')</th>
                            <td>{{ $city->name_en }}</td>
                        </tr>
                        <tr>
                            <th>Country</th>
                            <td>{{ $city->country }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.population')</th>
                            <td>{{ $city->population }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.year-of-foundation')</th>
                            <td>{{ $city->year_of_foundation }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.latitude')</th>
                            <td>{{ $city->latitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.longitude')</th>
                            <td>{{ $city->longitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.cities.fields.cities-to-go')</th>
                            <td>
                                @foreach ($city->possible_cities_to_go as $singleCitiesToGo)
                                    <span class="label label-info label-many">{{ $singleCitiesToGo->name_en }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#localizedcitydata" aria-controls="localizedcitydata" role="tab" data-toggle="tab">Localized city data</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="localizedcitydata">
<table class="table table-bordered table-striped {{ count($localized_city_datas) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
                        <th>@lang('quickadmin.localized-city-data.fields.language')</th>
                        <th>@lang('quickadmin.localized-city-data.fields.name')</th>
                        <th>@lang('quickadmin.localized-city-data.fields.description')</th>
                        <th>&nbsp;</th>
        </tr>
    </thead>

    <tbody>
        @if (count($localized_city_datas) > 0)
            @foreach ($localized_city_datas as $localized_city_data)
                <tr data-entry-id="{{ $localized_city_data->id }}">
                                <td>{{ $localized_city_data->language->name or '' }}</td>
                                <td>{{ $localized_city_data->name }}</td>
                                <td>{{ $localized_city_data->description }}</td>
                                <td>
                                    @can('localized_city_datum_view')
                                    <a href="{{ route('localized_city_datas.show',[$localized_city_data->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('localized_city_datum_edit')
                                    <a href="{{ route('localized_city_datas.edit',[$localized_city_data->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('localized_city_datum_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['localized_city_datas.destroy', $localized_city_data->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('cities.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop