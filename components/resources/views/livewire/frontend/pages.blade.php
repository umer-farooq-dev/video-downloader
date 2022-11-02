<div>

    <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

        @if ( $page->type == '404' )
        
          <x-frontend.404 :pageTrans="$pageTrans" />
          
        @elseif ( $page->type == 'login' )

          <section>
            <div class="page-header min-vh-100">
              <div class="container">
                <div class="row">
                  <div class="col-xl-4 col-lg-5 col-md-7 d-flex flex-column mx-lg-0 mx-auto">
                    <div class="card card-plain">
                      <div class="card-header pb-0 text-start">
                        <h4 class="font-weight-bolder">{{ __('Sign In') }}</h4>
                        <p class="mb-0">{{ __('Enter your email and password to sign in') }}</p>
                      </div>

                      <div class="card-body">

                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-4" :errors="$errors" />

                        <form wire:submit.prevent="onLogin">
              
                          <div class="mb-3">
                            <input class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="{{ __('Email') }}" type="email" wire:model="email" required autofocus />
                          </div>
                          <div class="mb-3">
                            <input class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}" type="password" wire:model="password" required />
                          </div>
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" wire:model="remember_me" id="remember_me">
                            <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
                          </div>
                          <div class="text-center">
                            <button class="btn btn-lg bg-gradient-primary btn-lg w-100 mt-4 mb-0">
                              <div wire:loading wire:target="onLogin">
                                <x-loading />
                              </div>
                              {{ __('Sign In') }}</button>
                          </div>
                        </form>

                      </div>
                    </div>
                  </div>

                  <div class="col-6 d-lg-flex d-none h-100 my-auto pe-0 position-absolute top-0 end-0 text-center justify-content-center flex-column">
                    <div class="position-relative bg-gradient-primary h-100 m-3 px-7 border-radius-lg d-flex flex-column justify-content-center">
                      <img src="{{ asset('assets/img/shapes/pattern-lines.svg') }}" alt="pattern-lines" class="position-absolute opacity-4 start-0">
                      <div class="position-relative">
                        <img class="max-width-500 w-100 position-relative z-index-2" src="{{ asset('assets/img/illustrations/chat.png') }}">
                      </div>
                      <h4 class="mt-5 text-white font-weight-bolder">{{ __('Welcome back!') }}</h4>
                      <p class="text-white">{{ __('Login with your email address and password to keep connected with us.') }}</p>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </section>
      
        @else

          <header class="header-2">

            <div class="page-header min-vh-75 relative">
                <div class="img-fluid shadow overlay-preview" style="
                  @if ( $general->overlay_type == 'solid' )

                  background: {{ $general->solid_color }};opacity: {{ $general->opacity }};

                  @elseif( $general->overlay_type == 'gradient' )

                  background: {{ $general->gradient_first_color }};
                  background: -moz-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }}  );
                  background: -webkit-linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                  background: linear-gradient( {{ $general->gradient_position }}, {{ $general->gradient_first_color }}, {{ $general->gradient_second_color }} );
                  opacity: {{ $general->opacity }};

                  @endif

                "></div>

              @if ( !empty($general->parallax_image) )
                <img class="position-absolute start-0 top-0 w-100 parallax-image" src="{{ $general->parallax_image }}" alt="Parallax Image" style="filter: blur({{ $general->blur }}px);">
              @else
                <img class="position-absolute start-0 top-0 w-100 parallax-image" src="{{ asset('assets/img/home-background.jpg') }}" alt="Parallax Image" style="filter: blur({{ $general->blur }}px);">
              @endif
              
              <div class="container">
                <div class="row">

                  <div class="col-lg-7 text-center mx-auto">
                    <h1 class="text-white">{{ __($pageTrans->title) }}</h1>
                    <h2 class="lead text-white letter-normal my-3">{{ __($pageTrans->subtitle) }}</h2>
                  </div>

                  @if ( $page->ads_status == true && $advertisement->area1_status == true && $advertisement->area1 != null )
                    <x-frontend.advertisement.area1 :advertisement="$advertisement" />
                  @endif

                  @if ( $page->type == 'downloader' || $page->type == 'home' )

                    <form wire:submit.prevent="onDownload" id="formDownload">

                      <div class="col-lg-8 z-index-2 border-radius-xl mx-auto py-3">

                        <div class="row bg-white shadow border-radius-md py-3 p-2 position-relative">
                          <div class="col-12 col-lg-10 mb-lg-0 mb-2">
                            <div class="input-group">
                              <input type="text" class="form-control form-control-lg" id="link" wire:model="link" placeholder="{{ __('Paste the URL here to start downloading...') }}" required>
                              <span class="input-group-text">
                                <button type="button" id="paste" class="btn-tooltip mb-0 border-0 bg-white text-dark" wire:ignore>
                                  <i class="far fa-clipboard fa-lg"></i>
                                </button>
                              </span>
                            </div>
                          </div>

                          <div class="col-12 col-lg-2 ps-lg-0">
                            <button class="btn bg-gradient-primary w-100 mb-0 h-100 position-relative z-index-2 p-lg-0">
                              <span>
                                <div wire:loading.inline wire:target="onDownload">
                                  <x-loading />
                                </div>
                                <span wire:target="onDownload" class="text-capitalize btn-download">{{ __('Download') }}</span>
                              </span>
                            </button>
                          </div>
                        </div>

                      </div>
                    </form>

                    <div class="text-center h-0" wire:loading wire:target="onDownload">
                        <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
                    </div>

                    <div class="col-lg-8 mx-auto">
                      <!-- Session Status -->
                      <x-auth-session-status class="mb-4" :status="session('status')" />

                      <!-- Validation Errors -->
                      <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    </div>

                   @endif

                  @if ( $page->ads_status == true && $advertisement->area2_status == true && $advertisement->area2 != null )
                    <x-frontend.advertisement.area2 :advertisement="$advertisement" />
                  @endif

                </div>
              </div>

              @if ( $general->wave_animation_status == true)

                <div class="position-absolute w-100 z-index-1 bottom-0">
                  <svg class="waves" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
                    <defs>
                      <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
                    </defs>
                    <g class="moving-waves">
                      <use xlink:href="#gentle-wave" x="48" y="-1" fill="rgba(255,255,255,0.40" />
                      <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.35)" />
                      <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.25)" />
                      <use xlink:href="#gentle-wave" x="48" y="8" fill="rgba(255,255,255,0.20)" />
                      <use xlink:href="#gentle-wave" x="48" y="13" fill="rgba(255,255,255,0.15)" />
                      <use xlink:href="#gentle-wave" x="48" y="16" fill="rgba(255,255,255,0.95" />
                    </g>
                  </svg>
                </div>

              @endif

            </div>
          </header>

          @if ( !empty($data) )
          
            <section id="download-box" class="pt-3 pb-4" wire:loading.remove wire:target="onDownload">
              <div class="container">

                <div class="row">
                  <div class="col-lg-9 z-index-2 border-radius-xl mt-n10 mx-auto py-3 blur shadow-blur">
                    <div class="row">

                      <div class="col-md-4 position-relative">

                        <div class="p-3">
                          <div class="card-header p-0 position-relative z-index-1">
                            <a href="javascript:;" class="d-block">

                              @if ( !empty( $data['thumbnail'] ) )

                                <img src="{{ $data['thumbnail'] }}" class="w-100 border-radius-lg shadow">

                              @else
                                <img src="{{ asset('assets/img/no-thumb.jpg') }}" class="w-100 border-radius-lg shadow">
                              @endif
                              
                            </a>
                          </div>

                          @if ( !empty( $data['title'] ) )

                            <h6 class="mt-3">{{ $data['title'] }}</h6>

                          @endif

                          @if ( !empty( $data['duration'] ) )
                            <p class="text-sm">{{ __('Duration') }}: {{ $data['duration'] }}</p>
                          @endif
                        
                            @if ( $general->share_icons_status == true )

                              <div class="social-share">
                                <div class="share-icons-sm relative">

                                    <a wire:ignore href="https://www.facebook.com/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                        onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','facebook','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                        data-label="Facebook"
                                        rel="noopener noreferrer nofollow"
                                        target="_blank"
                                        class="btn btn-facebook btn-simple rounded p-2">
                                        <i class="fab fa-facebook"></i>
                                    </a>

                                    <a wire:ignore href="https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                        onclick="window.open('https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','twitter','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                        rel="noopener noreferrer nofollow"
                                        target="_blank"
                                        class="btn btn-twitter btn-simple rounded p-2">
                                        <i class="fab fa-twitter"></i>
                                    </a>

                                    <a wire:ignore href="https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}" wire:ignore
                                        onclick="window.open('https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}','pinterest','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                        rel="noopener noreferrer nofollow"
                                        target="_blank"
                                        class="btn btn-pinterest btn-simple rounded p-2">
                                        <i class="fab fa-pinterest"></i>
                                    </a>

                                    <a wire:ignore href="https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                        onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','linkedin','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                        rel="noopener noreferrer nofollow"
                                        target="_blank"
                                        class="btn btn-linkedin btn-simple rounded p-2">
                                        <i class="fab fa-linkedin"></i>
                                    </a>

                                    <a wire:ignore href="https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                        onclick="window.open('https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}','reddit','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                        rel="noopener noreferrer nofollow"
                                        target="_blank"
                                        class="btn btn-reddit btn-simple rounded p-2">
                                        <i class="fab fa-reddit"></i>
                                    </a>

                                    <a wire:ignore href="https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                        onclick="window.open('https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','tumblr','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                        target="_blank"
                                        class="btn btn-tumblr btn-simple rounded p-2"
                                        rel="noopener noreferrer nofollow">
                                        <i class="fab fa-tumblr"></i>
                                    </a>

                                </div>
                              </div>
                            @endif
                          </div>

                        <hr class="vertical dark">
                      </div>

                      <div class="col-md-8 position-relative">
                        <div class="p-3">

                          @if ( !empty( $data['links'] ) )

                            
                            <ul class="nav nav-pills nav-fill p-1 rounded-bottom-0" role="tablist">

                                @switch( $data['source'] )

                                    @case('SoundCloud')
                                          <li class="nav-item">
                                              <a class="nav-link mb-0 px-0 py-1 active" href="javascript:;" id="audio-tab" data-bs-toggle="tab" data-bs-target="#audio">
                                                  <span class="ms-1">{{ __('Audio') }}</span>
                                              </a>
                                          </li>
                                        @break

                                    @case('Youtube')
                                          <li class="nav-item">
                                              <a class="nav-link mb-0 px-0 py-1 active" href="javascript:;" id="video-tab" data-bs-toggle="tab" data-bs-target="#video">
                                                  <span class="ms-1">{{ __('Video') }}</span>
                                              </a>
                                          </li>

                                          <li class="nav-item">
                                              <a class="nav-link mb-0 px-0 py-1" href="javascript:;" id="video-without-sound-tab" data-bs-toggle="tab" data-bs-target="#video-without-sound">
                                                  <span class="ms-1">{{ __('Video without Sound') }}</span>
                                              </a>
                                          </li>

                                          <li class="nav-item">
                                              <a class="nav-link mb-0 px-0 py-1" href="javascript:;" id="audio-tab" data-bs-toggle="tab" data-bs-target="#audio">
                                                  <span class="ms-1">{{ __('Audio') }}</span>
                                              </a>
                                          </li>
                                        @break

                                    @case('TikTok')
                                          <li class="nav-item">
                                              <a class="nav-link mb-0 px-0 py-1 active" href="javascript:;" id="video-tab" data-bs-toggle="tab" data-bs-target="#video">
                                                  <span class="ms-1">{{ __('Video') }}</span>
                                              </a>
                                          </li>

                                          <li class="nav-item">
                                              <a class="nav-link mb-0 px-0 py-1" href="javascript:;" id="audio-tab" data-bs-toggle="tab" data-bs-target="#audio">
                                                  <span class="ms-1">{{ __('Audio') }}</span>
                                              </a>
                                          </li>
                                        @break

                                    @default
                                        <li class="nav-item">
                                            <a class="nav-link mb-0 px-0 py-1 active" href="javascript:;" id="video-tab" data-bs-toggle="tab" data-bs-target="#video">
                                                <span class="ms-1">{{ __('Download Information') }}</span>
                                            </a>
                                        </li>
                                @endswitch

                            </ul>

                            <div class="tab-content">

                                <div class="card h-100 tab-pane fade {{ ($data['source'] != 'SoundCloud') ? 'active show' : '' }} rounded-top-0" id="video" role="tabpanel" aria-labelledby="video-tab">
                                    <div class="card-body table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>{{ __('Resolution') }}</th>
                                                    <th>{{ __('Size') }}</th>
                                                    <th>{{ __('Download') }}</th>
                                                </tr>                                          

                                                @foreach ($data['links'] as $key => $value)
                                                  
                                                  @if ( ($value['type'] === "mp4" && $value['mute'] === false) || $value['type'] === "jpg" )
                                                    
                                                    <tr>
                                                      <td class="align-middle py-4">

                                                          @if ( !empty( $value['quality'] ) )
                                                            <span class="d-block">
                                                              {{ $value['quality'] }} (.{{ ($value['type'] == 'progressive') ? 'mp3' : $value['type'] }})

                                                              @switch( $value['quality'] )
                                                                  @case('4320p')
                                                                  @case('4320p50')
                                                                  @case('4320p60')
                                                                  @case('4320P')
                                                                  @case('4320P50')
                                                                  @case('4320P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('8K') }}</span>
                                                                    @break

                                                                  @case('2880p')
                                                                  @case('2880p50')
                                                                  @case('2880p60')
                                                                  @case('2880P')
                                                                  @case('2880P50')
                                                                  @case('2880P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('5K') }}</span>
                                                                    @break

                                                                  @case('2160p')
                                                                  @case('2160p50')
                                                                  @case('2160p60')
                                                                  @case('2160P')
                                                                  @case('2160P50')
                                                                  @case('2160P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('4K') }}</span>
                                                                    @break

                                                                  @case('1440p')
                                                                  @case('1440p50')
                                                                  @case('1440p60')
                                                                  @case('1440P')
                                                                  @case('1440P50')
                                                                  @case('1440P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('2K') }}</span>
                                                                    @break

                                                                  @case('1080p')
                                                                  @case('1080p50')
                                                                  @case('1080p60')
                                                                  @case('1080P')
                                                                  @case('1080P50')
                                                                  @case('1080P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('Full HD') }}</span>
                                                                    @break

                                                                  @case('720p')
                                                                  @case('720p50')
                                                                  @case('720p60')
                                                                  @case('720P')
                                                                  @case('720P50')
                                                                  @case('720P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('HD') }}</span>
                                                                    @break

                                                                  @default
                                                              @endswitch

                                                              @if ( !empty($value['watermark']) && $value['watermark'] == true )
                                                                <span class="badge bg-gradient-success">{{ __('No Watermark') }}</span>
                                                              @endif

                                                            </span>
                                                          @endif

                                                      </td>
                                                      <td class="align-middle">
                                                            @if ( $value['size'] != 0 )
                                                              <span class="d-block">{{ $value['size'] }}</span>
                                                            @endif
                                                      </td>

                                                      <td class="align-middle">
                                                          <a class="btn bg-gradient-success mb-0" href="{{ $value['url'] }}" title="{{ __('Download') }}" onclick="window.location.href='{{ $value['filename'] }}.{{ $value['type'] }}'">
                                                            <span class="d-block"><i class="fas fa-download fa-fw"></i> {{ __('Download') }}</span>
                                                          </a>
                                                      </td>

                                                    </tr>

                                                  @endif

                                                @endforeach                                               

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            
                                <div class="card h-100 tab-pane fade rounded-top-0" id="video-without-sound" role="tabpanel" aria-labelledby="video-without-sound-tab">
                                    <div class="card-body table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>{{ __('Resolution') }}</th>
                                                    <th>{{ __('Size') }}</th>
                                                    <th>{{ __('Download') }}</th>
                                                </tr>                                          

                                                @foreach ($data['links'] as $key => $value)
                                                  @if ( ($data['source'] === 'Youtube' && $value['mute'] === true) || ($value['type'] === "mp4" && $value['mute'] === true) )
                                                    <tr>
                                                      <td class="align-middle py-4">

                                                          @if ( !empty( $value['quality'] ) )
                                                            <span class="d-block">
                                                              {{ $value['quality'] }} (.{{ ($value['type'] == 'progressive') ? 'mp3' : $value['type'] }})

                                                              @switch( $value['quality'] )
                                                                  @case('4320p')
                                                                  @case('4320p50')
                                                                  @case('4320p60')
                                                                  @case('4320P')
                                                                  @case('4320P50')
                                                                  @case('4320P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('8K') }}</span>
                                                                    @break

                                                                 @case('2880p')
                                                                  @case('2880p50')
                                                                  @case('2880p60')
                                                                  @case('2880P')
                                                                  @case('2880P50')
                                                                  @case('2880P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('5K') }}</span>
                                                                    @break

                                                                  @case('2160p')
                                                                  @case('2160p50')
                                                                  @case('2160p60')
                                                                  @case('2160P')
                                                                  @case('2160P50')
                                                                  @case('2160P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('4K') }}</span>
                                                                    @break

                                                                  @case('1440p')
                                                                  @case('1440p50')
                                                                  @case('1440p60')
                                                                  @case('1440P')
                                                                  @case('1440P50')
                                                                  @case('1440P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('2K') }}</span>
                                                                    @break

                                                                  @case('1080p')
                                                                  @case('1080p50')
                                                                  @case('1080p60')
                                                                  @case('1080P')
                                                                  @case('1080P50')
                                                                  @case('1080P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('Full HD') }}</span>
                                                                    @break

                                                                  @case('720p')
                                                                  @case('720p50')
                                                                  @case('720p60')
                                                                  @case('720P')
                                                                  @case('720P50')
                                                                  @case('720P60')
                                                                      <span class="badge bg-gradient-danger">{{ __('HD') }}</span>
                                                                    @break

                                                                  @default
                                                              @endswitch

                                                            </span>
                                                          @endif

                                                      </td>
                                                      <td class="align-middle">
                                                            @if ( $value['size'] != 0 )
                                                              <span class="d-block">{{ $value['size'] }}</span>
                                                            @endif
                                                      </td>

                                                      <td class="align-middle">
                                                          <a class="btn bg-gradient-success mb-0" href="{{ $value['url'] }}" title="{{ __('Download') }}" onclick="window.location.href='{{ $value['filename'] }}.{{ $value['type'] }}'">
                                                            <span class="d-block"><i class="fas fa-download fa-fw"></i> {{ __('Download') }}</span>
                                                          </a>
                                                      </td>

                                                    </tr>
                                                  @endif
                                                @endforeach                                               

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="card h-100 tab-pane fade {{ ($data['source'] == 'SoundCloud') ? 'active show' : '' }} rounded-top-0" id="audio" role="tabpanel" aria-labelledby="audio-tab">
                                    <div class="card-body table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <th>{{ __('Resolution') }}</th>
                                                    <th>{{ __('Size') }}</th>
                                                    <th>{{ __('Download') }}</th>
                                                </tr>                                          

                                                @foreach ($data['links'] as $key => $value)
                                                  @if ( !empty( $value['type'] ) && ( $value['type'] == 'mp3' || $value['type'] == 'm4a' || $value['type'] == 'hls' || preg_match('/.*kbps.*/', $value['quality'], $matches) ) )
                                                    <tr>
                                                      <td class="align-middle py-4">

                                                          @if ( !empty( $value['quality'] ) )
                                                            <span class="d-block">
                                                              {{ $value['quality'] }} (.{{ ($value['type'] == 'progressive') ? 'mp3' : $value['type'] }})
                                                            </span>
                                                          @endif

                                                      </td>
                                                      <td class="align-middle">
                                                            @if ( $value['size'] != 0 )
                                                              <span class="d-block">{{ $value['size'] }}</span>
                                                            @endif
                                                      </td>

                                                      <td class="align-middle">
                                                            <a class="btn bg-gradient-success mb-0" href="{{ $value['url'] }}" title="{{ __('Download') }}" onclick="window.location.href='{{ $value['filename'] }}.{{ $value['type'] }}'">
                                                              <span class="d-block"><i class="fas fa-download fa-fw"></i> {{ __('Download') }}</span>
                                                            </a>
                                                      </td>

                                                    </tr>
                                                  @endif
                                                @endforeach                                               

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>

                          @else

                            <div class="alert alert-danger" role="alert">
                                {{ __('No data found!') }}
                            </div>

                          @endif

                        </div>
                      </div>

                    </div>
                  </div>
                </div>

              </div>
            </section>

          @endif

          @if ( $general->supported_sites == true && !empty($supported_sites) && ( $page->type == 'downloader' || $page->type == 'home' ) )
            <section class="my-3">
              <div class="container">
                <div class="row">
                  <div class="info-horizontal bg-gray-100 border-radius-xl p-4">
                    <h5 class="text-center text-gradient text-dark">{{ __('Supported Resources') }}</h5>
                    <div class="is-divider"></div>
                    <div class="row">
                        @foreach ($supported_sites as $supported_site)
                          <div class="col">
                            <div class="card card-plain text-center">
                              <a href="{{ url('/') . '/' .  $supported_site['link'] }}">
                                <img class="avatar avatar-md shadow" src="{{ $supported_site['image'] }}">
                                <div class="card-body px-0">
                                  <h6 class="card-title">{{ $supported_site['title'] }}</h6>
                                </div>
                              </a>
                            </div>
                          </div>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </section>
          @endif

          <section class="my-3">
              <div class="container">
                  <div class="row">
                      <div class="info-horizontal bg-gray-100 border-radius-xl p-5">

                          @if ( $page->ads_status == true && $advertisement->area3_status == true && $advertisement->area3 != null )
                            <x-frontend.advertisement.area3 :advertisement="$advertisement" />
                          @endif

                          <div id="page-content">

                            @if ( Auth::user() )
                              <div class="d-flex justify-content-center">
                                <a href="{{ localization()->getLocalizedURL($pageTrans->locale, route('edit-page-translations', $pageTrans->translations[0]['id']), [], true) }}" class="btn btn-primary">{{ __('Edit Page') }}</a>
                              </div>
                            @endif

                            {!! $pageTrans->description !!}

                            @switch( $page->type )

                                @case('report')
                                      @livewire('frontend.report')
                                    @break

                                @case('contact')
                                      @livewire('frontend.contact')
                                    @break

                                @default
                            @endswitch
   
                          </div>

                          @if ( $general->share_icons_status == true )

                            <div class="social-share text-center">
                              <div class="is-divider"></div>
                              <div class="share-icons relative">

                                  <a wire:ignore href="https://www.facebook.com/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                      onclick="window.open('https://www.facebook.com/sharer/sharer.php?u={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','facebook','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                      data-label="Facebook"
                                      rel="noopener noreferrer nofollow"
                                      target="_blank"
                                      class="btn btn-facebook btn-simple rounded p-2">
                                      <i class="fab fa-facebook"></i>
                                  </a>

                                  <a wire:ignore href="https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                      onclick="window.open('https://twitter.com/share?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','twitter','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                      rel="noopener noreferrer nofollow"
                                      target="_blank"
                                      class="btn btn-twitter btn-simple rounded p-2">
                                      <i class="fab fa-twitter"></i>
                                  </a>

                                  <a wire:ignore href="https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                      onclick="window.open('https://www.pinterest.com/pin-builder/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&media={{ $page->featured_image }}&description={{ str_replace(' ', '%20', $pageTrans->title) }}','pinterest','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                      rel="noopener noreferrer nofollow"
                                      target="_blank"
                                      class="btn btn-pinterest btn-simple rounded p-2">
                                      <i class="fab fa-pinterest"></i>
                                  </a>

                                  <a wire:ignore href="https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                      onclick="window.open('https://www.linkedin.com/sharing/share-offsite/?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','linkedin','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                      rel="noopener noreferrer nofollow"
                                      target="_blank"
                                      class="btn btn-linkedin btn-simple rounded p-2">
                                      <i class="fab fa-linkedin"></i>
                                  </a>

                                  <a wire:ignore href="https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}"
                                      onclick="window.open('https://www.reddit.com/submit?url={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}&title={{ str_replace(' ', '%20', $pageTrans->title) }}','reddit','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                      rel="noopener noreferrer nofollow"
                                      target="_blank"
                                      class="btn btn-reddit btn-simple rounded p-2">
                                      <i class="fab fa-reddit"></i>
                                  </a>

                                  <a wire:ignore href="https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}"
                                      onclick="window.open('https://tumblr.com/widgets/share/tool?canonicalUrl={{ ($page->type == 'home') ? route('home') : route('page', $page->slug ) }}','tumblr','height=500,width=800,resizable=1,scrollbars=yes'); return false;"
                                      target="_blank"
                                      class="btn btn-tumblr btn-simple rounded p-2"
                                      rel="noopener noreferrer nofollow">
                                      <i class="fab fa-tumblr"></i>
                                  </a>

                              </div>
                            </div>
                          @endif

                          @if ( $page->ads_status == true && $advertisement->area4_status == true && $advertisement->area4 != null )
                            <x-frontend.advertisement.area4 :advertisement="$advertisement" />
                          @endif

                          @if ( $general->author_box_status == true )

                            <hr class="horizontal dark">
                            <div class="card card-profile card-plain mt-4">
                              <div class="row">

                                <div class="col-lg-2">
                                  <a href="javascript:;">
                                    <div class="position-relative">
                                      <div class="blur-shadow-image">
                                        <img class="w-100 rounded-3 shadow-lg" src="{{ $profile->avatar }}">
                                      </div>
                                    </div>
                                  </a>
                                </div>

                                <div class="col-lg-10 ps-0 my-auto">
                                  <div class="card-body text-start py-0">

                                    <div class="p-md-0 pt-3">
                                      <h5 class="font-weight-bolder mb-0">{{ $profile->fullname }}</h5>
                                      <p class="text-uppercase text-sm font-weight-bold mb-2">{{ $profile->position }}</p>
                                    </div>

                                    <p class="mb-4">{{ __($profile->bio) }}</p>

                                    @if ( ($profile->social_status == true) && !empty($profile->user_socials) )

                                      @foreach ($profile->user_socials as $element)

                                        <a class="btn btn-{{ $element->name }} btn-simple mb-0 ps-1 pe-2 py-0" href="{{ $element->url }}" target="blank">
                                          <i class="fab fa-{{ $element->name }} fa-lg" aria-hidden="true"></i>
                                        </a>

                                      @endforeach

                                    @endif

                                  </div>
                                </div>

                              </div>
                            </div>

                          @endif

                      </div>
                  </div>
              </div>
          </section>

        @endif

        <x-frontend.footer :footer="$footer" :general="$general" :socials="$socials" />

        <!-- jQuery -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>

        <!-- Popper JS -->
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>

        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        
        <!-- Theme JS -->
        <script src="{{ asset('assets/js/main.min.js') }}"></script>

        @if ( $general->recaptcha_v3 == true && !empty($api_key->recaptcha_public_api_key ) )
          <script src="https://www.google.com/recaptcha/api.js?render={{ $api_key->recaptcha_public_api_key }}"></script>
        @endif

        @if (Cookie::get('cookies') == null)

          @if ( $notice->status == true )
              <div class="row notice alert {{ $notice->background }}" role="alert">
                
                <div class="col-md-12 col-lg-{{ ($notice->button == true) ? '10' : '12'}} my-auto {{ $notice->align }}">
                  {!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}
                </div>

                @if ( $notice->button == true)
                  <div class="col-md-12 col-lg-2 my-auto p-2">
                      <button id="acceptCookies" target="_blank" class="btn btn-sm bg-white mb-0 text-capitalize"> {{ __('Accept all cookies') }} </button>
                  </div>
                @endif

                <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>

              </div>
              <script>
                 (function( $ ) {
                    "use strict";
             
                        $("#acceptCookies").click(function(){
                            jQuery.ajax({
                                type : 'get',
                                url : '{{ url('/') }}/cookies/accept',
                                success: function(e) {
                                    jQuery('.notice').remove();
                                }
                            });
                        });

                })( jQuery );
              </script>
          @endif

        @endif

        <script>
           (function( $ ) {
              "use strict";

                document.addEventListener('livewire:load', function () {

                      document.getElementById('paste').addEventListener('click', function(paste) {

                          paste = document.getElementById('paste');

                          '<i class="far fa-trash-alt fa-lg"></i>' === paste.innerHTML ? (link.value = "", paste.innerHTML = '<i class="far fa-clipboard fa-lg"></i>') : navigator.clipboard.readText().then(function(clipText) {
                              
                              @this.set('link', clipText);

                          }, paste.innerHTML = '<i class="far fa-trash-alt fa-lg"></i>');

                      });

                    @if ( !empty( Request::get('url') ) )
                      @this.set('link', '{{ Request::get('url') }}' );
                    @endif
                });

          })( jQuery );
        </script>

        @if ( $advanced->footer_status == true && $advanced->insert_footer != null )
          {!! $advanced->insert_footer !!}
        @endif

</div>
