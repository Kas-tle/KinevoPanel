{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
@lang('server.files.header')
@endsection

@section('content-header')
<h1>@lang('server.files.header')<small>@lang('server.files.header_sub')</small></h1>
<ol class="breadcrumb">
   <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
   <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
   <li>@lang('navigation.server.file_management')</li>
   <li class="active">@lang('navigation.server.file_browser')</li>
</ol>
@endsection

@section('content')
<div class="row mt--7">
   <div class="col-lg-12">
      <div class="card shadow">
         <div class="overlay file-overlay"><i class="fas fa-sync fa-spin"></i></div>
         <div id="load_files">
            <div class="alert alert-info" style="margin:10px;">@lang('server.files.loading')</div>
         </div>
         <div class="card-footer">
            <p class="text-muted small mb-0">@lang('server.files.path', ['path' => '<code>/home/container</code>', 'size' => '<code>' . $node->upload_size . ' MB</code>'])</p>
         </div>
      </div>
   </div>
</div>
@endsection

@section('footer-scripts')
@parent
{!! Theme::js('js/frontend/server.socket.js') !!}
{!! Theme::js('vendor/async/async.min.js') !!}
{!! Theme::js('vendor/lodash/lodash.js') !!}
{!! Theme::js('vendor/siofu/client.min.js') !!}
@if(App::environment('production'))
{!! Theme::js('js/frontend/files/filemanager.min.js?updated-cancel-buttons') !!}
@else
{!! Theme::js('js/frontend/files/src/index.js') !!}
{!! Theme::js('js/frontend/files/src/contextmenu.js') !!}
{!! Theme::js('js/frontend/files/src/actions.js') !!}
@endif
{!! Theme::js('js/frontend/files/upload.js') !!}
@endsection
