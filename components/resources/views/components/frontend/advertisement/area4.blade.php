@switch( $advertisement->area4_align )
    @case('left')
		<div class="area4 d-flex justify-content-start" style="margin:{{ $advertisement->area4_margin }}px;">
			{!! $advertisement->area4 !!}
		</div>

    @break

    @case('right')
		<div class="area4 d-flex justify-content-end" style="margin:{{ $advertisement->area4_margin }}px;">
			{!! $advertisement->area4 !!}
		</div>
    @break

    @default
		<div class="area4 d-flex justify-content-center" style="margin:{{ $advertisement->area4_margin }}px;">
			{!! $advertisement->area4 !!}
		</div>
@endswitch