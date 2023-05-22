@extends('master.backend')
@section('title',__('backend.categories'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-9">
                    <div class="card">
                        <form action="{{ route('backend.categories.update',$category->id) }}" class="needs-validation" novalidate method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="col-12">
                                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                        <h4 class="mb-sm-0">@lang('backend.categories'): #{{ $category->id }}</h4>
                                    </div>
                                </div>
                                <ul class="nav nav-pills nav-justified" role="tablist">
                                    @foreach(active_langs() as $lan)
                                    <li class="nav-item waves-effect waves-light">
                                        <a class="nav-link @if($loop->first) active @endif" data-bs-toggle="tab" href="#{{ $lan->code }}" role="tab" aria-selected="true">
                                            <span class="d-block d-sm-none"><i class="fas fa-flag">&nbsp; {{ $lan->code }}</i></span>
                                            <span class="d-none d-sm-block">{{ $lan->name }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="tab-content p-3 text-muted">
                                    @foreach(active_langs() as $lan)
                                    <div class="tab-pane @if($loop->first) active show @endif" id="{{ $lan->code }}" role="tabpanel">
                                        <div class="form-group row">
                                            <div class="mb-3">
                                                <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                                <input name="name[{{ $lan->code }}]" type="text" class="form-control" required="" value="{{ $category->translate($lan->code)->name }}">
                                                <div class="valid-feedback">
                                                    @lang('backend.name') @lang('messages.is-correct')
                                                </div>
                                                <div class="invalid-feedback">
                                                    @lang('backend.name') @lang('messages.not-correct')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="mb-3">
                                        <label>@lang('backend.slug') <span class="text-danger">*</span></label>
                                        <input name="slug" type="text" class="form-control" required="" value="{{ $category->slug }}">
                                        <div class="valid-feedback">
                                            @lang('backend.slug') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.slug') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-5 text-center">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                        @lang('backend.submit')
                                    </button>
                                    <a href="{{ url()->previous() }}" type="button" class="btn btn-secondary waves-effect">
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
@endsection
