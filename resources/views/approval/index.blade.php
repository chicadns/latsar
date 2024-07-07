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
            <button class="btn btn-success btn-sm" onclick="updateStatus(${row.id}, 'Sudah Disetujui')"><i class="fas fa-check" aria-hidden="true"></i></button>
            <button class="btn btn-danger btn-sm" onclick="updateStatus(${row.id}, 'Tidak Disetujui')"><i class="fas fa-times" aria-hidden="true"></i></button>
        `;
    }

    function updateStatus(id, status) {
        // Display an alert
        alert(`Status will be updated to: ${status}`);

        // Example AJAX request to update the status
        fetch('/update-status', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel
            },
            body: JSON.stringify({ id: id, status: status })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Status updated successfully.');
                // Optionally refresh the table data
                $('#historyTable').bootstrapTable('refresh');
            } else {
                alert('Failed to update status.');
            }
        })
        .catch(error => console.error('Error:', error));
    }
  </script>


@stop
