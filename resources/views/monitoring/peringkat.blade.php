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

    #mapcontainer {
        width: 100%;
        height: 100vh; 
        margin: 0; 
        padding: 0; 
    }

    .highcharts-data-labels {
        font-size: '30px';
    }

    .highcharts-contextmenu li {
        font-size: 16px !important; 
    }

</style>

{{-- Page content --}}
@section('content')

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-12"> 
        <h2><strong>Tingkat Pendayagunaan BMN Lainnya</strong></h2>
    </div>

    <div class="col-md-12"> 
        <div class="col-md-3 filterdata" style="border-radius: 5px 0px 0px 5px;"> 
            <div style=" margin-bottom: 8px;">
            <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5;">Pilih Kondisi Aset:</label>
            <select class="form-control" id="dropdownmap" style="width: 100%; background-color: #ECF0F5;">
                <option value="3">Baik Digunakan</option>
                <option value="1">Rusak Berat</option>
            </select>
            </div>
        </div> 

        <div class="col-md-3 filterdata"> 
            <div style=" margin-bottom: 8px;">
            <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5;">Kelompok Aset</label>
            <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
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
        <div class="col-md-3 filterdata" style="border-radius:0px 5px 5px 0px;"> 
        </div>
    </div>
</div>

<div class="container" style="margin-bottom: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div id="mapcontainer"></div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        
        <!-- Grouped Bar Chart Peringkat Penggunaan Aset Rusak Berat -->
        <div class="box box-default">
            <div class="box-header with-border">
                <h2 class="box-title" id="prov-title">Provinsi dengan Jumlah Aset Rusak Berat Tertinggi</h2>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                        <i class="fas fa-minus" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
            
            <label for="provDropdown" style="font-size: 15px; color: #222D32;width: 20%; margin-left: 75%; font-weight:normal;">Lokasi:</label>
            <select class="form-control prov" id="opsi-prov" style="width: 20%; margin-left: 75%;"">
            </select>  
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="chart-responsive">
                            <canvas id="barGroupRusak2" style="height: 400px; width: 500px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->


@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>

<script>
    $.ajax({
    url: '/propinsi/',
    type: "GET",
    dataType: "json",
    success: function(data) {
        $('#opsi-prov').empty();
        $('#opsi-prov').append('<option value="ri">BPS RI</option>');
        $.each(data, function(key, value) {
            $('#opsi-prov').append('<option value="'+ value.id +'">'+ value.name +'</option>');
        });
    }
});

function updateUnitDropdown() {
    var unitbagian = '#unitbagian'; 
    var prov = $('#opsi-prov').val(); 

    if(prov != "all" && prov != null){
        $('#unitbagian').show();
    }

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
                $(unitbagian).append('<option value="all">--</option>');
                $.each(data, function(key, value) {
                    $(unitbagian).append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            }
        });
    } else {
        $(unitbagian).empty();
        $(unitbagian).append('<option value="all">--</option>');
    }
}


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


(async () => {

const topology = await fetch(
    'https://code.highcharts.com/mapdata/countries/id/id-all.topo.json'
).then(response => response.json());

const regionNames = {
    'id-ac' : 'Provinsi Aceh',
    'id-ba' : 'Provinsi Bali',
    'id-bt' : 'Provinsi Banten',
    'id-be' : 'Provinsi Bengkulu',
    'id-yo' : 'Provinsi Yogyakarta',
    'id-jk' : 'Provinsi DKI Jakarta',
    'id-go' : 'Provinsi Gorontalo',
    'id-ja' : 'Provinsi Jambi',
    'id-jr' : 'Provinsi Jawa Barat',
    'id-jt' : 'Provinsi Jawa Tengah',
    'id-ji' : 'Provinsi Jawa Timur',
    'id-kb' : 'Provinsi Kalimantan Barat',
    'id-ks' : 'Provinsi Kalimantan Selatan',
    'id-kt' : 'Provinsi Kalimantan Tengah',
    'id-ki' : 'Provinsi Kalimantan Timur',
    'id-ku' : 'Provinsi Kalimantan Utara',
    'id-bb' : 'Provinsi Bangka-Belitung',
    'id-kr' : 'Provinsi Kepulauan Riau',
    'id-1024' : 'Provinsi Lampung',
    'id-ma' : 'Provinsi Maluku',
    'id-la' : 'Provinsi Maluku Utara',
    'id-nb' : 'Provinsi Nusa Tenggara Barat',
    'id-nt' : 'Provinsi Nusa Tenggara Timur',
    'id-pa' : 'Provinsi Papua',
    'id-ib' : 'Provinsi Papua Barat', 
    'id-ri' : 'Provinsi Riau',
    'id-sr' : 'Provinsi Sulawesi Barat',
    'id-se' : 'Provinsi Sulawesi Selatan',
    'id-st' : 'Provinsi Sulawesi Tengah',
    'id-sg' : 'Provinsi Sulawesi Tenggara',
    'id-sw' : 'Provinsi Sulawesi Utara',
    'id-sb' : 'Provinsi Sumatera Barat',
    'id-sl' : 'Provinsi Sumatera Selatan',
    'id-su' : 'Provinsi Sumatera Utara',
};

const data = [];

Highcharts.mapChart('mapcontainer', {
    chart: {
        map: topology
    },

    title: {
        text: 'Rasio Aset Rusak Berat',
        style: {
            fontSize: '18px',
        }
    },

    mapNavigation: {
        enabled: true,
        buttonOptions: {
            verticalAlign: 'bottom',
        }
    },

    colorAxis: {
        min: 0,
        stops: [
            [0, '#EFEFFF'], 
            [0.5, '#EF845F'],
            [1, '#4C2213'] 
        ]
    },

    series: [{
        data: data,
        name: 'Random data',
        states: {
            hover: {
                color: '#BADA55'
            }
        },
        dataLabels: {
                enabled: true,
                format: '{point.name}',
                style: {
                    fontFamily: 'Arial, sans-serif', 
                    fontSize: '14px', 
                    fontWeight: 'normal' 
                }
        }
    }],
    
    tooltip: {
        formatter: function() {
            const regionName = regionNames[this.point['hc-key']] || 'Unknown';
            return '<span style="color:' + this.point.color + '; font-size: 16px;">■ </span>'+ '<span style="font-size: 16px;"> <b>' + regionName + '</b>: <b>' + this.point.value + '</b></span>';
        }
    },
    
    exporting: {
        enabled: true,
        buttons: {
            contextButton: {
                menuItems: [{
                    text: 'Export to PNG',
                    onclick: function () {
                        this.exportChart({ type: 'image/png' });
                    }
                }, {
                    text: 'Export to JPEG',
                    onclick: function () {
                        this.exportChart({ type: 'image/jpeg' });
                    }
                }, {
                    text: 'Export to CSV',
                    onclick: function () {
                        exportDataToCSV(data, regionNames);
                    }
                }, {
                    text: 'Export to Excel',
                    onclick: function () {
                        exportDataToExcel(data, regionNames);
                    }
                }]
            }
        }
    }
});

})();

function exportDataToCSV(data, regionNames) {
    var csvContent = "data:text/csv;charset=utf-8,";

    csvContent += "Provinsi,Tingkat Kerusakan Aset\r\n";

    data.forEach(function(item) {
        const hcKey = item[0];
        const regionName = regionNames[hcKey] || 'Unknown';
        const value = item[1];
        csvContent += '"' + regionName + '",' + value + "\r\n";
    });

    var encodedUri = encodeURI(csvContent);
    var link = document.createElement("a");
    link.setAttribute("href", encodedUri);
    link.setAttribute("download", "region_data.csv");
    document.body.appendChild(link);
    link.click();
}

function exportDataToExcel(data, regionNames) {
    var workbook = XLSX.utils.book_new();
    
    var worksheet = XLSX.utils.aoa_to_sheet([['Region Name', 'Tingkat Kerusakan Aset']]);
    data.forEach(function(item) {
        const hcKey = item[0];
        const regionName = regionNames[hcKey] || 'Unknown';
        const value = item[1];
        XLSX.utils.sheet_add_aoa(worksheet, [[regionName, value]], {origin: -1});
    });

    XLSX.utils.book_append_sheet(workbook, worksheet, 'Data');

    XLSX.writeFile(workbook, 'data.xlsx');
}

function fetchDataAndUpdateChart(aggVal, asetType, valAset) {
    var selectedValue = $('#dropdownmap option:selected').text();
    var newTitle = "Rasio Aset " + selectedValue + "  ( " + $('#opsi-gab option:selected').text() + ")";
    var chart = Highcharts.charts[0];
    
    return fetch(`{{ route('api.mapnasional.byid', ['agg' => ':agg', 'asetType' => ':asetType', 'asetValue' => ':asetValue']) }}`.replace(':agg', aggVal).replace(':asetType', asetType).replace(':asetValue', valAset), {
        method: 'GET',
        headers: {
            "X-Requested-With": 'XMLHttpRequest',
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        chart.setTitle({ text: newTitle });
        const formattedData = data.rows.map(row => [row.id_area, row.value]);
        console.log(formattedData);
        updateHighmapsChart(formattedData);
        return formattedData; 
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

document.addEventListener("DOMContentLoaded", function() {
    const agg = document.getElementById("dropdownmap");
    const katAset = $('#opsi-gab').val();
    fetchDataAndUpdateChart(agg, "katAset", katAset);
    agg.addEventListener("change", function() {
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType = 'katAset'; 
        
        fetchDataAndUpdateChart(agg.value, asetType, katAset).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
    });

    $('#dropdownmap, #filter-aset, #opsi-gab, #opsi-prov').change(function() {
        var selectedValue = $('#dropdownmap option:selected').text();
        var kategori = $('#opsi-gab option:selected').text();  
        var golongan = $('#filter-aset option:selected').text();  
        var wil = $('#opsi-prov option:selected').text();

        if (golongan !== 'Seluruh Aset') {
            kategori = " (" + golongan + ' ' + kategori + ") ";
        } else {
            kategori = " " + kategori;
        }

        if (wil == "" || wil == null){
            wil = "BPS RI";
        }       

        var newprovTitle = 'Jumlah Aset '+ kategori + ' Menurut Kondisi pada ' + wil ;
        var newkabkotTitle = 'Jumlah Aset '+ kategori + ' Menurut Kondisi pada ' + wil ;

        $('#prov-title').text(newprovTitle);
        $('#kabkot-title').text(newkabkotTitle);
    });

    $('#filter-aset').on("change", function() {
        const aggVal = $('#dropdownmap').val();
        var asetType = 'katAset';
        var katAset = $('#opsi-gab').val();;
        if (katAset == null){
            if (kelAset == 1) {
                katAset = 1;
            }

            if (kelAset == 2) {
                katAset = 118;
            }
        }

        fetchDataAndUpdateChart(aggVal, asetType, katAset).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
    });

    $('#opsi-gab').on("change", function() {
        const aggVal = $('#dropdownmap').val();
        const katAset = $(this).val();
        const kelAset = $('#filter-aset').val(); 
        var asetType = 'katAset';
        
    
        fetchDataAndUpdateChart(aggVal, asetType, katAset).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
    });
});


function updateHighmapsChart(data) {
    var series = Highcharts.charts[0].series[0];
    var selectedValue = $('#dropdownmap option:selected').text();
    series.setData(data);
    series.chart.redraw();

    var colorStops;
    if (selectedValue === 'Rusak Berat') {
        colorStops = [
            [0, '#EFEFFF'], 
            [0.5, '#DE425B'],
            [1, '#550613'] 
        ];
    } else if (selectedValue === 'Baik Digunakan') {
        colorStops = [
            [0, '#EFEFFF'], 
            [0.5, '#70AB79'],
            [1, '#07290C'] 
        ];
      }
    Highcharts.charts[0].update({
        colorAxis: {
            stops: colorStops
        }
    });

}

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
                        labelString: "Provinsi"
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

    initializeBarChart('barGroupRusak2', '{!! route('api.rank.byprov', ['id' => ':id','asetType' => ':asetType', 'asetValue' => ':asetValue', 'tingkat' => ':tingkat']) !!}'
            .replace(':id', null)
            .replace(':asetType', "katAset")
            .replace(':asetValue', 1)
            .replace(':tingkat', 3), optionBarGroupedChart);

$(document).ready(function() {
    $('#filter-aset').val('1').change();
    $('#opsi-gab').val('1').change();
    updateChartsProv();

    function updateChartsProv() {
        var selectedNotes = $('#dropdownmap').val();
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType = 'katAset';
        var tingkatan;
        var prov = $('#opsi-prov').val();

        if (katAset == null){
            if (kelAset == 1) {
                katAset = 1;
            }

            if (kelAset == 2) {
                katAset = 118;
            }
        }

        if (prov == "ri" ) {
            tingkatan = 3;
        } else {
            tingkatan = null;
        }

        var ChartUrl = '{!! route('api.rank.byprov', ['id' => ':id','asetType' => ':asetType', 'asetValue' => ':asetValue', 'tingkat' => ':tingkat']) !!}'
            .replace(':id', prov)
            .replace(':asetType', asetType)
            .replace(':asetValue', katAset)
            .replace(':tingkat', tingkatan);

        initializeBarChart('barGroupRusak2', ChartUrl, optionBarGroupedChart);
    }

    $('#dropdownmap, #filter-aset, #tingkatan, #opsi-gab, #opsi-prov').change(function() {
        updateUnitDropdown();
        updateChartsProv();
    });


});


</script>

@endpush