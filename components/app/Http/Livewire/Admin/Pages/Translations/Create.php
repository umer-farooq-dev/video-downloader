<?php

namespace App\Http\Livewire\Admin\Pages\Translations;

use Livewire\Component;
use App\Models\Admin\Page;

class Create extends Component
{
    public $title             = [];
    public $subtitle          = [];
    public $short_description = [];
    public $description       = [];
    public $page_id, $pageID;

    public function mount($page_id)
    {
        $this->pageID = $page_id;        
    }

    public function render()
    {
        return view('livewire.admin.pages.translations.create');
    }

    private function resetInputFields()
    {
		$this->reset(['title', 'subtitle', 'short_description', 'description']);
    }

    public function onCreatePageTranslation()
    {
        $this->validate([
            'title.' . app()->getLocale() => 'required'
        ]);

        try {

            $page = Page::findOrFail($this->pageID);

            if ( $page->hasTranslation(app()->getLocale()) == true ) {

                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('This language has been translated. You can edit it on the translation page!') ]);
            }
            else {

                $page->translateOrNew(app()->getLocale())->title             = !empty($this->title[app()->getLocale()]) ? strip_tags($this->title[app()->getLocale()]) : '';
                $page->translateOrNew(app()->getLocale())->subtitle          = !empty($this->subtitle[app()->getLocale()]) ? strip_tags($this->subtitle[app()->getLocale()]) : '';
                $page->translateOrNew(app()->getLocale())->short_description = !empty($this->short_description[app()->getLocale()]) ? strip_tags($this->short_description[app()->getLocale()]) : '';
                $page->translateOrNew(app()->getLocale())->description       = !empty($this->description[app()->getLocale()]) ? $this->description[app()->getLocale()] : '';
                $page->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            }

            $this->resetInputFields();
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
