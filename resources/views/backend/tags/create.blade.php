@extends('master.backend')
@section('title',__('backend.tags'))
@section('content')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@lang('backend.add-new')</h4>
                                </div>
                            </div>
                            <form action="{{ route('backend.seo.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>@lang('backend.att') <span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" name="attribute" class="form-control" required=""  placeholder="<meta NAME=">
                                     </div>
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.att-name') <span class="text-danger">*</span></label>
                                    <div>
                                        <input type="text" name="attribute_name" class="form-control" required=""  placeholder="<meta name=KEYWORDS">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.content') <span class="text-danger">*</span></label>
                                    <div>
                                        <textarea type="text" name="content1" class="form-control" required=""  placeholder="<meta name=keywords content=DXC Example"></textarea>
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
