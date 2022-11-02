<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Header as HS;

class Header extends Component
{

	public $logo;
	public $favicon;
	public $sticky_header = true;
	protected $listeners = ['onSetLogo', 'onSetFavicon'];

    public function mount()
    {
        $hs                  = HS::findOrFail(1);
        $this->logo          = $hs->logo;
        $this->favicon       = $hs->favicon;
        $this->sticky_header = $hs->sticky_header;
    }

    public function render()
    {
        return view('livewire.admin.settings.header');
    }

    public function onSetLogo($value)
    {
        $this->logo = $value;
    }

    public function onSetFavicon($value)
    {
        $this->favicon = $value;
    }

    public function onUpdateHeader()
    {
        try {

            $hs                = HS::findOrFail(1);
            $hs->logo          = $this->logo;
            $hs->favicon       = $this->favicon;
            $hs->sticky_header = $this->sticky_header;
            $hs->updated_at    = new DateTime();
            $hs->save();
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
