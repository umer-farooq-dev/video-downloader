<?php

namespace App\Http\Livewire\Admin\Pages;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Page;
use Cviebrock\EloquentSluggable\Services\SlugService;

class Create extends Component
{
    public $slug;
    public $featured_image;
    public $type;

    protected $listeners = ['onSetFeaturedImage'];

    public function render()
    {
        return view('livewire.admin.pages.create');
    }

    private function resetInputFields()
    {
        $this->reset(['slug', 'type', 'featured_image']);
    }

    public function createSlug()
    {
        $this->slug = SlugService::createSlug(Page::class, 'slug', $this->slug);
    }
    
    public function onSetFeaturedImage($value)
    {
        $this->featured_image = $value;
    }

    public function onCreatePage()
    {

        $this->validate([
            'slug'  => 'required|unique:pages',
        ]);

        try {

            $page                 = new Page;
            $page->slug           = strip_tags($this->slug);
            $page->type           = ($this->type) ? strip_tags($this->type) : 'default';
            $page->featured_image = strip_tags($this->featured_image);
            $page->created_at     = new DateTime();
            $page->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewPage']);
            $this->resetInputFields();
            $this->emit('sendUpdatePageStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
