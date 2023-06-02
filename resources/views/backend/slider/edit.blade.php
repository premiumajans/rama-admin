@extends('master.backend')
@section('title',__('backend.slider'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.slider.update',$id) }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @include('backend.templates.components.card-col-12',['variable' => 'slider'])
                                    @include('backend.templates.components.multi-lan-tab')
                                    <div class="tab-content p-3 text-muted">
                                        @foreach(active_langs() as $lan)
                                            <div class="tab-pane @if($loop->first) active show @endif"
                                                 id="{{ $lan->code }}"
                                                 role="tabpanel">
                                                <div class="form-group row">
                                                    <div class="mb-3">
                                                        <label>@lang('backend.title') <span class="text-danger">*</span></label>
                                                        <input name="title[{{ $lan->code }}]" type="text"
                                                               class="form-control"
                                                               required="" value="{{ $slider->translate($lan->code)->title ?? __('backend.translation-not-found') }}">
                                                        {!! validation_response('backend.title') !!}
                                                    </div>
                                                    <div class="mb-3">
                                                        <label>@lang('backend.description') <span
                                                                class="text-danger">*</span></label>
                                                        <textarea class="form-control"
                                                                  id="elm{{ $lan->code }}1"
                                                                  name="description[{{$lan->code}}]">{!! $slider->translate($lan->code)->description ?? __('backend.translation-not-found') !!}</textarea>
                                                        {!! validation_response('backend.description') !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                            <div class="mb-3">
                                                <label>@lang('backend.video') <span class="text-danger">*</span></label>
                                                <input type="file" name="photo" class="form-control mb-3" required=""
                                                       id="validationCustom" accept="video/*" >
                                                {!! validation_response('backend.video') !!}
                                                @if(file_exists($slider->photo))
                                                    <video width="100%" controls>
                                                        <source src="{{ asset($slider->photo) }}">
                                                    </video>
                                                @endif
                                            </div>
                                            <div class="mb-3">
                                                <label>@lang('backend.alt') <span class="text-danger">*</span></label>
                                                <input type="text" name="alt" class="form-control" id="validationCustom"  value="{{ $slider->alt }}">
                                            </div>
                                    </div>
                                </div>
                                @include('backend.templates.components.buttons')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @include('backend.templates.components.tiny')
@endsection
