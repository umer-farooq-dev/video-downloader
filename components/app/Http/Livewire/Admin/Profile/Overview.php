<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Admin\UserSocial;
use Auth;
class Overview extends Component
{
    protected $listeners = ['sendUpdateProfileStatus' => 'onUpdateProfileStatus'];

    public function render()
    {
        $this->profile = User::select()->first();

        return view('livewire.admin.profile.overview', [
            'profile' => $this->profile,
            'socials' => UserSocial::all()->toArray(),
        ]);

    }

    public function onUpdateProfileStatus()
    {
        $this->render();
    }

}
