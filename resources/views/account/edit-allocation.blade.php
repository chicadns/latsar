@extends('layouts/default')

<?php
use Illuminate\Support\Facades\URL;
?>

{{-- Page title --}}
@section('title')
    Edit Aset
    @parent
@stop

{{-- Page content --}}
@section('content')
    <div class="d-flex justify-content-center">
    <div style="max-width: 800px; width: 100%; margin: 0 auto;">
        <div class="box box-default">
            <form class="form-horizontal" method="post" action="" autocomplete="off">

                <div class="box-header with-border">
                    <h2 class="box-title" style="margin: 7px;"> {{ $asset->name }} ({{ $asset_tag }})</h2>
                </div>

                <div class="box-body">
                    {{-- <input type="text" style="display: none" name="asset_status" id="asset_status" value="{{ Request::get('status') }}">
                    {{csrf_field()}} --}}

                    <!-- Satker -->
                    @if ($asset->company && $asset->company->name)
                        <div class="form-group">
                            {{ Form::label('model', trans('general.company').' *', array('class' => 'col-md-3 control-label')) }}
                            <div class="col-md-8">
                                <p class="form-control-static">
                                    {{ $asset->company->name }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Nama Perangkat -->
                    @if ($asset->name == NULL)
                        <div class="form-group>
                        {{ Form::label('name', trans('admin/hardware/form.name').' *', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <input required class="form-control" type="text" placeholder="Masukkan Nama Perangkat" name="name" id="name" tabindex="1">
                            {!! $errors->first('name', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>
                    @else
                    <div class="form-group">
                        {{ Form::label('name', trans('admin/hardware/form.name').' *', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <p class="form-control-static">
                                {{ $asset->name }}
                            </p>
                        </div>
                    </div>
                    @endif

                    {{-- Nomor BMN --}}
                    <div class="form-group {{ $errors->has('bmn') ? 'error' : '' }}">
                        {{ Form::label('bmn', trans('general.BMN_number').' *', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <input required class="form-control" type="text" placeholder="Masukkan Nomor BMN" name="bmn" id="bmn" value="{{ old('bmn', $asset->bmn) }}" tabindex="1">
                            {!! $errors->first('bmn', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>

                    {{-- Serial number --}}
                    <div class="form-group {{ $errors->has('serial') ? 'error' : '' }}">
                        {{ Form::label('serial', trans('general.serial').' *', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <input required class="form-control" type="text" placeholder="Masukkan Serial Number" name="serial" id="serial" value="{{ old('serial', $asset->serial) }}" tabindex="1">
                            {!! $errors->first('serial', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>

                    {{-- Kondisi Barang --}}
                    <div class="form-group">
                        {{ Form::label('kondisi', 'Kondisi Barang'.' *', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <select required class="form-control" id="kondisi" name="kondisi" onchange="toggleSupportingLinkInput()">
                                <option value="Baik"> Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </div>
                    </div>

                    <!-- Supporting Link Input -->
                    <div class="form-group" id="supporting-link-group" style="display: none;">
                        {{ Form::label('supporting_link', 'Sertakan bukti dukung', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <input class="form-control" type="url" name="supporting_link" id="supporting_link" placeholder="https://example.com">
                            {!! $errors->first('supporting_link', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                        </div>
                    </div>
                {{-- </div> --}}

                <hr style="border: 0; height: 2px; background-color: #e9e9e9;"/>

                {{-- <div class="box-body"> --}}
                    <h4 style="margin-left: 10px; margin-bottom: 15px;">Informasi Software</h4>

                    {{-- Software --}}
                    <div class="form-group">
                        {{ Form::label('os', 'Operating System (OS)', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <select class="form-control" id="os" name="os">
                                <option value="Baik">Windows</option>
                                <option value="Baik">Windows</option>
                                <option value="Baik">Windows</option>
                            </select>
                        </div>
                    </div>
                
                    {{-- Office --}}
                    <div class="form-group">
                        {{ Form::label('office', 'Microsoft Office'.' *', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <select required class="form-control" id="office" name="office">
                                <option value="Baik">Microsoft</option>
                                <option value="Baik">Microsoft</option>
                                <option value="Baik">Microsoft</option>
                            </select>
                        </div>
                    </div>
                
                    {{-- Antivirus --}}
                    <div class="form-group">
                        {{ Form::label('antivirus', 'Antivirus', array('class' => 'col-md-3 control-label')) }}
                        <div class="col-md-8">
                            <select class="form-control" id="antivirus" name="antivirus">
                                <option value="Baik">McAfee</option>
                                <option value="Baik">McAfee</option>
                                <option value="Baik">McAfee</option>
                            </select>
                        </div>
                    </div>

                </div> <!--/.box-body-->
                <div class="box-footer">
                    <a class="btn btn-link" href="{{ URL::previous() }}"> {{ trans('button.cancel') }}</a>
                    <button type="submit" class="btn btn-primary pull-right"><i class="fas fa-check icon-white" aria-hidden="true"></i> {{ trans('general.save') }}</button>
                </div>
            </form>
        </div>
    </div> <!--/.col-md-7-->
    </div>
@stop

@section('moar_scripts')
    <script>
        function toggleSupportingLinkInput() {
            var kondisi = document.getElementById("kondisi").value;
            var supportingLinkGroup = document.getElementById("supporting-link-group");
            
            if (kondisi === "Rusak Berat") {
                supportingLinkGroup.style.display = "block";
            } else {
                supportingLinkGroup.style.display = "none";
            }
        }
    </script>
@stop

