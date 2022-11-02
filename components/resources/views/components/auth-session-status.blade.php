@props(['status'])

@switch( $status )

    @case( 'success' )

		  <div class="alert alert-success text-white" role="alert">
		    {{ session('message') }}
		  </div>

        @break

    @case( 'error' )
    
		  <div class="alert alert-danger text-white" role="alert">
		    {{ session('message') }}
		  </div>

        @break

    @default

@endswitch