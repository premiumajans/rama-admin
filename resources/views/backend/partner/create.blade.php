@extends('master.backend')
@section('title',__('backend.partner'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.partner.store') }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    @include('backend.templates.components.card-col-12',['variable' => 'partner'])
                                    @include('backend.templates.items.create.validations.photo')
                                    <div class="mb-3">
                                        <label>@lang('backend.link') <span class="text-danger">*</span></label>
                                        <input name="link" type="url"
                                               class="form-control" placeholder="@lang('backend.link')">
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
