@extends('master.backend')
@section('title',__('backend.our-forigners'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-6 ">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@lang('backend.our-forigners'): #{{ $forigner->id }}</h4>
                                </div>
                            </div>
                            <form action="{{ route('backend.forigners.update',$forigner->id) }}" method="POST" class="custom-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required="" value="{{ $forigner->name }}" >
                                    <div class="valid-feedback">
                                        @lang('backend.name') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.name') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.phone') <span class="text-danger">*</span></label>
                                    <input type="text" name="phone" class="form-control" required=""  value="{{ $forigner->phone }}">
                                    <div class="valid-feedback">
                                        @lang('backend.phone') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.phone') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.location') <span class="text-danger">*</span></label>
                                    <input type="text" name="location" class="form-control" required=""  value="{{ $forigner->location }}">
                                    <div class="valid-feedback">
                                        @lang('backend.location') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.location') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.note'):</label>
                                    <input type="text" name="note" class="form-control" required=""  value="{{ $forigner->note }}">
                                    <div class="valid-feedback">
                                        @lang('backend.note') @lang('messages.is-correct')
                                    </div>
                                    <div class="invalid-feedback">
                                        @lang('backend.note') @lang('messages.not-correct')
                                    </div>
                                </div>
                                <div class="mb-0 text-center">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            @lang('backend.submit')
                                        </button>
                                        <a href="{{url()->previous()}}" type="button" class="btn btn-secondary waves-effect">
                                            @lang('backend.cancel')
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
