@extends('master.backend')
@section('title',__('backend.tags'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <h4 class="card-title">@lang('backend.add-meta-tags'):</h4>
                                    <a href="{{ route('backend.seo.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> &nbsp;@lang('backend.add-new')
                                    </a>
                                </div>
                            </div>
                            <p class="card-title-desc">
                            <div class="alert alert-secondary" role="alert">
                                < meta name(attribute)=keywords(attribute_name) content="example(content)">
                            </div>
                            </p>
                            <div id="accordion" class="custom-accordion">
                                @foreach($metaTags as $tag)
                                <div class="card mb-1 shadow-none">
                                    <a href="#Collapse{{$tag->id}}" class="text-dark collapsed" data-bs-toggle="collapse" aria-expanded="false" aria-controls="Collapse{{ $tag->id }}">
                                        <div class="card-header" id="headingOne">
                                            <h6 class="m-0">
                                                #{{ $tag->attribute_name }}
                                                <i class="mdi mdi-minus float-end accor-plus-icon"></i>
                                            </h6>
                                        </div>
                                    </a>
                                    <div id="Collapse{{$tag->id}}" class="collapse" aria-labelledby="headingOne" data-bs-parent="#accordion" style="">
                                        <div class="card-body">
                                            <form method="POST" class="needs-validation" novalidate action="{{ route('backend.seo.update',$tag->id) }}" enctype="multipart/form-data">
                                                @method('PUT')
                                                @csrf
                                                <div class="mb-3">
                                                    <label>@lang('backend.att') <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input name="attribute" type="text" class="form-control" required=""  value="{{ $tag->attribute }}">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>@lang('backend.att-name') <span class="text-danger">*</span></label>
                                                    <div>
                                                        <input name="attribute_name" type="text" class="form-control" required=""  value="{{ $tag->attribute_name }}">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label>@lang('backend.content') <span class="text-danger">*</span></label>
                                                    <div>
                                                        <textarea name="content1" type="text" class="form-control" required="" rows="5" >{{ $tag->content }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-5 text-center">
                                                    <div>
                                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                            @lang('backend.submit')
                                                        </button>
                                                        <a style="margin-right: 0.25rem!important;" class="btn btn-danger" href="{{ route('backend.delSeo',$tag->id) }}"><i class="fas fa-trash"></i>
                                                        </a>
                                                        <a style="margin-right: 0.25rem!important;" href="{{ route('backend.seoStatus',['id'=>$tag->id]) }}" class="btn btn-{{ $tag->status == 1 ? 'success' : 'secondary' }}">{{ $tag->status == 1 ? __('backend.active') : __('backend.deactive') }}</a>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
