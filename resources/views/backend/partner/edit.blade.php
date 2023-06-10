@extends('master.backend')
@section('title',__('backend.partner'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-xl-9">
                        <div class="card">
                            <form action="{{ route('backend.partner.update',$id) }}" class="needs-validation" novalidate
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    @include('backend.templates.components.card-col-12',['variable' => 'partner'])
                                    <div class="mb-3">
                                        <label>@lang('backend.photo')</label>
                                        <input name="photo" type="file"
                                               class="form-control">
                                        @if(file_exists($partner->photo))
                                            <img class="mt-2" src="{{ asset($partner->photo) }}" width="100%">
                                        @endif
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.link') <span class="text-danger">*</span></label>
                                        <input name="link" type="url"
                                               class="form-control" value="{{ $partner->link }}">
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
