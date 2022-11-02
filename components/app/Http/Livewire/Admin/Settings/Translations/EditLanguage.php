<?php

namespace App\Http\Livewire\Admin\Settings\Translations;

use Livewire\Component;
use DateTime;
use Illuminate\Support\Facades\Storage;
use App\Models\Admin\Languages;

class EditLanguage extends Component
{

    public $languages = [];
    public $lang_id;
    public $name;
    public $code;

    protected $listeners = ['sendDataEditLanguage' => 'onUpdateDataEditLanguage'];

    public function mount()
    {
        $this->languages = Storage::disk('local')->get('languages.json');
    }

    public function render()
    {
        return view('livewire.admin.settings.translations.edit-language');
    }
	
    private function resetInputFields()
    {
        $this->reset(['name', 'code']);
    }

    public function onUpdateDataEditLanguage(Languages $data)
    {
        $this->lang_id = $data->id;
        $this->name    = $data->name;
        $this->code    = $data->code;
    }

    public function onEditLanguage($id)
    {

        try {

            $lang             = Languages::findOrFail($id);
            $lang->name       = $this->name;
            $lang->code       = $this->code;
            $lang->updated_at = new DateTime();
            $lang->save();

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editLanguage']);
            $this->resetInputFields();
            $this->emit('sendUpdateLanguageStatus');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
