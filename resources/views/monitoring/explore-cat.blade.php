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
    <div class="col-md-12"> 
        <h2><strong>Rangkuman Informasi Aset</strong></h2>
    </div>
    <div class="col-md-9" style="height: 200px;"> 
        <p style="font-size: 17px;">Fokus pada bagian ini adalah untuk memberikan rangkuman informasi aset berdasarkan kategori aset yang telah dipilih. Bubble Chart digunakan sebagai alat untuk membandingkan merek pada kategori aset yang telah dipilih. Dari Bubble Chart ini, dapat diketahui banyaknya aset dengan merek tertentu (diwakili ukuran bubble), persentase aset dengan merek tersebut yang masih dalam kondisi baik (diwakili oleh sumbu y), dan rata-rata harga aset dengan merek tersebut (ditunjukkan pada sumbu x). Selain itu, pada Histogram juga ditampilkan sebaran usia aset berdasarkan kelompok usia dan kondisinya.</p>
        <p style="font-size: 17px;">Interpretasi pada Bubble Chart: 
        <ul style="font-size: 17px;">
            <li>Sumbu horizontal (X) mewakili tingkat rata-rata harga merek, dimana semakin ke kanan menunjukkan merek yang lebih mahal.</li>
            <li>Sumbu vertikal (Y) menggambarkan tingkat persentase aset yang masih dalam kondisi baik, dimana semakin ke atas menunjukkan persentase aset dengan merek tersebut semakin baik.</li>
            <li>Ukuran bubble menunjukkan jumlah aset dengan merek tersebut, dimana semakin besar bubble, semakin banyak jumlah asetnya.</li>
        </ul>

    </div>

    <div class="col-md-3" style="border-radius: 5px;background-color: #222D32; padding: 15px; height: 320px;"> 
    <div style=" margin-bottom: 8px;">
    <label for="asetDropdown" style="font-size: 16px; color: #ECF0F5;">Kelompok Aset:</label>
        <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
            <option value="1" selected>Aset TI</option>
            <option value="2">Aset non-TI</option>
        </select> 
    </div>              

    <div style=" margin-bottom: 8px;">
    <label for="groupDropdown" style="font-size: 16px; color: #ECF0F5;">Jenis:</label>
        <select class="form-control filterti" id="filter-ti" style="width: 100%; background-color: #ECF0F5;">
            <option value="hardwareti">Peralatan dan Mesin Khusus TIK</option>
            <option value="tinowujud">Aset Tak Berwujud</option>
        </select>               

        <select class="form-control filternonti" id="filter-nonti" style="width: 100%; background-color: #ECF0F5;">
            <option value="transport">Alat Angkutan Bermotor</option>
            <option value="alatbesar">Alat Besar</option>
            <option value="renovasi">Aset Tetap Renovasi</option>
            <option value="kontruksi">Kontruksi Dalam Pengerjaan</option>
            <option value="jalan">Jalan dan Jembatan</option>
            <option value="bangunan">Gedung dan Bangunan</option>
            <option value="rumahdinas">Rumah Negara</option>
        </select>
    </div>

    <div style=" margin-bottom: 16px;">
        <label for="catDropdown" style="font-size: 16px; color: #ECF0F5;">Kategori:</label>
        <select class="btn btn-default dropdown-toggle form control katgab"  id="opsi-gab" style="width: 100%; background-color: #ECF0F5;">
        </select>
    </div>

        @if ($kodeWil != "kabkot")
        <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Unit Kerja:</label>
            <select class="btn btn-default dropdown-toggle form control filterunit" id="filter-unitkerja" style="width: 100%; background-color: #ECF0F5;">
                @if ($kodeWil == "pusat")
                    <option value="pusat">Seluruh Unit Kerja</option>
                @else
                    <option value="pusat">Seluruh Unit Kerja Terkait</option>
                @endif
                @if ($kodeWil == "pusat" || $kodeWil == "prov")
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                @endif
            </select>
        @endif

        @if ($kodeWil == "kabkot")
            <div style="display:none;">
                <select class="btn btn-default dropdown-toggle form control filterunit" id="filter-unitkerja" style="width: 100%; background-color: #ECF0F5;">
                    @foreach($companies as $company)
                        <option value="{{ $company->id }}"></option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>
</div>

<div class="container">
<div class="row justify-content-center">
  <div class="col-md-12">

        <!-- Bubble Chart Informasi Aset-->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Persentase Aset yang Baik, Rata-rata Harga, dan Jumlah Aset berdasarkan Merek</h2>
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
                            <canvas id="bubbleInfo"  style="height: 500px; width: 600px;"></canvas>
                        </div> <!-- ./chart-responsive -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->

        <!-- Histogram Sebaran Usia Aset-->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Sebaran Usia Aset</h2>
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
                            <canvas id="histoAge3" style="height: 400px; width: 500px;"></canvas>
                        </div> <!-- ./chart-responsive -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->
        
        </div>
    </div>
</div> <!--/row-->

@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script> 
var bubbleCharts = {}; 
var optionBubbleChart = {
    tooltips: {
        callbacks: {
            label: function(tooltipItem, data) {
                var datasetLabel = data.datasets[tooltipItem.datasetIndex].label || "";
                var xLabel = "Rata-rata Harga Aset = " + tooltipItem.xLabel;
                var yLabel = tooltipItem.yLabel + "% " + "Aset " + "Berkondisi Baik";
                var zLabel = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index].r + "% dari kategori aset ini bermerek " + datasetLabel;
                return [datasetLabel, xLabel, yLabel, zLabel];
            }
        }
    },
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        xAxes: [{
            ticks: {
                beginAtZero: true,
                callback: function(value, index, values) {
                    return value.toLocaleString('id-ID', { style: 'currency', currency: 'IDR' });
                }
            },
            scaleLabel: {
                display: true,
                labelString: "Rata-rata Nilai Perolehan Pertama (IDR)",
            },
        }],
        yAxes: [{
            ticks: {
                max: 100
            },
            scaleLabel: {
                display: true,
                labelString: "Persentase Aset Berkondisi Baik", 
            },
        }],
    },
    legend: {
        display: true,
        position: 'bottom', 
    },
};


function initializeBubbleChart(chartId, chartUrl) {
    $.ajax({
        type: 'GET',
        url: chartUrl,
        headers: {
            "X-Requested-With": 'XMLHttpRequest',
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        },
        dataType: 'json',
        success: function (data) {
            if (bubbleCharts[chartId]) {
                bubbleCharts[chartId].destroy();
            }       

            bubbleCharts[chartId] = new Chart(document.getElementById(chartId).getContext('2d'), {
                type: 'bubble',
                data: data,
                options: optionBubbleChart,
                plugins: [{
                    afterDatasetsDraw: function(chart, easing) {
                        var ctx = chart.ctx;

                        chart.data.datasets.forEach(function(dataset, i) {
                            var meta = chart.getDatasetMeta(i);
                            if (meta.type == "bubble") { 
                                meta.data.forEach(function(element, index) {
                                    ctx.fillStyle = 'rgb(0, 0, 0)';
                                    var fontSize = 13;
                                    var fontStyle = 'normal';
                                    var fontFamily = 'Helvetica Neue';
                                    ctx.font = Chart.helpers.fontString(fontSize, fontStyle, fontFamily);

                                    var dataString = dataset.data[index].toString();
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'middle';

                                    var padding = 15;
                                    var position = element.tooltipPosition();
                                    ctx.fillText(dataset.title, position.x, position.y + (2 * fontSize) - padding);
                                });
                            } 
                        });
                    }
                }]
            });
        },
        error: function (data) {
            console.error("Ajax request failed:", data);
        },
    });
}


var histoCharts = {}; 
var optionHistoChart = {
    responsive: true,
    maintainAspectRatio: false,
    legend: {
        display: true 
    },
    scales: {
      xAxes: [{
        display: true,
        barPercentage: 1.2,
        ticks: {
            max: 3,
        },
        scaleLabel: {
            display: true,
            labelString: "Kelompok Umur Aset"
        }
     }],
      yAxes: [{
        ticks: {
          beginAtZero:true
        },
        stacked: true, 
        scaleLabel: {
            display: true,
            labelString: "Jumlah Aset"
        }
      }]
    }
};

function initializeHistoChart(chartId, chartUrl) {
        $.ajax({
            type: 'GET',
            url: chartUrl,
            headers: {
                "X-Requested-With": 'XMLHttpRequest',
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (data) {
                if (histoCharts[chartId]) {
                    histoCharts[chartId].destroy();
                }       

                histoCharts[chartId] = new Chart(document.getElementById(chartId).getContext('2d'), {
                    type: 'bar',
                    data: data,
                    options: optionHistoChart
                });
            },
            error: function (data) {
                console.error("Ajax request failed:", data);
            },
        });
    } 

    
    $(document).ready(function() {
    $('.filternonti').hide();
    var tingkat = 1; // Initialize tingkat here

    // Function to update charts
    function updateCharts(selectedItemId, tingkat, unit) {
        initializeBubbleChart('bubbleInfo', '{!! route('api.explore.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', selectedItemId).replace(':tingkat', tingkat).replace(':unit', unit));
        initializeHistoChart('histoAge3',  '{!! route('api.age.group', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit']) !!}'.replace(':id', selectedItemId).replace(':tingkat', tingkat).replace(':unit', unit));
    }

    // Function to append options to opsi gab
    function appendOptionsToOpsiGab(selectedCategory) {
        var data;
        switch(selectedCategory) {
            case 'hardwareti':
                data = <?php echo json_encode($hardwares); ?>;
                break;
            case 'tinowujud':
                data = <?php echo json_encode($tinowujud); ?>;
                break;
            case 'rumahdinas':
                data = <?php echo json_encode($rumahdinas); ?>;
                break;
            case 'alatbesar':
                data = <?php echo json_encode($alatbesar); ?>;
                break;
            case 'transport':
                data = <?php echo json_encode($transports); ?>;
                break;
            case 'renovasi':
                data = <?php echo json_encode($renovasi); ?>;
                break;
            case 'kontruksi':
                data = <?php echo json_encode($kontruksi); ?>;
                break;
            case 'jalan':
                data = <?php echo json_encode($jalan); ?>;
                break;
            case 'bangunan':
                data = <?php echo json_encode($bangunan); ?>;
                break;
            default:
                data = [];
        }

        $('#opsi-gab').empty();
        $.each(data, function(index, item) {
            $('#opsi-gab').append($('<option>').text(item.name).attr('value', item.id));
        });
    }

    // Event handler for filter-aset change
    $('#filter-aset').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue === '1') {
            $('#filter-ti').show().val('hardwareti');
            appendOptionsToOpsiGab('hardwareti');
            $('.filternonti').hide();
        } else if (selectedValue === '2') {
            $('.filterti').hide();
            $('.filternonti').show();
            $('#filter-nonti').val('transport').change();
            appendOptionsToOpsiGab('transport');
        }
        var selectedItemId = $('#opsi-gab').val(); 
        updateCharts(selectedItemId, tingkat, $('#filter-unitkerja').val());
    });

    // Event handlers for filter-ti and filter-nonti change
    $('#filter-ti, #filter-nonti').change(function() {
        var selectedCategory = $(this).val();
        appendOptionsToOpsiGab(selectedCategory);
        var selectedItemId = $('#opsi-gab').val(); 
        updateCharts(selectedItemId, tingkat, $('#filter-unitkerja').val());
    });

    // Event handler for opsi-gab change
    $('#opsi-gab').change(function() {
        var selectedItemId = $(this).val();
        updateCharts(selectedItemId, tingkat, $('#filter-unitkerja').val());
    });

    // Event handler for filter-unitkerja change
    $('#filter-unitkerja').change(function() {
        var unit = $(this).val();
        var selectedItemId = $('#opsi-gab').val();
        updateCharts(selectedItemId, unit ? 2 : 1, unit);
    });

    // Initialize select2
    $('#opsi-gab, #filter-unitkerja').select2({
        closeOnSelect: true 
    });

    // Trigger filter-aset change
    $('#filter-aset').val('1').change();
});






</script>

@endpush