@extends('layouts/default')
{{-- Page title --}}
@section('title')
{{ trans('general.dashboard') }}
@parent
@stop


{{-- Page content --}}
@section('content')

@if ($snipeSettings->dashboard_message!='')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        {!!  Helper::parseEscapedMarkedown($snipeSettings->dashboard_message)  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="row">
  <!-- panel -->
  <!-- PERANGKAT KERAS -->
  <div class="col-lg-2 col-xs-6">
      <a href="{{ route('hardware.index') }}">
    <!-- small box -->
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

@stop

@section('moar_scripts')
{{-- @include ('partials.bootstrap-table', ['simple_view' => true, 'nopages' => true]) --}}
@stop

@push('js')

@endpush
