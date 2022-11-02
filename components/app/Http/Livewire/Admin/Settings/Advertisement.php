<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Advertisement as Ads;
use App\Models\Admin\Page;
use GrahamCampbell\Security\Facades\Security;

class Advertisement extends Component
{

	public $area1;
	public $area1_status = false;
	public $area1_align  = 'center';
	public $area1_margin = 10;
	
	public $area2;
	public $area2_status = false;
	public $area2_align  = 'center';
	public $area2_margin = 10;
	
	public $area3;
	public $area3_status = false;
	public $area3_align  = 'center';
	public $area3_margin = 10;
	
	public $area4;
	public $area4_status = false;
	public $area4_align  = 'center';
	public $area4_margin = 10;

	public $pages = [];
	public $ads_status;

    public function mount()
    {
		$ads                = Ads::findOrFail(1);

		$this->pages        = Page::all()->toArray();

		$this->area1        = $ads->area1;
		$this->area1_status = $ads->area1_status;
		$this->area1_align  = $ads->area1_align;
		$this->area1_margin = $ads->area1_margin;
		
		$this->area2        = $ads->area2;
		$this->area2_status = $ads->area2_status;
		$this->area2_align  = $ads->area2_align;
		$this->area2_margin = $ads->area2_margin;
		
		$this->area3        = $ads->area3;
		$this->area3_status = $ads->area3_status;
		$this->area3_align  = $ads->area3_align;
		$this->area3_margin = $ads->area3_margin;
		
		$this->area4        = $ads->area4;
		$this->area4_status = $ads->area4_status;
		$this->area4_align  = $ads->area4_align;
		$this->area4_margin = $ads->area4_margin;

    }

    public function render()
    {

        return view('livewire.admin.settings.advertisement');
    }

    public function onUpdateADS()
    {
    	try {

			$ads               = Ads::findOrFail(1);
			$ads->area1        = $this->area1;
			$ads->area1_status = $this->area1_status;
			$ads->area1_align  = $this->area1_align;
			$ads->area1_margin = $this->area1_margin;

			$ads->area2        = $this->area2;
			$ads->area2_status = $this->area2_status;
			$ads->area2_align  = $this->area2_align;
			$ads->area2_margin = $this->area2_margin;

			$ads->area3        = $this->area3;
			$ads->area3_status = $this->area3_status;
			$ads->area3_align  = $this->area3_align;
			$ads->area3_margin = $this->area3_margin;

			$ads->area4        = $this->area4;
			$ads->area4_status = $this->area4_status;
			$ads->area4_align  = $this->area4_align;
			$ads->area4_margin = $this->area4_margin;

			$ads->updated_at   = new DateTime();
			$ads->save();

            foreach ($this->pages as $key => $value) {
                $page             = Page::findOrFail($value['id']);
                $page->ads_status = $value['ads_status'];
                $page->updated_at = new DateTime();
                $page->save();
            }

	        $this->mount();
	        $this->render();
	        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

    	} catch (\Exception $e) {
    		$this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
    	}

    }

}
