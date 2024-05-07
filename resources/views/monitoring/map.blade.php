@extends('layouts/default')
{{-- Page title --}}
@section('title')
{{ trans('Monitoring') }}
@parent
@stop
<style> 
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

<div class="col-md-6">
        @if(session('message'))
<div class="alert alert-success" role="alert">
    {{ session('message') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
        </div>
<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-9" style="height: 150px;"> 

        <h2><strong>Tingkat Pengelolaan Aset</strong></h2>
        <p style="font-size: 17px;">Bagian ini bertujuan untuk membandingkan jumlah aset yang rusak antara provinsi, di mana jumlah aset berasal dari BPS Provinsi dan BPS Kabupaten/Kota turunannya pada provinsi tersebut. Semakin tinggi jumlah aset yang rusak, semakin besar upaya yang perlu dilakukan dalam pengelolaan maupun pemeliharaan aset.</p>
    </div>

    <div class="col-md-3" style="border-radius: 5px;background-color: #222D32; padding: 15px; height: 230px;"> 
        <div style=" margin-bottom: 12px;">
        <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5;">Pilih Data</label>
        <select class="form-control" id="dropdownmap" style="width: 100%; background-color: #ECF0F5;">
            <option value="1">Persentase Aset Rusak Berat</option>
            <option value="2">Jumlah Aset Rusak Berat</option>
            <option value="3">Persentase Aset Rusak Ringan</option>
            <option value="4">Jumlah Aset Rusak Ringan</option>
        </select>
        <div style=" margin-bottom: 8px;">
        <label for="mapDropdown" style="font-size: 14px; color: #ECF0F5; margin-top:10px;">Kelompok Aset</label>
        <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
            <option value="null">Seluruh Aset</option>
            <option value="1">Aset TI</option>
            <option value="2">Aset non-TI</option>
        </select>
        </div>

        <label for="catDropdown" style="font-size: 15px; color: #ECF0F5;">Kategori Aset:</label>
        <select class="btn btn-default dropdown-toggle form control katgab" id="opsi-gab" style="width: 100%; background-color: #ECF0F5;">
        </select>  
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div id="mapcontainer"></div>
        </div>
    </div>
</div>



@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script src="https://code.highcharts.com/maps/highmaps.js"></script>
<script src="https://code.highcharts.com/maps/modules/exporting.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.0/xlsx.full.min.js"></script>

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

// Data Persentase Aset Rusak Berat 2024
const data = [
    ['id-ac', 17.85], ['id-ba', 2.67], ['id-bt', 18.71], ['id-be', 22.08], 
    ['id-yo', 9.63], ['id-jk', 20.16], ['id-go', 13.35], ['id-ja', 25.01], 
    ['id-jr', 19.73], ['id-jt', 5.41], ['id-ji', 12.28], ['id-kb', 20.31], 
    ['id-ks', 15.38], ['id-kt', 19.17], ['id-ki', 13.09], ['id-ku', 13.95], 
    ['id-bb', 12.86], ['id-kr', 15.01], ['id-1024', 17.75], ['id-ma', 26.12], 
    ['id-la', 22.72], ['id-nb', 5.41], ['id-nt', 19.33], ['id-pa', 39.18], 
    ['id-ib', 16.5], ['id-ri', 23.82], ['id-sr', 5.32], ['id-se', 11.34], 
    ['id-st', 12.31], ['id-sg', 19.63], ['id-sw', 24.51], ['id-sb', 16.13], 
    ['id-sl', 14.3], ['id-su', 18.32]
];

Highcharts.mapChart('mapcontainer', {
    chart: {
        map: topology
    },

    title: {
        text: 'Persentase Aset Rusak Berat 2024',
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
            [0.5, '#DE425B'],
            [1, '#550613'] 
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
    var newTitle = $('#dropdownmap option:selected').text() + "  (" + $('#filter-aset option:selected').text() + " " + $('#opsi-gab option:selected').text() + ")";
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
    agg.addEventListener("change", function() {
        const kelAset = $('#filter-aset').val();
        const katAset = $('#opsi-gab').val();
        var asetType, nilai;    

        if (katAset >= 1 && katAset != null) {
            asetType = 'katAset';
            nilai = katAset;
        } else {
            asetType = 'kelAset';
            nilai = kelAset;
        }
        
        fetchDataAndUpdateChart(agg.value, asetType, nilai).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
    });


    $('#filter-aset').on("change", function() {
        const aggVal = $('#dropdownmap').val();
        var asetType = 'kelAset';
        const kelAsetVal = $(this).val();
        fetchDataAndUpdateChart(aggVal, asetType, kelAsetVal).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
    });

    $('#opsi-gab').on("change", function() {
        const aggVal = $('#dropdownmap').val();
        const katAset = $(this).val();
        const kelAset = $('#filter-aset').val(); 
        var asetType, nilai; 
        
        if (katAset >= 1 && katAset !== null) {
            asetType = 'katAset';
            nilai = katAset;
        } else { 
            asetType = 'kelAset';
            nilai = kelAset;
        }
    
        fetchDataAndUpdateChart(aggVal, asetType, nilai).then(data => {
            Highcharts.charts[0].series[0].setData(data);
        });
    });
});


function updateHighmapsChart(data) {
    var series = Highcharts.charts[0].series[0];
    series.setData(data);
    series.chart.redraw();
}

</script>

@endpush
