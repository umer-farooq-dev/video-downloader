<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Blog') }}</title>

        <link rel="shortcut icon" href="{{ $header->favicon }}"/>

        <meta name="description" content="{{ __('Get all the latest news on updates, support issues and tutorials.') }}" />
        <meta name="robots" content="follow, index, max-snippet:-1, max-video-preview:-1, max-image-preview:large" />
        <link rel="canonical" href="{{ url()->current() }}" />
        <meta property="og:locale" content="{{ localization()->getCurrentLocaleRegional() }}">
        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ __('Blog') }}">
        <meta property="og:description" content="{{ __('Get all the latest news on updates, support issues and tutorials.') }}">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="{{ __('Blog') }}">
        <meta property="og:updated_time" content="@php 

          echo Carbon\Carbon::createFromFormat('Y-m-d H:i:s', ''.$page->updated_at.'' )->toIso8601String();

        @endphp">

        @if ( !empty($page->featured_image) )
<meta property="og:image" content="{{ $page->featured_image }}">
        <meta property="og:image:secure_url" content="{{ $page->featured_image }}">
        <meta property="og:image:width" content="{{ Image::make($page->featured_image)->width() }}">
        <meta property="og:image:height" content="{{ Image::make($page->featured_image)->height() }}">
        <meta property="og:image:alt" content="{{ __('Blog') }}">
        <meta property="og:image:type" content="{{ File::extension($page->featured_image) }}">
        @endif

        @php
        if ( !empty($twitter['url']) ) {

          $pregCheck = preg_match('/(?:https?:\/\/)?(?:mobile\.)?(?:www\.)?(?:twitter.com\/)(?:[@])?([A-Za-z0-9-_\.]+)(?:\/status\/(?:[a-z0-9]{0,}))?(?:\?.(?:\=.)?(?:\&.)?)?/', $twitter['url'], $match);

          if ( $pregCheck ){
            echo '<meta name="twitter:title" content="'.__('Blog').'">
        <meta name="twitter:description" content="'.__('Get all the latest news on updates, support issues and tutorials.').'">
        <meta name="twitter:site" content="@'.$match[1].'">
        <meta name="twitter:creator" content="@'.$match[1].'">';
          }

        }
        @endphp

        @if ( !empty($page->featured_image) )
        
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:image" content="{{ $page->featured_image }}">
        @endif

    @foreach(localization()->getSupportedLocales() as $localeCode => $properties)
    <link rel="alternate" hreflang="{{ $properties->key() }}" href="{{ localization()->getLocalizedURL($properties->key(), null, [], false) }}" />
    @endforeach

        @if ( $general->page_load == true )

        <!-- Pace -->
        <script rel="preload" src="{{ asset('assets/js/pace.min.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('assets/css/pace-theme-default.min.css') }}">

        @endif

        <!-- Icons -->
        <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet">

        <!-- Font Awesome -->
        <link type="text/css" href="{{ asset('assets/css/fontawesome.min.css') }}" rel="stylesheet">

        <!-- Theme CSS -->
        <link type="text/css" href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">

        <!-- Custom CSS -->
        <link type="text/css" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">
        
        @if ( !empty($general->font_family) )

          <link rel="stylesheet" href="https://fonts.googleapis.com/css?family={{ $general->font_family }}">

          <style>
            body, .card .card-body {
              font-family: {{ $general->font_family }} !important;
            }
          </style>

        @endif

        @if ( $advanced->header_status == true && $advanced->insert_header != null )
          {!! $advanced->insert_header !!}
        @endif

    </head>
    <body>

    <x-frontend.navbar :header="$header" :homeTitle="$homeTitle" :menus="$menus" :general="$general" />

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
                    <h1 class="text-white pt-3 mt-n5">{{ __('Our Blog') }}</h1>
                    <h2 class="lead text-white letter-normal my-3">{{ __('Stay up to date with the latest news') }}</h2>
                  </div>

                  @if ( $advertisement->area1_status == true && $advertisement->area1 != null )
                    <x-frontend.advertisement.area1 :advertisement="$advertisement" />
                  @endif

                  @if ( $advertisement->area2_status == true && $advertisement->area2 != null )
                    <x-frontend.advertisement.area2 :advertisement="$advertisement" />
                  @endif

                </div>
              </div>

              @if ( $general->wave_animation_status == true)

                <div class="position-absolute w-100 z-index-1 bottom-0">
                  <svg class="waves" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 40" preserveAspectRatio="none" shape-rendering="auto">
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

          <section class="my-3">
              <div class="container">
                  <div class="row">
                      <div class="info-horizontal">

                          @if ( $advertisement->area3_status == true && $advertisement->area3 != null )
                            <x-frontend.advertisement.area3 :advertisement="$advertisement" />
                          @endif

                          <div id="blog-content">


                            <div class="row">

                              @foreach ($pageTrans as $pageTran)
                                  <div class="col-lg-4 col-sm-6">
                                    <div class="card card-plain card-blog">
                                      <div class="card-image border-radius-lg position-relative">
                                        <a href="{{ localization()->getLocalizedURL(app()->getLocale(), $pageTran->slug, [], true) }}">
                                          <img class="w-100 border-radius-lg move-on-hover shadow" src="{{ ($pageTran->featured_image) ? $pageTran->featured_image : asset('assets/img/no-thumb.jpg') }}">
                                        </a>
                                      </div>
                                      <div class="card-body px-0">
                                        <h5>
                                          <a href="{{ localization()->getLocalizedURL(app()->getLocale(), $pageTran->slug, [], true) }}" class="text-dark font-weight-bold">{{ $pageTran->title }}</a>
                                        </h5>
                                        <p>{{ $pageTran->short_description }}</p>

                                        <a href="{{ localization()->getLocalizedURL(app()->getLocale(), $pageTran->slug, [], true) }}" class="text-info icon-move-right">{{ __('Read More') }}
                                          <i class="fas fa-arrow-right text-sm" aria-hidden="true"></i>
                                        </a>
                                      </div>
                                    </div>
                                  </div>

                              @endforeach

                            </div>

                            <div class="d-flex justify-content-center mt-4">
                              {{ $pageTrans->links() }}
                            </div>

                          </div>

                          @if ( $advertisement->area4_status == true && $advertisement->area4 != null )
                            <x-frontend.advertisement.area4 :advertisement="$advertisement" />
                          @endif

                      </div>
                  </div>
              </div>
          </section>

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
                
                <div class="col-md-12 col-lg-10 my-auto {{ $notice->align }}">
                  {!! __(GrahamCampbell\Security\Facades\Security::clean($notice->notice)) !!}
                </div>

                <div class="col-md-12 col-lg-2 my-auto p-2">

                  @if ( $notice->button == true)
                    <button id="acceptCookies" target="_blank" class="btn btn-sm bg-white mb-0 text-capitalize"> {{ __('Accept all cookies') }} </button>
                  @endif

                  <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>
                </div>

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

        @if ( $advanced->footer_status == true && $advanced->insert_footer != null )
          {!! $advanced->insert_footer !!}
        @endif

    </body>
</html>