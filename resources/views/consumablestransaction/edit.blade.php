@extends('layouts/edit-form', [
    'createText' => (isset($transaction)) ? ($transaction == 'pengeluaran' ? 'Menambah Transaksi Pengeluaran Barang' : 'Menambah Transaksi Pemasukkan Barang') : "",
    'updateText' => (old('types', $item->types) == 'Pengeluaran' ? 'Memperbarui Transaksi Pengeluaran Barang' : 'Memperbarui Transaksi Pemasukkan Barang'),
    'helpPosition' => 'right',
    'helpText' => trans('help.consumables'),
    'formAction' => (isset($item->id)) ? route('consumablestransaction.update', ['consumablestransaction' => $item->id]) : route('consumablestransaction.store'),
])

{{-- Page content --}}
@section('inputFields')
    <!-- status transaksi -->
    <div class="form-group">
        <label for="state" class="col-md-3 control-label">{{ 'Status Transaksi' }}</label>
        <div class="col-md-7 col-sm-12" @if ($current_user->company_id == $item->company_id || $current_user->id == $item->user_id || $current_user->id == $item->assigned_to || $current_user->isSuperUser() {{--|| json_decode($current_user['groups'], true)[0]['name'] == 'Pengguna'--}} || isset($transaction)) {{ $access_user = true }} @else {{ $access_user = false }} style="pointer-events: none" @endif>
            <select required class="select2" style="width:100%;" name="state" id="state">
                @if ((isset($transaction)) || (old('state', $item->state) == 'Entri Data'))
                    <option value="Entri Data" selected>Entri Data</option>
                @endif
                @if ((isset($transaction)) || (old('state', $item->state) == 'Entri Data') || (old('state', $item->state) == 'Disubmit'))
                    <option value="Disubmit" {{ old('state', $item->state) == 'Disubmit' ? 'selected' : '' }}>Disubmit</option>
                @endif
                @if (old('types', $item->types) == 'Pengeluaran')
                    @if ((old('state', $item->state) == 'Disubmit') || (old('state', $item->state) == 'Disetujui') || (old('state', $item->state) == 'Ditolak'))
                        <option value="Disetujui" {{ old('state', $item->state) == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                        <option value="Ditolak" {{ old('state', $item->state) == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                    @endif
                    @if ((old('state', $item->state) == 'Disetujui') || (old('state', $item->state) == 'Ditolak') || (old('state', $item->state) == 'Selesai'))
                        <option value="Selesai" {{ old('state', $item->state) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    @endif
                @else
                    @if ((old('state', $item->state) == 'Disubmit'))
                        <option value="Entri Data">Batal Disubmit</option>
                    @endif
                    @if ((old('state', $item->state) == 'Disubmit') || (old('state', $item->state) == 'Selesai'))
                        <option value="Selesai" {{ old('state', $item->state) == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    @endif
                @endif
            </select>
        </div>
    </div>
    <!-- jenis transaksi -->
    <input class="form-control" type="hidden" value="{{ (isset($transaction)) ? ( $transaction == 'pengeluaran' ? 'Pengeluaran' : 'Pemasukkan' ) : ( old('types', $item->types) == 'Pengeluaran' ? 'Pengeluaran' : 'Pemasukkan' ) }}" name="types" id="types">
    <!-- satuan unit kerja -->
    @include ('partials.forms.edit.company-select-2', ['translated_name' => 'Satuan/Unit Kerja Penyedia', 'fieldname' => 'company_id', 'transcstt' => 'true'])
    <!-- khusus pengeluaran -->
    <div @if($access_user == false) style="pointer-events: none" @endif>
    <div @if((isset($transaction) && $transaction == 'pemasukkan') || ($item->types == 'Pemasukkan') || (!$current_user->isSuperUser() && json_decode($current_user['groups'], true)[0]['name'] == 'Pengguna')) style="display: none;" @endif>
            @include ('partials.forms.edit.nip', ['translated_name' => 'NIP Penanggung Jawab'])
            @include ('partials.forms.edit.company-select', ['translated_name' => 'Satuan/Unit Kerja Penerima', 'fieldname' => 'company_user'])
            @include ('partials.forms.edit.user-select', ['translated_name' => 'Pengguna Barang', 'fieldname' => 'assigned_to', 'hide_new' => 'true', 'style_user' => 'pointer-events: none'])
    </div>
    <!-- tanggal pengadaan -->
    @include ('partials.forms.edit.purchase_date')
    <!-- catatan -->
    @include ('partials.forms.edit.notes')
    </div>
    <!-- modal -->
    <a href='{{ route('modal.show',['type' => 'statustransaction']) }}' data-toggle="modal" data-target="#createModal" class="showModal btn btn-sm btn-primary" style="display:none;">{{ trans('button.new') }}</a>
    <!-- tabel -->
    <div>
        <div class="row">
            <div class="col-md-12">
                <div class="box box-default">
                    <div class="box-header">
                        <h4 class="box-title">Data Transaksi Barang</h4>
                        <div class="box-tools">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                                <i class="fas fa-minus" aria-hidden="true"></i>
                                <span class="sr-only">{{ trans('general.collapse') }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="box-body">
                        <table class="table table-striped snipe-table">
                            <thead>
                            <tr>
                                <th>
                                    Nama Barang
                                </th>
                                <th>
                                    Kategori
                                </th>
                                <th>
                                    Biaya Pengadaan
                                </th>
                                <th>
                                    Tersisa
                                </th>
                                <th>
                                    Jumlah
                                </th>
                                @if ( isset($item) && $item->types == 'Pengeluaran' )
                                    <th class="data-approve" style="display: none">
                                        Jml. Disetujui
                                    </th>
                                @endif
                                <th @if($access_user == false) style="display: none" @endif></th>
                            </tr>
                            </thead>
                            <tbody class="input_fields_wrap"></tbody>
                        </table>
                        @if ( (isset($transaction)) || (old('state', $item->state) == 'Entri Data') )
                        <div class="form-group" @if($access_user == false) style="display: none" @endif>
                            <div class="col-md-12 col-sm-16" style="padding-left: 25px">
                                <button class="add_row_button btn btn-primary btn-sm" style="font-weight: bold;">
                                    <i class="fas fa-plus" aria-hidden="true"></i>
                                    Tambah transaksi
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('moar_scripts')
    <script>
        var countRow    = {{ count($itemdetails->toArray()) }};
        var access_user = <?php echo json_encode($access_user); ?>;
        var items       = <?php echo json_encode($item) ?>;
        var transaction = <?php echo json_encode(isset($transaction)? $transaction : '') ?>;
        var selectValue = [];
        $(document).ready(function () {
            if (countRow == 0) {
                addRowInput(0, 'indextr');
            } else {
                for(let i = 0; i < countRow; i++) {
                    addRowInput(i, 'updatetr');
                }
            }

            if (items.state == 'Disubmit' || items.state == 'Disetujui' || items.state == 'Ditolak' || items.state == 'Selesai' || access_user == false) {
                $('.closeselect').css('pointer-events', 'none');
                $('.closeinput').prop('readonly', true);
                $('.remove_field').prop('disabled', true);
            }
            if (access_user == false) {
                $('.hidden_field').css('display', 'none');
                $(`button[type="submit"]`).css('display', 'none');
                $('.btn-link').css('display', 'none');
            }
            if (items.state == 'Disetujui' || items.state == 'Ditolak' || items.state == 'Selesai') {
                $('.data-approve').css('display', 'block');
            }
            if (items.state == 'Disetujui') {
                $('.zeroinput').prop('readonly', false)
            }

            $(document).on("change", "#state", function () {
                if ($(this).val() == "Ditolak") {
                    $('.zeroinput').prop('readonly', true).val(0);
                    $('.data-approve').css('display', 'block');
                } else if ($(this).val() == "Disetujui") {
                    $('.zeroinput').prop('readonly', false).prop('required', true).val('');
                    $('.data-approve').css('display', 'block');
                } else if ($(this).val() == "Disubmit") {
                    $('.data-approve').css('display', 'none');
                    $('.zeroinput').prop('readonly', true).prop('required', false).val('');
                }
            });

            $('#state').select2({minimumResultsForSearch: -1});

            $(document).on("change", "select[name^='names[']", async function() {
                let index = $(this).attr('name').match(/\d+/)[0]; 
                let consumableId = $(this).val();
                $(this).closest('.input_fields_wrap').find('select').each(function(i) {
                    if ($(this).closest('tr').find('.delete_input').val() === '') {
                        selectValue[i] = $(this).val();
                    } else {
                        if ($(this).val() != null) {
                            selectValue[i] = $(this).val();
                        } else {
                            selectValue[i] = 0;
                        }
                    }
                });
                try {
                    let consumableData = await getConsumableData(consumableId);
                    $(`input[name="purchase_costs[${index}]"]`).val(consumableData.purchase_cost);
                    $(`input[name="purchase_costsview[${index}]"]`).val(consumableData.purchase_cost);
                    $(`input[name="categorys[${index}]"]`).val(consumableData.category_id); 
                    $(`input[name="categorysview[${index}]"]`).val(consumableData.category_name);
                    $(`input[name="remains[${index}]"]`).val(consumableData.qty);
                    if (items.types == "Pengeluaran" || transaction == "pengeluaran") {
                        $(`input[name="qtys[${index}]"]`).prop('readonly', false).focus().attr('max',consumableData.qty).attr('min', 1);
                    } else {
                        $(`input[name="qtys[${index}]"]`).prop('readonly', false).focus().attr('min', 1);
                    }
                } catch (error) {
                    console.log(error);
                }
            });
        });

        var x               = {{ isset($itemdetails[0]) ? count($itemdetails->toArray()) : 1 }};
        var pointIndex      = 0;
        var limit           = x;
        var baseUrl         = $('meta[name="baseUrl"]').attr('content');
        function updateIndex() {
            $('.input_fields_wrap').find('.indextr').each(function(i) {
                var data_id = {{ isset($itemdetails[0]) ? count($itemdetails->toArray()) : 0 }};
                $(this).attr('data-id', i+data_id);
                $(this).find('select, input, .remove_field').each(function() {
                    var name = $(this).attr('name').replace(/\[\d+\]/, '['+(i+data_id)+']');
                    var ids = $(this).attr('id').replace(/\[\d+\]/, '['+(i+data_id)+']');
                    $(this).attr('name', name);
                    $(this).attr('id', ids);
                });
            });
        }

        function getConsumableData(consumableId) {
            return new Promise((resolve, reject) => {
                $.ajax({
                    url: `/consumablestransaction/${consumableId}/getDataConsumables`,
                    success: (consumableData) => {resolve(consumableData)},
                    error: (err) => {reject(err)}
                });
            });
        }

        function addRowInput(index, classIndex) {
            var box_html        = '';
            var itemdetails     = <?php echo json_encode($itemdetails) ?>[index];
            var dataIsSet       = {{ isset($itemdetails[0]) ? 1 : 0 }}

            box_html += '<tr class="'+classIndex+'" data-id="'+index+'">';
            box_html += '<td class="closeselect">';
            box_html += '<div class="form-group"> <div class="col-md-12 col-sm-12">';
            box_html += '<select class="js-data-consumable-ajax form-control" required data-placeholder="Nama Barang" style="width: 100%" name="names['+index+']" id="names['+index+']">';
            if (dataIsSet == 1 && index < countRow && pointIndex == 0) {
                box_html += '<option value="'+itemdetails.consumable_id+'" name="consumables['+index+']" selected="selected" role="option" aria-selected="true">'+itemdetails.consumable_name+'</option>';
            }
            box_html += '</select>';
            box_html += '</div> </div>';
            box_html += '</td>';
            box_html += '<td>';
            box_html += '<div class="form-group"> <div class="col-md-7 col-sm-12" style="width: 100%">';
            box_html += '<input class="form-control" type="hidden" name="categorys['+index+']" id="categorys['+index+']" />';
            box_html += '<input class="form-control" disabled style="background: white; cursor: default;" type="text" name="categorysview['+index+']" id="categorysview['+index+']"/>';
            box_html += '</div> </div>';
            box_html += '</td>';
            box_html += '<td>';
            box_html += '<div class="form-group"> <div class="input-group col-md-7 col-sm-12" style="width: 100%">';
            box_html += '<input class="form-control" type="hidden" name="purchase_costs['+index+']" id="purchase_costs['+index+']"/>';
            box_html += '<input class="form-control" disabled style="background: white; cursor: default;" type="text" name="purchase_costsview['+index+']" id="purchase_costsview['+index+']"/>';
            box_html += '<span class="input-group-addon">{{ $snipeSettings->default_currency }}</span>';
            box_html += '</div> </div> </div>';
            box_html += '</td>';
            box_html += '<td>';
            box_html += '<div class="form-group"> <div class="col-md-7 col-sm-12" style="width: 100%">';
            box_html += '<input class="form-control" disabled style="background: white; cursor: default;" type="text" name="remains['+index+']" id="remains['+index+']">';
            box_html += '</div> </div>';
            box_html += '</td>';
            box_html += '<td>';
            box_html += '<div class="form-group"> <div class="col-md-7 col-sm-12" style="width: 100%;">';
            box_html += '<input class="form-control closeinput" required style="background: white; cursor: default;" type="number" name="qtys['+index+']" id="qtys['+index+']"/>';
            box_html += '</div> </div>';
            box_html += '</td>';
            if (dataIsSet == 1 && index < countRow && pointIndex == 0 && items.types == "Pengeluaran") {
                box_html += '<td class="data-approve" style="display: none">';
                box_html += '<div class="form-group"> <div class="col-md-7 col-sm-12" style="width: 100%;">';
                box_html += '<input class="form-control zeroinput" readonly="true" style="background: white; cursor: default;" type="number" min="0" max="'+itemdetails.qty+'" name="qtyapproves['+index+']" id="qtyapproves['+index+']">';
                box_html += '</div></div>';
                box_html += '</td>';
            }
            box_html += '<td class="hidden_field">';
            box_html += '<div class="form-group"> <div class="col-md-7 col-sm-12">';
            box_html += '<button class="remove_field btn btn-default btn-sm" id="deletes['+index+']" name="deletes['+index+']"><i class="fas fa-minus"></i></button>';
            if (dataIsSet == 1 && index < countRow && pointIndex == 0) {
                box_html += '<input type="hidden" class="delete_input form-control" id="deleted_details['+index+']" name="deleted_details['+index+']"/>';
            }
            box_html += '</div> </div>';
            box_html += '</td>';
            box_html += '</tr>';

            $('.input_fields_wrap').append(box_html);
            $('.input_fields_wrap').find('.js-data-consumable-ajax').select2({
                ajax: {
                    url:baseUrl+'api/v1/consumablestransaction/selectlist',
                    dataType: 'json',
                    delay: 250,
                    headers: {
                        "X-Requested-With": 'XMLHttpRequest',
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                    },
                    data: function (params) {
                        var data = {
                            search: params.term,
                            page: params.page || 1,
                            assetStatusType: $(this).data("asset-status-type"),
                            company_id: $('#company_select_2').val(),
                            value_select: selectValue,
                        };
                        return data;
                    },
                    cache: true
                },
                templateResult: function (data) {
                    if (data.loading) {
                        return $('<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Loading...');
                    }
                    var markup = data.text;
                    return markup;
                }
            });

            if (dataIsSet == 1 && index < countRow && pointIndex == 0) {
                $(`input[name="categorys[${index}]"]`).val(itemdetails.category_id);
                $(`input[name="categorysview[${index}]"]`).val(itemdetails.category_name);
                $(`input[name="purchase_costs[${index}]"]`).val(itemdetails.purchase_cost);
                $(`input[name="purchase_costsview[${index}]"]`).val(itemdetails.purchase_cost);
                $(`input[name="remains[${index}]"]`).val(itemdetails.consumable_qty);
                $(`input[name="qtys[${index}]"]`).val(itemdetails.qty);
                $(`input[name="qtyapproves[${index}]"]`).val(itemdetails.approve_qty)
                $(`button[name="deletes[${index}]"]`).attr('data-id', itemdetails.id);
                if (items.types == "Pengeluaran") {
                    $(`input[name="qtys[${index}]"]`).prop('readonly', false).attr('max',itemdetails.consumable_qty).attr('min', 1);
                } else {
                    $(`input[name="qtys[${index}]"]`).prop('readonly', false).attr('min', 1);
                }
                selectValue[index] = itemdetails.consumable_id.toString();
            } else {
                $(`input[name="qtys[${index}]"]`).prop('readonly', true);
            }
        }

        $('.add_row_button').click(function(e){
            e.preventDefault();
            if (x < 100) {
                addRowInput(x, 'indextr');
                $(".hold_field").addClass('remove_field').removeClass('hold_field');
                x++;
                pointIndex--;
                limit++;
            } else {
                $('.add_row_button').attr('disabled');
                $('.add_row_button').addClass('disabled');
            }
        });

        $('.input_fields_wrap').on("click",".remove_field", function(e){
            e.preventDefault();
            if (limit > 1) {
                var id = $(this).data('id');
                var removeValue = $(this).closest('tr').find('select').val();
                $('.add_row_button').removeAttr('disabled');
                $('.add_row_button').removeClass('disabled');
                if (selectValue.indexOf(removeValue) !== -1) {
                    selectValue.splice(selectValue.indexOf(removeValue), 1);
                }
                if (id != null) {
                    $(this).closest('tr').find('.delete_input').val(id);
                    $(this).closest('tr').css('display', 'none');
                    limit--;
                } else {
                    $(this).closest('tr').remove();
                    x--;
                    pointIndex++;
                    limit--;
                }
                updateIndex();
            } else {
                $(".remove_field").removeClass('remove_field').addClass('hold_field');
            } 
        });

        $("#state").on("change", function(){
            if($(this).val() == "Disubmit" && items.state != "Disubmit") {
                $(`button[type="submit"]`).removeAttr('type').attr('type', 'button').addClass('openModal');
            } else {
                $(".openModal").removeAttr('type').attr('type', 'submit').removeClass('openModal');
            }
            $(".openModal").off("click").click(function() {
                if($("#state").val() == "Disubmit") {
                    $(".showModal").click(); 
                }
            });
        });

        $('.js-data-companies-ajax').select2({
            placeholder: '',
            allowClear: false,
            ajax: {
                url: baseUrl+'api/v1/companies/selectlist2',
                dataType: 'json',
                delay: 250,
                headers: {
                    "X-Requested-With": 'XMLHttpRequest',
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                },
                data: function (params) {
                    var data = {
                        search: params.term,
                        page: params.page || 1,
                        assetStatusType: $(this).data("asset-status-type"),
                    };
                    return data;
                },
                cache: true
            },
            templateResult: function (data) {
                if (data.loading) {
                    return $('<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Loading...');
                }
                var markup = data.text;
                return markup;
            }
        });
    </script>
@stop