<?php

namespace App\Http\Livewire\Frontend\Install;

use Livewire\Component;
use App\Helpers\RequirementsChecker;
use App\Helpers\PermissionsChecker;
class Requirements extends Component
{

    protected $requirements;
    protected $permissions;

    public function mount(RequirementsChecker $rchecker, PermissionsChecker $pchecker)
    {
        $this->requirements = $rchecker;
        $this->permissions = $pchecker;
    }

    public function render()
    {

        $phpSupportInfo = $this->requirements->checkPHPversion(
            config('installer.core.minPhpVersion')
        );

        $requirements = $this->requirements->check(
            config('installer.requirements')
        );

        $permissions = $this->permissions->check(
            config('installer.permissions')
        );

        return view('livewire.frontend.install.requirements',[
            'phpSupportInfo' => $phpSupportInfo,
            'requirements'   => $requirements,
            'permissions'    => $permissions
        ]);
    }
}
