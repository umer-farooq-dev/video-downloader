<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Edit extends Component
{
    public $page_id;
    public $slug;
    public $featured_image;
    public $type;

    protected $listeners = ['onSetFeaturedImage', 'sendDataEditPage' => 'onDataEditPage'];

    public function render()
    {
        return view('livewire.admin.pages.edit');
    }

    public function onDataEditPage(Page $page)
    {
        $this->page_id        = $page->id;
        $this->slug           = $page->slug;
        $this->type           = $page->type;
        $this->featured_image = $page->featured_image;
    }

    public function createSlug()
    {
        $this->slug = SlugService::createSlug(Page::class, 'slug', $this->slug);
    }
    
    private function resetInputFields()
    {
        $this->reset(['page_id', 'slug', 'type', 'featured_image']);
    }

    public function onSetFeaturedImage($value)
    {
        $this->featured_image = $value;
    }
    
    public function onEditPage($id)
    {
        $this->validate([
            'slug'  => 'required',
        ]);

        try {

            $page                 = Page::findOrFail($id);
            $page->slug           = strip_tags($this->slug);
            $page->type           = ($this->type) ? strip_tags($this->type) : 'default';
            $page->featured_image = strip_tags($this->featured_image);
            $page->updated_at     = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editPage']);
            $this->resetInputFields();
            $this->emit('sendUpdatePageStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
