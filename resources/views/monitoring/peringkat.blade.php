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
    <div class="col-md-9" style="height: 150px;"> 
        <h2><strong>Peringkat Pengelolaan Aset</strong></h2>
        <p style="font-size: 17px;">Bagian ini bertujuan membandingkan penggunaan aset berdasarkan kondisinya di antara unit kerja BPS. Aset yang rusak berat perlu dihapus daripada digunakan sedangkan aset rusak ringan perlu dilakukan pemeliharaan segera. Dengan begitu, peringkat pengelolaan unit kerja berdasarkan jumlah tertinggi dari aset berkondisi baik.</p>
    </div>

    <div class="col-md-3" style="border-radius: 5px;background-color: #222D32; padding: 15px; height: 230px;"> 
    <div style=" margin-bottom: 8px;">
    <label for="groupDropdown" style="font-size: 15px; color: #ECF0F5;">Level:</label>
        <select class="form-control level" id="filter-lv" style="width: 100%; background-color: #ECF0F5;">
            <option value="1">Provinsi</option>
            <option value="2">Kabupaten/Kota</option>
            <option value="3">Direktorat dan lainnya</option>
        </select>         
    </div>
    <div style=" margin-bottom: 8px;">
    <label for="asetDropdown" style="font-size: 15px; color: #ECF0F5;">Kelompok Aset:</label>
        <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
            <option class="dropdown-item"  value="null" >Seluruh Aset</option>
            <option class="dropdown-item"  value="1">Aset TI</option>
            <option class="dropdown-item"  value="2">Aset non-TI</option>
        </select>  
    </div>  
    
    <label for="catDropdown" style="font-size: 15px; color: #ECF0F5;">Kategori Aset:</label>
        <select class="btn btn-default dropdown-toggle form control katgab" id="opsi-gab" style="width: 100%; background-color: #ECF0F5;">
        </select>  

    </div>
</div>

<div class="container">
<div class="row justify-content-center">
  <div class="col-md-12">

        <!-- Horizontal Bar Chart Rank Pengelolaan Aset Terbaik-->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Peringkat Unit Kerja dengan Pengelolaann Aset Terbaik</h2>
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
                            <canvas id="barRank"  style="height: 400px; width: 500px;"></canvas>
                        </div> <!-- ./chart-responsive -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->


        <!-- Grouped Bar Chart Peringkat Penggunaan Aset Rusak Berat-->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Unit Kerja dengan Jumlah Aset Rusak Berat Tertinggi</h2>
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
                            <canvas id="barGroupRusak" style="height: 400px; width: 500px;"></canvas>
                        </div> <!-- ./chart-responsive -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->

        <!-- Grouped Bar Chart Peringkat Penggunaan Aset Rusak Ringan-->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Unit Kerja dengan Jumlah Aset Rusak Ringan Tertinggi</h2>
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
                            <canvas id="barGroupRusak2" style="height: 400px; width: 500px;"></canvas>
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
 $('#opsi-gab').select2({
        closeOnSelect: true 
    });

$('#opsi-gab').append($('<option>').text('Seluruh Kategori').attr('value', ''));

$('#filter-aset').change(function() {
    var selectedValue = $(this).val();
    $('#opsi-gab').empty(); 
    $('#opsi-gab').append($('<option>').text('Seluruh Kategori').attr('value', '')); 

    if (selectedValue === '1') {
        data = <?php echo json_encode($ti); ?>;
        $.each(data, function(index, item) {
            $('#opsi-gab').append($('<option>').text(item.name).attr('value', item.id));
        });
    } else if (selectedValue === '2') {
        data = <?php echo json_encode($nonti); ?>;
        $.each(data, function(index, item) {
            $('#opsi-gab').append($('<option>').text(item.name).attr('value', item.id));
        });
    }
});



var barCharts = {}; 
var optionBarChart = {
    scales: {
        xAxes: [{
            ticks: {
                min: 0,
            },  
            scaleLabel: {
                display: true,
                labelString: "Jumlah Aset"
            }
        }],
        yAxes: [{
            scaleLabel: {
                display: true,
                labelString: "Unit Kerja"
            }
        }]
    }, 
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

var optionBarGroupedChart = {
    elements: {
        bar: {
            borderWidth: 2,
        }
    },
            plugins: {
                title: {
                    display: true,
                    text: "Chart.js Bar Chart - Stacked",
                },
            },
            interaction: {
                intersect: false,
            },
            scales: {
                xAxes: [{
                    ticks: {
                        min: 0,
                    },  
                    scaleLabel: {
                        display: true,
                        labelString: "Jumlah Aset"
                    }
                }],
                yAxes: [{
                    scaleLabel: {
                        display: true,
                        labelString: "Unit Kerja"
                    }
                }],
                x: {
                    stacked: true,
                  },
                 y: {
                   stacked: true,
                 }
            },
            maintainAspectRatio: false,
        };


    function initializeBarChart(chartId, chartUrl, option) {
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

    initializeBarChart('barRank', '{!! route('api.best.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', 1).replace(':asetType', 'kelAset').replace(':asetValue', null), optionBarChart);

initializeBarChart('barGroupRusak', '{!! route('api.worst.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', 1).replace(':asetType', 'kelAset').replace(':asetValue', null), optionBarGroupedChart);
initializeBarChart('barGroupRusak2', '{!! route('api.worse.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', 1).replace(':asetType', 'kelAset').replace(':asetValue', null), optionBarGroupedChart);

$(document).ready(function() {

    function updateCharts(selectedLv, asetType, katAset) {

        var baikChartUrl = '{!! route('api.best.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', selectedLv).replace(':asetType', asetType).replace(':asetValue', katAset);
        var rusakChartUrl = '{!! route('api.worst.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', selectedLv).replace(':asetType', asetType).replace(':asetValue', katAset);
        var ringanChartUrl = '{!! route('api.worse.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', selectedLv).replace(':asetType', asetType).replace(':asetValue', katAset);

        initializeBarChart('barRank', baikChartUrl, optionBarChart);
        initializeBarChart('barGroupRusak', rusakChartUrl, optionBarGroupedChart);
        initializeBarChart('barGroupRusak2', ringanChartUrl, optionBarGroupedChart);
    }

    $('#filter-lv').change(function() {
        var selectedLv = $(this).val();
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType;
        var nilai = null;

        if (katAset !== null && katAset >= 1) {
            asetType = 'katAset';
            nilai = katAset;
        } else {
            asetType = 'kelAset';
            nilai = kelAset;
        }
        updateCharts(selectedLv, asetType, nilai);
    });

    $('#filter-aset').change(function() {
        var selectedLv = $('#filter-lv').val();
        var asetType = 'kelAset';
        const kelAsetVal = $(this).val();
        updateCharts(selectedLv, asetType, kelAsetVal);
    });

    $('#opsi-gab').change(function() {
        var selectedLv = $('#filter-lv').val();
        var asetType = 'katAset';
        const katAset = $(this).val();
        updateCharts(selectedLv, asetType, katAset);
    });

});


</script>

@endpush