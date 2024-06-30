{{-- <!-- Asset -->
<div id="choose_assets" class="form-group{{ $errors->has($fieldname) ? ' has-error' : '' }}"{!! (isset($style)) ? ' style="'.e($style).'"' : '' !!}>
    {{ Form::label($fieldname, $translated_name, array('class' => 'col-md-3 control-label')) }}
    <div class="col-md-8">
        {{ Form::select($fieldname . '[jenis_barang][]', $jenis_barang_options, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-ajax--url' => route('account.search'), 'data-ajax--company-id' => $user->company_id, 'data-placeholder' => trans("general.select_asset")]) }}
        {{ Form::select($fieldname . '[kategori_barang][]', $kategori_barang_options, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-ajax--url' => route('account.search'), 'data-ajax--company-id' => $user->company_id, 'data-placeholder' => trans("general.select_asset")]) }}
        {{ Form::select($fieldname . '[nama_barang][]', $nama_barang_options, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'data-ajax--url' => route('account.search'), 'data-ajax--company-id' => $user->company_id, 'data-placeholder' => trans("general.select_asset")]) }}
    </div>
    {!! $errors->first($fieldname, '<div class="col-md-8 col-md-offset-3"><span class="alert-msg" aria-hidden="true"><i class="fas fa-times" aria-hidden="true"></i> :message</span></div>') !!}
</div>

<!-- Select2 Initialization -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#assigned_asset_select').select2({
            ajax: {
                url: '{{ route('account.search') }}', // The endpoint to fetch assets
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    var query = {
                        q: params.term, // search term
                        company_id: '{{ $user->company_id }}', // filter by user's company ID
                        page: params.page || 1 // pagination
                    }
                    return query;
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 5) < data.total_count // whether or not there are more results
                        }
                    };
                },
                cache: true
            },
            minimumInputLength: 1,
            placeholder: '{{ trans("general.select_asset") }}',
            multiple: true
        });
    });
</script>


{{-- Tambah Alokasi Baru --}}
<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Include Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<!-- Include Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> --}}
