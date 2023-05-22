@extends('master.frontend')
@section('front')
    <section class="error-404 section-padding pb-5">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="error-block ">
                        <div class="throw-code">
                            <h2>
                                404
                            </h2>
                        </div>
                        <div class="error-info">
                            <h2 class="mb-2">@lang('messages.404')!</h2>
                            <a href="{{ route('login') }}">@lang('backend.back-to-home')<i
                                    class="fa fa-angle-double-right ml-2"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="broken-img mt-5 mt-3  d-flex justify-content-center align-items-center">
                        <img src="{{asset('frontend/images/broken.png')}}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
