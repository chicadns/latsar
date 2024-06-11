@extends('layouts/default')
{{-- Page title --}}

@section('title')
{{ trans('Monitoring') }}
@parent
@stop

{{-- Page content --}}
@section('content')

@if ($kodeWil == "pusat")
<div class="row">
    <div class="col-md-10">
        <h4><strong>Aset yang Baru Ditambahkan Bulan Ini</strong></h4>
    </div>
    <div class="col-md-2">
        <div class="dropdown-container">
            <label for="month-year-dropdown">Filter:</label>
            <input type="text" id="month-year-dropdown">
        </div>
    </div>
</div>
                
<div class="row">

    <div class="col-md-2">
        <div style=" color: white; text-align: center;">
            <div style="margin-bottom: 5px; background-color: #70AB79; padding: 5px; border-radius: 2px; ">
                <h4 style="font-size: 20px; color: #FFFFFF;"><strong>Jumlah</strong></h4>
                <p id="asetBaru" style="font-size: 25px; margin: 0; font-weight: bold;""></p>
            </div>
            <div  style="margin-bottom: 5px; background-color: #70AB79; padding: 5px; border-radius: 2px; ">
                <h4 style="font-size: 20px; color: #FFFFFF; "><strong>Total Nilai</strong></h4>
                <p id="totalHarga" style="font-size: 25px; margin: 0;font-weight: bold;"></p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Jumlah Aset Baru Ditambahkan Menurut Kategori</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="chartBaru" style="height: 175px; width: 500px;"></canvas>
                </div> <!-- /.chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
    </div>

    <div class="col-md-4">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            data-cookie-id-table="dashLocationSummary"
                            data-height="225"
                            data-side-pagination="server"
                            data-sort-order="desc"
                            data-sort-field="assets_count"
                            id="dashLocationSummary"
                            class="table table-striped snipe-table"
                            data-url="{{ route('api.monthly.summ', ['tipe' => 'baru', 'month' => ':month', 'year' => ':year']) }}">
                            <thead class="bg-primary text-white"  style="background-color:#70AB79;">
                                <tr>
                                    <th class="col-sm-4" data-visible="true" data-field="unit">
                                        Satuan/Unit Kerja
                                    </th>
                                    <th class="col-sm-4" data-visible="true" data-field="total">
                                        Total Nilai
                                    </th>
                                    <th class="col-sm-4" data-visible="true" data-field="new">
                                        Aset yang Ditambahkan
                                    </th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div><!-- /.box-body -->
    </div> <!-- /.box -->
</div>



<div class="row">
    <div class="col-md-9">
        <h4><strong>Aset Rusak Bulan Ini</strong></h4>
    </div>
</div>
                
<div class="row">
    <div class="col-md-2">
    <div style=" color: white; text-align: center;">
        <div style="margin-bottom: 5px; background-color: #DE425B; padding: 5px; border-radius: 2px; ">
            <h4 style="font-size: 20px; color: #FFFFFF;"><strong>Jumlah</strong></h4>
            <p id="asetRusak" style="font-size: 25px; margin: 0;font-weight: bold;""></p>
        </div>
        <div  style="margin-bottom: 5px; background-color: #DE425B; padding: 5px; border-radius: 2px; ">
            <h4 style="font-size: 20px; color: #FFFFFF; "><strong>Total Aset Rusak</strong></h4>
            <p id="totalRusak" style="font-size: 25px; margin: 0;font-weight: bold;""></p>
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Jumlah Aset Rusak Menurut Kategori</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="chartRusak" style="height: 175px; width: 500px;"></canvas>
                </div> <!-- /.chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
    </div>

    <div class="col-md-4">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            data-cookie-id-table="dashLocationSummary"
                            data-height="225"
                            data-side-pagination="server"
                            data-sort-order="desc"
                            data-sort-field="assets_count"
                            id="dashRusakSummary"
                            class="table table-striped snipe-table"
                            data-url="{{ route('api.monthly.summ', ['tipe' => 'rusak', 'month' => ':month', 'year' => ':year']) }}">
                            <thead class="bg-primary text-white"  style="background-color:#DE425B;">
                                <tr>
                                    <th class="col-sm-3" data-visible="true" data-field="unit">
                                        Satuan/Unit Kerja
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="kat">
                                        Kategori
                                    </th>
                                    <th class="col-sm-1" data-visible="true" data-field="age">
                                        Umur Aset
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="nup">
                                        NUP
                                    </th>
                                    
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div><!-- /.box-body -->
    </div> <!-- /.box -->
</div>

@endif
@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script>
$(document).ready(function() {
            var now = new Date();
            $('#month-year-dropdown').datepicker({
                changeMonth: true,
                changeYear: true,
                showButtonPanel: true,
                dateFormat: 'MM yy',
                defaultDate: now,
                onClose: function(dateText, inst) {
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
    
                    month = parseInt(month) + 1;
                    month = month < 10 ? '0' + month : month;
    
                    loadReport(month, year);
                    updateTableUrl(month, year);
                }
            }).focus(function() {
                $(".ui-datepicker-calendar").hide();
            }).datepicker('setDate', now);
    
            var currentMonth = now.getMonth() + 1;
            var currentYear = now.getFullYear();
    
            currentMonth = currentMonth < 10 ? '0' + currentMonth : currentMonth;
    
            function loadReport(month, year) {
                $.ajax({
                    url: '/laporan/' + month + '/' + year,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        $('#asetBaru').text(data.asetBaru);
                        $('#totalRusak').text(data.totalRusak);
                        $('#asetRusak').text(data.asetRusak);
                        $('#totalHarga').text(data.totalHarga);
                    },
                    error: function(xhr, status, error) {
                        console.error('AJAX Error: ' + status + error);
                    }
                });
                initializeBarChart('chartBaru', '{!! route('api.laporan.bulanan', ['tipe' => ':tipe','month' => ':month', 'year' => ':year']) !!}'
                    .replace(':tipe', 'baru')
                    .replace(':month', month)
                    .replace(':year', year));
                initializeBarChart('chartRusak', '{!! route('api.laporan.bulanan', ['tipe' => ':tipe','month' => ':month', 'year' => ':year']) !!}'
                    .replace(':tipe', 'rusak')
                    .replace(':month', month)
                    .replace(':year', year));
            }
    
            function initializeTable(tableId, urlParams) {
                var url = $('#' + tableId).data('url');
                for (var param in urlParams) {
                    url = url.replace(':' + param, urlParams[param]);
                }
                $('#' + tableId).bootstrapTable('refreshOptions', {
                    url: url
                });
            }
    
            function updateTableUrl(month, year) {
                initializeTable('dashLocationSummary', { month: month, year: year });
                initializeTable('dashRusakSummary', { month: month, year: year });
            }
    
            loadReport(currentMonth, currentYear);
            updateTableUrl(currentMonth, currentYear);
        });



    var barCharts = {}; 
    var optionBarChart = {
    indexAxis: 'y',
    legend: {
            display: false 
        },
    elements: {
        bar: {
            borderWidth: 2,
        }
    },
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        xAxes: [{
            ticks: {
                min: 0,
                max: 0,
            }
        }]
    },
    plugins: {
        title: {
            display: true,
            text: 'Chart.js Horizontal Bar Chart'
        },
        datalabels: {
            display: true,
            align: 'end',
            anchor: 'end'
        }
    }
};

function initializeBarChart(chartId, chartUrl, option = optionBarChart) {
    $.ajax({
        type: 'GET',
        url: chartUrl,
        headers: {
            "X-Requested-With": 'XMLHttpRequest',
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            if (barCharts[chartId]) {
                barCharts[chartId].destroy();
            }

            if (data.labels.length === 0 || data.datasets[0].data.length === 0) {
                // Jika tidak ada data, tampilkan pesan "No Data Found"
                var ctx = document.getElementById(chartId).getContext('2d');
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); 
                ctx.font = '15px Poppins';
                ctx.textAlign = 'center';
                ctx.fillText('Data Tidak Ditemukan', ctx.canvas.width/1.6, ctx.canvas.height / 2);
            } else {
                var maxDataValue = Math.max(...data.datasets[0].data);
                option.scales.xAxes[0].ticks.max = maxDataValue + 2;

                barCharts[chartId] = new Chart(document.getElementById(chartId).getContext('2d'), {
                    type: 'horizontalBar',
                    data: data,
                    options: option,
                });
            }
        },
        error: function (data) {
            console.error("Ajax request failed:", data);
        },
    });
}


    
</script>

@endpush