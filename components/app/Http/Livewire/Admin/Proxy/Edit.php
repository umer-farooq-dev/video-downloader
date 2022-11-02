<?php

namespace App\Http\Livewire\Admin\Proxy;

use Livewire\Component;
use DateTime;
use App\Models\Admin\Proxy;

class Edit extends Component
{
    protected $listeners = ['sendDataEditProxy' => 'onDataEditProxy'];

    public $type;
    public $ip;
    public $port;
    public $username;
    public $password;
    public $proxy_id;

    public function render()
    {
        return view('livewire.admin.proxy.edit');
    }

    public function onDataEditProxy(Proxy $proxy)
    {
        $this->proxy_id = $proxy->id;
        $this->type     = $proxy->type;
        $this->ip       = $proxy->ip;
        $this->port     = $proxy->port;
        $this->username = $proxy->username;
        $this->password = $proxy->password;
    }

    private function resetInputFields()
    {
        $this->reset(['type', 'ip', 'port', 'username', 'password']);
    }

    public function onEditProxy($id)
    {
         $this->validate([
            'ip'       => 'required',
            'type'     => 'required',
            'port'     => 'required'
        ]);

        try {

            $proxy             = Proxy::findOrFail($id);
            $proxy->type       = $this->type;
            $proxy->ip         = $this->ip;
            $proxy->port       = $this->port;
            $proxy->username   = $this->username;
            $proxy->password   = $this->password;
            $proxy->updated_at = new DateTime();
            $proxy->save();
                   
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!') ]);
            $this->dispatchBrowserEvent('closeModal', ['id' => 'editProxy']);
            $this->resetInputFields();
            $this->emit('sendUpdateProxyStatus');
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }
    }

}
