{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
@lang('base.account.header')
@endsection

@section('content-header')
<h1>@lang('base.account.header')<small>@lang('base.account.header_sub')</small></h1>
<ol class="breadcrumb">
   <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
   <li class="active">@lang('strings.account')</li>
</ol>
@endsection

@section('content')
<div class="row mt--7">
   <div class="col-lg-6 mb-cs">
      <form action="{{ route('account') }}" method="post">
         <div class="card shadow">
            <div class="card-header bg-transparent">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">@lang('base.account.update_pass')</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="current_password" class="control-label">@lang('base.account.current_password')</label>
                     <div>
                        <input type="password" class="form-control" name="current_password" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="new_password" class="control-label">@lang('base.account.new_password')</label>
                     <div>
                        <input type="password" class="form-control" name="new_password" />
                        <p class="text-muted small no-margin">@lang('auth.password_requirements')</p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="new_password_again" class="control-label">@lang('base.account.new_password_again')</label>
                     <div>
                        <input type="password" class="form-control" name="new_password_confirmation" />
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer mt--3">
               {!! csrf_field() !!}
               <input type="hidden" name="do_action" value="password" />
               <div class="">
                  <input type="submit" class="btn btn-primary btn-sm" value="@lang('base.account.update_pass')" />
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="col-lg-6 mb-cs">
      <form action="{{ route('account') }}" method="POST">
         <div class="card shadow">
            <div class="card-header bg-transparent">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">@lang('base.account.update_identity')</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="form-group col-lg-6">
                     <label for="first_name" class="control-label">@lang('base.account.first_name')</label>
                     <div>
                        <input type="text" class="form-control" name="name_first" value="{{ Auth::user()->name_first }}" />
                     </div>
                  </div>
                  <div class="form-group col-lg-6">
                     <label for="last_name" class="control-label">@lang('base.account.last_name')</label>
                     <div>
                        <input type="text" class="form-control" name="name_last" value="{{ Auth::user()->name_last }}" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="password" class="control-label">@lang('strings.username')</label>
                     <div>
                        <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" />
                        <p class="text-muted small no-margin">@lang('base.account.username_help', [ 'requirements' => '<code>a-z A-Z 0-9 _ - .</code>'])</p>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="language" class="control-label">@lang('base.account.language')</label>
                     <div>
                        <select name="language" id="language" class="form-control">
                        @foreach($languages as $key => $value)
                        <option value="{{ $key }}" {{ Auth::user()->language !== $key ?: 'selected' }}>{{ $value }}</option>
                        @endforeach
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer mt--3">
               {!! csrf_field() !!}
               <input type="hidden" name="do_action" value="identity" />
               <div class="">
                  <button type="submit" class="btn btn-sm btn-primary">@lang('base.account.update_identity')</button>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
<div class="row">
   <div class="col-lg-6 mb-cs">
      <form action="{{ route('account') }}" method="post">
         <div class="card shadow">
            <div class="card-header bg-transparent">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">@lang('base.account.update_email')</h3>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="new_email" class="control-label">@lang('base.account.new_email')</label>
                     <div>
                        <input type="email" class="form-control" name="new_email" />
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="form-group col-lg-12">
                     <label for="password" class="control-label">@lang('base.account.current_password')</label>
                     <div>
                        <input type="password" class="form-control" name="current_password" />
                     </div>
                  </div>
               </div>
            </div>
            <div class="card-footer mt--3">
               {!! csrf_field() !!}
               <input type="hidden" name="do_action" value="email" />
               <div class="">
                  <input type="submit" class="btn btn-primary btn-sm" value="@lang('base.account.update_email')" />
               </div>
            </div>
         </div>
      </form>
   </div>
</div>
</div>
@endsection
