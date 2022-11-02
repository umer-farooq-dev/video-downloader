<?php

namespace App\Http\Livewire\Admin\Pages\Translations;

use Livewire\Component;
use App\Models\Admin\Page;
use App\Models\Admin\PageTranslation;
use Livewire\WithPagination;

class Showlist extends Component
{
    public $page_id, $pageID;

    use WithPagination;
    public $searchQuery        = '';
    protected $paginationTheme = 'bootstrap';
    protected $listeners       = ['onDeletePageTranslation'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount($page_id)
    {
        $this->pageID = $page_id;
    }

    public function render()
    {
        return view('livewire.admin.pages.translations.showlist', [
            'page_translations' => PageTranslation::where('page_id', $this->pageID)->where('title', 'like', '%'.$this->searchQuery.'%')->orderBy('id', 'DESC')->paginate(15),
            'page_id'           => $this->pageID,
            'slug'              => Page::where('id', $this->pageID)->first()->slug
        ]);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Translation
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteConfirmPageTranslation($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeletePageTranslation($id)
    {
        try {

            $page = PageTranslation::findOrFail($id);

            $page->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }


    }

}
