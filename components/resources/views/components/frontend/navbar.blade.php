<div class="container position-sticky z-index-sticky @if ($header->sticky_header) top-0 @endif">
  <div class="row">
    <div class="col-12">

      <!-- Begin::Navbar -->
      <nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-fixed shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
        <div class="container-fluid">
          <a class="navbar-brand font-weight-bolder ms-sm-3" title="{{ __($homeTitle) }}" href="{{ route('home') }}">
            @if ( !empty($header->logo) )
              <div class="logo-image">
                <img src="{{ $header->logo }}">
              </div>
            @else
              {{ $homeTitle }}
            @endif
          </a>
          <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon mt-2">
              <span class="navbar-toggler-bar bar1"></span>
              <span class="navbar-toggler-bar bar2"></span>
              <span class="navbar-toggler-bar bar3"></span>
            </span>
          </button>

          <div class="collapse navbar-collapse pt-3 pb-2 py-lg-0 w-100 justify-content-center justify-content-md-end align-items-center align-items-md-end" id="navigation">

            <ul class="navbar-nav navbar-nav-hover">

                <!-- Begin:Lang Menu -->
                @if ( $general->language_switcher == true )

                  @php
                    $mobileLangMenu = '';
                  @endphp

                  <li class="nav-item dropdown dropdown-hover mx-2 my-auto">
                     <a class="nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center" id="navbarDropdownMenuLang" data-bs-toggle="dropdown" aria-expanded="false">
                     <img src="{{ asset('assets/img/flags/' . localization()->getCurrentLocale() . '.svg') }}" class="lang-menu me-1 my-auto"> 
                     {{ localization()->getCurrentLocaleNative() }}
                     <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1">
                     </a>
                     <ul class="dropdown-menu dropdown-menu-animation p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="navbarDropdownMenuLang">
                        <div class="d-none d-lg-block">
                           @foreach(localization()->getSupportedLocales() as $localeCode => $properties)

                            @php
                              $mobileLangMenu .='<h6 class="dropdown-header text-dark font-weight-bolder px-0">
                                      <img src="'.asset('assets/img/flags/' . $properties->key() . '.svg').'" class="lang-menu me-1 my-auto"> 
                                      <a href="'. url('/') . '/' .  $properties->key() .'">'.$properties->native().'</a>
                                     </h6>';
                            @endphp

                           <li class="nav-item dropdown dropdown-hover dropdown-subitem">
                              <a class="dropdown-item border-radius-md mb-1" rel="alternate" hreflang="{{ $properties->key() }}" href="{{ url('/') . '/' .  $properties->key() }}">
                                <img src="{{ asset('assets/img/flags/' . $properties->key() . '.svg') }}" class="lang-menu me-1 my-auto"> {{ $properties->native() }}
                              </a>
                           </li>
                           @endforeach
                        </div>

                        <div class="row d-lg-none">
                          <div class="col-12 d-flex justify-content-center flex-column">

                            {!! GrahamCampbell\Security\Facades\Security::clean($mobileLangMenu) !!}

                          </div>
                        </div>

                     </ul>
                  </li>
                  
                @endif
                <!-- End:Lang Menu -->
                
                @foreach($menus as $key => $value)

                  @if( count($value['children']) )
                    <li class="nav-item dropdown dropdown-hover mx-2">
                        <a class="{{ ($value['type'] == 'button') ? 'btn btn-sm btn-round text-capitalize mb-lg-0 me-1 ' . $value['class'] : 'nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center' }}" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}" id="navbarDropdownMenuLink{{ $key }}" data-bs-toggle="dropdown" aria-expanded="false">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} fa-fw"></i>
                           @endif
                           {{ __($value['text']) }}
                           <img src="{{ asset('assets/img/down-arrow-dark.svg') }}" alt="down-arrow" class="arrow ms-1">
                        </a>
                        <x-frontend.menu :childs="$value['children']" />
                    </li>

                  @else
                    <li class="nav-item mx-2 my-auto">
                        <a class="{{ ($value['type'] == 'button') ? 'btn btn-sm btn-round text-capitalize mb-lg-0 me-1 ' . $value['class'] : 'nav-link ps-2 d-flex justify-content-between cursor-pointer align-items-center' }}" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">
                           @if ( !empty($value['icon']) )
                             <i class="{{ $value['icon'] }} fa-fw"></i>
                           @endif
                          {{ __($value['text']) }}
                        </a>
                    </li>
                  @endif

                @endforeach

            </ul>
          </div>
        </div>
      </nav>
      <!-- End::Navbar -->
    </div>
  </div>
</div>
