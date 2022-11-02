<?php

namespace App\Http\Livewire\Admin\Settings\Redirects;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Redirect;

class Create extends Component
{

    public $old_slug;
    public $new_slug;

    public function render()
    {
        return view('livewire.admin.settings.redirects.create');
    }

    private function resetInputFields()
    {
		$this->reset(['old_slug', 'new_slug']);
    }

    public function onAddRedirect()
    {
        
        $this->validate([
            'old_slug'  => 'required',
            'new_slug'  => 'required',
        ]);

        try {

            $redirect             = new Redirect;
            $redirect->old_slug   = strip_tags($this->old_slug);
            $redirect->new_slug   = strip_tags($this->new_slug);
            $redirect->created_at = new DateTime();
            $redirect->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewRedirect']);
            $this->resetInputFields();
            $this->emit('sendUpdateRedirectStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
