@extends('master.backend')
@section('title',__('backend.informations'))
@section('content')
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid ">
                <div class="row justify-content-center">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@lang('backend.informations'):</h4>
                                </div>
                                <form action="{{ route('backend.informations.update',auth()->user()->id) }}"
                                      method="POST" class="needs-validation" novalidate=""
                                      enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="mb-3">
                                        <label>@lang('backend.name') <span class="text-danger">*</span></label>
                                        <input type="text" id="validationCustom" name="name" class="form-control"
                                               required="" value="{{ auth()->user()->name }}">
                                        <div class="valid-feedback">
                                            @lang('backend.name') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.name') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.email') <span class="text-danger">*</span></label>
                                        <input type="text" id="validationCustom" class="form-control" name="email"
                                               required="" value="{{ auth()->user()->email }}">
                                        <div class="valid-feedback">
                                            @lang('backend.email') @lang('messages.is-correct')
                                        </div>
                                        <div class="invalid-feedback">
                                            @lang('backend.email') @lang('messages.not-correct')
                                        </div>
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
                                                @lang('backend.cancel')
                                            </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-7 ">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0">@lang('backend.change-password'):</h4>
                                </div>
                                <form action="{{ route('backend.informations.store') }}" method="POST"
                                      class="needs-validation" novalidate enctype="multipart/form-data">
                                    @csrf
                                    <input hidden name="id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                                    <div class="mb-3">
                                        <label>@lang('backend.current-password') <span
                                                class="text-danger">*</span></label>
                                        <div class="input-group" id="datepicker1">
                                            <input type="password" name="current_password" class="form-control"
                                                   required="">
                                            <span id="show_current_password" class="input-group-text"><i
                                                    id="show_current_icon" class="fas fa-eye"></i></span>
                                        </div>
                                        {!! validation_response('backend.current-password') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.new-password') <span class="text-danger">*</span></label>
                                        <div class="input-group" id="datepicker1">
                                            <input id="password" type="password" name="password" class="form-control"
                                                   required="">
                                            <span id="show_password" class="input-group-text"><i id="show_icon"
                                                                                                 class="fas fa-eye"></i></span>
                                            <span id="generate_password" class="input-group-text"><i
                                                                              class="fas fa-key"></i></span>
                                        </div>
                                        {!! validation_response('backend.new-password') !!}
                                    </div>
                                    <div class="mb-3">
                                        <label>@lang('backend.cnew-password') <span class="text-danger">*</span></label>
                                        <div class="input-group" id="datepicker1">
                                            <input type="password" id="password_confirmation"
                                                   name="password_confirmation" class="form-control"
                                                   data-parsley-equalto="#pass2" required="">
                                        </div>
                                        {!! validation_response('backend.cnew-password') !!}
                                    </div>
                                    <div class="mb-0 text-center">
                                        <div>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                                @lang('backend.submit')
                                            </button>
                                            <a href="{{url()->previous()}}" type="button"
                                               class="btn btn-secondary waves-effect">
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
@section('scripts')
    <script src="{{ asset('backend/js/auth.js') }}"></script>
@endsection
