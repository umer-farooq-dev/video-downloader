<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\FooterTranslation;
use Livewire\WithPagination;

class Footer extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners       = ['onDeleteFooterTranslation'];

    public function render()
    {
        return view('livewire.admin.settings.footer', [
        	'footer_translations' => FooterTranslation::orderBy('id', 'DESC')->paginate(15)
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Translation
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteConfirmFooterTranslation($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeleteFooterTranslation($id)
    {   
        try {

            $page = FooterTranslation::findOrFail($id);
            $page->delete($id);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
