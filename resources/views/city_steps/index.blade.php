@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.city-steps.title')</h3>
    @can('city_step_create')
    <p>
        <a href="{{ route('city_steps.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($city_steps) > 0 ? 'datatable' : '' }} @can('city_step_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('city_step_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.city-steps.fields.by-player')</th>
                        <th>@lang('quickadmin.city-steps.fields.to-city')</th>
                        <th>created_at</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($city_steps) > 0)
                        @foreach ($city_steps as $city_step)
                            <tr data-entry-id="{{ $city_step->id }}">
                                @can('city_step_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $city_step->by_player->device_id or '' }}</td>
                                <td>{{ $city_step->to_city->name_en or '' }}</td>
                                <td>{{ $city_step->created_at}}</td>
                                <td>                                    @can('city_step_edit')
                                    <a href="{{ route('city_steps.edit',[$city_step->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('city_step_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['city_steps.destroy', $city_step->id])) !!}
                                    {!! Form::submit(trans('quickadmin.qa_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">@lang('quickadmin.qa_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('city_step_delete')
            window.route_mass_crud_entries_destroy = '{{ route('city_steps.mass_destroy') }}';
        @endcan

    </script>
@endsection