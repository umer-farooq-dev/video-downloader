<?php

namespace App\Http\Livewire\Admin\Settings\SupportedSites;

use Livewire\Component;
use DateTime;
use App\Models\Admin\SupportedSite;
use App\Models\Admin\Page;

class Create extends Component
{
    public $title;
    public $link;
    public $image;

    public $pages = [];

    protected $listeners = ['onSetSiteImage'];

    public function mount()
    {
        $this->pages = Page::orderBy('id', 'DESC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.settings.supported-sites.create');
    }

    private function resetInputFields()
    {
		$this->reset(['title', 'link', 'image']);
    }

    public function onSetSiteImage($value)
    {
        $this->image = $value;
    }

    public function onCreateSite()
    {

        $this->validate([
            'title'  => 'required',
            'link'   => 'required',
        ]);

        try {

            $site             = new SupportedSite;
            $site->title      = strip_tags($this->title);
            $site->link       = strip_tags($this->link);
            $site->image      = strip_tags($this->image);
            $site->created_at = new DateTime();
            $site->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewSite']);
            $this->resetInputFields();
            $this->emit('sendUpdateSiteStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
