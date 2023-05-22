<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <div class="navbar-brand-box">
                <a href="" class="logo logo-light">
                     <span class="logo-sm justify-content-center">
                         <img src="{{asset('backend/images/favicon-admin.png')}}" alt="logo-sm-light" height="30">
                     </span>
                    <span class="logo-lg justify-content-center">
                        <img src="{{ asset('backend/images/logo-w.png') }}" alt="logo-light" height="50">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">
            <div class="dropdown d-sm-inline-block">
                <button type="button" class="btn header-item waves-effect"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    @if(app()->getLocale() == 'en')
                        <img class="" src="{{ asset('backend/images/flags/en.jpg')}}" height="16">
                    @elseif(app()->getLocale() == 'az')
                        <img class="" src="{{ asset('backend/images/flags/az.png')}}" height="16">
                    @else
                        <img class="" src="{{ asset('backend/images/flags/ru.jpg')}}" height="16">
                    @endif
                </button>
                <div class="dropdown-menu dropdown-menu-end">

                    <a href="{{ route('backend.switchLang','az') }}" class="dropdown-item notify-item">
                        <img src="{{ asset('backend/images/flags/az.png')}}" class="me-1" height="12">
                        <span class="align-middle">Azərbaycan</span>
                    </a>
                    <a href="{{ route('backend.switchLang','en') }}" class="dropdown-item notify-item">
                        <img src="{{ asset('backend/images/flags/en.jpg')}}" class="me-1" height="12">
                        <span class="align-middle">English</span>
                    </a>
                    <a href="{{ route('backend.switchLang','ru') }}" class="dropdown-item notify-item">
                        <img src="{{ asset('backend/images/flags/ru.jpg')}}" class="me-1" height="12">
                        <span class="align-middle">Русский</span>
                    </a>
                </div>
            </div>
            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <img class="rounded-circle header-profile-user"
                         src="{{ Avatar::create(\Illuminate\Support\Facades\Auth::user()->name)->toBase64(); }}"
                         alt="Header Avatar">
                    <span class="d-xl-inline-block ms-1 ">{{ auth()->user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu">
                    <a href="{{ route('logout') }}" type="submit" class="dropdown-item text-danger">
                        <i class="ri-shut-down-line align-middle me-1 text-danger"></i>
                        @lang('backend.logout')
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
