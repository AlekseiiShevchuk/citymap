@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.sea-zone.title')</h3>
    @can('sea_zone_create')
    <p>
        <a href="{{ route('sea_zones.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($sea_zones) > 0 ? 'datatable' : '' }} @can('sea_zone_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('sea_zone_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.sea-zone.fields.start-point-latitude')</th>
                        <th>@lang('quickadmin.sea-zone.fields.start-point-longitude')</th>
                        <th>@lang('quickadmin.sea-zone.fields.end-point-lalitude')</th>
                        <th>@lang('quickadmin.sea-zone.fields.end-point-longitude')</th>
                        <th>@lang('quickadmin.sea-zone.fields.city-transfer')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($sea_zones) > 0)
                        @foreach ($sea_zones as $sea_zone)
                            <tr data-entry-id="{{ $sea_zone->id }}">
                                @can('sea_zone_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $sea_zone->start_point_latitude }}</td>
                                <td>{{ $sea_zone->start_point_longitude }}</td>
                                <td>{{ $sea_zone->end_point_lalitude }}</td>
                                <td>{{ $sea_zone->end_point_longitude }}</td>
                                <td>{{ $sea_zone->city_transfer->points or '' }}</td>
                                <td>
                                    @can('sea_zone_view')
                                    <a href="{{ route('sea_zones.show',[$sea_zone->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('sea_zone_edit')
                                    <a href="{{ route('sea_zones.edit',[$sea_zone->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('sea_zone_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['sea_zones.destroy', $sea_zone->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('sea_zone_delete')
            window.route_mass_crud_entries_destroy = '{{ route('sea_zones.mass_destroy') }}';
        @endcan

    </script>
@endsection