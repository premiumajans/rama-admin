<div class="mb-3">
    <label>@lang('backend.description') <span
            class="text-danger">*</span></label>
    <textarea name="description[{{ $lan->code }}]" type="text"
              class="form-control" id="elm{{$lan->code}}1"
              required=""
              placeholder="@lang('backend.description')"></textarea>
    {!! validation_response('backend.description') !!}
</div>
