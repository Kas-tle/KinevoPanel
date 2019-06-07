{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
@lang('base.api.index.header')
@endsection

@section('content-header')
<h1>@lang('base.api.index.header')<small>@lang('base.api.index.header_sub')</small></h1>
<ol class="breadcrumb">
    <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
    <li class="active">@lang('navigation.account.api_access')</li>
</ol>
@endsection

@section('content')
<div class="row mt--7">
    <div class="col-lg-12">
        <div class="card shadow">
            <div class="card-header border-0">
               <div class="row align-items-center">
                  <div class="col">
                     <h3 class="mb-0">Credentials List</h3>
                  </div>
                  <div class="col text-right">
                     <a href="{{ route('account.api.new') }}" class="btn btn-sm btn-primary">Create New</a>
                  </div>
               </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                  <thead class="thead-light">
                    <tr>
                        <th>Key</th>
                        <th>Memo</th>
                        <th>Last Used</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                  </thead>
                    @foreach($keys as $key)
                        <tr>
                            <td>
                                <code class="toggle-display" style="cursor:pointer" data-toggle="tooltip" data-placement="right" title="Click to Reveal">
                                    <i class="fas fa-key"></i> &bull;&bull;&bull;&bull;&bull;&bull;&bull;&bull;
                                </code>
                                <code class="d-none" data-attr="api-key">
                                    {{ $key->identifier }}{{ decrypt($key->token) }}
                                </code>
                            </td>
                            <td>{{ $key->memo }}</td>
                            <td>
                                @if(!is_null($key->last_used_at))
                                    @datetimeHuman($key->last_used_at)
                                    @else
                                    &mdash;
                                @endif
                            </td>
                            <td>@datetimeHuman($key->created_at)</td>
                            <td>
                                <a href="#" data-action="revoke-key" data-attr="{{ $key->identifier }}">
                                    <i class="fas fa-trash text-danger"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $(document).ready(function() {
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        });
        $('.toggle-display').on('click', function () {
            $(this).parent().find('code[data-attr="api-key"]').removeClass('d-none');
            $(this).hide();
        });

        $('[data-action="revoke-key"]').click(function (event) {
            var self = $(this);
            event.preventDefault();
            swal({
                type: 'error',
                title: 'Revoke API Key',
                text: 'Once this API key is revoked any applications currently using it will stop working.',
                showCancelButton: true,
                allowOutsideClick: true,
                closeOnConfirm: false,
                confirmButtonText: 'Revoke',
                confirmButtonColor: '#d9534f',
                showLoaderOnConfirm: true
            }, function () {
                $.ajax({
                    method: 'DELETE',
                    url: Router.route('account.api.revoke', { identifier: self.data('attr') }),
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                }).done(function (data) {
                    swal({
                        type: 'success',
                        title: '',
                        text: 'API Key has been revoked.'
                    });
                    self.parent().parent().slideUp();
                }).fail(function (jqXHR) {
                    console.error(jqXHR);
                    swal({
                        type: 'error',
                        title: 'Whoops!',
                        text: 'An error occurred while attempting to revoke this key.'
                    });
                });
            });
        });
    });
    </script>
@endsection
