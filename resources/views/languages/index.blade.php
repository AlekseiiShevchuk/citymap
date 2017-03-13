@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.languages.title')</h3>
    @can('language_create')
    <p>
        
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($languages) > 0 ? 'datatable' : '' }} @can('language_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('language_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.languages.fields.abbreviation')</th>
                        <th>@lang('quickadmin.languages.fields.name')</th>
                        <th>@lang('quickadmin.languages.fields.is-active-for-admin')</th>
                        <th>@lang('quickadmin.languages.fields.is-active-for-users')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($languages) > 0)
                        @foreach ($languages as $language)
                            <tr data-entry-id="{{ $language->id }}">
                                @can('language_delete')
                                    <td></td>
                                @endcan

                                <td>{{ $language->abbreviation }}</td>
                                <td>{{ $language->name }}</td>
                                <td>{{ Form::checkbox("is_active_for_admin", 1, $language->is_active_for_admin == 1, ["disabled"]) }}</td>
                                <td>{{ Form::checkbox("is_active_for_users", 1, $language->is_active_for_users == 1, ["disabled"]) }}</td>
                                <td>                                    @can('language_edit')
                                    <a href="{{ route('languages.edit',[$language->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.qa_edit')</a>
                                    @endcan
                                    @can('language_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.qa_are_you_sure")."');",
                                        'route' => ['languages.destroy', $language->id])) !!}
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
        @can('language_delete')
            window.route_mass_crud_entries_destroy = '{{ route('languages.mass_destroy') }}';
        @endcan

    </script>
@endsection