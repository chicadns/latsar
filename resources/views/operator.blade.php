@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('general.dashboard') }}
@parent
@stop

{{-- Page content --}}
@section('content')

@if ($snipeSettings->dashboard_message != '')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        {!! Helper::parseEscapedMarkedown($snipeSettings->dashboard_message) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
  <!-- PERANGKAT KERAS -->
  <div class="col-lg-2 col-xs-6">
      <a href="{{ route('hardware.index') }}">
        <div class="small-box bg-teal">
          <div class="inner">
            <h3>{{ number_format(\App\Models\Asset::AssetsForShow()->count()) }}</h3>
            <p>{{ strtolower(trans('general.assets')) }}</p>
          </div>
          <div class="icon" aria-hidden="true">
            <i class="fas fa-barcode" aria-hidden="true"></i>
          </div>
          @can('index', \App\Models\Asset::class)
            <a href="{{ route('hardware.index') }}" class="small-box-footer">{{ trans('general.view_all') }} <i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
          @endcan
        </div>
      </a>
  </div><!-- ./col -->
</div>

<div class="row">
    <div class="col-md-3 mb-4" style="background: white; padding: 5px; margin-left:17px;">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title mb-0"><b>Persentase Jumlah Pegawai yang <br/> Sudah Menguasai Perangkat IT</b></h5>
            </div>
            <hr/>
            <div class="card-body text-center" style="padding-bottom: 8px;">
                <canvas id="allocatedUsersChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-4" style="background: white; padding: 5px; margin-left:17px;">
        <div class="card">
            <div class="card-header text-center">
                <h5 class="card-title mb-0"><b>Persentase Jumlah Perangkat IT yang <br/> Belum Dialokasikan ke Pegawai</h5>
            </div>
            <hr/>
            <div class="card-body text-center" style="padding-bottom: 8px;">
                <canvas id="itemsNotAllocatedChart"></canvas>
            </div>
        </div>
    </div>
</div>

@stop

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ctxAllocatedUsers = document.getElementById('allocatedUsersChart').getContext('2d');
        const ctxItems = document.getElementById('itemsNotAllocatedChart').getContext('2d');

        const allocatedUsersCount = @json($allocatedUsersCount);
        const notAllocatedUsersCount = @json($notAllocatedUsersCount);

        const allocatedUsersData = {
            labels: ['Allocated', 'Not Allocated'],
            datasets: [{
                data: [allocatedUsersCount, notAllocatedUsersCount],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        new Chart(ctxAllocatedUsers, {
            type: 'pie',
            data: allocatedUsersData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                }
            }
        });

        const totalAssets = @json($totalAssets);
        const allocatedAssets = @json($allocatedAssets);
        const notAllocatedAssets = @json($notAllocatedAssets);

        const itemsNotAllocatedData = {
            labels: ['Allocated', 'Not Allocated'],
            datasets: [{
                data: [allocatedAssets, notAllocatedAssets],
                backgroundColor: [
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        };

        new Chart(ctxItems, {
            type: 'pie',
            data: itemsNotAllocatedData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                }
            }
        });
    });
</script>
@endpush
