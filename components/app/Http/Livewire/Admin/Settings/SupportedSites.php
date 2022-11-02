<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\SupportedSite;

class SupportedSites extends Component
{

    public $sites        = [];
    protected $listeners = ['onDeleteSite', 'sendUpdateSiteStatus' => 'onUpdateSiteStatus'];

    public function mount()
    {
         $this->sites = SupportedSite::orderBy('id', 'DESC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.settings.supported-sites');
    }

    public function onUpdateSiteStatus(){
        $this->mount();
    }

    /**
     * -------------------------------------------------------------------------------
     *  Show Modal Edit
     * -------------------------------------------------------------------------------
    **/

    public function onShowEditSiteModal($id)
    {
        $this->emit('sendDataEditSite', ['id' => $id]);
        $this->dispatchBrowserEvent('showModal', ['id' => 'editSite']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Site
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteConfirmSite($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeleteSite($id)
    {
        try {
            $site = SupportedSite::findOrFail($id);

            $site->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
            $this->mount();
            
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
