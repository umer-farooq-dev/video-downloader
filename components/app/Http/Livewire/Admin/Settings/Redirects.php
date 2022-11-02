<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\Redirect;

class Redirects extends Component
{
    public $redirects    = [];
    protected $listeners = ['onDeleteRedirect', 'sendUpdateRedirectStatus' => 'onUpdateRedirectStatus'];

    public function mount()
    {
         $this->redirects = Redirect::all()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.settings.redirects');
    }

    public function onUpdateRedirectStatus(){
        $this->mount();
    }

    /**
     * -------------------------------------------------------------------------------
     *  Show Modal Edit
     * -------------------------------------------------------------------------------
    **/

    public function onShowEditRedirectModal($id)
    {
        $this->emit('sendDataEditRedirect', ['id' => $id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editRedirect']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Redirect
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteConfirmRedirect($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeleteRedirect($id)
    {
        try {
            $page = Redirect::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
