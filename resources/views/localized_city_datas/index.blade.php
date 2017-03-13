@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.localized-city-data.title')</h3>
    @can('localized_city_datum_create')
    <p>
        <a href="{{ route('localized_city_datas.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($localized_city_datas) > 0 ? 'datatable' : '' }} @can('localized_city_datum_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('localized_city_datum_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.localized-city-data.fields.city')</th>
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
                                @can('localized_city_datum_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $localized_city_data->city->name_en or '' }}</td>
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
@stop

@section('javascript') 
    <script>
        @can('localized_city_datum_delete')
            window.route_mass_crud_entries_destroy = '{{ route('localized_city_datas.mass_destroy') }}';
        @endcan

    </script>
@endsection