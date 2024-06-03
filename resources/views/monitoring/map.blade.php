@extends('layouts/default')
{{-- Page title --}}
@section('title')
{{ trans('Monitoring') }}
@parent
@stop
<style> 
    .filterdata {
        background-color: #222D32; 
        padding: 15px; 
        height: 100px;
    }   
</style>

{{-- Page content --}}
@section('content')

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-12"> 
        <h2><strong>Tingkat Pendayagunaan Aset</strong></h2>
    </div>

    <div class="col-md-12"> 
        <div class="col-md-3 filterdata"> 
            <div style=" margin-bottom: 8px;">
            <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5;">Kelompok Aset</label>
            <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
                <option value="null">Seluruh Aset</option>
                <option value="1">Aset TI</option>
                <option value="2">Aset non-TI</option>
            </select>
            </div>
        </div>

        <div class="col-md-3 filterdata">
            <label for="catDropdown" style="font-size: 15px; color: #ECF0F5;">Kategori Aset:</label>
            <select class="btn btn-default dropdown-toggle form control katgab" id="opsi-gab" style="width: 100%; background-color: #ECF0F5;">
            </select>  
        </div>
        <div class="col-md-3 filterdata"> 
            <label for="provDropdown" style="font-size: 15px; color: #ECF0F5;">Wilayah:</label>
            <select class="form-control prov" id="opsi-prov" style="width: 100%; background-color: #ECF0F5;">
                
            </select>  
        </div>

        <div class="col-md-3 filterdata" style="border-radius:0px 5px 5px 0px;"> 
        </div>
    </div>
</div>

<div class="container">
<div class="row justify-content-center">
  <div class="col-md-12">
        <!-- Horizontal Bar Chart Rank Pengelolaan Aset Terbaik-->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Jumlah Aset Berdasarkan Kondisi dan Tahun Pembelian</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <select class="form-control" id="unitbagian" name="unitbagian" style="width: 20%; margin-left: 75%;">
               </select>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart-responsive">
                            <canvas id="lineCap"  style="height: 400px; width: 500px;"></canvas>
                        </div> <!-- ./chart-responsive -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->

        <!-- Grouped Bar Chart Peringkat Penggunaan Aset Rusak Berat-->
        @can('superadmin')
        <div id="ri-box">
           <div class="box box-default">
               <div class="box-header with-border">
                   <h2 class="box-title" id="prov-title">Perbandingan Jumlah Aset dan Pegawai pada Unit Kerja</h2>
                   <div class="box-tools pull-right">
                       <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                           <i class="fas fa-minus" aria-hidden="true"></i>
                       </button>
                   </div>
               </div>
               <select class="form-control" id="tingkatan" name="tingkatan" style="width: 20%; margin-left: 75%;">
                   <option value="1">Provinsi</option>
                   <option value="2">Kabupaten/Kota</option>
                   <option value="3">Eselon 2/3</option>
               </select>
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
        </div>
        @endcan

        <!-- Grouped Bar Chart Peringkat Penggunaan Aset Rusak Berat-->
        <div id="prov-box" style="display: none;">
           <div class="box box-default">
               <div class="box-header with-border">
                   <h2 class="box-title" id="prov-title">Perbandingan Jumlah Aset dan Pegawai pada Unit Kerja</h2>
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
    </div>
</div> <!--/row-->
@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script>
$.ajax({
    url: '/propinsi/',
    type: "GET",
    dataType: "json",
    success: function(data) {
        $('#opsi-prov').empty();
        $('#opsi-prov').append('<option value="all">Keseluruhan</option>');
        $.each(data, function(key, value) {
            $('#opsi-prov').append('<option value="'+ value.id +'">'+ value.name +'</option>');
        });
    }
});

function updateUnitDropdown() {
    var unitbagian = '#unitbagian'; 
    var prov = $('#opsi-prov').val(); 

    if (prov == null){
        prov = 'all';
    }

    if (prov) {
        $.ajax({
            url: '/wilayah/' + prov ,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $(unitbagian).empty();
                $(unitbagian).append('<option value="all">Seluruh Unit Kerja</option>');
                $.each(data, function(key, value) {
                    $(unitbagian).append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            }
        });
    } else {
        $(unitbagian).empty();
        $(unitbagian).append('<option value="all">Seluruh Unit Kerja</option>');
    }
}

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
            },
            scaleLabel: {
                display: true,
                labelString: "Jumlah Aset",
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

initializeLineChart('lineCap', '{!! route('api.aset.yearly', ['id' => ':id','asetType' => ':asetType', 'asetValue' => ':asetValue', 'wil' => ':wil']) !!}'.replace(':id', 'all').replace(':asetType', 'kelAset').replace(':asetValue', null).replace(':wil', 1));
// initializeBarChart('barGroupRusak', '{!! route('api.condi.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue', 'notes' => ':notes']) !!}'.replace(':tingkat', 1).replace(':asetType', 'kelAset').replace(':asetValue', null).replace(':notes', 1), optionBarGroupedChart);
initializeBarChart('barGroupRusak', '{!! route('api.unit.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', 1).replace(':asetType', 'kelAset').replace(':asetValue', null), optionBarGroupedChart);
$(document).ready(function() {
    updateUnitDropdown();

    function updateCharts() {
        var selectedNotes = $('#dropdownmap').val();
        var tingkatan = $('#tingkatan').val();
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType;
        var nilai = null;

        if (katAset != null && katAset >= 1) {
            asetType = 'katAset';
            nilai = katAset;
        } else {
            asetType = 'kelAset';
            nilai = kelAset;
        }

        var ChartUrl = '{!! route('api.unit.rank', ['tingkat' => ':tingkat','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':tingkat', tingkatan).replace(':asetType', asetType).replace(':asetValue', nilai);
        initializeBarChart('barGroupRusak', ChartUrl, optionBarGroupedChart);
        
        var tingkatan = $('#tingkatan option:selected').text();
        var newTitle = 'Perbandingan Jumlah Aset dan Pegawai pada Unit Kerja Tingkat ' + tingkatan ;
        $('#prov-title').text(newTitle);
    }

    function updateChartsProv(prov) {
        var selectedNotes = $('#dropdownmap').val();
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType;
        var nilai = null;

        if (katAset != null && katAset >= 1) {
            asetType = 'katAset';
            nilai = katAset;
        } else {
            asetType = 'kelAset';
            nilai = kelAset;
        }

        var ChartUrl = '{!! route('api.rank.byprov', ['id' => ':id','asetType' => ':asetType', 'asetValue' => ':asetValue']) !!}'.replace(':id', prov).replace(':asetType', asetType).replace(':asetValue', nilai);
        initializeBarChart('barGroupRusak2', ChartUrl, optionBarGroupedChart);
        
        var prov = $('#opsi-prov option:selected').text();
        var newTitle = 'Perbandingan Jumlah Aset dan Pegawai pada Unit Kerja di' + prov ;
        $('#prov2-title').text(newTitle);
    }

    function updateLineChart(prov, wil){
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType;
        var nilai = null;

        if (katAset != null && katAset >= 1) {
            asetType = 'katAset';
            nilai = katAset;
        } else {
            asetType = 'kelAset';
            nilai = kelAset;
        }

        initializeLineChart('lineCap', '{!! route('api.aset.yearly', ['id' => ':id','asetType' => ':asetType', 'asetValue' => ':asetValue','wil' => ':wil']) !!}'.replace(':id', prov).replace(':asetType', asetType).replace(':asetValue', nilai).replace(':wil', wil));
    }

    $('#dropdownmap, #filter-aset, #tingkatan, #opsi-gab, #opsi-prov').change(function() {
        var prov = $('#opsi-prov').val();
        updateUnitDropdown();
        if (prov != 'all') {
            $('#prov-box').show();
            $('#ri-box').hide();
            updateChartsProv(prov);
        } else {
            $('#prov-box').hide();
            $('#ri-box').show();
            updateCharts();
        }
        updateLineChart(prov, 1);
    });

    $('#unitbagian').change(function() {
        var prov = $('#opsi-prov').val();
        var unit = $('#unitbagian').val();
        var wil = 1;
            if (unit != 'all'){
                prov = unit;
                wil = 2;
            }
        updateLineChart(prov, wil);
        
    });

});

</script>

@endpush
