<div class="mb-3">
    <label>@lang('backend.photo') <span class="text-danger">*</span></label>
    <input name="photo" type="file"
           class="form-control"
           required="" >
    {!! validation_response('backend.photo') !!}
</div>
