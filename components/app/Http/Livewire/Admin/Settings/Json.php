<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Json as Jsons;

class Json extends Component
{
    public $status;

    public function mount()
    {
        $json         = Jsons::findOrFail(1);
        $this->status = $json->status;
    }

    public function render()
    {
        return view('livewire.admin.settings.json');
    }

    public function onUpdateJson()
    {
        try {

            $json               = Jsons::findOrFail(1);
            $json->status       = $this->status;
            $json->updated_at = new DateTime();
            $json->save();

            $this->mount();
            $this->render();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
