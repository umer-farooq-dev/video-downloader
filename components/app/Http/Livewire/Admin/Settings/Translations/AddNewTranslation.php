<?php

namespace App\Http\Livewire\Admin\Settings\Translations;

use Livewire\Component;
use File;
use App;
use DateTime;
use App\Models\Admin\Translations;
use App\Models\Admin\Languages;
class AddNewTranslation extends Component
{
    public $key;
    public $value;
    public $lang_id;

    public function mount($lang_id)
    {
        $this->lang_id = $lang_id;
    }

    public function render()
    {
        return view('livewire.admin.settings.translations.add-new-translation');
    }

    private function resetInputFields()
    {
		$this->reset(['key', 'value']);
    }

    public function onAddTranslation()
    {
        $this->validate([
            'key'   => 'required',
            'value' => 'required'
        ]);

        try {
            
            $trans             = new Translations;
            $trans->key        = strip_tags( $this->key );
            $trans->value      = strip_tags( $this->value );
            $trans->lang_id    = strip_tags( $this->lang_id );
            $trans->created_at = new DateTime();
            $trans->save();       
 
            $trans           = Languages::findOrFail($this->lang_id);
            $transData       = Translations::where('lang_id', $this->lang_id)->get(['key', 'value']);

            $arrayData = array();

            foreach ($transData as $value) {
                $arrayData += array( $value['key'] => $value['value'] );
            }

            $jsonData = json_encode($arrayData, true);

            File::put( App::langPath() . ('/' . $trans->code . '.json'), $jsonData );

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewTranslation']);
            $this->resetInputFields();
            $this->emit('sendUpdateTranslationStatus');

        } catch (\Exception $e) {

            $this->addError('error', __('Unable to create new translation. Please check your permissions!'));
            
        }


    }


}
