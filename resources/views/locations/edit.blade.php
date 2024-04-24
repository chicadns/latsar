@extends('layouts/edit-form', [
    'createText' => trans('admin/locations/table.create') ,
    'updateText' => trans('admin/locations/table.update'),
    'topSubmit' => true,
    'helpPosition' => 'right',
    'formAction' => (isset($item->id)) ? route('locations.update', ['location' => $item->id]) : route('locations.store'),
])

{{-- Page content --}}
@section('inputFields')

<div class="form-group {{ $errors->has('id') ? ' has-error' : '' }}">
    {{ Form::label('koderuang', trans('admin/locations/table.id'), array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7{{  (Helper::checkIfRequired($item, 'koderuang')) ? ' required' : '' }}">
    {{Form::text('koderuang', old('koderuang', $item->koderuang), array('class' => 'form-control', 'aria-label'=>'koderuang')) }}
        {!! $errors->first('koderuang', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}

    </div>
</div>
@include ('partials.forms.edit.name', ['translated_name' => trans('admin/locations/table.name')])

<!-- Currency -->
<!-- <div class="form-group {{ $errors->has('currency') ? ' has-error' : '' }}">
    <label for="currency" class="col-md-3 control-label">
        {{ trans('admin/locations/table.currency') }}
    </label>
    <div class="col-md-9{{  (Helper::checkIfRequired($item, 'currency')) ? ' required' : '' }}">
        {{ Form::text('currency', old('currency', $item->currency), array('class' => 'form-control','placeholder' => 'USD', 'maxlength'=>'3', 'style'=>'width: 60px;', 'aria-label'=>'currency')) }}
        {!! $errors->first('currency', '<span class="alert-msg" aria-hidden="true">:message</span>') !!}
    </div>
</div> -->

<div class="form-group {{ $errors->has('address') ? ' has-error' : '' }}">
    {{ Form::label('address', trans('admin/locations/table.address'), array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7">
        {{Form::text('address', old('address', $item->address), array('class' => 'form-control', 'aria-label'=>'address')) }}
        {!! $errors->first('address', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('city') ? ' has-error' : '' }}">
    {{ Form::label('city', trans('admin/locations/table.city'), array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7">
    {{Form::text('city', old('city', $item->city), array('class' => 'form-control', 'aria-label'=>'city')) }}
        {!! $errors->first('city', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('state') ? ' has-error' : '' }}">
    {{ Form::label('state', trans('admin/locations/table.state'), array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-7">
    {{Form::text('state', old('state', $item->state), array('class' => 'form-control', 'aria-label'=>'state')) }}
        {!! $errors->first('state', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}

    </div>
</div>

<!-- LDAP Search OU -->
@if ($snipeSettings->ldap_enabled == 1)
    <div class="form-group {{ $errors->has('ldap_ou') ? ' has-error' : '' }}">
        <label for="ldap_ou" class="col-md-3 control-label">
            {{ trans('admin/locations/table.ldap_ou') }}
        </label>
        <div class="col-md-7{{  (Helper::checkIfRequired($item, 'ldap_ou')) ? ' required' : '' }}">
            {{ Form::text('ldap_ou', old('ldap_ou', $item->ldap_ou), array('class' => 'form-control')) }}
            {!! $errors->first('ldap_ou', '<span class="alert-msg" aria-hidden="true">:message</span>') !!}
        </div>
    </div>
@endif

@include ('partials.forms.edit.image-upload', ['image_path' => app('locations_upload_path')])
@stop

