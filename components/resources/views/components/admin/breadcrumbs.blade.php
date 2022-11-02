<nav aria-label="breadcrumb">
	<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
		<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="{{ route('admin') }}">{{ __('Admin') }}</a></li>
		<li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ __( ucwords( str_replace( '-', ' ', Route::currentRouteName() ) ) ) }}</li>
	</ol>
</nav>