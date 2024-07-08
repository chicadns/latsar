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
            <form class="form-horizontal" method="POST" action="{{ route('allocations.update', $asset->id) }}" autocomplete="off">
            @csrf
            @method('PUT')

            <div class="box-header with-border">
                <h2 class="box-title" style="margin: 7px;"> {{ $asset->name }} ({{ $asset_tag }})</h2>
            </div>

            <div class="box-body">
                <!-- Nama Perangkat -->
                <div class="form-group">
                    <label for="name" class="col-md-3 control-label">{{ trans('admin/hardware/form.name') }} *</label>
                    <div class="col-md-8">
                        <p class="form-control-static">{{ $asset->name }}</p>
                    </div>
                </div>

                {{-- Nomor BMN --}}
                <div class="form-group">
                    <label for="bmn" class="col-md-3 control-label">{{ trans('general.BMN_number') }} *</label>
                    <div class="col-md-8">
                        <input required class="form-control" type="text" placeholder="Masukkan Nomor BMN" name="bmn" id="bmn" value="{{ old('bmn', $asset->bmn) }}" tabindex="1">
                        {!! $errors->first('bmn', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

                {{-- Serial number --}}
                <div class="form-group">
                    <label for="serial" class="col-md-3 control-label">{{ trans('general.serial') }} *</label>
                    <div class="col-md-8">
                        <input required class="form-control" type="text" placeholder="Masukkan Serial Number" name="serial" id="serial" value="{{ old('serial', $asset->serial) }}" tabindex="1">
                        {!! $errors->first('serial', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

                {{-- Kondisi Barang --}}
                <div class="form-group">
                    <label for="kondisi" class="col-md-3 control-label">Kondisi Barang *</label>
                    <div class="col-md-8">
                        <select required class="form-control" id="kondisi" name="kondisi" onchange="toggleSupportingLink()">
                            <option value="Baik">Baik</option>
                            <option value="Rusak Ringan">Rusak Ringan</option>
                            <option value="Rusak Berat">Rusak Berat</option>
                        </select>
                    </div>
                </div>

                <!-- Supporting Link Input -->
                <div class="form-group" id="supporting-link-group" style="display: none;">
                    <label for="supporting_link" class="col-md-3 control-label">Sertakan bukti dukung *</label>
                    <div class="col-md-8">
                        <input class="form-control" type="url" name="supporting_link" id="supporting_link" placeholder="https://example.com">
                        {!! $errors->first('supporting_link', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

            </div>
            <div class="box-body">

                {{-- Informasi Software --}}
                <h4 style="margin-left: 10px; margin-bottom: 15px;">Informasi Software</h4>

                {{-- Operating System (OS) --}}
                <div class="form-group">
                    <label for="os" class="col-md-3 control-label">Operating System (OS)</label>
                    <div class="col-md-8">
                        <select class="form-control" id="os" name="os">
                            <option value="Windows">Windows</option>
                            <option value="Linux">Linux</option>
                            <option value="Mac">Mac</option>
                        </select>
                    </div>
                </div>

                {{-- Microsoft Office --}}
                <div class="form-group">
                    <label for="office" class="col-md-3 control-label">Microsoft Office *</label>
                    <div class="col-md-8">
                        <select required class="form-control" id="office" name="office">
                            <option value="Microsoft">Microsoft</option>
                            <option value="LibreOffice">LibreOffice</option>
                            <option value="Google Docs">Google Docs</option>
                        </select>
                    </div>
                </div>

                {{-- Antivirus --}}
                <div class="form-group">
                    <label for="antivirus" class="col-md-3 control-label">Antivirus</label>
                    <div class="col-md-8">
                        <select class="form-control" id="antivirus" name="antivirus">
                            <option value="McAfee">McAfee</option>
                            <option value="Norton">Norton</option>
                            <option value="Avast">Avast</option>
                        </select>
                    </div>
                </div>
            </div> <!--/.box-body-->

            <div class="box-footer">
                <a class="btn btn-link" href="{{ route('allocations.index') }}">{{ trans('button.cancel') }}</a>
                <button type="submit" class="btn btn-primary pull-right"><i class="fas fa-check icon-white" aria-hidden="true"></i> {{ trans('general.save') }}</button>
            </div>
        </form>

        </div>
    </div> <!--/.col-md-7-->
    </div>
@stop

@section('moar_scripts')
    <script>
        function toggleSupportingLink() {
            var kondisi = document.getElementById('kondisi').value;
            var supportingLinkGroup = document.getElementById('supporting-link-group');
            
            if (kondisi === 'Rusak Berat') {
                supportingLinkGroup.style.display = 'block';
            } else {
                supportingLinkGroup.style.display = 'none';
            }
        }
    </script>
@stop

