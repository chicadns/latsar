@extends('layouts/default')

<?php
use Illuminate\Support\Facades\URL;
?>

{{-- Page title --}}
@section('title')
    Edit Aset
    @parent
@stop

@php
function generateSelectOptions($name, $options, $selectedValue) {
    $html = '';
    foreach ($options as $value => $label) {
        $selected = (old($name, $selectedValue) == $value) ? 'selected' : '';
        $html .= "<option value=\"$value\" $selected>$label</option>";
    }
    return $html;
}
@endphp

{{-- Page content --}}
@section('content')
    <div class="d-flex justify-content-center">
    <div style="max-width: 800px; width: 100%; margin: 0 auto;">
        <div class="box box-default">
            <form class="form-horizontal" method="POST" action="{{ route('allocations.create', $asset->id) }}" autocomplete="off">
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
                    <div class="required col-md-8">
                        <input required class="form-control" type="text" placeholder="Masukkan Nomor BMN" name="bmn" id="bmn" value="{{ old('bmn', $asset->bmn) }}" tabindex="1">
                        {!! $errors->first('bmn', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

                {{-- Serial number --}}
                <div class="form-group">
                    <label for="serial" class=" col-md-3 control-label">Serial Number *</label>
                    <div class="required col-md-8">
                        <input required class="form-control" type="text" placeholder="Masukkan Serial Number" name="serial" id="serial" value="{{ old('serial', $asset->serial) }}" tabindex="1">
                        {!! $errors->first('serial', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

                {{-- Kondisi Barang --}}
                <div class="form-group">
                    <label for="kondisi" class=" col-md-3 control-label">Kondisi Barang *</label>
                    <div class="required col-md-8">
                        <select required class="form-control" id="kondisi" name="kondisi" onchange="toggleSupportingLink()">
                            {!! generateSelectOptions('kondisi', ['Baik' => 'Baik', 'Rusak Ringan' => 'Rusak Ringan', 'Rusak Berat' => 'Rusak Berat'], $asset->kondisi) !!}
                        </select>
                    </div>
                </div>

                <!-- Supporting Link Input -->
                <div class="form-group" id="supporting-link-group" style="display: none;">
                    <label for="supporting_link" class="col-md-3 control-label">Sertakan bukti dukung *</label>
                    <div class="col-md-8">
                        <input class="form-control" type="url" name="supporting_link" id="supporting_link" placeholder="https://example.com" value="{{ old('supporting_link', $asset->supporting_link) }}">
                        {!! $errors->first('supporting_link', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

            </div>
            <div class="box-body">

                {{-- Informasi Software --}}
                <h4 style="margin-left: 10px; margin-bottom: 15px;">Informasi Software</h4>

                {{-- Operating System (OS) --}}
                <div class="form-group">
                    <label for="os" class=" col-md-3 control-label">Operating System (OS) *</label>
                    <div class="required col-md-8">
                        <select required class="form-control" id="os" name="os" onchange="toggleOtherOSField()">
                            {!! generateSelectOptions('os', [
                                '' => 'Pilih Operating System',
                                'Windows 7' => 'Windows 7',
                                'Windows 7 32 Bit Home' => 'Windows 7 32 Bit Home',
                                'Windows 7 Premium' => 'Windows 7 Premium',
                                'Windows 8.1 SL 64 BIT' => 'Windows 8.1 SL 64 BIT',
                                'Windows 8 Pro 64' => 'Windows 8 Pro 64',
                                'Windows 10 Enterprise' => 'Windows 10 Enterprise',
                                '99' => 'Lainnya',
                            ], $asset->_snipeit_sistem_operasi_2) !!}
                        </select>
                    </div>
                </div>

                <!-- OS Lainnya Input -->
                <div class="form-group" id="other-os-group" style="display: none;">
                    <label for="other_os" class="col-md-3 control-label" style="margin-top: -10px;">Masukkan Nama <br/>Operating System (OS) *</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="os2" id="other_os" placeholder="Masukkan Nama OS Lainnya" value="{{ old('other_os', $asset->os2) }}">
                        {!! $errors->first('other_os', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

                {{-- Microsoft Office --}}
                <div class="form-group">
                    <label for="office" class=" col-md-3 control-label">Aplikasi Office *</label>
                    <div class="required col-md-8">
                        <select required class="form-control" id="office" name="office" onchange="toggleOtherOfficeField()">
                            {!! generateSelectOptions('office', [
                                '' => 'Pilih Microsoft Office',
                                'Microsoft Office 2003 Pro' => 'Microsoft Office 2003 Pro',
                                'Microsoft Office 2013 Pro' => 'Microsoft Office 2013 Pro',
                                'Office Pro Plus 2013' => 'Office Pro Plus 2013',
                                'Microsoft Office Pro Plus 2013 OLP NL GOV' => 'Microsoft Office Pro Plus 2013 OLP NL GOV',
                                'Microsoft Office Pro Plus 2019 OLP NL GOV' => 'Microsoft Office Pro Plus 2019 OLP NL GOV',
                                'Microsoft Office MACSTD 2019 OLP NL' => 'Microsoft Office MACSTD 2019 OLP NL',
                                'MICROSOFT Office 365' => 'MICROSOFT Office 365',
                                'Microsoft Office 365 E1 Gov' => 'Microsoft Office 365 E1 Gov',
                                '99' => 'Lainnya',
                            ], $asset->_snipeit_software_office_1) !!}
                        </select>
                    </div>
                </div>

                <!-- Office Lainnya Input -->
                <div class="form-group" id="other-office-group" style="display: none;">
                    <label for="other_office" class="col-md-3 control-label" style="margin-top: -10px;">Masukkan Nama <br/>Aplikasi Office *</label>
                    <div class="col-md-8">
                        <input class="form-control" type="text" name="office2" id="other_office" placeholder="Masukkan Nama Office Lainnya" value="{{ old('other_office', $asset->office2) }}">
                        {!! $errors->first('other_office', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
                    </div>
                </div>

                {{-- Antivirus --}}
                <div class="form-group">
                    <label for="antivirus" class="col-md-3 control-label">Antivirus</label>
                    <div class="col-md-8">
                        <select class="form-control" id="antivirus" name="antivirus">
                            {!! generateSelectOptions('antivirus', [
                                '' => 'Pilih Antivirus',
                                'Mcafee - MVISON EDR&EPP 1-1 Biz' => 'Mcafee - MVISON EDR&EPP 1-1 Biz',
                                'TRENDMICRO Smart Protection' => 'TRENDMICRO Smart Protection',
                                'Symantec EndPoint Protection' => 'Symantec EndPoint Protection',
                                'SC Endpoint Prtcn SubsVL' => 'SC Endpoint Prtcn SubsVL',
                                'SC Endpoint Prtcn SubsVL OLV D' => 'SC Endpoint Prtcn SubsVL OLV D',
                            ], $asset->_snipeit_antivirus_3) !!}
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
            var supportingLinkInput = document.getElementById('supporting_link');
            
            if (kondisi === 'Rusak Berat') {
                supportingLinkGroup.style.display = 'block';
                supportingLinkInput.setAttribute('required', 'required');
            } else {
                supportingLinkGroup.style.display = 'none';
                supportingLinkInput.removeAttribute('required');
            }
        }

        // Call the function on page load to ensure the correct state is set based on the initial value
        document.addEventListener('DOMContentLoaded', function() {
            toggleSupportingLink();
        });

        function toggleOtherOSField() {
            var os = document.getElementById('os').value;
            var otherOSGroup = document.getElementById('other-os-group');
            var otherOSInput = document.getElementById('other_os');
            
            if (os === '99') { // Assuming '99' corresponds to 'Lainnya'
                otherOSGroup.style.display = 'block';
                otherOSInput.setAttribute('required', 'required');
            } else {
                otherOSGroup.style.display = 'none';
                otherOSInput.removeAttribute('required');
            }
        }

        // Call the function on page load to ensure the correct state is set based on the initial value
        document.addEventListener('DOMContentLoaded', function() {
            toggleOtherOSField();
        });

        function toggleOtherOfficeField() {
            var office = document.getElementById('office').value;
            var otherOfficeGroup = document.getElementById('other-office-group');
            var otherOfficeInput = document.getElementById('other_office');
            
            if (office === '99') { // Assuming '99' corresponds to 'Lainnya'
                otherOfficeGroup.style.display = 'block';
                otherOfficeInput.setAttribute('required', 'required');
            } else {
                otherOfficeGroup.style.display = 'none';
                otherOfficeInput.removeAttribute('required');
            }
        }

        // Call the function on page load to ensure the correct state is set based on the initial value
        document.addEventListener('DOMContentLoaded', function() {
            toggleOtherOfficeField();
        });

    </script>
@stop

