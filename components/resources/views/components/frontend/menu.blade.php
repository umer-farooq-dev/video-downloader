@php
	$mobileMenu = '';
@endphp

<ul class="dropdown-menu dropdown-menu-animation dropdown-md p-3 border-radius-lg mt-0 mt-lg-3" aria-labelledby="navbarDropdownMenuLink">

 	<div class="d-none d-lg-block">
		 @foreach($childs as $key => $child)

		 		{{-- Begin::Mobile Menu --}}
				@php
				 	$mobileMenu .='<h6 class="dropdown-header text-dark font-weight-bolder px-0">
								 	<a href="'.( ($child['menu_items']  == 'custom') ? $child['url'] : route('home') . '/' . $child['url'] ).'">'. __($child['text']) .'</a>
								 </h6>';
				@endphp
				{{-- End::Mobile Menu --}}
				
			 <li class="nav-item dropdown dropdown-hover dropdown-subitem">
			 	<a class="dropdown-item border-radius-md ps-3 d-flex align-items-center justify-content-between mb-1" href="{{ ( $child['menu_items']  == 'custom' ) ? $child['url'] : route('home') . '/' . $child['url'] }}">{{ __($child['text']) }}
			 		
			 		@if ( count($child['children']) )
			 			<img src="{{ asset('assets/img/down-arrow.svg') }}" alt="down-arrow" class="arrow">
			 		@endif
			 	</a>

			 	@if(count($child['children']))
			 		<div class="dropdown-menu mt-0 py-3 px-2 mt-3">

					 	@foreach ($child['children'] as $key => $value)
                        	<a class="dropdown-item ps-3 border-radius-md mb-1" href="{{ ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] }}">{{ __($value['text']) }}</a>

                        	{{-- Begin::Mobile Menu --}}
                        	@php
                        		$mobileMenu .= '<a class="dropdown-item border-radius-md" href="'. ( $value['menu_items']  == 'custom' ) ? $value['url'] : route('home') . '/' . $value['url'] .'">'. __($value['text']) .'</a>';
                        	@endphp
                        	{{-- End::Mobile Menu --}}

					 	@endforeach

				 	</div>
			 	@endif
			 </li>
		 @endforeach
	 </div>

	<div class="row d-lg-none">
		<div class="col-12 d-flex justify-content-center flex-column">
			{!! GrahamCampbell\Security\Facades\Security::clean($mobileMenu) !!}
		</div>
	</div>

 </ul>