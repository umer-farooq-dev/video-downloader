<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Advanced as Insert;

class Advanced extends Component
{

	public $insert_header;
	public $header_status = true;

	public $insert_footer;
	public $footer_status = true;

    public function mount()
    {
		$insert              = Insert::findOrFail(1);
		$this->insert_header = $insert->insert_header;
		$this->header_status = $insert->header_status;
		$this->insert_footer = $insert->insert_footer;
		$this->footer_status = $insert->footer_status;
    }

    public function render()
    {
        return view('livewire.admin.settings.advanced');
    }

    public function onUpdate()
    {
    	try {

			$insert                = Insert::findOrFail(1);
			$insert->insert_header = $this->insert_header;
			$insert->header_status = $this->header_status;
			$insert->insert_footer = $this->insert_footer;
			$insert->footer_status = $this->footer_status;
			$insert->updated_at    = new DateTime();
			$insert->save();

	        $this->mount();
	        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

    	} catch (\Exception $e) {
    		$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
    	}
    }

}
