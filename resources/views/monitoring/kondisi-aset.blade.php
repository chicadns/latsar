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

.filtertahun {
    background-color: #ECF0F5;
}

.filtertahun + .select2-container--default .select2-selection--single {
    margin-left: 15px;
}
</style>

{{-- Page content --}}
@section('content')

<div class="row" style="margin-bottom: 50px;">
    <div class="col-md-12"> 
        <h2><strong>Utilitas Aset</strong></h2>
    </div>

    <div class="col-md-12"> 
        <div class="col-md-3 filterdata" style="border-radius: 5px 0px 0px 5px;"> 
            <div style="margin-bottom: 8px;">
                <label for="hardwareDropdown" style="font-size: 16px; color: #ECF0F5;">Kelompok Aset:</label>
                <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
                    <option class="dropdown-item" value="1">Aset TI</option>
                    <option class="dropdown-item" value="2">Aset non-TI</option>
                </select>
            </div> 
        </div>

        <div class="col-md-3 filterdata"> 
            @if ($kodeWil == "pusat")
                <div style="margin-bottom: 8px;">
                    <label for="groupDropdown" style="font-size: 16px; color: #ECF0F5;">Lokasi:</label>
                    <select class="form-control level" id="filter-lv" style="width: 100%; background-color: #ECF0F5;">
                        <option value="1">Seluruh Unit Kerja</option>
                        <option value="2">BPS Pusat</option>   <!--option value="4">Satuan Unit Kerja</option> -->
                        <option value="3">BPS Provinsi</option>
                        <option value="5">BPS Kabupaten/Kota</option>
                    </select>  
                </div>

        </div> 

        <div class="col-md-3 filterdata"> 
            <div id="unit-satuan" style="display:none;">
                <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Satuan/Unit Kerja:</label>
                <input type="hidden" id="kode-wil" value="{{ $kodeWil }}">
                <select class="btn btn-default dropdown-toggle form-control filterunit" id="filter-unitkerja" style="width: 100%; background-color: #ECF0F5;">
                </select>  
            </div>
            @endif

            <div id="unit-turunan" style="display:none;">
                <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Unit Kerja:</label>
                <input type="hidden" id="kode-wil" value="{{ $kodeWil }}">
                <select class="btn btn-default dropdown-toggle form-control filterunit" id="filter-turunan" style="width: 100%; background-color: #ECF0F5;">
                </select>  
            </div>
        </div> 

        <div class="col-md-3 filterdata" style="border-radius: 0px 5px 5px 0px;"> 
        <div style="display: none;">
            <label for="thnDropdown" style="font-size: 16px; color: #ECF0F5;">Rentang Tahun Pembelian:</label>  
                <input type="hidden" id="thn" value="{{ $years }}">
                <input type="hidden" id="thnri" value="{{ $yearsri }}">
                <input type="hidden" id="thnpr" value="{{ $yearspr }}">
                <input type="hidden" id="thnkk" value="{{ $yearskk }}">
                <div class="row" style="display:flex; width:100%;">
                    <select id="start-year" class="form-control year-select filtertahun" style="width: 125px;" >
                    </select>
                    <select id="end-year" class="form-control year-select filtertahun" style="width: 125px;" >
                    </select>
                </div>

        </div>
               
        </div>

    </div>
</div>

<div class="row">
    <div class="col-md-9">
        <h3><strong>Digunakan Sendiri</strong></h3>
    </div>

    <div class="col-md-3">
        <div class="row" style="display:none;">
            <span  style="display:flex; align-items: center; padding-right:20px;">Status:  
            <select class="form-control status" id="filter-status" style="width: 100%; background-color: #ECF0F5; border-color: black; margin-left:10px;">
                <option value="">Pilih status</option>
                <option value="2">Siap Dialokasikan</option>
                <option value="3">Telah Dialokasikan</option>
                <option value="1">Dalam Pemeliharaan</option>
            </select>
            </span>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <!-- Grafik pertama -->
        <div class="box box-default mb-4">
            <div class="box-header with-border">
                <h2 class="box-title">Kelompok Aset Berdasarkan Kondisi</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="chart-responsive">
                    <canvas id="pieCondition"  style="height: 250px; width: 500px;"></canvas>
                </div> <!-- ./chart-responsive -->
            </div><!-- /.box-body -->
        </div> <!-- /.box -->

            <div class="box-body">
            
                <div class="row">
                    <div class="col-md-12">
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h2 class="box-title">Jumlah Kategori Aset Rusak Berat Tertinggi</h2>
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
                                        <canvas id="groupedNewAsset"  style="height: 300px; width: 500px;"></canvas>
                                    </div> <!-- ./chart-responsive -->
                                </div> <!-- /.col -->
                            </div> <!-- /.row -->
                        </div><!-- /.box-body -->
                    </div> <!-- /.box -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
            </div><!-- /.box-body -->
    </div>

    <div class="col-md-6">
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title">Rasio Kategori Aset Rusak Berat Tertinggi</h2>
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
                            <canvas id="barRank"  style="height: 600px; width: 500px;"></canvas>
                        </div> <!-- ./chart-responsive -->
                    </div> <!-- /.col -->
                </div> <!-- /.row -->
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
$(document).ready(function() {
    var startYearSelect = $('#start-year');
    var endYearSelect = $('#end-year');

    startYearSelect.change(function() {
        var selectedStartYear = parseInt($(this).val());
        endYearSelect.find('option').each(function() {
            var optionYear = parseInt($(this).val());
            if (optionYear < selectedStartYear) {
                $(this).attr('disabled', 'disabled');
            } else {
                $(this).removeAttr('disabled');
            }
        });

        if (parseInt(endYearSelect.val()) < selectedStartYear) {
            endYearSelect.val(selectedStartYear);
        }
    });

    endYearSelect.change(function() {
        var selectedEndYear = parseInt($(this).val());
        startYearSelect.find('option').each(function() {
            var optionYear = parseInt($(this).val());
            if (optionYear > selectedEndYear) {
                $(this).attr('disabled', 'disabled');
            } else {
                $(this).removeAttr('disabled');
            }
        });

        if (parseInt(startYearSelect.val()) > selectedEndYear) {
            startYearSelect.val(selectedEndYear);
        }
    });
});

$('#opsi-gab').select2({
        closeOnSelect: true 
    });
$('#filter-aset').change(function() {
    var selectedValue = $(this).val();
    $('#opsi-gab').empty(); 

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

function updateCharts() {
    var selectedAset = $('#filter-aset').val() || null;
    var selectedLv = $('#filter-lv').val();
    var unit = $('#filter-unitkerja').val();
    var kodeWil = $('#kode-wil').val();
    var status = $('#filter-status').val() || null;
    var selectedTahun = [];
    const startYear = parseInt($('#start-year').val());
    const endYear = parseInt($('#end-year').val());

    for (let year = startYear; year <= endYear; year++) {
        selectedTahun.push(year);
    }
    const years = selectedTahun.join(',');
    
    if (kodeWil == "prov") {
        selectedLv = 4;
        unit = $('#filter-turunan').val();
    } 

    if (selectedLv == 4 && unit == '') {
        selectedLv = 1;
    }

    if (selectedLv <= 1) {
        unit = null;
    } 

    if (unit == ""){
        unit = null;
    }
    
    var pieChartUrl = '{!! route('api.assets.notes', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years', 'status' => ':status']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit).replace(':years', years).replace(':status', status);
    var barPercentage = '{!! route('api.worst.percentage', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years', 'status' => ':status']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit).replace(':years', years).replace(':status', status);
    var latestChartUrl = '{!! route('api.latest.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years', 'status' => ':status']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit).replace(':years', years).replace(':status', status);

    initializePieChart('pieCondition', pieChartUrl);
    initializeBarChart('groupedNewAsset', latestChartUrl);
    initializeBarChart('barRank',barPercentage, percentageChart);
 }


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
            formatter: function(value, context) {
                var dataset = context.chart.data.datasets[0];
                var total = dataset.data.reduce(function(previousValue, currentValue) {
                    return previousValue + currentValue;
                });
                var percentage = Math.round((value / total) * 100) + '%';
                return value + '\n (' + percentage + ')';
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
            display: false,
        }
    }
};

var percentageChart =  {
    scales: {
        xAxes: [{
            ticks: {
                min: 0,
                max: 1,
            },  
            scaleLabel: {
                display: true,
                labelString: "Rasio"
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
    maintainAspectRatio: false,
    tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var dataset = data.datasets[tooltipItem.datasetIndex];
                    var currentValue = dataset.data[tooltipItem.index];
                    return dataset.label + ': ' + currentValue;
                    }
                }
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


    initializePieChart('pieCondition', '{!! route('api.assets.notes', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years', 'status' => ':status']) !!}'.replace(':id', 1).replace(':tingkat', 1).replace(':unit', null).replace(':years', 'all').replace(':status', null));
    initializeBarChart('barRank', '{!! route('api.worst.percentage',  ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years', 'status' => ':status']) !!}'.replace(':id', 1).replace(':tingkat', 1).replace(':unit', null).replace(':years', 'all').replace(':status', null), percentageChart);
    initializeBarChart('groupedNewAsset', '{!! route('api.latest.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years', 'status' => ':status']) !!}'.replace(':id', 1).replace(':tingkat', 1).replace(':unit', null).replace(':years', 'all').replace(':status', null));

$(document).ready(function() {
    $('#filter-aset').val('1').change();
    var companies = @json($companies);
    var bpsri = @json($bpsri);
    var bpspr = @json($bpspr);
    var bpskk = @json($bpskk);
    var thn = parseInt($('#thn').val());
    var thnri = parseInt($('#thnri').val());
    var thnpr = parseInt($('#thnpr').val());
    var thnkk = parseInt($('#thnkk').val());
    var kodeWil = $('#kode-wil').val();
    $('#filter-unitkerja, #filter-turunan, #start-year, #end-year').select2();
    var selectedLv = $('#filter-lv').val();
    var unit = $('#filter-unitkerja').val();

    function buatYearDropdowns(selectedLv, unit = null) {
        var endYear = new Date().getFullYear();
        var unit = $('#filter-unitkerja').val();
        var startYear;
        
        $('#start-year').empty();
        $('#end-year').empty();

        if (selectedLv == 1 || selectedLv == 2  || selectedLv == 3) {
            startYear = 1961;
        } else if (selectedLv == 5) {
            startYear = 1969;
        } else if (selectedLv == 4) {
            startYear = thn;

                if (kodeWil !== "kabkot") {
                    $.each(companies, function(index, item) {
                        if (item.id == unit) {
                            startYear = item.smallest_year;
                        } 
                    });
                } 
            }

        for (var year = endYear; year >= startYear; year--) {
            $('#start-year').append('<option value="' + year + '" ' + (year == startYear ? 'selected' : '') + '>' + year + '</option>');
            $('#end-year').append('<option value="' + year + '" ' + (year == endYear ? 'selected' : '') + '>' + year + '</option>');
        }
    }

    if (kodeWil != "pusat") {
        $('#unit-turunan').show();
        if (kodeWil == "prov") {
            $('#filter-turunan').append($('<option>').text('Seluruh Unit Kerja Terkait').attr('value', '')); 
            $.each(companies, function(index, item) {
                $('#filter-turunan').append($('<option>').text(item.name).attr('value', item.id));
            });
            unit = $('#filter-turunan').val();
            buatYearDropdowns(4, unit);
        }  

        if (kodeWil == "kabkot") {
            $('#unit-turunan').hide();
            buatYearDropdowns(4, unit);
        }  
    } else {
        buatYearDropdowns(selectedLv, unit);
    }

    $('#filter-aset, #start-year, #end-year, #filter-status').change(function() {
        updateCharts();
    });

    $('#filter-turunan').change(function() {
        var unit = $('#filter-turunan').val();
        buatYearDropdowns(4, unit);
        updateCharts();
    });

    $('#filter-unitkerja').change(function() {
        var unit = $('#filter-unitkerja').val();
        buatYearDropdowns(4, unit);
        updateCharts();
    });


    $('#filter-lv').change(function() {
        var selectedLv = $('#filter-lv').val();
        var unit = $('#filter-unitkerja').val();    

        if (selectedLv == 4 && unit == '') {
            selectedLv = 1;
        }   

        if (selectedLv <= 1) {
            unit = null;
        }   

        if (selectedLv == 4) {
            $('#unit-satuan').show();
            $('#filter-unitkerja').empty();
            if (kodeWil !== "kabkot") {
                if (kodeWil === "pusat") {
                    $('#filter-unitkerja').append($('<option>').text('Seluruh Satuan/Unit Kerja').attr('value', '')); 
                } else if (kodeWil === "prov") {
                    $('#filter-turunan').append($('<option>').text('Seluruh Unit Kerja Terkait').attr('value', '')); 
                    unit = $('#filter-turunan').val();
                }
                $.each(companies, function(index, item) {
                    $('#filter-turunan').append($('<option>').text(item.name).attr('value', item.id));
                    $('#filter-unitkerja').append($('<option>').text(item.name).attr('value', item.id));
                });
            } else {
                $('#unit-satuan').hide();
            }
        } else if (selectedLv == 2 || selectedLv == 3 || selectedLv == 5) {
            $('#unit-satuan').show();
            $('#filter-unitkerja').empty();
            if (selectedLv == 2 ) {
                $('#filter-unitkerja').append($('<option>').text('Seluruh Satuan Unit').attr('value', ''));
            } else {
                $('#filter-unitkerja').append($('<option>').text('Seluruh Unit Kerja').attr('value', ''));
            }
            
            var data;
            if (selectedLv == 2) {
                data = bpsri;
            } else if (selectedLv == 3) {
                data = bpspr;
            } else if (selectedLv == 5) {
                data = bpskk;
            }   

            $.each(data, function(id, name) {
                $('#filter-unitkerja').append($('<option>').text(name).attr('value', id));
            });
        } else {
            $('#unit-satuan').hide();
        }   

        buatYearDropdowns(selectedLv, unit);
        updateCharts();
    });

});

</script>

@endpush