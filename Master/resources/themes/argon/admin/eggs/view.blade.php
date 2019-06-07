{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.admin')

@section('title')
    Nests &rarr; Egg: {{ $egg->name }}
@endsection

@section('content-header')
    <h1>{{ $egg->name }}<small>{{ str_limit($egg->description, 50) }}</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}">Admin</a></li>
        <li><a href="{{ route('admin.nests') }}">Nests</a></li>
        <li><a href="{{ route('admin.nests.view', $egg->nest->id) }}">{{ $egg->nest->name }}</a></li>
        <li class="active">{{ $egg->name }}</li>
    </ol>
@endsection

@section('content')
<div class="row mt--7">
    <div class="col-md-12">
       <div class="card shadow bg-secondary mb-cs">
         <div class="card-body bg-secondary" style="padding: 0.75rem">
           <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
              <li class="nav-item">
                 <a class="nav-link mb-sm-3 mb-md-0 active" href="{{ route('admin.nests.egg.view', $egg->id) }}" role="tab">Configuration</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('admin.nests.egg.variables', $egg->id) }}" role="tab">Variables</a>
              </li>
              <li class="nav-item">
                 <a class="nav-link mb-sm-3 mb-md-0" href="{{ route('admin.nests.egg.scripts', $egg->id) }}" role="tab">Scripts</a>
              </li>
           </ul>
         </div>
       </div>
    </div>
    <div class="col-md-12">
        <div class="alert alert-info">
            <strong>Notice:</strong> Editing an Egg or any of the Process Management fields <em>requires</em> that each Daemon be rebooted in order to apply the changes.
        </div>
    </div>
</div>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" enctype="multipart/form-data" method="POST">
    <div class="row mb-cs">
        <div class="col-md-12">
            <div class="card shadow">
                <div class="card-body">
                    <div class="row mb--4">
                        <div class="col-md-8">
                            <div class="form-group no-margin-bottom">
                                <label for="pName" class="control-label">Egg File</label>
                                <div>
                                    <input type="file" name="import_file" class="form-control" style="border: 0;margin-left:-10px;" />
                                    <p class="text-muted small no-margin-bottom">If you would like to replace settings for this Egg by uploading a new JSON file, simply select it here and press "Update Egg". This will not change any existing startup strings or Docker images for existing servers.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! csrf_field() !!}
                            <button type="submit" name="_method" value="PUT" class="btn btn-sm btn-danger pull-right">Update Egg</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="{{ route('admin.nests.egg.view', $egg->id) }}" method="POST">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-cs">
                <div class="card-header border-transparent">
                   <div class="row align-items-center">
                      <div class="col">
                         <h3 class="mb-0">Configuration</h3>
                      </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pName" class="control-label">Name <span class="field-required"></span></label>
                                <input type="text" id="pName" name="name" value="{{ $egg->name }}" class="form-control" />
                                <p class="text-muted small">A simple, human-readable name to use as an identifier for this Egg.</p>
                            </div>
                            <div class="form-group">
                                <label for="pUuid" class="control-label">UUID</label>
                                <input type="text" id="pUuid" readonly value="{{ $egg->uuid }}" class="form-control" />
                                <p class="text-muted small">This is the globally unique identifier for this Egg which the Daemon uses as an identifier.</p>
                            </div>
                            <div class="form-group">
                                <label for="pAuthor" class="control-label">Author</label>
                                <input type="text" id="pAuthor" readonly value="{{ $egg->author }}" class="form-control" />
                                <p class="text-muted small">The author of this version of the Egg. Uploading a new Egg configuration from a different author will change this.</p>
                            </div>
                            <div class="form-group">
                                <label for="pDockerImage" class="control-label">Docker Image <span class="field-required"></span></label>
                                <input type="text" id="pDockerImage" name="docker_image" value="{{ $egg->docker_image }}" class="form-control" />
                                <p class="text-muted small">The default docker image that should be used for new servers using this Egg. This can be changed per-server as needed.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pDescription" class="control-label">Description <span class="field-required"></span></label>
                                <textarea id="pDescription" name="description" class="form-control" rows="6">{{ $egg->description }}</textarea>
                                <p class="text-muted small">A description of this Egg that will be displayed throughout the Panel as needed.</p>
                            </div>
                            <div class="form-group">
                                <label for="pStartup" class="control-label">Startup Command <span class="field-required"></span></label>
                                <textarea id="pStartup" name="startup" class="form-control" rows="6">{{ $egg->startup }}</textarea>
                                <p class="text-muted small">The default startup command that should be used for new servers using this Egg.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card shadow mb-cs">
                <div class="card-header border-transparent">
                   <div class="row align-items-center">
                      <div class="col">
                         <h3 class="mb-0">Process Management</h3>
                      </div>
                   </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-warning">
                                The following configuration options should not be edited unless you understand how this system works. If wrongly modified it is possible for the daemon to break.</br>
                                All fields are required unless you select a separate option from the 'Copy Settings From' dropdown, in which case fields may be left blank to use the values from that Egg.
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFrom" class="form-label">Copy Settings From</label>
                                <select name="config_from" id="pConfigFrom" class="form-control">
                                    <option value="">None</option>
                                    @foreach($egg->nest->eggs as $o)
                                        <option value="{{ $o->id }}" {{ ($egg->config_from !== $o->id) ?: 'selected' }}>{{ $o->name }} &lt;{{ $o->author }}&gt;</option>
                                    @endforeach
                                </select>
                                <p class="text-muted small">If you would like to default to settings from another Egg select it from the menu above.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStop" class="form-label">Stop Command</label>
                                <input type="text" id="pConfigStop" name="config_stop" class="form-control" value="{{ $egg->config_stop }}" />
                                <p class="text-muted small">The command that should be sent to server processes to stop them gracefully. If you need to send a <code>SIGINT</code> you should enter <code>^C</code> here.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigLogs" class="form-label">Log Configuration</label>
                                <textarea data-action="handle-tabs" id="pConfigLogs" name="config_logs" class="form-control" rows="6">{{ ! is_null($egg->config_logs) ? json_encode(json_decode($egg->config_logs), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">This should be a JSON representation of where log files are stored, and whether or not the daemon should be creating custom logs.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="pConfigFiles" class="form-label">Configuration Files</label>
                                <textarea data-action="handle-tabs" id="pConfigFiles" name="config_files" class="form-control" rows="6">{{ ! is_null($egg->config_files) ? json_encode(json_decode($egg->config_files), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">This should be a JSON representation of configuration files to modify and what parts should be changed.</p>
                            </div>
                            <div class="form-group">
                                <label for="pConfigStartup" class="form-label">Start Configuration</label>
                                <textarea data-action="handle-tabs" id="pConfigStartup" name="config_startup" class="form-control" rows="6">{{ ! is_null($egg->config_startup) ? json_encode(json_decode($egg->config_startup), JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) : '' }}</textarea>
                                <p class="text-muted small">This should be a JSON representation of what values the daemon should be looking for when booting a server to determine completion.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    {!! csrf_field() !!}
                    <button type="submit" name="_method" value="PATCH" class="btn btn-primary btn-sm pull-right">Save</button>
                    <a href="{{ route('admin.nests.egg.export', ['option' => $egg->id]) }}" class="btn btn-sm btn-info pull-right" style="margin-right:10px;">Export</a>
                    <button id="deleteButton" type="submit" name="_method" value="DELETE" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="alert alert-info">
                <strong>Notice:</strong> Editing an Egg or any of the Process Management fields <em>requires</em> that each Daemon be rebooted in order to apply the changes.
            </div>
        </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    <script>
    $('#pConfigFrom').select2();
    $('#deleteButton').on('mouseenter', function (event) {
        $(this).html('<i class="fas fa-trash"></i> Delete Egg');
    }).on('mouseleave', function (event) {
        $(this).html('<i class="fas fa-trash"></i>');
    });
    $('textarea[data-action="handle-tabs"]').on('keydown', function(event) {
        if (event.keyCode === 9) {
            event.preventDefault();

            var curPos = $(this)[0].selectionStart;
            var prepend = $(this).val().substr(0, curPos);
            var append = $(this).val().substr(curPos);

            $(this).val(prepend + '    ' + append);
        }
    });
    </script>
@endsection
