@extends('master.backend')
@section('title',__('backend.permissions'))
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
                                    <h4 class="mb-sm-0">@lang('backend.permissions'):</h4>
                                </div>
                            </div>
                            <form action="{{ route('backend.permissions.store') }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control" required="" placeholder="permissions index">
                                   {!! validation_response('backend.name') !!}
                                </div>
                                <div class="mb-3">
                                    <label>@lang('backend.guard-name') <span class="text-danger">*</span></label>
                                    <select name="guardName" class="form-control">
                                        <option value="admin">Admin</option>
                                        <option value="web">Web</option>
                                    </select>
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
