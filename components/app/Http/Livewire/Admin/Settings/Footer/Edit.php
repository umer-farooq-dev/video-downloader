<?php

namespace App\Http\Livewire\Admin\Settings\Footer;

use Livewire\Component;
use App\Models\Admin\FooterTranslation;

class Edit extends Component
{

    public $layout;
    public $widget1;
    public $widget2;
    public $widget3;
    public $widget4;
    public $widget5;
    public $bottom_text;

    public $trans_id, $transID;

    public function mount($trans_id)
    {
        $this->transID                         = $trans_id;

        $footerTrans                           = FooterTranslation::findOrFail($this->transID);
        $this->layout[app()->getLocale()]      = $footerTrans->layout;
        $this->widget1[app()->getLocale()]     = $footerTrans->widget1;
        $this->widget2[app()->getLocale()]     = $footerTrans->widget2;
        $this->widget3[app()->getLocale()]     = $footerTrans->widget3;
        $this->widget4[app()->getLocale()]     = $footerTrans->widget4;
        $this->widget5[app()->getLocale()]     = $footerTrans->widget5;
        $this->bottom_text[app()->getLocale()] = $footerTrans->bottom_text;

    }

    public function render()
    {
        return view('livewire.admin.settings.footer.edit');
    }

    public function onUpdateFooterTranslation()
    {   
        try {

            $footer                                                  = FooterTranslation::findOrFail($this->transID);
            $footer->layout      = !empty($this->layout[app()->getLocale()]) ? strip_tags($this->layout[app()->getLocale()]) : '';
            $footer->widget1     = !empty($this->widget1[app()->getLocale()]) ? $this->widget1[app()->getLocale()] : '';
            $footer->widget2     = !empty($this->widget2[app()->getLocale()]) ? $this->widget2[app()->getLocale()] : '';
            $footer->widget3     = !empty($this->widget3[app()->getLocale()]) ? $this->widget3[app()->getLocale()] : '';
            $footer->widget4     = !empty($this->widget4[app()->getLocale()]) ? $this->widget4[app()->getLocale()] : '';
            $footer->widget5     = !empty($this->widget5[app()->getLocale()]) ? $this->widget5[app()->getLocale()] : '';
            $footer->bottom_text = !empty($this->bottom_text[app()->getLocale()]) ? $this->bottom_text[app()->getLocale()] : '';
            
            $footer->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
         
    }

}
