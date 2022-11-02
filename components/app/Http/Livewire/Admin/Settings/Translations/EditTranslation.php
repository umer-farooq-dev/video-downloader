<?php

namespace App\Http\Livewire\Admin\Settings\Translations;

use Livewire\Component;
use File;
use App;
use DateTime;
use App\Models\Admin\Translations;
use App\Models\Admin\Languages;

class EditTranslation extends Component
{
    public $searchQuery = '';

    public $lang_id;
    public $lang_name = '';

    public $translations = [];
    public $value;
    public $key;

    protected $listeners = ['sendUpdateTranslationStatus' => 'onUpdateTranslationStatus'];

    public function mount($lang_id)
    {
        $this->lang_id   = $lang_id;
        $this->lang_name = Languages::findOrFail($this->lang_id)->name;
    }

    public function render()
    {
        $this->translations = Translations::where('lang_id', $this->lang_id )->where(function ($query) {
               $query->where('key', 'like', '%'.$this->searchQuery.'%')
                     ->orWhere('value', 'like', '%'.$this->searchQuery.'%');
           })->orderBy('id', 'DESC')->get()->toArray();

        return view('livewire.admin.settings.translations.edit-translation',[
            'translations' => $this->translations
        ]);
    }

    public function onUpdateTranslationStatus(){
        $this->mount($this->lang_id);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function onUpdateTranslation()
    {

        $this->validate([
            'translations.*.key'   => 'required',
            'translations.*.value' => 'required'
        ]);

        if ( !empty($this->translations) ) {

            foreach ($this->translations as $key => $value) {
                
                $trans             = Translations::findOrFail($value['id']);
                $trans->value      = strip_tags( $value['value'] );
                $trans->updated_at = new DateTime();
                $trans->save();
            }

            try {
     
                $trans           = Languages::findOrFail($this->lang_id);
                $transData       = Translations::where('lang_id', $this->lang_id)->get(['key', 'value']);

                $arrayData = array();

                foreach ($transData as $value) {
                    $arrayData += array( strip_tags($value['key']) => strip_tags($value['value']) );
                }

                $jsonData = json_encode($arrayData, true);

                File::put( App::langPath() . ('/' . $trans->code . '.json'), $jsonData );

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
                $this->mount($this->lang_id);

            } catch (\Exception $e) {

                $this->addError('error', __('Unable to create new translation. Please check your permissions!') );
                
            }

        }
    }

    public function onDeleteTranslation($id)
    {
 
        $trans = Translations::findOrFail($id);

        $trans->delete($id);

        try {
 
            $trans           = Languages::findOrFail($this->lang_id);
            $transData       = Translations::where('lang_id', $this->lang_id)->get(['key', 'value']);

            $arrayData = array();

            foreach ($transData as $value) {
                $arrayData += array( $value['key'] => $value['value'] );
            }

            $jsonData = json_encode($arrayData, true);

            File::put( App::langPath() . ('/' . $trans->code . '.json'), $jsonData );

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            $this->mount($this->lang_id);

        } catch (\Exception $e) {

            $this->addError('error', __('Unable to create new translation. Please check your permissions!') );
        }

    }

}
