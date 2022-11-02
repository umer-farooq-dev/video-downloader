<?php

namespace App\Http\Livewire\Frontend\Install;

use Livewire\Component;
use App\Models\Admin\Page;
use Illuminate\Support\Facades\Artisan;
use App\Models\Install;
class Import extends Component
{

    public function mount(){
        $install                  = Install::findOrFail(1);
        if ($install->database    == false) return redirect()->route('sw_database');
        else if ($install->admin  == false) return redirect()->route('sw_admin');
    }

    public function render()
    {
        return view('livewire.frontend.install.import');
    }

    public function onImportData(){

        Artisan::call('db:seed', ['class' => 'DatabaseSeeder']);

        $install         = Install::findOrFail(1);
        $install->import = true;
        $install->save();

        return redirect()->route('sw_finished');

    }
}
