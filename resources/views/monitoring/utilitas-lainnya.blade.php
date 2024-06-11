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
    <div class="col-md-9">
        <h3><strong>Digunakan Pihak Lain</strong></h3>
    </div>
</div>
                
<div class="row">
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Jumlah Aset yang Digunakan oleh Pihak Lain Menurut Kategori dan Kondisi</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="AsetSewa" style="height: 350px; width: 500px;"></canvas>
                </div> <!-- /.chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
    </div>

    <div class="col-md-6">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            data-cookie-id-table="dashLocationSummary"
                            data-height="400"
                            data-side-pagination="server"
                            data-sort-order="desc"
                            data-sort-field="assets_count"
                            id="dashLocationSummary"
                            class="table table-striped snipe-table"
                            data-url="{{ route('api.assets.sewa.info', ['sort' => 'category', 'order' => 'asc']) }}">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="col-sm-3" data-visible="true" data-field="category">
                                        Kategori
                                    </th>
                                    <th class="col-sm-1" data-visible="true" data-field="nup">
                                        NUP
                                    </th>
                                    <th class="col-sm-1" data-visible="true" data-field="umur">
                                        Umur Aset
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="harga">
                                        Harga
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="nilaibuku">
                                        Nilai Buku
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="unitkerja">
                                        Satuan/Unit Kerja
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
        <h3><strong>Tidak Digunakan</strong></h3>
    </div>
</div>
                
<div class="row">
    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Jumlah Aset yang Tidak Digunakan Menurut Kategori dan Kondisi</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="UnusedAset" style="height: 350px; width: 500px;"></canvas>
                </div> <!-- /.chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
    </div>

    <div class="col-md-6">
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table
                            data-cookie-id-table="dashLocationSummary"
                            data-height="400"
                            data-side-pagination="server"
                            data-sort-order="desc"
                            data-sort-field="assets_count"
                            id="dashLocationSummary"
                            class="table table-striped snipe-table"
                            data-url="{{ route('api.unused.assets.info', ['sort' => 'category', 'order' => 'asc']) }}">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th class="col-sm-3" data-visible="true" data-field="category">
                                        Kategori
                                    </th>
                                    <th class="col-sm-1" data-visible="true" data-field="nup">
                                        NUP
                                    </th>
                                    <th class="col-sm-1" data-visible="true" data-field="umur">
                                        Umur Aset
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="harga">
                                        Harga
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="nilaibuku">
                                        Nilai Buku
                                    </th>
                                    <th class="col-sm-3" data-visible="true" data-field="unitkerja">
                                        Satuan/Unit Kerja
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
<script> 

    var barCharts = {}; 
    var optionBarChart = {
    indexAxis: 'y',
    legend: {
        position: 'top',
        labels: {
            boxWidth: 40,
            fontSize: 16,
        },
    },
    elements: {
        bar: {
            borderWidth: 2,
        }
    },
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            scaleLabel: {
                display: false,
            },
        }],
        xAxes: [{
            scaleLabel: {
                display: true,
                labelString: "Jumlah Aset", 
            },
        }],
    }, 
    plugins: {
        title: {
            display: true,
            text: 'Chart.js Horizontal Bar Chart'
        },
        datalabels: {
            display: false,
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

                barCharts[chartId] = new Chart(document.getElementById(chartId).getContext('2d'), {
                    type: 'horizontalBar',
                    data: data,
                    options: option,
                });
            },
            error: function (data) {
                console.error("Ajax request failed:", data);
            },
        });
    } 
initializeBarChart('UnusedAset', '{!! route('api.unused.aset') !!}');
initializeBarChart('AsetSewa', '{!! route('api.sewa.aset') !!}');
    
</script>

@endpush