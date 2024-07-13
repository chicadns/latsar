@extends('layouts/default')

{{-- Page title --}}
@section('title')
{{ trans('general.hello_name', array('name' => $user->present()->getFullNameAttribute())) }}
@parent
@stop

{{-- Account page content --}}
@section('content')

@if ($acceptances = \App\Models\CheckoutAcceptance::forUser(Auth::user())->pending()->count())
  <div class="col-md-12">
    <div class="alert alert alert-warning fade in">
      <i class="fas fa-exclamation-triangle faa-pulse animated"></i>

      <strong>
        <a href="{{ route('account.accept') }}" style="color: white;">
          {{ trans('general.unaccepted_profile_warning', array('count' => $acceptances)) }}
        </a>
        </strong>
    </div>
  </div>
@endif

  <div class="row">
    <div class="col-md-12">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs hidden-print">

          <li class="active">
            <a href="#details" data-toggle="tab">
            <span class="hidden-lg hidden-md">
            <i class="fas fa-info-circle fa-2x"></i>
            </span>
              <span class="hidden-xs hidden-sm">{{ trans('admin/users/general.info') }}</span>
            </a>
          </li>

          <li>
            <a href="#asset" data-toggle="tab">
            <span class="hidden-lg hidden-md">
            <i class="fas fa-barcode fa-2x" aria-hidden="true"></i>
            </span>
              <span class="hidden-xs hidden-sm">{{ trans('general.assets') }}
                {{-- {!! ($user->assets()->AssetsForShow()->count() > 0 ) ? '<badge class="badge badge-secondary">'.number_format($user->assets()->AssetsForShow()->count()).'</badge>' : '' !!} --}}
            </span>
            </a>
          </li>

          {{-- <li>
            <a href="#licenses" data-toggle="tab">
            <span class="hidden-lg hidden-md">
            <i class="far fa-save fa-2x"></i>
            </span>
              <span class="hidden-xs hidden-sm">{{ trans('general.licenses') }}
                {!! ($user->licenses->count() > 0 ) ? '<badge class="badge badge-secondary">'.number_format($user->licenses->count()).'</badge>' : '' !!}
            </span>
            </a>
          </li> --}}

          <li>
            <a href="#accessories" data-toggle="tab">
            <span class="hidden-lg hidden-md">
            <i class="far fa-keyboard fa-2x"></i>
            </span>
              <span class="hidden-xs hidden-sm">{{ trans('general.accessories') }}
                {{-- {!! ($user->assets_non_it()->AssetsForShow()->count() > 0 ) ? '<badge class="badge badge-secondary">'.number_format($user->assets_non_it()->AssetsForShow()->count()).'</badge>' : '' !!} --}}
            </span>
            </a>
          </li>

          <li>
            <a href="#consumables" data-toggle="tab">
            <span class="hidden-lg hidden-md">
                <i class="fas fa-tint fa-2x"></i>
            </span>
              <span class="hidden-xs hidden-sm">{{ trans('general.consumables') }}
                {!! ($user->consumables->count() > 0 ) ? '<badge class="badge badge-secondary">'.number_format($user->consumables->count()).'</badge>' : '' !!}
            </span>
            </a>
          </li>

        </ul>

        <div class="tab-content">
          <div class="tab-pane active" id="details">
            <div class="row">


              <!-- Start button column -->
              <div class="col-md-3 col-xs-12 col-sm-push-9">



                <div class="col-md-12 text-center">

                </div>
                <div class="col-md-12 text-center">
                  <img src="{{ $user->present()->gravatar() }}"  class="img-thumbnail hidden-print" style="margin-bottom: 20px;" alt="{{ $user->present()->fullName() }}">
                </div>

                  {{-- <div class="col-md-12">
                    <a href="{{ route('profile') }}" style="width: 100%;" class="btn btn-sm btn-primary hidden-print">
                      {{ trans('general.editprofile') }}
                    </a>
                  </div> --}}

                {{-- <div class="col-md-12" style="padding-top: 5px;">
                  <a href="{{ route('account.password.index') }}" style="width: 100%;" class="btn btn-sm btn-primary hidden-print" target="_blank" rel="noopener">
                    {{ trans('general.changepassword') }}
                  </a>
                </div> --}}

                @can('self.api')
                <div class="col-md-12" style="padding-top: 5px;">
                  <a href="{{ route('user.api') }}" style="width: 100%;" class="btn btn-sm btn-primary hidden-print" target="_blank" rel="noopener">
                    {{ trans('general.manage_api_keys') }}
                  </a>
                </div>
                @endcan


                  <div class="col-md-12" style="padding-top: 5px;">
                    <a href="{{ route('profile.print') }}" style="width: 100%;" class="btn btn-sm btn-primary hidden-print" target="_blank" rel="noopener">
                      {{ trans('admin/users/general.print_assigned') }}
                    </a>
                  </div>

{{-- 
                  <div class="col-md-12" style="padding-top: 5px;">
                    @if (!empty($user->email))
                      <form action="{{ route('profile.email_assets') }}" method="POST">
                        {{ csrf_field() }}
                        <button style="width: 100%;" class="btn btn-sm btn-primary hidden-print" rel="noopener">{{ trans('admin/users/general.email_assigned') }}</button>
                      </form>
                    @else
                      <button style="width: 100%;" class="btn btn-sm btn-primary hidden-print" rel="noopener" disabled title="{{ trans('admin/users/message.user_has_no_email') }}">{{ trans('admin/users/general.email_assigned') }}</button>
                    @endif
                  </div> --}}

                <br><br>
              </div>

              <!-- End button column -->

              <div class="col-md-9 col-xs-12 col-sm-pull-3">

                <div class="row-new-striped">

                  <div class="row">
                    <!-- name -->

                    <div class="col-md-3 col-sm-2">
                      {{ trans('admin/users/table.name') }}
                    </div>
                    <div class="col-md-9 col-sm-2">
                      {{ $user->present()->fullName() }}
                    </div>

                  </div>



                  <!-- company -->
                  @if (!is_null($user->company))
                    <div class="row">

                      <div class="col-md-3">
                        {{ trans('general.company') }}
                      </div>
                      <div class="col-md-9">
                        {{ $user->company->name }}
                      </div>

                    </div>

                  @endif

                  <!-- username -->
                  <div class="row">

                    <div class="col-md-3">
                      {{ trans('admin/users/table.username') }}
                    </div>
                    <div class="col-md-9">

                      @if ($user->isSuperUser())
                        <label class="label label-danger"><i class="fas fa-crown" title="superuser"></i></label>&nbsp;
                      @elseif ($user->hasAccess('admin'))
                        <label class="label label-warning"><i class="fas fa-crown" title="admin"></i></label>&nbsp;
                      @endif
                      {{ $user->username }}

                    </div>

                  </div>

                  <!-- address -->
                  @if (($user->address) || ($user->city) || ($user->state) || ($user->country))
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('general.address') }}
                      </div>
                      <div class="col-md-9">

                        @if ($user->address)
                          {{ $user->address }} <br>
                        @endif
                        @if ($user->city)
                          {{ $user->city }}
                        @endif
                        @if ($user->state)
                          {{ $user->state }}
                        @endif
                        @if ($user->country)
                          {{ $user->country }}
                        @endif
                        @if ($user->zip)
                          {{ $user->zip }}
                        @endif

                      </div>
                    </div>
                  @endif

                  @if ($user->jobtitle)
                    <!-- jobtitle -->
                    <div class="row">

                      <div class="col-md-3">
                        {{ trans('admin/users/table.job') }}
                      </div>
                      <div class="col-md-9">
                        {{ $user->jobtitle }}
                      </div>

                    </div>
                  @endif

                  @if ($user->employee_num)
                    <!-- employee_num -->
                    <div class="row">

                      <div class="col-md-3">
                        {{ trans('admin/users/table.employee_num') }}
                      </div>
                      <div class="col-md-9">
                        {{ $user->employee_num }}
                      </div>

                    </div>
                  @endif

                  @if ($user->manager)
                    <!-- manager -->
                    <div class="row">

                      <div class="col-md-3">
                        {{ trans('admin/users/table.manager') }}
                      </div>
                      <div class="col-md-9">
                        <a href="{{ route('users.show', $user->manager->id) }}">
                          {{ $user->manager->getFullNameAttribute() }}
                        </a>
                      </div>

                    </div>

                  @endif


                  @if ($user->email)
                    <!-- email -->
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('admin/users/table.email') }}
                      </div>
                      <div class="col-md-9">
                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                      </div>
                    </div>
                  @endif

                  @if ($user->website)
                    <!-- website -->
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('general.website') }}
                      </div>
                      <div class="col-md-9">
                        <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                      </div>
                    </div>
                  @endif

                  @if ($user->phone)
                    <!-- phone -->
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('admin/users/table.phone') }}
                      </div>
                      <div class="col-md-9">
                        <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
                      </div>
                    </div>
                  @endif

                  @if ($user->userloc)
                    <!-- location -->
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('admin/users/table.location') }}
                      </div>
                      <div class="col-md-9">
                        {{ link_to_route('locations.show', $user->userloc->name, [$user->userloc->id]) }}
                      </div>
                    </div>
                  @endif

                  <!-- last login -->
                  <div class="row">
                    <div class="col-md-3">
                      {{ trans('general.last_login') }}
                    </div>
                    <div class="col-md-9">
                      {{ \App\Helpers\Helper::getFormattedDateObject($user->last_login, 'datetime', false) }}
                    </div>
                  </div>


                  @if ($user->department)
                    <!-- empty -->
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('general.department') }}
                      </div>
                      <div class="col-md-9">
                          {{ $user->department->name }}
                      </div>
                    </div>
                  @endif

                  @if ($user->created_at)
                    <!-- created at -->
                    <div class="row">
                      <div class="col-md-3">
                        {{ trans('general.created_at') }}
                      </div>
                      <div class="col-md-9">
                        {{ \App\Helpers\Helper::getFormattedDateObject($user->created_at, 'datetime')['formatted']}}
                      </div>
                    </div>
                  @endif

                </div> <!--/end striped container-->
              </div> <!-- end col-md-9 -->



            </div> <!--/.row-->
          </div><!-- /.tab-pane -->

          <div class="tab-pane" id="asset">
            <!-- checked out assets table -->


            <div class="table table-responsive">
              @if ($user->id)
                <div class="box-header with-border">
                  <div class="box-heading">
                    <h2 class="box-title"> {{ trans('general.asset') }} {{ trans('general.of') }} {{ $user->first_name }}</h2>
                  </div>
                </div><!-- /.box-header -->
              @endif

              <div class="box-body">
                <!-- checked out assets table -->
                <div class="table-responsive">
                  <div style="position: absolute; display: flex;">
                    <button class="btn btn-primary" style="margin-top: 5px;" data-toggle="modal" data-target="#checkout_user">{{ trans('general.add_allocation') }}</button>
                  </div>

                  <!-- Modal Tambah Alokasi -->
                  <div class="modal" id="checkout_user" tabindex="-1" role="dialog">
                  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h3 class="modal-title">{{ trans('general.add_allocation_it') }}</h3>
                        <button type="button" class="close" style="position: absolute; right: 15px; top: 15px" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form id="hardwareForm" method="post" action="{{ route('allocations.store') }}">
                          @csrf
                          <table 
                            {{-- data-columns="{{ \App\Presenters\AddAllocationPresenter::dataTableLayout() }}" --}}
                            data-cookie="true"
                            data-cookie-id-table="addAllocation"
                            data-id-table="addAllocation"
                            data-search="true"
                            data-query-params="queryParams"
                            data-pagination="true"
                            data-side-pagination="server"
                            data-page-list="[10, 25, 50, 100]"
                            data-show-footer="true"
                            data-show-refresh="true"
                            data-sort-order="asc"
                            data-response-handler="responseHandler"
                            id="addAllocation"
                            class="table table-striped snipe-table"
                            data-url="{{ route('satker.index') }}"
                            data-checkbox-header="false"
                          >
                            <thead>
                              <tr>
                                  <th data-field="state" data-checkbox="true"></th> <!-- Checkbox for selection -->
                                  <th data-field="category_name" data-sortable="true">Kategori</th>
                                  <th data-field="name" data-sortable="true">Nama Perangkat</th>
                                  <th data-field="bmn" data-sortable="true">Nomor BMN</th>
                                  <th data-field="serial" data-sortable="true">Serial Number</th>
                                  <!-- Add other columns as needed -->
                              </tr>
                            </thead>
                          </table>
                          <div class="box-footer">
                            <a class="btn btn-link" class="close" data-dismiss="modal"> {{ trans('button.cancel') }}</a>
                            <button type="submit" onclick="sendSelectedIds(event)" class="btn btn-primary pull-right" ><i class="fas fa-check icon-white" aria-hidden="true"></i>  {{ trans('general.checkout') }}</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>

                {{-- Tabel Perangkat IT milik sendiri --}}
                  <table
                    data-columns="{{ \App\Presenters\UserAllocationPresenter::dataTableLayout() }}"
                    data-cookie="true"
                    data-cookie-id-table="userAssets"
                    data-id-table="userAssets"
                    data-search="true"
                    data-pagination="true"
                    data-side-pagination="client"
                    data-show-columns="true"
                    data-show-export="true"
                    data-show-footer="true"
                    data-show-refresh="true"
                    data-sort-order="asc"
                    id="userAssets"
                    class="table table-striped snipe-table"
                    data-url="{{ route('allocations.user') }}"
                    data-export-options='{
                  "fileName": "my-assets-{{ date('Y-m-d') }}",
                  "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                  }'>
                  </table>
                </div>
                </div> <!-- .table-responsive-->
            </div>
          </div><!-- /asset -->

          <!-- <div class="tab-pane" id="licenses">

            <div class="table-responsive">
              <table
                      data-cookie-id-table="userLicenses"
                      data-pagination="true"
                      data-id-table="userLicenses"
                      data-search="true"
                      data-side-pagination="client"
                      data-show-columns="true"
                      data-show-export="true"
                      data-show-refresh="true"
                      data-sort-order="asc"
                      id="userLicenses"
                      class="table table-striped snipe-table"
                      data-export-options='{
                    "fileName": "my-licenses-{{ date('Y-m-d') }}",
                    "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                    }'>
                <thead>
                <tr>
                  <th class="col-md-4">{{ trans('general.name') }}</th>
                  <th class="col-md-4">{{ trans('admin/hardware/form.serial') }}</th>
                  <th class="col-md-4">{{ trans('general.category') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user->licenses as $license)
                  <tr>
                    <td>{{ $license->name }}</td>
                    <td>
                      @can('viewKeys', $license)
                        {{ $license->serial }}
                      @else
                        ------------
                      @endcan
                    </td>
                    <td>{{ $license->category->name }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div> -->

          <div class="tab-pane" id="accessories">
            <div class="table table-responsive">
              @if ($user->id)
                <div class="box-header with-border">
                  <div class="box-heading">
                    <h2 class="box-title"> {{ trans('general.accessories') }} {{ trans('general.of') }} {{ $user->first_name }}</h2>
                  </div>
                </div><!-- /.box-header -->
              @endif

              <div class="box-body">
                <!-- checked out assets table -->
                <div class="table-responsive">
                  <form style="position: absolute; display: flex;">
                  <input type="hidden" name="transaction_type" value="pengeluaran">
                  <button type="submit" class="btn btn-primary disabled" style="margin-top: 5px;">{{ trans('general.add_allocation') }}</button>
              </form>
                  <table
                          data-cookie="true"
                          data-cookie-id-table="userAssets"
                          data-pagination="true"
                          data-id-table="userAssets"
                          data-search="true"
                          data-side-pagination="client"
                          data-show-columns="true"
                          data-show-export="true"
                          data-show-footer="true"
                          data-show-refresh="true"
                          data-sort-order="asc"
                          id="userAssets"
                          class="table table-striped snipe-table"
                          data-export-options='{
                  "fileName": "my-assets-{{ date('Y-m-d') }}",
                  "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","icon"]
                  }'>
                    <thead>
                    <tr>
                      <th class="col-md-1">#</th>
                      <th class="col-md-1">{{ trans('general.image') }}</th>
                      <th class="col-md-2" data-switchable="true" data-visible="true">{{ trans('general.category') }}</th>
                      <th class="col-md-2" data-switchable="true" data-visible="true">{{ trans('admin/hardware/table.asset_tag') }}</th>
                      <th class="col-md-2" data-switchable="true" data-visible="true">{{ trans('general.name') }}</th>
                      <th class="col-md-2" data-switchable="true" data-visible="true">{{ trans('admin/hardware/table.asset_model') }}</th>
                      <th class="col-md-3" data-switchable="true" data-visible="true">{{ trans('admin/hardware/table.serial') }}</th>
                      @can('self.view_purchase_cost')
                        <th class="col-md-6" data-footer-formatter="sumFormatter" data-fieldname="purchase_cost">{{ trans('general.purchase_cost') }}</th>
                      @endcan
                      @foreach ($field_array as $db_column => $field_name)
                        <th class="col-md-1" data-switchable="true" data-visible="true">{{ $field_name }}</th>
                      @endforeach

                    </tr>

                    </thead>
                    <tbody>
                    @php
                      $counter = 1
                    @endphp
                    @foreach ($user->assets_non_it as $asset)
                      <tr>
                        <td>{{ $counter }}</td>
                        <td>
                          @if (($asset->image) && ($asset->image!=''))
                            <img src="{{ Storage::disk('public')->url(app('assets_upload_path').e($asset->image)) }}" style="max-height: 30px; width: auto" class="img-responsive">
                          @elseif (($asset->model) && ($asset->model->image!=''))
                            <img src="{{ Storage::disk('public')->url(app('models_upload_path').e($asset->model->image)) }}" style="max-height: 30px; width: auto" class="img-responsive">
                          @endif
                        </td>
                        <td>
                          @if (($asset->model) && ($asset->model->category))
                          {{ $asset->model->category->name }}
                          @endif
                        </td>
                        <td>{{ $asset->asset_tag }}</td>
                        <td>{{ $asset->name }}</td>
                        <td>
                          @if ($asset->physical=='1')
                            {{ $asset->model->name }}
                          @endif
                        </td>
                        <td>{{ $asset->serial }}</td>

                        @can('self.view_purchase_cost')
                        <td>
                          {!! Helper::formatCurrencyOutput($asset->purchase_cost) !!}
                        </td>
                        @endcan

                        @foreach ($field_array as $db_column => $field_value)
                          <td>
                            {{ $asset->{$db_column} }}
                          </td>
                        @endforeach

                      </tr>

                      @php
                        $counter++
                      @endphp
                    @endforeach
                    </tbody>
                  </table>
                </div>
                </div> <!-- .table-responsive-->
            </div>
          </div><!-- /accessories-tab -->

          <div class="tab-pane" id="consumables">
            @if ($user->id)
                <div class="box-header with-border">
                  <div class="box-heading">
                    <h2 class="box-title"> {{ trans('general.consumable') }} {{ trans('general.of') }} {{ $user->first_name }}</h2>
                  </div>
                </div><!-- /.box-header -->
              @endif
              
            <div class="table-responsive" style="padding:10px; padding-bottom: 45px; ">
              <form method="get" action="{{ route('consumablestransaction.create') }}" style="position: absolute; display: flex;">
                  <input type="hidden" name="transaction_type" value="pengeluaran">
                  <button type="submit" class="btn btn-primary" style="margin-top: 5px;">{{ trans('general.add_request') }}</button>
              </form>
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
            {{-- probably usefull someday --}}
              {{-- <table
                      data-cookie-id-table="userConsumableTable"
                      data-id-table="userConsumableTable"
                      id="userConsumableTable"
                      data-search="true"
                      data-pagination="true"
                      data-side-pagination="client"
                      data-show-columns="true"
                      data-show-fullscreen="true"
                      data-show-export="true"
                      data-show-footer="true"
                      data-show-refresh="true"
                      data-sort-order="asc"
                      data-sort-name="name"
                      class="table table-striped snipe-table table-hover"
                      data-export-options='{
                    "fileName": "export-consumable-{{ str_slug($user->username) }}-{{ date('Y-m-d') }}",
                    "ignoreColumn": ["actions","image","change","checkbox","checkincheckout","delete","download","icon"]
                    }'>
                <thead>
                <tr>
                  <th class="col-md-3">{{ trans('general.name') }}</th>
                  @can('self.view_purchase_cost')
                    <th class="col-md-2" data-footer-formatter="sumFormatter" data-fieldname="purchase_cost">{{ trans('general.purchase_cost') }}</th>
                  @endcan
                  <th class="col-md-2">{{ trans('general.date') }}</th>
                  <th class="col-md-5">{{ trans('general.notes') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($user->consumables as $consumable)
                  <tr>
                    <td>{{ $consumable->name }}</td>
                    @can('self.view_purchase_cost')
                      <td>
                        {!! Helper::formatCurrencyOutput($consumable->purchase_cost) !!}
                      </td>
                    @endcan
                    <td>{{ Helper::getFormattedDateObject($consumable->pivot->created_at, 'datetime',  false) }}</td>
                    <td>{{ $consumable->pivot->note }}</td>
                  </tr>
                @endforeach
                </tbody>
              </table> --}}
            </div>
          </div><!-- /consumables-tab -->

        </div><!-- /.tab-content -->
      </div><!-- nav-tabs-custom -->
    </div>
  </div>







@stop

@section('moar_scripts')
  @include ('partials.bootstrap-table')
  <script>

    function actionFormatter(value, row, index) {
      let editUrl = '';
      const id_on_asset = row.id;

      if (row.source === 'user' || row.allocation_id === null) {
          // Route for creating a new allocation
          editUrl = '{{ route("allocations.edit.new", [":asset_id"]) }}'.replace(':asset_id', id_on_asset);
      } else {
          // Route for editing an existing allocation
          editUrl = '{{ route("allocations.edit", [":id", ":asset_id"]) }}'.replace(':id', row.allocation_id).replace(':asset_id', id_on_asset);
      }

      const deleteUrl = '{{ route("allocations.destroy", [":asset_id"]) }}'.replace(':asset_id', row.allocation_id);
      const submitUrl = '{{ route("allocations.submit", [":asset_id"]) }}'.replace(':asset_id', row.allocation_id);

      const csrfToken = '@csrf';
      const methodDelete = '@method("DELETE")';
      const methodPost = '@method("POST")';

      function createButton(url, title, classes, icon, extraAttributes = '') {
          return `<a href="${url}" title="${title}" class="${classes}" ${extraAttributes}>
                      <i class="${icon}" aria-hidden="true"></i>
                  </a>`;
      }

      function createForm(url, title, classes, icon, extraAttributes = '', hiddenFields = '') {
          return `<form action="${url}" method="POST" style="display:inline;" ${extraAttributes}>
                      ${csrfToken}
                      ${hiddenFields}
                      <button type="submit" title="${title}" class="${classes}">
                          <i class="${icon}" aria-hidden="true"></i>
                      </button>
                  </form>`;
      }

      let editButton = '', deleteButton = '', submitButton = '';

      switch (row.status) {
          case "Menunggu Persetujuan":
              editButton = createButton('#', 'Edit', 'actions btn btn-sm btn-warning disabled', 'fas fa-pencil-alt');
              deleteButton = createForm('#', 'Hapus', 'btn btn-danger btn-sm disabled', 'fas fa-trash');
              submitButton = createForm('#', 'Kirim', 'btn btn-success btn-sm disabled', 'fas fa-paper-plane');
              break;

          case "Belum Dikirim":
              if (row.complete_status == 1) {
                  editButton = createButton(editUrl, 'Edit', 'actions btn btn-sm btn-warning', 'fas fa-pencil-alt');
                  deleteButton = createForm(deleteUrl, 'Hapus', 'btn btn-danger btn-sm', 'fas fa-trash', `onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Pengajuan? (Menghapus Pengajuan Tidak Akan Menghapus Perangkat dari Database)')"`, methodDelete);
                  submitButton = createForm(submitUrl, 'Kirim', 'btn btn-success btn-sm', 'fas fa-paper-plane', `onclick="return confirm('Apakah Anda Yakin Ingin Mengirim Data ${row.name} Ini?')"`, `<input type="hidden" name="id" value="${row.id}">${methodPost}`);
              } else {
                  editButton = createButton(editUrl, 'Edit', 'actions btn btn-sm btn-warning', 'fas fa-pencil-alt');
                  deleteButton = createForm(deleteUrl, 'Hapus', 'btn btn-danger btn-sm', 'fas fa-trash', `onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Pengajuan? (Menghapus Pengajuan Tidak Akan Menghapus Perangkat dari Database)')"`, methodDelete);
                  submitButton = createForm('#', 'Kirim', 'btn btn-success btn-sm disabled', 'fas fa-paper-plane', '', `<input type="hidden" name="id" value="${row.id}">${methodPost}`);
              }
              break;

          case "Sudah Disetujui":
              editButton = createButton(editUrl, 'Edit', 'actions btn btn-sm btn-warning', 'fas fa-pencil-alt');
              deleteButton = createForm('#', 'Hapus', 'btn btn-danger btn-sm disabled', 'fas fa-trash');
              submitButton = createForm('#', 'Kirim', 'btn btn-success btn-sm disabled', 'fas fa-paper-plane');
              break;

          case "Tidak Disetujui":
              editButton = createButton('#', 'Edit', 'actions btn btn-sm btn-warning disabled', 'fas fa-pencil-alt');
              deleteButton = createForm(deleteUrl, 'Hapus', 'btn btn-danger btn-sm', 'fas fa-trash', `onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Pengajuan? (Menghapus Pengajuan Tidak Akan Menghapus Perangkat dari Database)')"`, `${methodDelete}<input type="hidden" name="deleted_at" value="{{ now() }}">`);
              submitButton = createForm('#', 'Kirim', 'btn btn-success btn-sm disabled', 'fas fa-paper-plane');
              break;
      }

      return `
          <nobr>
              ${editButton}
              ${deleteButton}
              ${submitButton}
          </nobr>
      `;
  }


    // Ensure the confirmation message is shown before preventing default action for disabled buttons
    document.addEventListener('click', function(event) {
        const target = event.target.closest('a.disabled, button.disabled');
        if (target) {
            event.preventDefault();
        }
    });


    function warningFormatter(value, row, index) {
        return `<nobr>${value}</nobr>`;
    }

    function counterFormatter(value, row, index) {
        return index + 1; // index is zero-based, so add 1
    }

    function sendSelectedIds(event) {
      event.preventDefault(); // Prevent the default form submission

      var selectedIds = $('#addAllocation').bootstrapTable('getSelections').map(function(row) {
        return row.id;
      });

      if (selectedIds.length === 0) {
        alert('No assets selected');
        return;
      }

      // Remove existing input if present
      $('#hardwareForm input[name="selected_ids"]').remove();

      var input = $("<input>")
        .attr("type", "hidden")
        .attr("name", "selected_ids")
        .val(JSON.stringify(selectedIds));
      
      $('#hardwareForm').append(input);

      // Now submit the form
      $('#hardwareForm').submit();
    } 

    function queryParams(params) {
    return {
      limit: params.limit,
      offset: params.offset,
      search: params.search,
      sort: params.sort,
      order: params.order
    };
  }

    function responseHandler(res) {
        return {
            "total": res.total,
            "rows": res.data
        };
    }

</script>
@stop
