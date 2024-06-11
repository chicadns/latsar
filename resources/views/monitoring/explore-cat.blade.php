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

<div class="row" style="margin-bottom: 50px;">
    <div class="col-md-12"> 
        <h2><strong>Umur dan Kondisi Aset</strong></h2>
    </div>

    <div class="col-md-12"> 
        <div class="col-md-3 filterdata" style="border-radius: 5px 0px 0px 5px;"> 
            <div style=" margin-bottom: 8px;">
                <label for="asetDropdown" style="font-size: 16px; color: #ECF0F5;">Kelompok Aset:</label>
                <select class="form-control" id="filter-aset" style="width: 100%; background-color: #ECF0F5;">
                    <option value="1" selected>Aset TI</option>
                    <option value="2">Aset non-TI</option>
                </select> 
            </div> 
        </div>             

        <div class="col-md-3 filterdata"> 
            <div style=" margin-bottom: 8px;">
                <label for="groupDropdown" style="font-size: 16px; color: #ECF0F5;">Jenis:</label>
                <select class="form-control filterti" id="filter-ti" style="width: 100%; background-color: #ECF0F5;">
                    <option value="hardwareti">Peralatan dan Mesin Khusus TIK</option>
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
        </div>

        <div class="col-md-3 filterdata"> 
            <div style=" margin-bottom: 16px;">
                <label for="catDropdown" style="font-size: 16px; color: #ECF0F5;">Kategori:</label>
                <select class="btn btn-default dropdown-toggle form control katgab"  id="opsi-gab" style="width: 100%; background-color: #ECF0F5;">
                </select>
            </div>
        </div>

        <div class="col-md-3 filterdata" style="border-radius:0px 5px 5px 0px;"> 
            @if ($kodeWil != "kabkot")
            <label for="companyDropdown" style="font-size: 16px; color: #ECF0F5;">Lokasi:</label>
                <select class="btn btn-default dropdown-toggle form control filterunit" id="filter-unitkerja" style="width: 100%; background-color: #ECF0F5;">
                    @if ($kodeWil == "pusat")
                        <option value="pusat">Seluruh Satuan/Unit Kerja</option>
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
</div>

    <div class="row">
        <div class="col-md-10">

            <!-- Histogram Sebaran Usia Aset-->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h2 class="box-title" id="age-title">Sebaran Umur Aset</h2>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" aria-hidden="true">
                            <i class="fas fa-minus" aria-hidden="true"></i>
                        </button>
                    </div>
                    <select class="form-control" id="brand" name="brand" style="width: 20%; margin-left: 80%;">
                        <!-- Options will be added here -->
                    </select>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="chart-responsive">
                        <canvas id="histoAge3" style="height: 400px; width: 500px;"></canvas>
                    </div> <!-- ./chart-responsive -->
                </div><!-- /.box-body -->
            </div> <!-- /.box -->

        </div>
        <div class="col-md-2">
            <div style=" color: white;">
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <div style="padding: 5px; border-radius: 2px; ">
                        <h4 id="sctotal" style="font-size: 25px; color: #222D32;font-weight: bold;"></h4>
                        <p  id="scjudul" style="font-size: 20px; margin: 0; color: #222D32; margin-bottom: 5px;"></p>
                    </div>
                    <div style="background-color: #70AB79; padding: 10px; border-radius: 2px; border: 1px solid #000;">
                        <h4 id="scbaik" style="font-size: 23px; color: #FFFFFF; margin: 0 0 5px 0;"></h4>
                        <p style="font-size: 20px; margin: 0;">Dalam Kondisi Baik</p>
                    </div>                  

                    <div style="background-color: #FAC517; padding: 10px; border-radius: 2px; border: 1px solid #000;">
                        <h4 id="scumur" style="font-size: 23px; color: #FFFFFF; margin: 0 0 5px 0;"></h4>
                        
                        <p style="font-size: 20px; margin: 0;">Penggunaan Lebih dari 10 Tahun</p>

                    </div>                  
                    <div style="background-color: #DE425B; padding: 10px; border-radius: 2px; border: 1px solid #000;">
                        <h4 id="scrusak" style="font-size: 23px; color: #FFFFFF; margin: 0 0 5px 0;"></h4>
                        <p style="font-size: 20px; margin: 0;">Tidak Dapat Digunakan</p>
                    </div>                  
                </div>

            </div>
        </div>
    </div>
    <div>
        
        <h4 id="scumur" style="font-size: 23px; color: #FFFFFF; margin: 0 0 5px 0;"></h4>

    </div>


@stop

@section('moar_scripts')
@include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true])
@stop

@push('js')
<script> 
function updateBrandDropdown() {
    var brandDropdownId = '#brand'; 
    var categoryId = $('#opsi-gab').val(); 
    var unit =  $('#filter-unitkerja').val();

    if (categoryId) {
        $.ajax({
            url: '/merek/' + categoryId + "/" + unit,
            type: "GET",
            dataType: "json",
            success: function(data) {
                $(brandDropdownId).empty();
                $(brandDropdownId).append('<option value="all">Seluruh Aset</option>');
                $.each(data, function(key, value) {
                    $(brandDropdownId).append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            }
        });
    } else {
        $(brandDropdownId).empty();
        $(brandDropdownId).append('<option value="all">Seluruh Aset</option>');
    }
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
    
    function updateCharts() {
        var merek = $('#brand').val();
        if (merek === null) merek = 'all'; 
        var selectedItemId = $('#opsi-gab').val(); 
        var unit =  $('#filter-unitkerja').val();
        var tingkat = 1;
        if (unit != 'pusat') {
            tingkat = 2;
        }

        var category = $('#opsi-gab option:selected').text();  
        var newageTitle = 'Sebaran Umur Aset '+ category;
        $.ajax({
                url: '/masamanfaat/' + selectedItemId + '/' + tingkat + '/' + unit,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    $('#scjudul').text('Aset ' + category);
                    $('#sctotal').text(data.total + ' NUP');
                    $('#scbaik').text(data.baik);
                    $('#scumur').text(data.berumur_lebih_10_tahun);
                    $('#scrusak').text(data.rusak_berat);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + status + error);
                }
            });
        
        initializeHistoChart('histoAge3',  '{!! route('api.age.group', ['id' => ':id', 'tingkat' => ':tingkat', 'unit' => ':unit', 'merek' => ':merek']) !!}'.replace(':id', selectedItemId).replace(':tingkat', tingkat).replace(':unit', unit).replace(':merek', merek));
        $('#age-title').text(newageTitle);
    }

    
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

    
    $('#filter-aset').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue === '1') {
            $('#filter-ti').show().val('hardwareti');
            appendOptionsToOpsiGab('hardwareti');
            $('.filternonti').hide();
        } else if (selectedValue === '2') {
            $('.filterti').hide();
            $('.filternonti').show();
            $('#opsi-gab').val('hardwareti');
            appendOptionsToOpsiGab('transport');
        }
        updateBrandDropdown();
        updateCharts();
    });

    
    $('#filter-ti, #filter-nonti').change(function() {
        var selectedCategory = $(this).val();
        appendOptionsToOpsiGab(selectedCategory);
        updateBrandDropdown();
        updateCharts();
    });

    // Event handler for opsi-gab change
    $('#opsi-gab, #filter-unitkerja').change(function() {
        updateBrandDropdown();
        updateCharts();
    });

    $('#brand').change(function() {
        updateCharts();
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