<?php

namespace App\Http\Livewire\Frontend\Install;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Install;

class Finished extends Component
{

    public function mount(){
        $install                  = Install::findOrFail(1);
        if ($install->database    == false) return redirect()->route('sw_database');
        else if ($install->admin  == false) return redirect()->route('sw_admin');
        else if ($install->import == false) return redirect()->route('sw_import');

        $ins           = Install::findOrFail(1);
        $ins->finished = true;
        $ins->save();
    }

    public function render()
    {
        return view('livewire.frontend.install.finished');
    }
}
