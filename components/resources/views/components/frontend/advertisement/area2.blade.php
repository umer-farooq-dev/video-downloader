@switch( $advertisement->area2_align )
    @case('left')
		<div class="area2 d-flex justify-content-start" style="margin:{{ $advertisement->area2_margin }}px;">
			{!! $advertisement->area2 !!}
		</div>

    @break

    @case('right')
		<div class="area2 d-flex justify-content-end" style="margin:{{ $advertisement->area2_margin }}px;">
			{!! $advertisement->area2 !!}
		</div>
    @break

    @default
		<div class="area2 d-flex justify-content-center" style="margin:{{ $advertisement->area2_margin }}px;">
			{!! $advertisement->area2 !!}
		</div>
@endswitch