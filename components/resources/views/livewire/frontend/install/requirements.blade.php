<div>

    @foreach($requirements['requirements'] as $type => $requirement)
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('PHP') }} >= {{ $phpSupportInfo['minimum'] }}</th>
                    <th class="text-end">
                        <strong>{{ $phpSupportInfo['current'] }}</strong>
                        <i class="text-gradient fas fa-fw fa-{{ $phpSupportInfo['supported'] ? 'check-circle text-success' : 'exclamation-circle text-danger' }}"></i>
                    </th>
                </tr>
            </thead>

            <tbody>

                @foreach ($requirements['requirements'][$type] as $extention => $enabled)
                    <tr class="{{ $enabled ? '' : 'text-danger' }}">
                        <td>{{ $extention }}</td>
                        <td class="text-end"><i class="text-gradient fas fa-fw fa-{{ $enabled ? 'check-circle text-success' : 'exclamation-circle text-danger' }}"></i></td>
                    </tr>
                @endforeach
 
            </tbody>
        </table>
    @endforeach

    <table class="table">
        <thead>
            <tr>
                <th colspan="2">{{ __('Permissions') }}</th>
            </tr>
        </thead>
         <tbody>

            @foreach($permissions['permissions'] as $permission)

                @if ( $permission['folder'] == '.env')

                    <tr class="{{ $permission['permission'] ? '' : 'text-danger' }}">
                        <td><input type="text" class="form-control" value="components/{{ $permission['folder'] }}" onclick="this.select()"></td>
                        <td class="text-end align-middle">
                            <strong>{{ $permission['permission'] ? '' : __('The file is not writable!') }}</strong>
                            <i class="text-gradient fas fa-fw fa-{{ $permission['permission'] ? 'check-circle text-success' : 'exclamation-circle text-danger' }}"></i>
                            
                        </td>
                    </tr>

                @else
                    <tr class="{{ $permission['isSet'] ? '' : 'text-danger' }}">
                        <td><input type="text" class="form-control" value="components/{{ $permission['folder'] }}" onclick="this.select()"></td>
                        <td class="text-end align-middle">
                            <strong>{{ $permission['permission'] }}</strong>
                            <i class="text-gradient fas fa-fw fa-{{ $permission['isSet'] ? 'check-circle text-success' : 'exclamation-circle text-danger' }}"></i>
                        </td>
                    </tr>
                @endif

            @endforeach
        </tbody>
    </table>

    @if ( !isset($requirements['errors']) && $phpSupportInfo['supported'] && !isset($permissions['errors']) && $permissions['permissions'][0]['permission'] == true)
        <div class="row">
            <div class="col-md-12 text-center">
              <a class="btn bg-gradient-primary mt-3" href="{{ route('sw_database') }}">{{ __('Continue') }}</a>
          </div>
        </div>
    @endif

</div>
