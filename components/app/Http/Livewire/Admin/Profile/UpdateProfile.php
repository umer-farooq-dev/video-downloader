<?php

namespace App\Http\Livewire\Admin\Profile;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Admin\UserSocial;
use Auth;
use DateTime;
class UpdateProfile extends Component
{

    //Socials
    public $inputs = [];
    public $i = 1;
    public $name, $url;
    public $socials = [];

    //Profile
    public $avatar;
    public $fullname;
    public $position;
    public $address;
    public $phone;
    public $email;
    public $bio;
    public $social_status = false;

    public function mount()
    {
        $profile             = Auth::user();

        $this->fullname      = $profile->fullname;
        $this->position      = $profile->position;
        $this->address       = $profile->address;
        $this->phone         = $profile->phone;
        $this->email         = $profile->email;
        $this->bio           = $profile->bio;
        $this->avatar        = $profile->avatar;
        $this->social_status = $profile->social_status;
        $this->socials       = UserSocial::all()->toArray();
        $this->i             = auth()->user()->user_socials->count();
    }

    public function render()
    {
        return view('livewire.admin.profile.update-profile');
    }

    private function resetInputFields()
    {
		$this->reset(['name', 'url']);
    }

    public function addSocial($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);
    }

    public function removeSocial($i)
    {
        unset($this->inputs[$i]);
    }

    //Update profile
    public function onUpdateProfile()
    {
        $this->validate([
            'email'          => 'required|email',
            'socials.*.name' => 'required',
            'socials.*.url'  => 'required',
            'name.*'         => 'required',
            'url.*'          => 'required'
        ]);

        try {

            $profile                = Auth::user();
            
            $profile->fullname      = $this->fullname;
            $profile->position      = $this->position;
            $profile->address       = $this->address;
            $profile->phone         = $this->phone;
            $profile->email         = $this->email;
            $profile->bio           = $this->bio;
            $profile->social_status = $this->social_status;

            $profile->updated_at = new DateTime();

            $profile->save();

            if ( $this->socials != null) {

                foreach ($this->socials as $key => $value) {
                    $usocial             = UserSocial::findOrFail($value['id']);
                    $usocial->name       = $value['name'];
                    $usocial->url        = $value['url'];
                    $usocial->user_id    = Auth::id();
                    $usocial->updated_at = new DateTime();
                    $usocial->save();
                }

            }

            if ( $this->name != null) {

                foreach ($this->name as $key => $value) {
                    $usocial             = new UserSocial;
                    $usocial->name       = ($this->name[$key] == '') ? 'facebook' : $this->name[$key];
                    $usocial->url        = $this->url[$key];
                    $usocial->user_id    = Auth::id();
                    $usocial->created_at = new DateTime();
                    $usocial->save();
                }
            }

            $this->inputs = [];
       
            $this->resetInputFields();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->mount();
            $this->render();
            $this->emit('sendUpdateProfileStatus');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function onDeleteSocial($id)
    {
        try {

            $social = UserSocial::findOrFail($id);
            $social->delete($id);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
