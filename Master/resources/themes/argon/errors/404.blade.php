{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.error')

@section('title')
    @lang('base.errors.404.header')
@endsection

@section('content-header')
@endsection

@section('content')
<!-- This is why we don't let Pterodactyl's make links... fat fingered dinosaurs... -->
<div class="row mt--7">
    <div class="col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-12">
        <div class="card">
            <div class="card-body text-center">
                <h1 class="text-yellow" style="font-size: 160px !important;font-weight: 100 !important;">404</h1>
                <p class="text-muted">@lang('base.errors.404.desc')</p>
            </div>
            <div class="card-footer">
                <a href="{{ URL::previous() }}"><button class="btn btn-sm btn-warning">&larr; @lang('base.errors.return')</button></a>
                <a href="/"><button class="btn btn-sm btn-primary">@lang('base.errors.home')</button></a>
            </div>
        </div>
    </div>
</div>
@endsection
