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

            <p>&nbsp;</p>

            <a href="{{ route('players.index') }}" class="btn btn-default">@lang('quickadmin.qa_back_to_list')</a>
        </div>
    </div>
@stop