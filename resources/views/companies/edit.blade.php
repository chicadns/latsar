@extends('layouts/edit-form', [
    'createText' => trans('admin/companies/table.create') ,
    'updateText' => trans('admin/companies/table.update'),
    'helpPosition'  => 'right',
    'formAction' => (isset($item->id)) ? route('companies.update', ['company' => $item->id]) : route('companies.store'),
])

{{-- Page content --}}
@section('inputFields')
<!-- Kode Wilayah -->
<div class="form-group {{ $errors->has('kode_wil') ? ' has-error' : '' }}">
    <label for="kode_wil" class="col-md-3 control-label">Kode Wilayah</label>
    <div class="col-md-7 col-sm-12{{  (\App\Helpers\Helper::checkIfRequired($item, 'kode_wil')) ? ' required' : '' }}">
        <input class="form-control" type="text" name="kode_wil" aria-label="kode_wil" id="kode_wil" value="{{ old('kode_wil', $item->kode_wil) }}"{!!  (\App\Helpers\Helper::checkIfRequired($item, 'kode_wil')) ? ' data-validation="required" required' : '' !!} />
        {!! $errors->first('kode_wil', '<span class="alert-msg" aria-hidden="true"><i class="fa fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

<!-- Nama Satker -->
@include ('partials.forms.edit.name', ['translated_name' => trans('admin/companies/table.name')])
@include ('partials.forms.edit.phone')
@include ('partials.forms.edit.fax')
@include ('partials.forms.edit.email')
@include ('partials.forms.edit.image-upload', ['image_path' => app('companies_upload_path')])

@stop
