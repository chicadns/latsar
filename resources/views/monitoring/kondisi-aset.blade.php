@extends('layouts/default')
{{-- Page title --}}

@section('title')
{{ trans('Monitoring') }}
@parent
@stop

{{-- Page content --}}
@section('content')

<div class="row" style="margin-bottom: 50px;">
    <div class="col-md-9" style="height: 150px;"> 
        <h2><strong>Kondisi Aset</strong></h2>
        <p style="font-size: 17px;">Pada bagian ini, visualisasi data berfokus pada menampilkan proporsi kondisi aset yang dibagi menjadi tiga kategori: rusak ringan, rusak berat, dan baik. Grafik yang disajikan adalah gambaran proporsi dari setiap kondisi aset dan peringkat kategori aset berdasarkan jumlah aset yang kondisinya rusak berat terbanyak.</p>
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

<div class="row">
    <div class="col-md-6">
        <!-- Grafik pertama -->
        <div class="box box-default mb-4">
            <div class="box-header with-border">
                <h2 class="box-title">Persentase Kondisi Aset</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="pieCondition"  style="height: 400px; width: 500px;"></canvas>
                </div> <!-- ./chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
    </div>

    <div class="col-md-6">
        <!-- Grafik kedua -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Kategori Aset dengan Kerusakan Tertinggi</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="barGroupRusak" style="height: 400px; width: 500px;"></canvas>
                </div> <!-- ./chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
    </div>
</div>


@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script> 
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.4.0/dist/chartjs-plugin-datalabels.min.js"></script>
<script> 

    var pieCharts = {}; 
    var optionPieChart = {
    legend: {
        position: 'top',
        labels: {
            boxWidth: 40,
            fontSize: 16,
        },
    },
    tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        counts = data.datasets[0].data;
                        total = 0;
                        for(var i in counts) {
                            total += counts[i];
                        }
                        prefix = data.labels[tooltipItem.index] || '';
                        return prefix+" "+Math.round(counts[tooltipItem.index]/total*100)+"%";
                    }
                }
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
    },
    responsive: true,
    maintainAspectRatio: false,
    };


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


    function initializePieChart(chartId, chartUrl) {
        $.ajax({
            type: 'GET',
            url: chartUrl,
            headers: {
                "X-Requested-With": 'XMLHttpRequest',
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                if (pieCharts[chartId]) {
                    pieCharts[chartId].destroy();
                }       

                // Create a new chart
                pieCharts[chartId] = new Chart(document.getElementById(chartId).getContext('2d'), {
                    type: 'pie',
                    data: data,
                    options: optionPieChart
                });
            },
            error: function (data) {
                console.error("Ajax request failed:", data);
            },
        });
    } 
    
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
    initializePieChart('pieCondition', '{!! route('api.assets.notes', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', null).replace(':tingkat', 1).replace(':unit', null));
    initializeBarChart('barGroupRusak', '{!! route('api.worst.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', null).replace(':tingkat', 1).replace(':unit', null));

$(document).ready(function() {
    $('#filter-unitkerja').select2();
    $('#filter-turunan').select2();
    var kodeWil = $('#kode-wil').val();
    data = <?php echo json_encode($companies); ?>;
    

    function updateCharts(selectedAset, selectedLv, unit) {
        var pieChartUrl = '{!! route('api.assets.notes', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit);
        var barChartUrl = '{!! route('api.worst.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit);
        
        initializePieChart('pieCondition', pieChartUrl);
        initializeBarChart('barGroupRusak', barChartUrl);
    }

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