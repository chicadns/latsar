@extends('layouts/default')

{{-- Page title --}}
@section('title')
Rangkuman Transaksi
@parent
@stop

@section('header_right')

@stop

{{-- Page content --}}
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#Pemasukkan" class="pemasukkan_set" data-toggle="tab">
                        <span class="hidden-lg hidden-md">
                            <i class="fas fa-barcode" aria-hidden="true"></i>
                        </span>
                        <span class="hidden-xs hidden-sm">
                            Pemasukkan {!! ($data_type['pemasukkan']->count() > 0) ? '<badge class="badge badge-secondary">'.$data_type['pemasukkan']->count().'</badge>' : '' !!}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="#Pengeluaran" class="pengeluaran_set" data-toggle="tab">
                        <span class="hidden-lg hidden-md">
                        <i class="fas fa-barcode" aria-hidden="true"></i>
                        </span>
                        <span class="hidden-xs hidden-sm">
                            Pengeluaran {!! ($data_type['pengeluaran']->count() > 0) ? '<badge class="badge badge-secondary">'.$data_type['pengeluaran']->count().'</badge>' : '' !!}
                        </span>
                    </a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade in active" id="Pemasukkan">
                    <div class="table table-responsive">
                        <table
                            data-columns="{{ \App\Presenters\TransactionDashboardPresenter::dataTableLayout() }}"
                            data-cookie-id-table="transactionDashboardTable1"
                            data-pagination="true"
                            data-id-table="transactionDashboardTable1"
                            data-side-pagination="server"
                            data-show-columns="true"
                            data-show-export="true"
                            data-show-refresh="true"
                            data-show-footer="true"
                            id="transactionDashboardTable1"
                            class="table table-striped snipe-table"
                            data-url="{{ route('api.transactiondashboard.index',['type_filter' => 'Pemasukkan']) }}"
                            data-export-options='{
                            "fileName": "export-transactiondashboard-{{ date('Y-m-d') }}",
                            "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                            }'>
                        </table>
                    </div>
                </div>

                <div class="tab-pane" id="Pengeluaran">
                    <div class="table table-responsive">
                        <div class="form-group selectList" style="display: flex; flex-direction: row; gap: 10px; position: absolute; margin-top: 3mm;"></div>
                        <table
                            data-columns="{{ \App\Presenters\TransactionDashboardPresenter::dataTableLayout() }}"
                            data-cookie-id-table="transactionDashboardTable2"
                            data-pagination="true"
                            data-id-table="transactionDashboardTable2"
                            data-side-pagination="server"
                            data-show-columns="true"
                            data-show-export="true"
                            data-show-refresh="true"
                            data-show-footer="true"
                            id="transactionDashboardTable2"
                            class="table table-striped snipe-table"
                            data-url="{{ route('api.transactiondashboard.index',['type_filter' => 'Pengeluaran']) }}"
                            data-export-options='{
                            "fileName": "export-transactiondashboard-{{ date('Y-m-d') }}",
                            "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                            }'>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="col-md-4 closechart1">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Transaksi Menurut Unit Kerja</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('general.collapse') }}</span>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="statusPieChartByCompany" height="290"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 closechart2">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Transaksi Menurut Nama Barang</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                            <span class="sr-only">{{ trans('general.collapse') }}</span>
                        </button>
                    </div>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="statusPieChartByConsumable" height="290"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('moar_scripts')
<script>
    var company_id = <?php echo json_encode($company_type['id']); ?>;
    var company_name = <?php echo json_encode($company_type['name']); ?>;
    var selectedOptions = {
        company: company_id,
        category: null,
        namestuff: null
    };
    var valuetab = window.location.hash.replace(/[^a-zA-Z\s]/g, '').trim();
    var baseUrl = $('meta[name="baseUrl"]').attr('content');
    var access = <?php echo json_encode($access_user['super_user']); ?>;
    var group = <?php echo json_encode($access_user['group']); ?>;
    var prov = <?php echo json_encode($access_user['prov']); ?>;
    var box_html = '';
    var optionSelect = '';
    if (access == false && company_id != null) {
        optionSelect = `<option value="`+company_id+`" selected="selected" role="option" aria-selected="true"  role="option">`+company_name+`</option>`;
    }
    box_html += `<div class="form-group hidden-company">
                    <select style="width: 200px" class="js-data-filter-ajax select2" data-endpoint="companies" data-numberpoint="2" data-placeholder="Filter Nama Satuan Kerja" name="companyFilter" id="companyFilter">`+optionSelect+`</select>
                </div>
                <div class="form-group hidden-name">
                    <select style="width: 200px" class="js-data-filter-ajax select2" data-endpoint="transactiondashboard" data-numberpoint="" data-placeholder="Filter Nama Barang" name="nameFilter" id="nameFilter"></select>    
                </div>`;
    $('.selectList').append(box_html);
    if (company_id != null) {
        $('.hidden-company').css('display', 'none');
    } else {
        $('.hidden-name').css('display', 'none');
    }
    $('.pemasukkan_set').click(function() {
        var texttab  = $(this).find('.hidden-xs.hidden-sm').text().trim();
        valuetab = texttab.replace(/[^a-zA-Z\s]/g, '').trim();
        generateChart('company', {typeFilter: valuetab, compFilter: selectedOptions.company});
        generateChart('consumable', {typeFilter: valuetab, compFilter: selectedOptions.company});
    });
    $('.pengeluaran_set').click(function() {
        var texttab  = $(this).find('.hidden-xs.hidden-sm').text().trim();
        valuetab = texttab.replace(/[^a-zA-Z\s]/g, '').trim();
        generateChart('company', {typeFilter: valuetab, compFilter: selectedOptions.company});
        generateChart('consumable', {typeFilter: valuetab, compFilter: selectedOptions.company});
    });
    $('.select2').change(function() {
        selectedOptions.company = $('#companyFilter').val();
        selectedOptions.namestuff = $('#nameFilter').val();
        // $('#transactionDashboardTable1').bootstrapTable('refresh');
        $('#transactionDashboardTable2').bootstrapTable('refresh');
        generateChart('company', {typeFilter: valuetab, compFilter: selectedOptions.company});
        generateChart('consumable', {typeFilter: valuetab, compFilter: selectedOptions.company});
    });
    $('#companyFilter').change(function() {
        if ($(this).val() == null) {
            $('.hidden-name').css('display', 'none');
        } else {
            $('.hidden-name').css('display', 'block');
        }
    });
    $('.js-data-filter-ajax').each(function (i, item) {
        var link = $(item);
        var endpoint = link.data("endpoint");
        var numberpoint = link.data("numberpoint");
        link.select2({
            allowClear: (access) ? true : (group == 'Admin Pusat') ? true : (prov) ? true : (endpoint == 'transactiondashboard') ? true : false,
            ajax: {
                url: baseUrl+'api/v1/'+endpoint+'/selectlist'+numberpoint,
                dataType: 'json',
                delay: 250,
                headers: {"X-Requested-With": 'XMLHttpRequest', "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')},
                data: function (params) {
                    var data = {search: params.term, page: params.page || 1, assetStatusType: link.data("asset-status-type"), filterCompany: $('#companyFilter').val()};
                    return data;
                }
            },
            templateResult: function (data) {
                if (data.loading) {
                    return $('<i class="fas fa-spinner fa-spin" aria-hidden="true"></i> Loading...');
                }
                var markup = data.text;
                return markup;
            }
        });
    });

    // var pieChartCanvasForCompany = $("#statusPieChartByCompany").get(0).getContext("2d");
    // var pieChartCanvasForConsumable = $("#statusPieChartByConsumable").get(0).getContext("2d");
    // var pieChartComp = new Chart(pieChartCanvasForCompany);
    // var pieChartCons = new Chart(pieChartCanvasForConsumable);
    var ctxcompany = document.getElementById("statusPieChartByCompany");
    var ctxconsumable = document.getElementById("statusPieChartByConsumable");
    var pieOptions = {
              legend: {
                  position: 'top',
                  responsive: true,
                  maintainAspectRatio: true,
              },
              tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        counts = data.datasets[0].data;
                        total = 0;
                        for (var i in counts) {
                            total += parseInt(counts[i]);
                        }
                        prefix = data.labels[tooltipItem.index] || '';
                        return prefix+" "+Math.round(counts[tooltipItem.index]/total*100)+"%";
                    }
                }
              }
    };

    var myPieChartCompany;
    var myPieChartConsumable;
    function generateChart(dpndvar, additionalData) {
        $.ajax({
            type: 'GET',
            // url: '{{ (\App\Models\Setting::getSettings()->dash_chart_type == 'name') ? route('api.statuslabels.assets.byname') : route('api.statuslabels.assets.bytype', ['type_filter' => 'Pengeluaran']) }}',
            url: (dpndvar == "company") ? '{{ route('api.transaction.bycompany') }}' : '{{ route('api.transaction.byconsumable') }}',
            data: additionalData,
            headers: {
                "X-Requested-With": 'XMLHttpRequest',
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                if (dpndvar == "company" && myPieChartCompany) {
                    myPieChartCompany.destroy();
                } else if (dpndvar == "consumable" && myPieChartConsumable) {
                    myPieChartConsumable.destroy();
                }
                if (dpndvar == "company") {
                    myPieChartCompany = new Chart(ctxcompany,{
                        type   : 'doughnut',
                        data   : data,
                        options: pieOptions
                    });
                    $('.closechart1').css('display', 'block');
                } else {
                    myPieChartConsumable = new Chart(ctxconsumable,{
                        type   : 'doughnut',
                        data   : data,
                        options: pieOptions
                    });
                    $('.closechart2').css('display', 'block');
                }
            },
            error: function (data) {
                // window.location.reload(true);
                if (dpndvar == "company") {
                    $('.closechart1').css('display', 'none');
                } else {
                    $('.closechart2').css('display', 'none');
                }

            },
        });
    }
    generateChart('company', {typeFilter: valuetab, compFilter: selectedOptions.company});
    generateChart('consumable', {typeFilter: valuetab, compFilter: selectedOptions.company});
    var lastcomp = document.getElementById('statusPieChartByCompany').clientWidth;
    var lastcons = document.getElementById('statusPieChartByConsumable').clientWidth;
    addEventListener('resize', function() {
        var currentcomp = document.getElementById('statusPieChartByCompany').clientWidth;
        var currentcons = document.getElementById('statusPieChartByConsumable').clientWidth;
        if (currentcomp != lastcomp) {
            generateChart('company', {typeFilter: valuetab, compFilter: selectedOptions.company});
        }
        if (currentcons != lastcons) {
            generateChart('consumable', {typeFilter: valuetab, compFilter: selectedOptions.company});
        }
        lastcons = currentcons;
        lastcomp = currentcomp;
    });
</script>
@include ('partials.bootstrap-table')
@stop