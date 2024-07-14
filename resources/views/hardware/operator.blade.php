@extends('layouts/default')

@section('title0')


@if (Request::get('status'))
  @if (Request::get('status')=='Allitems')
    {{ trans('general.all') }} {{ trans('general.assets') }}
  @elseif (Request::get('status')=='Pending')
    {{ trans('general.assets') }} - {{ trans('general.pending') }}
  @elseif (Request::get('status')=='RTD')
    {{ trans('general.assets') }} - {{ trans('general.ready_to_deploy') }}
  @elseif (Request::get('status')=='Deployed')
    {{ trans('general.assets') }} - {{ trans('general.deployed') }}
  @elseif (Request::get('status')=='Undeployable')
    {{ trans('general.assets') }} - {{ trans('general.undeployable') }}
  @elseif (Request::get('status')=='Deployable')
    {{ trans('general.assets') }} - {{ trans('general.deployed') }}
  @elseif (Request::get('status')=='Requestable')
    {{ trans('general.assets') }} - {{ trans('admin/hardware/general.requestable') }}
  @elseif (Request::get('status')=='Archived')
    {{ trans('general.assets') }} - {{ trans('general.archived') }}
  @elseif (Request::get('status')=='Deleted')
    {{ trans('general.assets') }} - {{ trans('general.deleted') }}
  @elseif (Request::get('status')=='Allstuff')
    {{ trans('general.all') }} {{ trans('general.accessories') }}
  @elseif (Request::get('status')=='Allocated')
    {{ trans('general.accessories') }} - {{ trans('general.allocated') }}
  @elseif (Request::get('status')=='Available')
    {{ trans('general.accessories') }} - {{ trans('general.available') }}
  @elseif (Request::get('status')=='Unavailable')
    {{ trans('general.accessories') }} - Tidak Teralokasikan
  @elseif (Request::get('status')=='Repair')
    {{ trans('general.accessories') }} - {{ trans('general.repair') }}
  @elseif (Request::get('status')=='AssetTI1')
    {{ trans('general.assets') }} - {{ trans('general.assetti1') }}
  @elseif (Request::get('status')=='AssetTI2')
    {{ trans('general.assets') }} - {{ trans('general.assetti2') }}
  @elseif (Request::get('status')=='AssetNonTI1')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti1') }}
  @elseif (Request::get('status')=='AssetNonTI2')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti2') }}
  @elseif (Request::get('status')=='AssetNonTI3')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti3') }}
  @elseif (Request::get('status')=='AssetNonTI4')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti4') }}
  @elseif (Request::get('status')=='AssetNonTI5')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti5') }}
  @elseif (Request::get('status')=='AssetNonTI6')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti6') }}
  @elseif (Request::get('status')=='AssetNonTI7')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti7') }}
  @elseif (Request::get('status')=='AssetNonTI8')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti8') }}
  @elseif (Request::get('status')=='AssetNonTI9')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti9') }}
  @elseif (Request::get('status')=='AssetNonTI10')
    {{ trans('general.accessories') }} - {{ trans('general.assetnonti10') }}
  @endif
@endif

@if ((Request::get('company_id')) && ($company))
  {{ $company->name }}
@endif

  @if (Request::has('order_number'))
    : Order #{{ Request::get('order_number') }}
    : Nomor BAST #{{ Request::get('order_number') }}  
  @endif
@stop

{{-- Page title --}}
@section('title')
@yield('title0')  @parent
@stop

@section('header_right')
  <a href="{{ route('reports/custom') }}" style="margin-right: 5px;" class="btn btn-default">
    {{ trans('admin/hardware/general.custom_export') }}</a>
  @can('create', \App\Models\Asset::class)
    <a href="{{ route('hardware.create', ['status' => Request::get('status')]) }}" accesskey="n" class="btn btn-primary pull-right"></i> {{ trans('general.create') }}</a>
  @endcan

@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-body">
       
          <div class="row">
            <div class="col-md-12">

                @include('partials.asset-bulk-actions', ['status' => Request::get('status')])
                   
              <table
                data-advanced-search="true"
                data-click-to-select="true"
                data-columns="{{ \App\Presenters\AssetOperatorPresenter::dataTableLayout() }}"
                data-cookie-id-table="assetsListingTable"
                data-pagination="true"
                data-id-table="assetsListingTable"
                data-search="true"
                data-side-pagination="server"
                data-show-columns="true"
                data-show-export="true"
                data-show-footer="true"
                data-show-refresh="true"
                data-sort-order="asc"
                data-sort-name="name"
                data-show-fullscreen="true"
                data-toolbar="#assetsBulkEditToolbar"
                data-bulk-button-id="#bulkAssetEditButton"
                data-bulk-form-id="#assetsBulkForm"
                id="assetsListingTable"
                class="table table-striped snipe-table"
                data-url="{{ route('api.assets.index',
                    array('status' => e(Request::get('status')),
                    'order_number'=>e(Request::get('order_number')),
                    'company_id'=>e(Request::get('company_id')),
                    'status_id'=>e(Request::get('status_id')))) }}"
                data-export-options='{
                "fileName": "export{{ (Request::has('status')) ? '-'.str_slug(Request::get('status')) : '' }}-assets-{{ date('Y-m-d') }}",
                "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                }'>
              </table>

            </div><!-- /.col -->
          </div><!-- /.row -->
        
      </div><!-- ./box-body -->
    </div><!-- /.box -->
  </div>
</div>
@stop

@section('moar_scripts')
@include('partials.bootstrap-table')

@stop