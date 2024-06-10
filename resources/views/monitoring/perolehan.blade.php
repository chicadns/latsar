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
                        <option value="5">BPS RI</option>   
                        <option value="2">BPS Provinsi</option>
                        <option value="3">BPS Kabupaten/Kota</option>
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
                <label for="thnDropdown" style="font-size: 16px; color: #ECF0F5;">Tahun Pembelian:</label>
                <input type="hidden" id="thn" value="{{ $years }}">
                <div class="row" style="display:flex; width:100%;">
                    <select id="end-year" class="form-control year-select filtertahun" style="width: 125px;" >
                    </select>
                </div>
        </div>
        
    </div>
</div>

    <div class="row justify-content-center">
        <div class="col-md-3">
            <div style=" color: white; text-align: center;">
                <div style="margin-bottom: 20px; background-color: #70AB79; padding: 5px; border-radius: 2px; ">
                    <h4 style="font-size: 20px; color: #FFFFFF;"><strong>Jumlah</strong></h4>
                    <p id="totalNilai" style="font-size: 25px; margin: 0; font-weight: bold;"></p>
                </div>
                <div  style="margin-bottom: 20px; background-color: #70AB79; padding: 5px; border-radius: 2px; ">
                    <h4 style="font-size: 20px; color: #FFFFFF; "><strong>Perubahan</strong></h4>
                    <p id="persen" style="font-size: 25px; margin: 0;font-weight: bold;"></p>
                </div>
                <div  style="margin-bottom: 20px; background-color: #70AB79; padding: 5px; border-radius: 2px; ">
                    <h4 style="font-size: 20px; color: #FFFFFF; "><strong>Aset Baru</strong></h4>
                    <p id="nup" style="font-size: 25px; margin: 0;font-weight: bold;"></p>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Total Nilai Perolehan Pertama Aset Tertinggi Menurut Kategori</h2>
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
                                <canvas id="barKatDana" style="height: 300px; width: 500px;"></canvas>
                            </div> <!-- ./chart-responsive -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
                </div><!-- /.box-body -->
            </div> <!-- /.box -->
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title">Total Nilai Perolehan Pertama Aset Tertinggi Menurut Satuan Unit</h2>
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
                                <canvas id="barUnitDana" style="height: 300px; width: 500px;"></canvas>
                            </div> <!-- ./chart-responsive -->
                        </div> <!-- /.col -->
                    </div> <!-- /.row -->
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
                            data-url="{{ route('api.yearly.summ', ['id' => 'id', 'tingkat' => ':tingkat', 'unit' => ':unit','years' => ':years']) }}">
                            <thead class="bg-primary text-white"  style="background-color:#70AB79;">
                                <tr>
                                    <th class="col-sm-4" data-visible="true" data-field="unit">
                                        Unit Kerja
                                    </th>
                                    <th class="col-sm-4" data-visible="true" data-field="new">
                                        Aset Baru
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
    tooltips: {
            callbacks: {
                label: function(tooltipItem, chart) {
                    var dataset = chart.datasets[tooltipItem.datasetIndex];
                    var index = tooltipItem.index;
                    var percentKat = dataset.data[index];
                    var assetCount = dataset.assetCounts[index];
                    return dataset.label + ': Rp' + percentKat + ' Miliar' + ' ( ' + assetCount + ' NUP )';
                }
            }
        },
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
                labelString: "Nilai (dalam Miliar Rupiah)", 
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

var optionBarChart1 = {
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
    label: function(tooltipItem, chart) {
        var dataset = chart.datasets[tooltipItem.datasetIndex];
        var index = tooltipItem.index;
        var percentKat = dataset.data[index];
        var assetDetails = dataset.assetDetails[index];
        
        // Inisialisasi teks untuk detail
        var detailsText = '';

        // Loop melalui setiap detail aset dan tambahkan ke teks detail
        assetDetails.forEach(function(detail) {
            detailsText += detail.category_name + ': ' + detail.asset_count + ' items\n';
        });

        // Mengembalikan teks label dengan informasi detail aset
        return dataset.label + ': Rp' + percentKat + ' Miliar\n' + detailsText;
    }
}

    },
    scales: {
        yAxes: [{
            scaleLabel: {
                display: true,
                labelString: "",
            },
        }],
        xAxes: [{
            scaleLabel: {
                display: true,
                labelString: "Nilai (dalam Miliar Rupiah)", 
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

            if (data.labels.length === 0 || data.datasets[0].data.length === 0) {
                // Jika tidak ada data, tampilkan pesan "No Data Found"
                var ctx = document.getElementById(chartId).getContext('2d');
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height); 
                ctx.font = '15px Poppins';
                ctx.textAlign = 'center';
                ctx.fillText('Data Tidak Ditemukan', ctx.canvas.width/2, ctx.canvas.height / 2);
            } else {

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



$(document).ready(function() {
    var companies = @json($companies);
    var kodeWil = $('#kode-wil').val();
    var selectedLv = $('#filter-lv').val();
    var selectedAset = $('#filter-aset').val() || null;
    var unit = null;
    var thn = parseInt($('#thn').val());
    
    // Event listeners
    $('#filter-aset, #start-year, #end-year, #filter-turunan, #filter-unitkerja, #filter-lv').change(updateCharts);
    
    updateCharts(thn);

    function updateCharts(thn = null) {
        var selectedAset = $('#filter-aset').val() || null;
        var selectedLv = $('#filter-lv').val();
        var kodeWil = $('#kode-wil').val();
        var status = $('#filter-status').val() || null;
        let years = parseInt($('#end-year').val());

        if (isNaN(years)) {
            years = thn;
        }

        loadReport(selectedAset, selectedLv, unit, years);
        updateTableUrl(selectedAset, selectedLv, unit, years);

        var barkatChart = '{!! route('api.highest.cat', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years']) !!}'
            .replace(':id', selectedAset)
            .replace(':tingkat', selectedLv)
            .replace(':unit', unit)
            .replace(':years', years);
        initializeBarChart('barKatDana', barkatChart, optionBarChart);
        
        var barunitChart = '{!! route('api.highest.unit', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'years' => ':years']) !!}'
            .replace(':id', selectedAset)
            .replace(':tingkat', selectedLv)
            .replace(':unit', unit)
            .replace(':years', years);
        initializeBarChart('barUnitDana', barunitChart, optionBarChart1);
    }

    function loadReport(selectedAset, selectedLv, unit, years) {
    $.ajax({
        url: '/tahunan_nilai/' + selectedAset + '/' + selectedLv + '/' + unit + '/' + years,
        type: 'GET',
        success: function(data) {
            console.log(data);
            $('#totalNilai').text(data.total + " Miliar ");

            // Display percentage with icons
            if (data.perBefore >= 0) {
                $('#persen').html('<i class="fas fa-arrow-up" style="color: white;"></i> ' + data.perBefore + " %");
            } else {
                $('#persen').html('<i class="fas fa-arrow-down" style="color: white;"></i> ' + (data.perBefore*(-1)) + " %");
            }

            $('#nup').text(data.asetBaru + " NUP");
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error: ' + status + error);
        }
    });
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

    function updateTableUrl(selectedAset, selectedLv, unit, years) {
        initializeTable('dashLocationSummary', { id: selectedAset, tingkat: selectedLv, unit: unit, years: years });
    }

    function buatYearDropdowns(selectedLv, unit = null) {
        var endYear = new Date().getFullYear();
        // $('#end-year').empty();

        for (var year = endYear; year >= 2000; year--) {
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
        }  
        if (kodeWil == "kabkot") {
            $('#unit-turunan').hide();
        }  
    } else {
        buatYearDropdowns(selectedLv, unit);
    }
});




</script>

@endpush