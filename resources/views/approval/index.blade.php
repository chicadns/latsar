@extends('layouts/default')

@php
if ($user->groups->contains('id', 4)) {
            abort(403);
    }
@endphp

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
                <!-- Bulk Action Buttons -->
                <div>
                  Aksi Pengajuan Terpilih : 
                  <button id="bulkApprove" class="btn btn-success"><i class="fas fa-check" aria-hidden="true"></i> Setuju</button>
                  <button id="bulkDecline" class="btn btn-danger"><i class="fas fa-times" aria-hidden="true"></i> Tolak</button>
                </div>
                
                <!-- Approval Table -->
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
                    data-click-to-select="true"
                    id="approvalTable"
                    class="table table-striped snipe-table"
                    data-url="{{ route('approval.request') }}"
                    data-export-options='{
                    "fileName": "export-approval-{{ date('Y-m-d') }}",
                    "ignoreColumn": ["actions"]
                    }'>
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
                  data-sort-order="desc"
                  data-sort-name="request_date"
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
    // Function to get selected rows
    function getSelectedRows() {
        return $('#approvalTable').bootstrapTable('getSelections');
    }

    // Bulk Approve Action
    $('#bulkApprove').on('click', function () {
        var selectedRows = getSelectedRows();
        if (selectedRows.length === 0) {
            alert('Silahkan pilih minimal satu baris.');
            return;
        }
        if (confirm('Apakah Anda Yakin Ingin Menyetujui Semua Pengajuan Terpilih?')) {
            var ids = selectedRows.map(row => row.id);

            $.ajax({
                url: '{{ route("approval.bulkUpdateStatus") }}',
                method: 'POST',
                data: {
                    ids: ids,
                    status: 'Sudah Disetujui',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.message);
                    $('#approvalTable').bootstrapTable('refresh');
                },
                error: function (response) {
                    alert('Terjadi kesalahan saat memproses permintaan.');
                }
            });
        }
    });

    // Bulk Decline Action
    $('#bulkDecline').on('click', function () {
        var selectedRows = getSelectedRows();
        if (selectedRows.length === 0) {
            alert('Silahkan pilih minimal satu baris.');
            return;
        }
        if (confirm('Apakah Anda Yakin Ingin Menolak Semua Pengajuan Terpilih?')) {
            var ids = selectedRows.map(row => row.id);

            $.ajax({
                url: '{{ route("approval.bulkUpdateStatus") }}',
                method: 'POST',
                data: {
                    ids: ids,
                    status: 'Tidak Disetujui',
                    _token: '{{ csrf_token() }}'
                },
                success: function (response) {
                    alert(response.message);
                    $('#approvalTable').bootstrapTable('refresh');
                },
                error: function (response) {
                    alert('Error occurred while processing the request.');
                }
            });
        }
    });


    function counterFormatter(value, row, index) {
        return index + 1; // index is zero-based, so add 1
    }

    function actionFormatter(value, row, index) {
    const modalId = `setuju_popup_${index}`;

    // Conditionally create the supporting link section
    let supportingLinkHtml = '';
    if (row.kondisi === 'Rusak Berat') {
        supportingLinkHtml = `
            <!-- Bukti Dukung -->
            <div class="form-group row">
                <label for="link" class="col-md-4 col-form-label control-label text-right">Bukti Dukung</label>
                <div class="col-md-8 text-left" name="link" style="margin-top: 1px;">
                    <a href="${row.supporting_link}" target="_blank" class="form-control-static">${row.supporting_link}</a>
                </div>
            </div>
        `;
    }

    return `
      <div style="display:inline;">
        <input type="hidden" name="setuju_button">
        <button title="Setuju" class="btn btn-success btn-sm" data-toggle="modal" data-target="#${modalId}">
          <i class="fas fa-check" aria-hidden="true"></i></button>
      </div>

      <!-- Modal -->
      <div class="modal" id="${modalId}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Detail Pengajuan</b></h4>
              <button type="button" class="close" style="position: absolute; right: 15px; top: 15px" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div id="setujuForm" action="">
                @csrf
                <div class="box-body">
                  
                  <!-- Tanggal Pengajuan -->
                  <div class="form-group row">
                    <label for="request_date" class="col-md-4 col-form-label control-label text-right">Tanggal Pengajuan</label>
                    <div class="col-md-8 text-left" name="request_date" style="margin-top: -7px;">
                      <p class="form-control-static">${row.request_date}</p>
                    </div>
                  </div>

                  <!-- Nama Pegawai -->
                  <div class="form-group row">
                    <label for="user_first_name" class="col-md-4 col-form-label control-label text-right">Nama Pegawai</label>
                    <div class="col-md-8 text-left" name="user_first_name" style="margin-top: -7px;">
                      <p class="form-control-static">${row.user_first_name}</p>
                    </div>
                  </div>

                  <!-- Nama Perangkat -->
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label control-label text-right">Nama Perangkat</label>
                    <div class="col-md-8 text-left" name="name" style="margin-top: -7px;">
                      <p class="form-control-static">${row.name}</p>
                    </div>
                  </div>

                  <!-- Kategori -->
                  <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label control-label text-right">Kategori</label>
                    <div class="col-md-8 text-left" name="category" style="margin-top: -7px;">
                      <p class="form-control-static">${row.category}</p>
                    </div>
                  </div>

                  <!-- Nomor BMN -->
                  <div class="form-group row">
                    <label for="bmn" class="col-md-4 col-form-label control-label text-right">Nomor BMN</label>
                    <div class="col-md-8 text-left" name="bmn" style="margin-top: -7px;">
                      <p class="form-control-static">${row.bmn}</p>
                    </div>
                  </div>

                  <!-- Serial Number -->
                  <div class="form-group row">
                    <label for="serial" class="col-md-4 col-form-label control-label text-right">Nomor serial</label>
                    <div class="col-md-8 text-left" name="serial" style="margin-top: -7px;">
                      <p class="form-control-static">${row.serial}</p>
                    </div>
                  </div>
                  
                  <!-- Kondisi -->
                  <div class="form-group row">
                    <label for="kondisi" class="col-md-4 col-form-label control-label text-right">Kondisi</label>
                    <div class="col-md-8 text-left" name="kondisi" style="margin-top: -7px;">
                      <p class="form-control-static">${row.kondisi}</p>
                    </div>
                  </div>

                  ${supportingLinkHtml}

                  <div style="padding: 2px; margin-bottom: 15px; margin-top: 0px;">
                    <h4 style="color: white;"><b></b></h4>
                  </div>

                  <!-- Operating System (OS) -->
                  <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label control-label text-right">Operating System (OS)</label>
                    <div class="col-md-8 text-left" name="link" style="margin-top: -7px;">
                      <p class="form-control-static">${row.os}</p>
                    </div>
                  </div>

                  <!-- Microsoft Office -->
                  <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label control-label text-right">Microsoft Office</label>
                    <div class="col-md-8 text-left" name="link" style="margin-top: -7px;">
                      <p class="form-control-static">${row.office}</p>
                    </div>
                  </div>

                  <!-- Antivirus -->
                  <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label control-label text-right">Antivirus</label>
                    <div class="col-md-8 text-left" name="link" style="margin-top: -7px;">
                      <p class="form-control-static">${row.antivirus}</p>
                    </div>
                  </div>
                </div>

                <div class="box-footer">
                  <a class="btn btn-link pull-left" class="close" data-dismiss="modal"> {{ trans('button.cancel') }}</a>
                  <form action="{{ route('approval.update-status') }}" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="setuju" value="${row.id}"> <!-- Pass the id of the row -->
                    <button type="submit" title="Setuju" class="btn btn-success pull-right">
                      <i class="fas fa-check" aria-hidden="true"></i> Setuju
                    </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <form action="{{ route('approval.update-status') }}" method="POST" style="display:inline;">
        @csrf
        <input type="hidden" name="tidak_setuju" value="${row.id}"> <!-- Pass the id of the row -->
        <button type="submit" title="Tolak" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda Yakin Ingin Menolak Pengajuan?')">
          <i class="fas fa-times" aria-hidden="true"></i>
        </button>
      </form>
    `;
  }

    function actionHistoryFormatter(value, row, index) {
    const modalId = `view_popup_${index}`;

    // Conditionally create the supporting link section
    let supportingLinkHtml = '';
    if (row.kondisi === 'Rusak Berat') {
        supportingLinkHtml = `
            <!-- Bukti Dukung -->
            <div class="form-group row">
                <label for="link" class="col-md-4 col-form-label control-label text-right">Bukti Dukung</label>
                <div class="col-md-8 text-left" name="link" style="margin-top: 1px;">
                    <a href="${row.supporting_link}" target="_blank" class="form-control-static">${row.supporting_link}</a>
                </div>
            </div>
        `;
    }
    return `
      <div style="display:inline;">
        <input type="hidden" name="view_button">
        <button title="Lihat" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#${modalId}">
          <i class="fas fa-eye" aria-hidden="true"></i></button>
      </div>

      <!-- Modal -->
      <div class="modal" id="${modalId}" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title"><b>Detail Pengajuan</b></h4>
              <button type="button" class="close" style="position: absolute; right: 15px; top: 15px" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="setujuForm" action="">
                <div class="box-body">
                  <!-- Tanggal Pengajuan -->
                  <div class="form-group row">
                    <label for="request_date" class="col-md-4 col-form-label control-label text-right">Tanggal Pengajuan</label>
                    <div class="col-md-8 text-left" name="request_date" style="margin-top: -7px;">
                      <p class="form-control-static">${row.request_date}</p>
                    </div>
                  </div>

                  <!-- Tanggal Penanganan -->
                  <div class="form-group row">
                    <label for="request_date" class="col-md-4 col-form-label control-label text-right">Tanggal Penanganan</label>
                    <div class="col-md-8 text-left" name="request_date" style="margin-top: -7px;">
                      <p class="form-control-static">${row.handling_date}</p>
                    </div>
                  </div>
                  
                  <!-- Status Persetujuan -->
                  <div class="form-group row">
                    <label for="request_date" class="col-md-4 col-form-label control-label text-right">Status Persetujuan</label>
                    <div class="col-md-8 text-left" name="request_date" style="margin-top: -7px;">
                      <p class="form-control-static">${row.status}</p>
                    </div>
                  </div>

                  <div style="padding: 2px; margin-bottom: 15px; margin-top: 0px;">
                    <h4 style="color: white;"><b></b></h4>
                  </div>

                  <!-- Nama Pegawai -->
                  <div class="form-group row">
                    <label for="user_first_name" class="col-md-4 col-form-label control-label text-right">Nama Pegawai</label>
                    <div class="col-md-8 text-left" name="user_first_name" style="margin-top: -7px;">
                      <p class="form-control-static">${row.user_first_name}</p>
                    </div>
                  </div>

                  <!-- Nama Perangkat -->
                  <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label control-label text-right">Nama Perangkat</label>
                    <div class="col-md-8 text-left" name="name" style="margin-top: -7px;">
                      <p class="form-control-static">${row.name}</p>
                    </div>
                  </div>

                  <!-- Kategori -->
                  <div class="form-group row">
                    <label for="category" class="col-md-4 col-form-label control-label text-right">Kategori</label>
                    <div class="col-md-8 text-left" name="category" style="margin-top: -7px;">
                      <p class="form-control-static">${row.category}</p>
                    </div>
                  </div>

                  <!-- Nomor BMN -->
                  <div class="form-group row">
                    <label for="bmn" class="col-md-4 col-form-label control-label text-right">Nomor BMN</label>
                    <div class="col-md-8 text-left" name="bmn" style="margin-top: -7px;">
                      <p class="form-control-static">${row.bmn}</p>
                    </div>
                  </div>

                  <!-- Serial Number -->
                  <div class="form-group row">
                    <label for="serial" class="col-md-4 col-form-label control-label text-right">Nomor serial</label>
                    <div class="col-md-8 text-left" name="serial" style="margin-top: -7px;">
                      <p class="form-control-static">${row.serial}</p>
                    </div>
                  </div>
                  
                  <!-- Kondisi -->
                  <div class="form-group row">
                    <label for="kondisi" class="col-md-4 col-form-label control-label text-right">Kondisi</label>
                    <div class="col-md-8 text-left" name="kondisi" style="margin-top: -7px;">
                      <p class="form-control-static">${row.kondisi}</p>
                    </div>
                  </div>

                  ${supportingLinkHtml}

                  <div style="padding: 2px; margin-bottom: 15px; margin-top: 0px;">
                    <h4 style="color: white;"><b></b></h4>
                  </div>

                  <!-- Operating System (OS) -->
                  <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label control-label text-right">Operating System (OS)</label>
                    <div class="col-md-8 text-left" name="link" style="margin-top: -7px;">
                      <p class="form-control-static">${row.os}</p>
                    </div>
                  </div>

                  <!-- Microsoft Office -->
                  <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label control-label text-right">Microsoft Office</label>
                    <div class="col-md-8 text-left" name="link" style="margin-top: -7px;">
                      <p class="form-control-static">${row.office}</p>
                    </div>
                  </div>

                  <!-- Antivirus -->
                  <div class="form-group row">
                    <label for="link" class="col-md-4 col-form-label control-label text-right">Antivirus</label>
                    <div class="col-md-8 text-left" name="link" style="margin-top: -7px;">
                      <p class="form-control-static">${row.antivirus}</p>
                    </div>
                  </div>
                </div>

                <div class="box-footer">
                  <a class="btn btn-link pull-right" class="close" data-dismiss="modal"> Tutup</a>
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
