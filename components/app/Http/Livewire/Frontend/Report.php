<?php

namespace App\Http\Livewire\Frontend;

use Livewire\Component;
use App\Models\Admin\Report as RP;
use DateTime;
class Report extends Component
{
    public $links;

    public function render()
    {
        return view('livewire.frontend.report');
    }

    public function sendReport()
    {
        $this->validate([
            'links'        => 'required'
        ]);

        $this->links = explode(PHP_EOL, $this->links);

        if ( count($this->links) > 0 ) {

            foreach ($this->links as $key => $value) {
                $report             = new RP;
                $report->link       = $value;
                $report->created_at = new DateTime();
                $report->save();
            }

            $this->links = null;
            session()->flash('status', 'success');
            session()->flash('message', __('Thanks for reporting issues to us. We will fix this issues as soon as possible.'));

        } else {

            $this->addError('404', __('Data not found!'));
        }
        
    }
}
