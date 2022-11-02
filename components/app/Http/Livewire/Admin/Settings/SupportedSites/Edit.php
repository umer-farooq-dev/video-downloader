<?php

namespace App\Http\Livewire\Admin\Settings\SupportedSites;

use Livewire\Component;
use DateTime;
use App\Models\Admin\SupportedSite;
use App\Models\Admin\Page;

class Edit extends Component
{

    public $title;
    public $link;
    public $image;
    public $site_id;

    public $pages = [];

    protected $listeners = ['onSetSiteImage', 'sendDataEditSite' => 'onUpdateDataEditSite'];

    public function mount()
    {
        $this->pages = Page::orderBy('id', 'DESC')->get()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.settings.supported-sites.edit');
    }

    private function resetInputFields()
    {
		$this->reset(['title', 'link', 'image']);
    }

    public function onSetSiteImage($value)
    {
        $this->image = $value;
    }

    public function onUpdateDataEditSite(SupportedSite $data)
    {
        $this->site_id = $data->id;
        $this->title   = $data->title;
        $this->link    = $data->link;
        $this->image   = $data->image;
    }

    public function onEditSite($id)
    {

        $this->validate([
            'title'  => 'required',
            'link'  => 'required',
        ]);

        try {

            $site             = SupportedSite::findOrFail($id);
            $site->title      = strip_tags($this->title);
            $site->link       = strip_tags($this->link);
            $site->image      = strip_tags($this->image);
            $site->updated_at = new DateTime();
            $site->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editSite']);
            $this->resetInputFields();
            $this->emit('sendUpdateSiteStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
