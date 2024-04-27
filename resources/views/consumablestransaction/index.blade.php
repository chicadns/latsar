@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{'Transaksi Barang'}}
@parent
@stop

@section('header_right')
  @can('create', \App\Models\ConsumableTransaction::class)
    @if (!Auth::user()->isSuperUser() && json_decode(Auth::user()['groups'], true)[0]['name'] == 'Pengguna') @else
      <form method="get" action="{{ route('consumablestransaction.create') }}" style="display: inline-block;">
        <input type="hidden" name="transaction_type" value="pemasukkan">
        <button type="submit" class="btn btn-primary">Buat Pemasukkan</button>
      </form>
    @endif

    <form method="get" action="{{ route('consumablestransaction.create') }}" style="display: inline-block;">
      <input type="hidden" name="transaction_type" value="pengeluaran">
      <button type="submit" class="btn btn-primary">Buat Pengeluaran</button>
    </form>
  @endcan
@stop

{{-- Page content --}}
@section('content')

<div class="row">
  <div class="col-md-12">
    <div class="box box-default">
      <div class="box-body">
          <div class="table table-responsive">
            <table
                  data-columns="{{ \App\Presenters\ConsumableTransactionPresenter::dataTableLayout() }}"
                  data-cookie-id-table="consumablesTransactionTable"
                  data-pagination="true"
                  data-id-table="consumablesTransactionTable"
                  data-search="true"
                  data-side-pagination="server"
                  data-show-columns="true"
                  data-show-export="false"
                  data-show-refresh="true"
                  data-sort-order="asc"
                  data-sort-name="id"
                  data-toolbar="#toolbar"
                  id="consumablesTransactionTable"
                  class="table table-striped snipe-table"
                  data-url="{{ route('api.consumablestransaction.index') }}"
                  data-export-options='{
                  "fileName": "export-consumablestransaction-{{ date('Y-m-d') }}",
                  "ignoreColumn": ["actions"]
                  }'>
            </table>
          </div>
      </div><!-- /.box-body -->
    </div><!-- /.box -->

  </div> <!-- /.col-md-12 -->
</div> <!-- /.row -->
@stop

@section('moar_scripts')
<!-- @include ('partials.bootstrap-table', ['exportFile' => 'consumables-export', 'search' => true,'showFooter' => true, 'columns' => \App\Presenters\ConsumablePresenter::dataTableLayout()]) -->
@include ('partials.bootstrap-table')
@stop
