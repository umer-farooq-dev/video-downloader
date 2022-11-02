<?php

namespace App\Http\Livewire\Admin\Settings\Footer;

use Livewire\Component;
use App\Models\Admin\Footer;

class Create extends Component
{
    public $layout;
    public $widget1;
    public $widget2;
    public $widget3;
    public $widget4;
    public $widget5;
    public $bottom_text;

    public function render()
    {
        return view('livewire.admin.settings.footer.create');
    }

    public function onCreateFooterTranslation()
    {   

        try {

            $footer = Footer::findOrFail(1);

            if ( $footer->hasTranslation(app()->getLocale()) == true ) {

                $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('This footer language has been translated. You can edit it on the translation page!') ]);
            }
            else {

                $footer->translateOrNew(app()->getLocale())->layout      = !empty($this->layout[app()->getLocale()]) ? strip_tags($this->layout[app()->getLocale()]) : '';
                $footer->translateOrNew(app()->getLocale())->widget1     = !empty($this->widget1[app()->getLocale()]) ? $this->widget1[app()->getLocale()] : '';
                $footer->translateOrNew(app()->getLocale())->widget2     = !empty($this->widget2[app()->getLocale()]) ? $this->widget2[app()->getLocale()] : '';
                $footer->translateOrNew(app()->getLocale())->widget3     = !empty($this->widget3[app()->getLocale()]) ? $this->widget3[app()->getLocale()] : '';
                $footer->translateOrNew(app()->getLocale())->widget4     = !empty($this->widget4[app()->getLocale()]) ? $this->widget4[app()->getLocale()] : '';
                $footer->translateOrNew(app()->getLocale())->widget5     = !empty($this->widget5[app()->getLocale()]) ? $this->widget5[app()->getLocale()] : '';
                $footer->translateOrNew(app()->getLocale())->bottom_text = !empty($this->bottom_text[app()->getLocale()]) ? $this->bottom_text[app()->getLocale()] : '';
                
                $footer->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            }

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
         
    }

}
