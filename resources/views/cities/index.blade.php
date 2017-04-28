@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.cities.title')</h3>
    @can('city_create')
    <p>
        <a href="{{ route('cities.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        <a href="#" class="btn btn-default" data-toggle="modal" data-target="#myModal">Show by map</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <!--Modal-->
        <div class="panel-body">

            <div class="modal fade" id="myModal" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div id="loader" class="display-none"></div>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Map</h4>
                        </div>
                        <div id="map-content" class="modal-body">
                            <div id="map"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Modal End-->

            <table class="table table-bordered table-striped {{ count($cities) > 0 ? 'datatable' : '' }} @can('city_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('city_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.cities.fields.name-en')</th>
                        <th>Country</th>
                        <th>@lang('quickadmin.cities.fields.population')</th>
                        <th>@lang('quickadmin.cities.fields.year-of-foundation')</th>
                        <th>@lang('quickadmin.cities.fields.latitude')</th>
                        <th>@lang('quickadmin.cities.fields.longitude')</th>
                        <th>@lang('quickadmin.cities.fields.cities-to-go')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($cities) > 0)
                        @foreach ($cities as $city)
                            <tr data-entry-id="{{ $city->id }}">
                                @can('city_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $city->name_en }}</td>
                                <td>{{ $city->country }}</td>
                                <td>{{ $city->population }}</td>
                                <td>{{ $city->year_of_foundation }}</td>
                                <td>{{ $city->latitude }}</td>
                                <td>{{ $city->longitude }}</td>
                                <td>
                                    @foreach ($city->possible_cities_to_go as $singleCitiesToGo)
                                        <span class="label label-info label-many">{{ $singleCitiesToGo->name_en }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('city_view')
                                    <a href="{{ route('cities.show',[$city->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.qa_view')</a>
                                    @endcan
                                    @can('city_edit')
                                    <a href="{{ route('cities.edit',[$city->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('city_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['cities.destroy', $city->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/cities.js') }}"></script>
    <script async defer
            src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY_FRONT') }}&callback=initMap">
    </script>
    <script>
        @can('city_delete')
            window.route_mass_crud_entries_destroy = '{{ route('cities.mass_destroy') }}';
        @endcan

    </script>
@endsection