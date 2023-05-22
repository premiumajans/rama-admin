<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('backend.includes.meta')
    @include('backend.includes.styles')
</head>

<body class="auth-body-bg">
<div class="bg-overlay"></div>
<div class="my-5 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <div class="ex-page-content text-center">
                            <h1>404!</h1>
                            <h3>@lang('messages.404')</h3><br>
                            <a class="btn btn-info mb-5 waves-effect waves-light" href="{{ route('backend.index') }}">@lang('backend.dashboard')</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.includes.scripts')
</body>
</html>
