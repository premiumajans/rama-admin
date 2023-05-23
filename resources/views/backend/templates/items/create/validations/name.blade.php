<div class="mb-3">
    <label>@lang('backend.name') <span class="text-danger">*</span></label>
    <input name="name[{{ $lan->code }}]" type="text"
           class="form-control"
           required="" placeholder="@lang('backend.name')">
    {!! validation_response('backend.name') !!}
</div>
