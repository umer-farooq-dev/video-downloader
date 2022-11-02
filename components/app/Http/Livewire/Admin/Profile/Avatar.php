<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\Admin\User;
use Auth;
use DateTime;
class Avatar extends Component
{

    public $avatar;
	public $fullname;
	public $position;

    protected $listeners = ['onSetAvatar', 'sendUpdateProfileStatus' => 'onUpdateProfileStatus'];

    public function mount()
    {
        $profile        = Auth::user();
		$this->fullname = $profile->fullname;
		$this->position = $profile->position;
        $this->avatar   = $profile->avatar;
    }

    public function render()
    {
        return view('livewire.admin.profile.avatar', [
          'profile' => User::select()->first()
        ]);

    }

    //Set Avatar
    public function onSetAvatar($value)
    {
        $this->avatar = $value;

        return $this->onUpdateAvatar();
    }

    //Update Avatar
    public function onUpdateAvatar()
    {
    	
        try {

            $profile = Auth::user();

            $profile->avatar = $this->avatar;

            $profile->updated_at = new DateTime();

            $profile->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function onUpdateProfileStatus()
    {
        $this->render();
    }
}
