@extends('layouts/default')

{{-- Page title --}}
@section('title')
 {{ trans('general.consumable') }} -
 {{ $consumable->name }}
@parent
@stop

@section('header_right')
<a href="{{ URL::previous() }}" class="btn btn-primary pull-right">
  {{ trans('general.back') }}</a>
@stop


{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-9">
    <div class="box box-default">
      @if ($consumable->id)
      <div class="box-header with-border">
        <div class="box-heading">
          <h2 class="box-title"> {{ $consumable->name }}</h2>
        </div>
      </div><!-- /.box-header -->
      @endif

      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <div class="table table-responsive">
              <div style="position: absolute; margin-top: 10px; display: flex;">
                <div style="margin-right: 10px;">
                  <select style="width: 150px" class="select2" name="seltype" id="seltype">
                    <option value="">Semua Jenis</option>
                    <option value="Pemasukkan">Pemasukkan</option>
                    <option value="Pengeluaran">Pengeluaran</option>
                  </select>
                </div>
                <div>
                  <select style="width: 150px" class="select2" name="selstate" id="selstate">
                    <option value="">Semua Status</option>
                    <option value="Entri Data">Entri Data</option>
                    <option value="Disubmit">Disubmit</option>
                    <option value="Disetujui" class="out">Disetujui</option>
                    <option value="Ditolak" class="out">Ditolak</option>
                    <option value="Selesai">Selesai</option>
                  </select>
                </div>
              </div>
              <table
                      data-columns="{{ \App\Presenters\ConsumableBasedOnNamePresenter::dataTableLayout() }}"
                      data-cookie-id-table="consumablesCheckedoutTable"
                      data-pagination="true"
                      data-id-table="consumablesCheckedoutTable"
                      data-search="false"
                      data-side-pagination="server"
                      data-show-columns="false"
                      data-show-export="true"
                      data-show-footer="true"
                      data-show-refresh="true"
                      data-sort-order="asc"
                      data-sort-name="id"
                      id="consumablesCheckedoutTable"
                      class="table table-striped snipe-table"
                      data-url="{{route('api.consumables.show.transaction', $consumable->id)}}"
                      data-export-options='{
                "fileName": "export-consumables-{{ str_slug($consumable->name) }}-transaction-{{ date('Y-m-d') }}",
                "ignoreColumn": ["actions","image","change"]
                }'>
              </table>
            </div>
          </div> <!-- /.col-md-12-->

        </div>
      </div>
    </div> <!-- /.box.box-default-->
  </div> <!-- /.col-md-9-->

  <div class="col-md-3">

        <div class="box box-default">
          <div class="box-body">
            <div class="row">
              <div class="col-md-12">


                @if ($consumable->image!='')
                <div class="col-md-12 text-center">
                  <a href="{{ Storage::disk('public')->url('consumables/'.e($consumable->image)) }}" data-toggle="lightbox"><br>
                      <img src="{{ Storage::disk('public')->url('consumables/'.e($consumable->image)) }}" class="img-responsive img-thumbnail" alt="{{ $consumable->name }}"></a>
                </div>
                @endif

                @if ($consumable->purchase_date)
                  <div class="col-md-12">
                    <strong>{{ trans('general.purchase_date') }}: </strong><br>
                    {{ Helper::getFormattedDateObject($consumable->purchase_date, 'date', false) }}
                  </div>
                @endif

                @if ($consumable->purchase_cost)
                  <div class="col-md-12">
                    <strong>{{ trans('general.purchase_cost') }}:</strong><br>
                    {{ $snipeSettings->default_currency }}
                    {{ Helper::formatCurrencyOutput($consumable->purchase_cost) }}
                  </div>
                @endif

                @if ($consumable->item_no)
                  <div class="col-md-12">
                    <strong>{{ trans('admin/consumables/general.item_no') }}:</strong><br>
                    {{ $consumable->item_no }}
                  </div>
                @endif

                @if ($consumable->model_number)
                  <div class="col-md-12">
                    <strong>{{ trans('general.model_no') }}:</strong><br>
                    {{ $consumable->model_number }}
                  </div>
                @endif

                @if ($consumable->manufacturer)
                  <div class="col-md-12">
                    <strong>{{ trans('general.manufacturer') }}:</strong><br>
                    <a href="{{ route('manufacturers.show', $consumable->manufacturer->id) }}">{{ $consumable->manufacturer->name }}</a>
                  </div>
                @endif

                @if ($consumable->order_number)
                  <div class="col-md-12">
                    <strong>{{ trans('general.order_number') }}:</strong><br>
                    {{ $consumable->order_number }}
                  </div>
                @endif

                @if ($consumable->company_id)
                  <div class="col-md-12">
                    <strong>{{ trans('general.company') }}:</strong><br>
                    <a href="{{ route('companies.show', $consumable->company->id) }}">{{ $consumable->company->name }}</a>
                  </div>
                @endif

    <!-- @can('checkout', \App\Models\Consumable::class)

      <div class="col-md-12">
        <br><br>
        @if ($consumable->numRemaining() > 0)
          <a href="{{ route('consumables.checkout.show', $consumable->id) }}" style="margin-bottom:10px; width:100%" class="btn btn-primary btn-sm">
            {{ trans('general.checkout') }}
          </a>
        @else
          <button style="margin-bottom:10px; width:100%" class="btn btn-primary btn-sm disabled">
            {{ trans('general.checkout') }}
          </button>
        @endif
      </div>

    @endcan -->

    @if ($consumable->notes)
       
    <div class="col-md-12">
      <strong>
        {{ trans('general.notes') }}:
      </strong>
              </div>
    <div class="col-md-12">
      {!! nl2br(Helper::parseEscapedMarkedownInline($consumable->notes)) !!}
            </div>
          </div>
  @endif

    </div>
    
  </div> <!-- /.col-md-3-->
</div> <!-- /.row-->



@can('consumables.files', \App\Models\Consumable::class)
  @include ('modals.upload-file', ['item_type' => 'consumable', 'item_id' => $consumable->id])
@endcan
@stop

@section('moar_scripts')
<script>
  var selectedOptions = {
    type: null,
    state: null
  };
  $('.select2').select2({minimumResultsForSearch: -1});
  $('.select2').change(function() {
    selectedOptions.type = $('#seltype').val();
    selectedOptions.state = $('#selstate').val();
    $('#consumablesCheckedoutTable').bootstrapTable('refresh');
  });
</script>
@include ('partials.bootstrap-table', ['exportFile' => 'consumable' . $consumable->name . '-export', 'search' => false])
@stop
