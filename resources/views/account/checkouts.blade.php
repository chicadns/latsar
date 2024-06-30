@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('admin/hardware/general.checkout') }}
@stop

{{-- Account page content --}}
@section('content')

<div class="row">
  <div class="col-md-9">
  {{ Form::open(['method' => 'POST', 'files' => true, 'class' => 'form-horizontal', 'autocomplete' => 'off']) }}
  <!-- CSRF Token -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <div class="box box-default">
      <div class="box-body">

        <!-- Satuan Kerja -->
        @if ($user->company && $user->company->name)
          <div class="form-group">
              {{ Form::label('model', trans('general.company'), array('class' => 'col-md-3 control-label')) }}
              <div class="col-md-8">
                  <p class="form-control-static">
                      {{ $user->company->name }}
                  </p>
              </div>
          </div>
        @endif

        <!-- Pilih Aset -->
        @include('partials.forms.edit.asset-user-checkout', [
        'translated_name' => trans('general.choose_assets'),
        'fieldname' => 'choose_assets',
        'required' => 'true',
        // 'jenis_barang_options' => $jenis_barang_options,
        // 'kategori_barang_options' => $kategori_barang_options,
        // 'nama_barang_options' => $nama_barang_options
        ])

        <!-- Diberikan kepada -->
        @if ($user->first_name)
          <div class="form-group">
              {{ Form::label('model', trans('general.allocate_to'), array('class' => 'col-md-3 control-label')) }}
              <div class="col-md-8">
                  <p class="form-control-static">
                      {{ $user->first_name }}
                  </p>
              </div>
          </div>
        @endif

        <!-- Tanggal Alokasi -->
        <div class="form-group {{ $errors->has('checkout_at') ? 'error' : '' }}">
            {{ Form::label('checkout_at', trans('admin/hardware/form.checkout_date'), array('class' => 'col-md-3 control-label')) }}
            <div class="col-md-8">
                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd" data-date-end-date="0d" data-date-clear-btn="true">
                    <input type="text" class="form-control" placeholder="{{ trans('general.select_date') }}" name="checkout_at" id="checkout_at" value="{{ old('checkout_at', date('Y-m-d')) }}">
                    <span class="input-group-addon"><i class="fas fa-calendar" aria-hidden="true"></i></span>
                </div>
                {!! $errors->first('checkout_at', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            </div>
        </div>

        <!-- Note -->
        <div class="form-group {{ $errors->has('note') ? 'error' : '' }}">
            {{ Form::label('note', trans('admin/hardware/form.notes'), array('class' => 'col-md-3 control-label')) }}
            <div class="col-md-8">
                <textarea class="col-md-6 form-control" id="note" name="note"></textarea>
                {!! $errors->first('note', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
            </div>
        </div>

      <!-- .box-body -->
      <div class="text-right box-footer">
        <a class="btn btn-link" href="{{ URL::previous() }}">{{ trans('button.cancel') }}</a>
        <button type="submit" class="btn btn-primary"><i class="fas fa-check icon-white" aria-hidden="true"></i> {{ trans('general.save') }}</button>
      </div>
    </div> <!-- .box-default -->
    {{ Form::close() }}
  </div> <!-- .col-md-9 -->
</div> <!-- .row-->

@stop
