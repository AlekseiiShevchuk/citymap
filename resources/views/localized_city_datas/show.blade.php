@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.localized-city-data.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.localized-city-data.fields.city')</th>
                            <td>{{ $localized_city_data->city->name_en or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.localized-city-data.fields.language')</th>
                            <td>{{ $localized_city_data->language->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.localized-city-data.fields.name')</th>
                            <td>{{ $localized_city_data->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.localized-city-data.fields.description')</th>
                            <td>{{ $localized_city_data->description }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('localized_city_datas.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop