<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\Admin\User;
use Auth;
use DateTime;
use Illuminate\Support\Facades\Hash;
class ChangePassword extends Component
{

  	public $current_password;
  	public $new_password;
  	public $retype_new_password;

    public function render()
    {
        return view('livewire.admin.profile.change-password');
    }

    //Change password
    public function onChangePassword()
    {

    	$this->validate([
    		'current_password'    => 'required',
    		'new_password'        => 'required',
    		'retype_new_password' => 'required|same:new_password',
    	]);

        try {

            $profile = Auth::user();

            if (!Hash::check($this->current_password, $profile->password)) {

                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('Current password is incorrect!') ]);
                return;
            }

            $profile->password   = Hash::make($this->new_password);

            $profile->updated_at = new DateTime();

            $profile->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
