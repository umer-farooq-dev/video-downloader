<div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
    <div class="ms-md-auto pe-md-3 d-flex align-items-center"></div>
    <ul class="navbar-nav justify-content-end">

        <!-- Begin:Lang Menu -->
        @php
            $mobileLangMenu = '';
        @endphp

        <li class="nav-item dropdown pe-4 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                 <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" class="lang-menu me-1 my-auto">
                 <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1">
            </a>

            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">
                @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
                    <li class="mb-2">
                      <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $localeCode }}" href="{{ localization()->getLocalizedURL($localeCode, null, [], true) }}">
                        <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                      </a>
                    </li>
                @endforeach
            </ul>
        </li>
        <!-- End:Lang Menu -->

        <li class="nav-item dropdown pe-2 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-user cursor-pointer"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton">

                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('profile') }}">
                        <div class="d-flex py-1">
                            <h6 class="text-sm font-weight-normal mb-1">{{ __('Profile') }}</h6>
                        </div>
                    </a>
                </li>

                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('home') }}" target="_blank">
                        <div class="d-flex py-1">
                            <h6 class="text-sm font-weight-normal mb-1">{{ __('Go to Website') }}</h6>
                        </div>
                    </a>
                </li>

                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="https://codecanyon.net/user/themeluxury"  target="_blank">
                        <div class="d-flex py-1">
                            <h6 class="text-sm font-weight-normal mb-1">{{ __('Get Support') }}</h6>
                        </div>
                    </a>
                </li>

                <li class="mb-2">
                    <a class="dropdown-item border-radius-md" href="{{ route('logout') }}">
                        <div class="d-flex py-1">
                            <h6 class="text-sm font-weight-normal mb-1">{{ __('Logout') }}</h6>
                        </div>
                    </a>
                </li>

            </ul>
        </li>

        <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                    <i class="sidenav-toggler-line"></i>
                </div>
            </a>
        </li>
    </ul>
</div>
