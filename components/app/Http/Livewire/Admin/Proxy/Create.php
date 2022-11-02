<?php

namespace App\Http\Livewire\Admin\Proxy;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Proxy;

class Create extends Component
{
    public $proxies;
    public $type;

    public function render()
    {
        return view('livewire.admin.proxy.create');
    }

    private function resetInputFields()
    {
        $this->reset(['type', 'proxies']);
    }

    public function onAddProxy()
    {
          $this->validate([
            'proxies' => 'required',
            'type'    => 'required'
        ]);

        try {

            $exData = preg_split('/\n|\r\n?/', $this->proxies);

            foreach ($exData as $valData) {
                
                $exProxy           = explode(':', $valData);

                $proxy             = new Proxy;
                $proxy->type       = $this->type;
                $proxy->ip         = $exProxy[0];
                $proxy->port       = $exProxy[1];
                $proxy->username   = $exProxy[2] ?? '';
                $proxy->password   = $exProxy[3] ?? '';
                $proxy->usage      = 0;
                $proxy->banned     = true;
                $proxy->created_at = new DateTime();
                $proxy->save();
            }

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'addNewProxy']);
            $this->resetInputFields();
            $this->emit('sendUpdateProxyStatus');

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

}
