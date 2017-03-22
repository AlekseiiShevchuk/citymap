@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.players.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('quickadmin.players.fields.device-id')</th>
                            <td>{{ $player->device_id }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.players.fields.nickname')</th>
                            <td>{{ $player->nickname }}</td>
                        </tr>
                        <tr>
                            <th>@lang('quickadmin.players.fields.language')</th>
                            <td>{{ $player->language->name or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">

                <li role="presentation" class="active"><a href="#all_city_steps" aria-controls="all_city_steps" role="tab" data-toggle="tab">All Player city steps</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="all_city_steps">
                    <table class="table table-bordered table-striped {{ count($player->all_city_steps) > 0 ? 'datatable' : '' }}">
                        <thead>
                        <tr>
                            <th>City name</th>
                            <th>Created_at</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if (count($player->all_city_steps) > 0)
                            @foreach ($player->all_city_steps as $city_step)

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
                                <td colspan="8">@lang('quickadmin.qa_no_entries_in_table')</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <p>&nbsp;</p>

            <a href="{{ route('players.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop