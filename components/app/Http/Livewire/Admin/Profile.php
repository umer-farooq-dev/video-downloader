<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Auth;
class Profile extends Component
{

    public function render()
    {
        return view('livewire.admin.profile');
    }

    public function onLogout()
    {
    	Auth::logout();
    	return redirect('/');
    }

}
