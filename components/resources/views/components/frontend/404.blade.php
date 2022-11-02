<section class="my-10">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 my-auto">
        <h1 class="display-1 text-bolder text-gradient text-danger">{{ $pageTrans->title }}</h1>
        <h2>{{ $pageTrans->subtitle }}</h2>
        <p class="lead">{!! GrahamCampbell\Security\Facades\Security::clean($pageTrans->description) !!}</p>
        <a class="btn bg-gradient-dark mt-4" href="{{ route('home') }}">{{ __('Go to Homepage') }}</a>
      </div>
      <div class="col-lg-6 my-auto position-relative">
        <img class="w-100 position-relative" src="{{ asset('assets/img/illustrations/error-404.png') }}" alt="404-error">
      </div>
    </div>
  </div>
</section>