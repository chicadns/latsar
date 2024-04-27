<!-- Company -->
@if (($snipeSettings->full_multiple_companies_support=='1') && (!Auth::user()->isSuperUser()))
    <!-- full company support is enabled and this user isn't a superadmin -->
    <div class="form-group">
    {{ Form::label($fieldname."_2", $translated_name, array('class' => 'col-md-3 control-label')) }}
        <div class="col-md-7 col-sm-12" @if (json_decode(Auth::user()['groups'], true)[0]['name'] == 'Pengguna') @else style="pointer-events: none" @endif>
            <select class="js-data-companies-ajax" data-placeholder="{{ trans('general.select_company') }}" name="{{ $fieldname }}_2" style="width: 100%" id="company_select_2">
                @if ($company_id = Request::old($fieldname."_2", (isset($item)) ? $item->{$fieldname} : ''))
                    <option value="{{ $company_id }}" selected="selected" role="option" aria-selected="true"  role="option">
                        {{ (\App\Models\Company::find($company_id)) ? \App\Models\Company::find($company_id)->name : '' }}
                    </option>
                @else
                {{-- ($company_id = old('company_id_2', (isset($current_user)) ? $current_user->company_id : '')) --}}
                    {{$company_id = Auth::user()->company_id}}
                    @if (isset($transcstt))
                        @if ($company_id < 26 && $company_id != 6 && $company_id != 7)
                            {{$company_id = 5}}
                        @endif
                        <option value="{{ $company_id }}" selected="selected" role="option" aria-selected="true"  role="option">
                            {{ (\App\Models\Company::find($company_id)) ? \App\Models\Company::find($company_id)->name : '' }}
                        </option>
                    @else
                        <option value="{{ $company_id }}" selected="selected" role="option" aria-selected="true"  role="option">
                            {{ (\App\Models\Company::find($company_id)) ? \App\Models\Company::find($company_id)->name : '' }}
                        </option>
                    @endif
                {{-- @else --}}
                    {{-- <option value="" role="option">{{ trans('general.select_company') }}</option> --}}
                @endif
            </select>
        </div>
    </div>

@else
    <!-- full company support is enabled or this user is a superadmin -->
    <div id="{{ $fieldname }}_2" class="form-group{{ $errors->has($fieldname."_2") ? ' has-error' : '' }}">
        {{ Form::label($fieldname."_2", $translated_name, array('class' => 'col-md-3 control-label')) }}
        <div class="col-md-7 col-sm-12">
            <select class="js-data-companies-ajax" data-placeholder="{{ trans('general.select_company') }}" name="{{ $fieldname }}_2" style="width: 100%" id="company_select_2">
                @if ($company_id = Request::old($fieldname, (isset($item)) ? $item->{$fieldname} : ''))
                    <option value="{{ $company_id }}" selected="selected">
                        {{ (\App\Models\Company::find($company_id)) ? \App\Models\Company::find($company_id)->name : '' }}
                    </option>
                @else
                    <option value="">{{ trans('general.select_company') }}</option>
                @endif
            </select>
        </div>
        {!! $errors->first($fieldname."_2", '<div class="col-md-8 col-md-offset-3"><span class="alert-msg"><i class="fas fa-times"></i> :message</span></div>') !!}

    {!! $errors->first($fieldname."_2", '<div class="col-md-8 col-md-offset-3"><span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span></div>') !!}
    </div>

@endif