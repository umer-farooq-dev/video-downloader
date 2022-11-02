<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use DateTime, App, File;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Languages;
use App\Models\Admin\PageTranslation;
use App\Models\Admin\FooterTranslation;

class Translations extends Component
{
    public $languages      = [];
    public $translations   = [];
    public $activeTransTab = false;

    protected $listeners = ['onDeleteLanguage', 'sendUpdateLanguageStatus' => 'onUpdateLanguageStatus'];

    public function mount()
    {
         $this->languages = Languages::all()->toArray();
    }

    public function render()
    {
        return view('livewire.admin.settings.translations');
    }

    /**
     * -------------------------------------------------------------------------------
     *  Set Default Language
     * -------------------------------------------------------------------------------
    **/

    public function onSetDefault($id)
    {
        try {

            Languages::where('default', '=', true)->update( ['default' => false] );
            $trans             = Languages::findOrFail($id);
            $trans->default    = true;
            $trans->updated_at = new DateTime();
            $trans->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

    /**
     * -------------------------------------------------------------------------------
     *  Edit
     * -------------------------------------------------------------------------------
    **/

    public function onUpdateLanguageStatus(){
        $this->mount();
    }

    public function onShowEditLanguageModal($id)
    {
        try {
            $trans        = Languages::findOrFail($id);

            $this->emit('sendDataEditLanguage', ['lang_id' => $trans->id]);
            $this->dispatchBrowserEvent('showModal', ['id' => 'editLanguage']);
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteLanguageConfirm( $id )
    {
        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!')]);
    }

    public function onDeleteLanguage($id)
    {
        try {

            $trans = Languages::findOrFail($id);
            $trans->delete($id);

            $page_trans = PageTranslation::where('locale', $trans->code)->get();
            foreach ($page_trans as $page_tran) {
                $page_tran->delete($page_tran->id);
            }

            $footer_trans = FooterTranslation::where('locale', $trans->code)->get();
            foreach ($footer_trans as $footer_tran) {
                $footer_tran->delete($footer_tran->id);
            }

            try {
                
                File::delete( App::langPath() . ('/' . $trans->code . '.json') );

            } catch (\Exception $e) {

                $this->addError('error', __('Cannot delete file. Please check your permissions!'));
            }

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }
}
