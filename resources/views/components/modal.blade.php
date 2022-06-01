<div class="modal fade popup-delete bd-example-modal-lg create-administrator" id="{{ $modal_id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveVehicleModalLabel">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
            <div class="modal-footer">
                @if($form_id)
                    <button type="submit" class="btn btn-primary" form="{{ $form_id }}">{{ $save_text }}</button>
                @endif
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('lang.cancel') }}</button>
            </div>
        </div>
    </div>

</div>
