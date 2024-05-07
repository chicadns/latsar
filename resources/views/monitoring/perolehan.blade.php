@extends('layouts/default')
{{-- Page title --}}

@section('title')
{{ trans('Monitoring') }}
@parent
@stop
<style> 


</style>

{{-- Page content --}}
@section('content')

<div class="row" style="margin-bottom: 50px;">
    <div class="col-md-9" style="height: 150px;"> <!-- Atur tinggi col-md-9 -->
        <h2><strong>Nilai Perolehan Pertama</strong></h2>
        <p style="font-size: 17px;">Pada bagian ini, visualisasi data berfokus pada menampilkan total nilai perolehan pertama selama lima tahun terakhir. Selain itu, juga ditampilkan kategori aset serta kondisinya berdasarkan jumlah aset yang paling banyak dibeli selama lima tahun terakhir.</p>
    </div>

    <div class="col-md-3" style="border-radius: 5px;background-color: #222D32; padding: 15px; height: 230px;"> <!-- Atur tinggi col-md-3 -->
        <div style=" margin-bottom: 8px;">
        <label for="hardwareDropdown" style="font-size: 16px; color: #ECF0F5;">Kelompok Aset:</label>
            <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
                <option class="dropdown-item"  value="" >Gabungan</option>
                <option class="dropdown-item"  value="1">Aset TI</option>
                <option class="dropdown-item"  value="2">Aset non-TI</option>
            </select>
        </div> 

        @if ($kodeWil == "pusat")
        <div style=" margin-bottom: 8px;">
        <label for="groupDropdown" style="font-size: 16px; color: #ECF0F5;">Level:</label>
        <select class="form-control level" id="filter-lv" style="width: 100%; background-color: #ECF0F5;">
            <option value="1">Nasional</option>
            <option value="2">Provinsi</option>
            <option value="3">Kabupaten/Kota</option>
            <option value="4">Satuan Unit Kerja</option>
        </select>  
        </div> 

        <div id="unit-satuan" style="display:none;">
        <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Unit Kerja:</label>
        <input type="hidden" id="kode-wil" value="{{ $kodeWil }}">
        <select class="btn btn-default dropdown-toggle form control filterunit" id="filter-unitkerja" style="width: 100%; background-color: #ECF0F5;">
        </select>  
        </div>
        @endif

        <div id="unit-turunan" style="display:none;">
        <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Unit Kerja:</label>
        <input type="hidden" id="kode-wil" value="{{ $kodeWil }}">
        <select class="btn btn-default dropdown-toggle form control filterunit" id="filter-turunan" style="width: 100%; background-color: #ECF0F5;">
        </select>  
        </div> 
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Line Chart Perolehan Pertama Aset -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Nilai Perolehan Pertama Aset Selama Lima Tahun Terakhir</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="chart-responsive">
                                <canvas id="lineCap" style="height: 400px; width: 500px;"></canvas>
                            </div> <!-- ./chart-responsive -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
            </div> <!-- /.box -->

            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Pembelian Aset dengan Jumlah Tertinggi Berdasarkan Kategori Selama Lima Tahun Terakhir</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="chart-responsive">
                        <canvas id="groupedNewAsset" style="height: 400px; width: 500px;"></canvas>
                    </div> <!-- ./chart-responsive -->
                </div><!-- /.box-body -->
            </div> <!-- /.box -->
        </div>
    </div>
</div>

@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')

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
                display: true,
                labelString: "Kategori Aset",
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
            color: '#fff',
            font: {
                size: 12
            }
        }
    }
};


var lineCharts = {};
var optionLineChart = {
    plugins: {
        title: {
            display: true,
            text: "Chart.js Line Chart",
        },
        legend: {
            display: false 
        }
    },
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero: true,
                callback: function(value, index, values) {
                    return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                }
            },
            scaleLabel: {
                display: true,
                labelString: "Total Nilai Perolehan Pertama Aset (IDR)",
            },
        }],
        xAxes: [{
            scaleLabel: {
                display: true,
                labelString: "Tahun Pembelian Aset", 
            },
        }],
    },
    interaction: {
        intersect: false,
    },
    maintainAspectRatio: false,
};



    function initializeBarChart(chartId, chartUrl) {
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
                    options: optionBarChart,
                });
            },
            error: function (data) {
                console.error("Ajax request failed:", data);
            },
        });
    } 


function initializeLineChart(chartId, chartUrl) {
    $.ajax({
        type: 'GET',
        url: chartUrl,
        headers: {
            "X-Requested-With": 'XMLHttpRequest',
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            if (lineCharts[chartId]) {
                lineCharts[chartId].destroy();
            }
            // Create a new chart instance
            lineCharts[chartId] = new Chart(document.getElementById(chartId).getContext('2d'), {
                type: 'line',
                data: data,
                options: optionLineChart,
            });
        },
        error: function (data) {
            console.error("Ajax request failed:", data);
        },
    });
} 

initializeBarChart('groupedNewAsset', '{!! route('api.latest.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', null).replace(':tingkat', 1).replace(':unit', null));

initializeLineChart('lineCap', '{!! route('api.first.value', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', null).replace(':tingkat', 1).replace(':unit', null));

$(document).ready(function() {
    $('#filter-unitkerja').select2();
    $('#filter-turunan').select2();
    var kodeWil = $('#kode-wil').val();
    data = <?php echo json_encode($companies); ?>;

    if (kodeWil != "pusat") {
        $('#unit-turunan').show();
        if (kodeWil == "prov") {
                $('#filter-turunan').append($('<option>').text('Seluruh Unit Kerja Terkait').attr('value', '')); 
            }
            $.each(data, function(index, item) {
                $('#filter-turunan').append($('<option>').text(item.name).attr('value', item.id));
            }); 

            $('#filter-turunan').change(function() {
                var selectedLv = 4;
                var selectedAset = $('#filter-aset').val();
                var unit = $(this).val();       

                if (!selectedAset) selectedAset = null;
                updateCharts(selectedAset, selectedLv, unit);
        });
    } 

    function updateCharts(selectedAset, selectedLv, unit) {
        var latestChart = '{!! route('api.latest.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit);
        var lineChart = '{!! route('api.first.value', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit);
        
        initializeBarChart('groupedNewAsset', latestChart);
        initializeLineChart('lineCap', lineChart);
    }   

    $('#filter-aset').change(function() {
        var selectedAset = $(this).val();
        var selectedLv = $('#filter-lv').val();
        var unit = $('#filter-unitkerja').val();    

        if (!selectedAset) selectedAset = null; 

        if (selectedLv <= 3) unit = null;   

        updateCharts(selectedAset, selectedLv, unit);
    });

    $('#filter-lv').change(function() {
        var selectedLv = $(this).val();
        var selectedAset = $('#filter-aset').val();
        if (!selectedAset) selectedAset = null;

        if (selectedLv == 4) {
            $('#unit-satuan').show();
            $('#filter-unitkerja').empty(); 

            if (kodeWil != "kabkot") {
                if (kodeWil == "pusat") {
                    $('#filter-unitkerja').append($('<option>').text('Seluruh Unit Kerja').attr('value', '')); 
                } else if (kodeWil == "prov") {
                    $('#filter-unitkerja').append($('<option>').text('Seluruh Unit Kerja Terkait').attr('value', '')); 
                }

                $.each(data, function(index, item) {
                    $('#filter-unitkerja').append($('<option>').text(item.name).attr('value', item.id));
                });

            } else {
                $.each(data, function(index, item) {
                    $('#filter-unitkerja').append($('<option style="display:none;">').text(item.name).attr('value', item.id));
                });
            } 

            updateCharts(selectedAset, 1, null);
        } else { 
            $('#unit-satuan').hide();
            updateCharts(selectedAset, selectedLv, null);
        }
    });

    $('#filter-unitkerja').change(function() {
        var selectedLv = $('#filter-lv').val();
        var selectedAset = $('#filter-aset').val();
        var unit = $(this).val();   

        if (!selectedAset) selectedAset = null;
        unit = selectedLv <= 3 ? null : unit; 
        updateCharts(selectedAset, selectedLv, unit);
    });

});



</script>

@endpush