{{-- See snipeit_modals.js for what powers this --}}
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h2 class="modal-title">{{ trans('admin/locations/table.create')  }}</h2>
        </div>
        <div class="modal-body">
            <form action="{{ route('api.locations.store') }}" onsubmit="return false">
                <div class="alert alert-danger" id="modal_error_msg" style="display:none"></div>

                <div class="dynamic-form-row">
                    <div class="col-md-5 col-xs-12"><label for="modal-koderuang">{{ trans('admin/locations/table.id') }}:</label></div>
                    <div class="col-md-7 col-xs-12"><input type='text' name="koderuang" id='modal-koderuang' class="form-control"></div>
                </div>

                <div class="dynamic-form-row">
                    <div class="col-md-5 col-xs-12"><label for="modal-name">{{ trans('admin/locations/table.name') }}:</label></div>
                    <div class="col-md-7 col-xs-12 required"><input type='text' name="name" id='modal-name' class="form-control"></div>
                </div>

                <div class="dynamic-form-row">
                    <div class="col-md-5 col-xs-12 country"><label for="modal-address">{{ trans('admin/locations/table.address') }}:</label></div>
                    <div class="col-md-7 col-xs-12"><input type='text' name="address" id='modal-address' class="form-control"></div>
                </div>

                <div class="dynamic-form-row">
                    <div class="col-md-5 col-xs-12"><label for="modal-city">{{ trans('admin/locations/table.city') }}:</label></div>
                    <div class="col-md-7 col-xs-12"><input type='text' name="city" id='modal-city' class="form-control"></div>
                </div>

                <div class="dynamic-form-row">
                    <div class="col-md-5 col-xs-12"><label for="modal-state">{{ trans('admin/locations/table.state') }}:</label></div>
                    <div class="col-md-7 col-xs-12"><input type='text' name="state" id='modal-state' class="form-control"></div>
                </div>

            </form>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('button.cancel') }}</button>
            <button type="button" class="btn btn-primary" id="modal-save">{{ trans('general.save') }}</button>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
