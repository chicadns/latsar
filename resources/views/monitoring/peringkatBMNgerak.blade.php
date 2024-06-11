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
        <h2><strong>Tingkat Pendayagunaan BMN TI Bergerak</strong></h2>
    </div>

    <div class="col-md-12"> 
        <div class="col-md-3 filterdata" style="border-radius: 5px 0px 0px 5px;"> 
            <div style="margin-bottom: 8px;">
                <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5;">Pilih Kondisi Aset:</label>
                <select class="form-control" id="dropdownmap" style="width: 100%; background-color: #ECF0F5;">
                    <option value="3">Baik Digunakan</option>
                    <option value="1">Rusak Berat</option>
                </select>
            </div>
        </div> 

        <div class="col-md-3 filterdata">
            <label for="catDropdown" style="font-size: 15px; color: #ECF0F5;">Kategori Aset:</label>
            <select class="btn btn-default dropdown-toggle form-control katgab" id="opsi-gab" style="width: 100%; background-color: #ECF0F5;">
            </select>  
        </div>

        <div class="col-md-3 filterdata" style="display: none;"> 
            <div style="margin-bottom: 8px;">
                <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5;">Kelompok Aset</label>
                <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
                    <option value="1">Aset TI</option>
                </select>
            </div>
        </div>

        <div class="col-md-3 filterdata"> 
            <!-- Add content or functionality if necessary -->
        </div>

        <div class="col-md-3 filterdata" style="border-radius: 0px 5px 5px 0px;"> 
            <!-- Add content or functionality if necessary -->
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
        $('#opsi-gab').append('<option value="gerak">BMN TI Bergerak</option>');
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
        text: 'Rasio BMN TI Bergerak Baik Digunakan terhadap Jumlah Pegaawai',
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
    var newTitle = "Rasio Aset " + $('#opsi-gab option:selected').text()  + " " + selectedValue + " Terhadap Jumlah Pegawai";
    var chart = Highcharts.charts[0];
    
    
    return fetch(`{{ route('api.bmngerak.byid', ['agg' => ':agg', 'asetType' => ':asetType', 'asetValue' => ':asetValue']) }}`.replace(':agg', aggVal).replace(':asetType', asetType).replace(':asetValue', valAset), {
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
    const agg = $('#dropdownmap').val();
    const katAset = $('#opsi-gab').val();
    $('#opsi-gab').val("gerak").change();
    // fetchDataAndUpdateChart(agg, "katAset", "gerak");

    $('#dropdownmap').on("change", function() {
        const aggVal = $(this).val();
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType = 'katAset'; 
        
        fetchDataAndUpdateChart(aggVal, asetType, katAset).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
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



$(document).ready(function() {
    $('#filter-aset').val('1').change();
});


</script>

@endpush