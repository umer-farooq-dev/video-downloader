<?php

namespace App\Http\Livewire\Admin\Pages\Translations;

use Livewire\Component;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\Page;

class Edit extends Component
{
    public $title             = [];
    public $subtitle          = [];
    public $short_description = [];
    public $description       = [];

    public $slug;
    public $trans_id, $transID;

    public function mount($trans_id)
    {
        $this->transID                               = $trans_id;

        $pageTrans                                   = PageTranslation::findOrFail($this->transID);
        $this->slug                                  = Page::where('id', $pageTrans->page_id)->first()->slug;
        $this->title[app()->getLocale()]             = $pageTrans->title;
        $this->subtitle[app()->getLocale()]          = $pageTrans->subtitle;
        $this->short_description[app()->getLocale()] = $pageTrans->short_description;
        $this->description[app()->getLocale()]       = $pageTrans->description;
    }

    public function render()
    {
        return view('livewire.admin.pages.translations.edit');
    }

    public function onEditPageTranslation()
    {   

        $this->validate([
            'title.' . app()->getLocale() => 'required'
        ]);

        try {

            $page                    = PageTranslation::findOrFail($this->transID);
            
            $page->title             = !empty($this->title[app()->getLocale()]) ? strip_tags($this->title[app()->getLocale()]) : '';
            $page->subtitle          = !empty($this->subtitle[app()->getLocale()]) ? strip_tags($this->subtitle[app()->getLocale()]) : '';
            $page->short_description = !empty($this->short_description[app()->getLocale()]) ? strip_tags($this->short_description[app()->getLocale()]) : '';
            $page->description       = !empty($this->description[app()->getLocale()]) ? $this->description[app()->getLocale()] : '';
            $page->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
