<div class="mb-3">
    <label>@lang('backend.title') <span class="text-danger">*</span></label>
    <input name="title[{{ $lan->code }}]" type="text"
           class="form-control"
           required="" placeholder="@lang('backend.title')">
    {!! validation_response('backend.title') !!}
</div>
