<!-- nip -->
<div class="form-group {{ $errors->has('employee_num') ? ' has-error' : '' }}">
    <label for="nip" class="col-md-3 control-label">{{ $translated_name }}</label>
    <div class="col-md-7 col-sm-12{{  (Helper::checkIfRequired($item, 'nip')) ? ' required' : '' }}">
        <input class="form-control" type="text" name="nip" id="nip" value="{{ old('nip', $item->employee_num) }}" placeholder="Masukkan NIP Penanggung Jawab" {!!  (Helper::checkIfRequired($item, 'nip')) ? ' data-validation="required" required' : '' !!} />
        {!! $errors->first('employee_num', '<span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span>') !!}
    </div>
</div>
