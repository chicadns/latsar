@extends('layouts/default')

{{-- Page title --}}
@section('title')
  Pengajuan BMN End-User
@parent
@stop

{{-- Page content --}}
@section('content')

  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs hidden-print">

          <li class="active">
            <a href="#pengajuan" data-toggle="tab">
            <span class="hidden-lg hidden-md">
            <i class="fas fa-info-circle fa-2x"></i>
            </span>
              <span class="hidden-xs hidden-sm">Pengajuan</span>
            </a>
          </li>

          <li>
            <a href="#history" data-toggle="tab">
            <span class="hidden-lg hidden-md">
            <i class="fas fa-info-circle fa-2x"></i>
            </span>
              <span class="hidden-xs hidden-sm">History</span>
            </a>
          </li>
        </ul>

        {{-- Tab --}}
        <div class="tab-content">

          {{-- Tab Pengajuan --}}
          <div class="tab-pane active" id="pengajuan">
            <div class="table table-responsive">
              <div class="box-header with-border">
                <div class="box-heading">
                  <h2 class="box-title">{{ trans('general.enduser') }}</h2>
                </div>
              </div>

              <div class="box-body">

                <table
                  data-columns="{{ \App\Presenters\ApprovalPresenter::dataTableLayout() }}"
                  data-cookie="true"
                  data-cookie-id-table="approvalTable"
                  data-id-table="approvalTable"
                  data-pagination="true"
                  data-search="true"
                  data-side-pagination="client"
                  data-show-columns="true"
                  data-show-export="true"
                  data-show-footer="true"
                  data-show-refresh="true"
                  data-sort-order="asc"
                  data-sort-name="id"
                  data-toolbar="#toolbar"
                  id="approvalTable"
                  class="table table-striped snipe-table"
                  data-url="{{ route('approval.request') }}"
                  data-export-options='{
                  "fileName": "export-approval-{{ date('Y-m-d') }}",
                  "ignoreColumn": ["actions"]
                  }'>
                    {{-- <thead>
                      <tr>
                          <th data-field="name" data-sortable="true">Nama Perangkat</th>
                          <th data-field="bmn" data-sortable="true">Nomor BMN</th>
                          <th data-field="serial" data-sortable="true">Serial Number</th>
                          <!-- Add other columns as needed -->
                      </tr>
                    </thead> --}}
                </table>

              </div>
            </div>
          </div>

          {{-- Tab History --}}
          <div class="tab-pane" id="history">
            <div class="table table-responsive">
              <div class="box-header with-border">
                <div class="box-heading">
                  <h2 class="box-title">History {{ trans('general.enduser') }}</h2>
                </div>
              </div>

              <div class="box-body">
                <table
                  data-columns="{{ \App\Presenters\ApprovalHistoryPresenter::dataTableLayout() }}"
                  data-cookie="true"
                  data-cookie-id-table="historyTable"
                  data-id-table="historyTable"
                  data-pagination="true"
                  data-search="true"
                  data-side-pagination="client"
                  data-show-columns="true"
                  data-show-export="true"
                  data-show-footer="true"
                  data-show-refresh="true"
                  data-sort-order="asc"
                  data-sort-name="id"
                  data-toolbar="#toolbar"
                  id="historyTable"
                  class="table table-striped snipe-table"
                  data-url="{{ route('approval.history') }}"
                  data-export-options='{
                  "fileName": "export-approval-{{ date('Y-m-d') }}",
                  "ignoreColumn": ["actions"]
                  }'>
                </table>
              </div>
            </div>
          </div>
        </div>

        

      </div>
    </div>
  </div>
@stop

@section('moar_scripts')
  @include ('partials.bootstrap-table', ['exportFile' => 'consumables-export', 'search' => true,'showFooter' => true, 'columns' => \App\Presenters\ConsumablePresenter::dataTableLayout()])
  
  <script>

    function counterFormatter(value, row, index) {
        return index + 1; // index is zero-based, so add 1
    }

    function actionFormatter(value, row, index) {
        return `
          <form  style="display:inline;">
            <input type="hidden" name="setuju_button">
            <button title="Setuju" class="btn btn-success btn-sm" data-toggle="modal" data-target="#setuju_popup">
              <i class="fas fa-check" aria-hidden="true"></i></button>
          </form>

          <!-- Modal -->
            <div class="modal" id="setuju_popup" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title">${row.name}</h3>
                  <button type="button" class="close" style="position: absolute; right: 15px; top: 15px" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="setujuForm" method="post" action="">
                    @csrf
                    <div>
                      <p> hello </p>  
                    </div>
                    <div class="box-footer">
                      <a class="btn btn-link" class="close" data-dismiss="modal"> {{ trans('button.cancel') }}</a>
                      <form action="{{ route('approval.update-status') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('POST') <!-- Assuming a POST method for status update -->
                        <input type="hidden" name="setuju" value="${row.id}"> <!-- Pass the id of the row -->
                        <button type="submit" title="Setuju" class="btn btn-success pull-right" onclick="return confirm('Setujui Pengajuan?')">
                          <i class="fas fa-check" aria-hidden="true"></i> Setuju
                        </button>
                      </form>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </div>

          <form action="{{ route('approval.update-status') }}" method="POST" style="display:inline;">
            @csrf
            @method('POST') <!-- Assuming a POST method for status update -->
            <input type="hidden" name="tidak_setuju" value="${row.id}"> <!-- Pass the id of the row -->
            <button type="submit" title="Tidak Setuju" class="btn btn-danger btn-sm" onclick="return confirm('Tidaksetujui Pengajuan?')">
              <i class="fas fa-times" aria-hidden="true"></i>
            </button>
          </form>
        `;
    }

    function actionHistoryFormatter(value, row, index) {
        return `
          <form method="get" style="display:inline;">
            <input type="hidden" name="view_button" value="ch">
            <button type="submit" title="Lihat" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#view_popup">
              <i class="fas fa-eye" aria-hidden="true"></i></button>
          </form>

          <!-- Modal -->
            <div class="modal" id="view_popup" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h3 class="modal-title">${row.name} (${row.bmn})</h3>
                  <button type="button" class="close" style="position: absolute; right: 15px; top: 15px" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="setujuForm" method="post" action="">
                    @csrf
                    <div>
                      <div class="form-group">
                          {{ Form::label('user', 'Nama Pegawai', array('class' => 'col-md-3 control-label')) }}
                          <div class="col-md-8">
                              <p class="form-control-static">
                                  ${row.user_first_name}
                              </p>
                          </div>
                      </div>  
                    </div>
                    <div class="box-footer">
                      
                    </div>
                  </form>
                </div>
              </div>
            </div>
            </div>
        `;
    }
  </script>


@stop
