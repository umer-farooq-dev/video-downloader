<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\General as GS;
use App\Models\Admin\Social;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Brotzka\DotenvEditor\DotenvEditor;
class General extends Component
{

    protected $listeners          = ['onSetParallaxImage'];
    public $wave_animation_status = true;
    public $parallax_image;

    public $overlay_type          = 'solid';
    public $solid_color           = 'white';
    public $gradient_first_color  = 'white';
    public $gradient_second_color = 'white';
    public $gradient_position     = 'to top';

    public $opacity               = 0;
    public $blur                  = 0;

    //

    public $inputs                = [];
    public $i                     = 1;
    public $name, $url;
    public $socials               = [];

    public $font_family           = 'Open Sans';
    public $timezone              = 'UTC';
    public $font_style            = 'regular';
    public $prefix                = 'VidClear_';

    public $maintenance_mode             = false;
    public $automatic_language_detection = false;
    public $recaptcha_v3                 = true;
    public $language_switcher            = true;
    public $page_load                    = true;
    public $supported_sites              = true;
    public $default_language             = 'en';
    public $main_color                   = '#cb0c9f';
    public $share_icons_status           = true;
    public $author_box_status            = true;
    public $social_status                = true;

    public $google_fonts          = [];
    public $timezones             = [];

    public function mount()
    {

         $gs                                 = GS::findOrFail(1);

         $this->wave_animation_status        = $gs->wave_animation_status;
         $this->parallax_image               = $gs->parallax_image;
         $this->overlay_type                 = $gs->overlay_type;
         $this->solid_color                  = $gs->solid_color;
         $this->gradient_first_color         = $gs->gradient_first_color;
         $this->gradient_second_color        = $gs->gradient_second_color;
         $this->gradient_position            = $gs->gradient_position;
         $this->opacity                      = $gs->opacity;
         $this->blur                         = $gs->blur;

         $this->font_family                  = $gs->font_family;
         $this->font_style                   = $gs->font_style;
         $this->prefix                       = $gs->prefix;
         $this->timezone                     = $gs->timezone;
         $this->default_language             = $gs->default_language;
         $this->main_color                   = $gs->main_color;

         $this->maintenance_mode             = $gs->maintenance_mode;
         $this->automatic_language_detection = $gs->automatic_language_detection;
         $this->recaptcha_v3                 = $gs->recaptcha_v3;
         $this->language_switcher            = $gs->language_switcher;
         $this->page_load                    = $gs->page_load;
         $this->supported_sites              = $gs->supported_sites;
         $this->share_icons_status           = $gs->share_icons_status;
         $this->author_box_status            = $gs->author_box_status;
         $this->social_status                = $gs->social_status;

         $this->socials                      = Social::all()->toArray();
         $this->i                            = Social::all()->count();
         $this->google_fonts                 = Storage::disk('local')->get('google-fonts.json');
         $this->timezones                    = Storage::disk('local')->get('timezones.json');
    }

    public function render()
    {
        return view('livewire.admin.settings.general');
    }

    private function resetInputFields()
    {
		$this->reset(['name', 'url']);
    }

    public function onSetParallaxImage($value)
    {
      $this->parallax_image = $value;
    }

    public function addSocial($i)
    {
        $i = $i + 1;

        $this->i = $i;

        array_push($this->inputs ,$i);

    }

    public function removeSocial($i)
    {
        unset($this->inputs[$i]);
    }

    public function onUpdateGeneral()
    {

        try {

            $env = new DotenvEditor();

            $env->changeEnv([
                'APP_TIMEZONE'       => $this->timezone 
            ]);

            $gs                               = GS::findOrFail(1);

            $gs->wave_animation_status        = $this->wave_animation_status;
            $gs->parallax_image               = $this->parallax_image;
            $gs->overlay_type                 = $this->overlay_type;
            $gs->solid_color                  = $this->solid_color;
            $gs->gradient_first_color         = $this->gradient_first_color;
            $gs->gradient_second_color        = $this->gradient_second_color;
            $gs->gradient_position            = $this->gradient_position;
            $gs->opacity                      = $this->opacity;
            $gs->blur                         = $this->blur;

            $gs->font_family                  = $this->font_family;
            $gs->font_style                   = $this->font_style;
            $gs->prefix                       = $this->prefix;
            $gs->timezone                     = $this->timezone;
            $gs->default_language             = $this->default_language;
            $gs->main_color                   = $this->main_color;

            $gs->maintenance_mode             = $this->maintenance_mode;
            $gs->automatic_language_detection = $this->automatic_language_detection;
            $gs->recaptcha_v3                 = $this->recaptcha_v3;
            $gs->language_switcher            = $this->language_switcher;
            $gs->page_load                    = $this->page_load;
            $gs->supported_sites              = $this->supported_sites;
            $gs->share_icons_status           = $this->share_icons_status;
            $gs->author_box_status            = $this->author_box_status;
            $gs->social_status                = $this->social_status;
            $gs->updated_at                   = new DateTime();
            $gs->save();

            if ( $this->socials != null) {

                foreach ($this->socials as $key => $value) {
                    $usocial             = Social::findOrFail($value['id']);
                    $usocial->name       = $value['name'];
                    $usocial->url        = $value['url'];
                    $usocial->updated_at = new DateTime();
                    $usocial->save();
                }

            }

            if ( $this->name != null) {

                foreach ($this->name as $key => $value) {
                    $usocial             = new Social;
                    $usocial->name       = ($this->name[$key] == '') ? 'facebook' : $this->name[$key];
                    $usocial->url        = $this->url[$key];
                    $usocial->created_at = new DateTime();
                    $usocial->save();
                }
            }

            $this->inputs = [];
       
            $this->resetInputFields();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
            $this->mount();
            $this->render();
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function onDeleteSocial($id)
    {
        try {

            $social = Social::findOrFail($id);
            $social->delete($id);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
