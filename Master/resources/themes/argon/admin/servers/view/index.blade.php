{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.admin')

@section('title')
    Server — {{ $server->name }}
@endsection

@section('content-header')
    <h1>{{ $server->name }}<small>{{ str_limit($server->description) }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.servers') }}">Servers</a></li>
        <li class="active">{{ $server->name }}</li>
    </ol>
@endsection

@section('content')
@include('admin.servers.partials.navigation')
<div class="row">
    <div class="col-sm-8 mb-cs">
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow">
                    <div class="card-header border-transparent">
                       <div class="row align-items-center">
                          <div class="col">
                             <h3 class="mb-0">Information</h3>
                          </div>
                       </div>
                    </div>
                    <div class="table-responsive no-padding">
                        <table class="table table-sm table-hover align-items-center table-flush">
                            <tr>
                                <td>Internal Identifier</td>
                                <td><code>{{ $server->id }}</code></td>
                            </tr>
                            <tr>
                                <td>External Identifier</td>
                                @if(is_null($server->external_id))
                                    <td><span class="badge badge-primary">Not Set</span></td>
                                @else
                                    <td><code>{{ $server->external_id }}</code></td>
                                @endif
                            </tr>
                            <tr>
                                <td>UUID / Docker Container ID</td>
                                <td><code>{{ $server->uuid }}</code></td>
                            </tr>
                            <tr>
                                <td>Current Egg</td>
                                <td>
                                    <a href="{{ route('admin.nests.view', $server->nest_id) }}">{{ $server->nest->name }}</a> ::
                                    <a href="{{ route('admin.nests.egg.view', $server->egg_id) }}">{{ $server->egg->name }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td>Server Name</td>
                                <td>{{ $server->name }}</td>
                            </tr>
                            <tr>
                                <td>CPU Limit</td>
                                <td>
                                    @if($server->cpu === 0)
                                        <code>Unlimited</code>
                                    @else
                                        <code>{{ $server->cpu }}%</code>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>CPU Threads</td>
                                <td>
                                    @if($server->threads != null)
                                        <code>{{ $server->threads }}</code>
                                    @else
                                        <span class="label label-default">Not Set</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Memory</td>
                                <td>
                                    @if($server->memory === 0)
                                        <code>Unlimited</code>
                                    @else
                                        <code>{{ $server->memory }}MB</code>
                                    @endif
                                    /
                                    @if($server->swap === 0)
                                        <code data-toggle="tooltip" data-placement="top" title="Swap Space">Not Set</code>
                                    @elseif($server->swap === -1)
                                        <code data-toggle="tooltip" data-placement="top" title="Swap Space">Unlimited</code>
                                    @else
                                        <code data-toggle="tooltip" data-placement="top" title="Swap Space"> {{ $server->swap }}MB</code>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Disk Space</td>
                                <td>
                                    @if($server->disk === 0)
                                        <code>Unlimited</code>
                                    @else
                                        <code>{{ $server->disk }}MB</code>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Block IO Weight</td>
                                <td><code>{{ $server->io }}</code></td>
                            </tr>
                            <tr>
                                <td>Default Connection</td>
                                <td><code>{{ $server->allocation->ip }}:{{ $server->allocation->port }}</code></td>
                            </tr>
                            <tr>
                                <td>Connection Alias</td>
                                <td>
                                    @if($server->allocation->alias !== $server->allocation->ip)
                                        <code>{{ $server->allocation->alias }}:{{ $server->allocation->port }}</code>
                                    @else
                                        <span class="badge badge-primary">No Alias Assigned</span>
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
      @if($server->suspended)
            <div class="card card-stats bg-warning shadow mb-4">
               <div class="card-body">
                  <div class="row">
                     <div class="col">
                        <span class="h2 font-weight-bold mb-0 text-white">Suspended</span>
                     </div>
                  </div>
               </div>
            </div>
      @endif
      @if($server->installed !== 1)
          <div class="card card-stats bg-{{ (! $server->installed) ? 'primary' : 'warning' }} shadow mb-4">
             <div class="card-body">
                <div class="row">
                   <div class="col">
                      <span class="h2 font-weight-bold mb-0 text-white">{{ (! $server->installed) ? 'Installing' : 'Install Failed' }}</span>
                   </div>
                </div>
             </div>
          </div>
      @endif
      <div class="card card-stats shadow mb-4">
         <div class="card-body">
            <div class="row">
               <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Server Owner</h5>
                  <span class="h2 font-weight-bold mb-0">{{ str_limit($server->user->username, 16) }}</span>
               </div>
               <div class="col-auto">
                  <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                     <i class="fas fa-user"></i>
                  </div>
               </div>
            </div>
            <p class="mt-0 mb-0 text-muted text-sm">
               <span><a href="{{ route('admin.users.view', $server->user->id) }}">More info</a></span>
            </p>
         </div>
      </div>
      <div class="card card-stats shadow mb-4">
         <div class="card-body">
            <div class="row">
               <div class="col">
                  <h5 class="card-title text-uppercase text-muted mb-0">Server Node</h5>
                  <span class="h2 font-weight-bold mb-0">{{ str_limit($server->node->name, 16) }}</span>
               </div>
               <div class="col-auto">
                  <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                     <i class="fas fa-user"></i>
                  </div>
               </div>
            </div>
            <p class="mt-0 mb-0 text-muted text-sm">
               <span><a href="{{ route('admin.nodes.view', $server->node->id) }}">More info</a></span>
            </p>
         </div>
      </div>
    </div>
</div>
@endsection
