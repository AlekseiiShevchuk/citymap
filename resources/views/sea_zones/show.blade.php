@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.sea-zone.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.sea-zone.fields.start-point-latitude')</th>
                            <td>{{ $sea_zone->start_point_latitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sea-zone.fields.start-point-longitude')</th>
                            <td>{{ $sea_zone->start_point_longitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sea-zone.fields.end-point-lalitude')</th>
                            <td>{{ $sea_zone->end_point_lalitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sea-zone.fields.end-point-longitude')</th>
                            <td>{{ $sea_zone->end_point_longitude }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.sea-zone.fields.city-transfer')</th>
                            <td>{{ $sea_zone->city_transfer->points or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('sea_zones.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop