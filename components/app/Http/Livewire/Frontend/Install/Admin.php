<?php

namespace App\Http\Livewire\Frontend\Install;

use Livewire\Component;
use App\Models\Admin\User;
use DateTime;
use Brotzka\DotenvEditor\DotenvEditor;
use App\Models\Install;
class Admin extends Component
{
    public $email;
    public $password;

    public function mount(){
        $install                  = Install::findOrFail(1);
        if ($install->database    == false) return redirect()->route('sw_database');
    }

    public function render()
    {
        return view('livewire.frontend.install.admin');
    }

    public function onCreateAdmin(){

        $this->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if ( User::find(1) === null ) {

            $user             = new User;
            $user->id         = 1;
            $user->fullname   = 'James Smith';
            $user->position   = 'CEO / Co-Founder';
            $user->address    = '121 King Street, Melbourne Victoria 3000, Australia';
            $user->phone      = '+61 3 8376 6284';
            $user->email      = $this->email;
            $user->password   = bcrypt($this->password);
            $user->bio        = 'Enjoy the little things in life. For one day, you may look back and realize they were the big things. Many of life\'s failures are people who did not realize how close they were to success when they gave up.';
            $user->gender     = 1;
            $user->avatar     = asset('assets/img/avatar.jpg');
            $user->created_at = new DateTime();
            $user->save();

            $install        = Install::findOrFail(1);
            $install->admin = true;
            $install->save();

            return redirect()->route('sw_import');

        }
        else {

            $user             = User::findOrFail(1);
            $user->email      = $this->email;
            $user->password   = bcrypt($this->password);
            $user->updated_at = new DateTime();
            $user->save();

            $install        = Install::findOrFail(1);
            $install->admin = true;
            $install->save();

            return redirect()->route('sw_import');
        }

    }
}
