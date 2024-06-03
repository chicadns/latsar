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
        <h2><strong>Nilai Perolehan Pertama</strong></h2>
    </div>

    <div class="col-md-12"> 
        <div class="col-md-3 filterdata" style="border-radius: 5px 0px 0px 5px;"> 
            <div style="margin-bottom: 8px;">
                <label for="hardwareDropdown" style="font-size: 16px; color: #ECF0F5;">Kelompok Aset:</label>
                <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
                    <option class="dropdown-item" value="">Gabungan</option>
                    <option class="dropdown-item" value="1">Aset TI</option>
                    <option class="dropdown-item" value="2">Aset non-TI</option>
                </select>
            </div> 
        </div>

        <div class="col-md-3 filterdata"> 
            @if ($kodeWil == "pusat")
                <div style="margin-bottom: 8px;">
                    <label for="groupDropdown" style="font-size: 16px; color: #ECF0F5;">Level:</label>
                    <select class="form-control level" id="filter-lv" style="width: 100%; background-color: #ECF0F5;">
                        <option value="1">Nasional</option>
                        <option value="2">BPS Provinsi</option>
                        <option value="3">BPS Kabupaten/Kota</option>
                        <option value="4">Satuan Unit Kerja</option>
                    </select>  
                </div>
        </div> 

        <div class="col-md-3 filterdata"> 
            <div id="unit-satuan" style="display:none;">
                <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Unit Kerja:</label>
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
                <label for="thnDropdown" style="font-size: 16px; color: #ECF0F5;">Rentang Tahun Pembelian:</label>
                <input type="hidden" id="thn" value="{{ $years }}">
                <div class="row" style="display:flex; width:100%;">
                    <select id="start-year" class="form-control year-select filtertahun">
                    </select>
                    <select id="end-year" class="form-control year-select filtertahun">
                    </select>
                </div>
        </div>
        
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Line Chart Perolehan Pertama Aset -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Total Nilai Perolehan Pertama Aset dari Tahun ke Tahun</h2>
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
        </div>
    </div>
</div>

@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
   
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

function updateCharts() {
    var selectedAset = $('#filter-aset').val() || null;
    var selectedLv = $('#filter-lv').val();
    var unit = $('#filter-unitkerja').val();
    var kodeWil = $('#kode-wil').val();
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

    if (selectedLv <= 3) {
        unit = null;
    } 

    console.log("unit" + unit);
    console.log("lv" + selectedLv);

    
    var lineChart = '{!! route('api.first.value', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years']) !!}'.replace(':id', selectedAset).replace(':tingkat', selectedLv).replace(':unit', unit).replace(':years', years);
    initializeLineChart('lineCap', lineChart);
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

initializeLineChart('lineCap', '{!! route('api.first.value', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years']) !!}'.replace(':id', null).replace(':tingkat', 1).replace(':unit', null).replace(':years', 'all'));

$(document).ready(function() {
    var companies = @json($companies);
    var thn = parseInt($('#thn').val());
    var kodeWil = $('#kode-wil').val();
    $('#filter-unitkerja, #filter-turunan, #start-year, #end-year').select2();
    var selectedLv = $('#filter-lv').val();
    var unit = $('#filter-unitkerja').val();

    function buatYearDropdowns(selectedLv, unit = null) {
        var endYear = new Date().getFullYear();
        var startYear;
        
        $('#start-year').empty();
        $('#end-year').empty();

        if (selectedLv == 1 || selectedLv == 2) {
            startYear = 1961;
        } else if (selectedLv == 3) {
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

    $('#filter-aset, #start-year, #end-year').change(function() {
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

        if (selectedLv <= 3) {
            unit = null;
        } 

        if (selectedLv == 4) {
            $('#unit-satuan').show();
            $('#filter-unitkerja').empty();
            if (kodeWil !== "kabkot") {
                if (kodeWil === "pusat") {
                    $('#filter-unitkerja').append($('<option>').text('Seluruh Unit Kerja').attr('value', '')); 
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
        } else {
            $('#unit-satuan').hide();
        }

        buatYearDropdowns(selectedLv, unit);
        updateCharts();
    });
});



</script>

@endpush