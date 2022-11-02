<?php

namespace App\Http\Livewire\Admin\Settings\Redirects;

use Livewire\Component;
use App\Models\Admin\Redirect;
use DateTime;

class Edit extends Component
{
    public $old_slug;
    public $new_slug;
    public $redirect_id;

    protected $listeners = ['sendDataEditRedirect' => 'onUpdateDataEditRedirect'];

    public function render()
    {
        return view('livewire.admin.settings.redirects.edit');
    }

	private function resetInputFields()
    {
        $this->reset(['old_slug', 'new_slug']);
    }

    public function onUpdateDataEditRedirect(Redirect $data)
    {
        $this->redirect_id = $data->id;
        $this->old_slug    = $data->old_slug;
        $this->new_slug    = $data->new_slug;
    }

    public function onEditRedirect($id)
    {

        $this->validate([
            'old_slug'  => 'required',
            'new_slug'  => 'required',
        ]);

        try {

            $redirect             = Redirect::findOrFail($id);
            $redirect->old_slug   = strip_tags($this->old_slug);
            $redirect->new_slug   = strip_tags($this->new_slug);
            $redirect->updated_at = new DateTime();
            $redirect->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editRedirect']);
            $this->resetInputFields();
            $this->emit('sendUpdateRedirectStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
