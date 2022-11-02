<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use App\Models\Admin\Proxy as Proxies;
use Livewire\WithPagination;
use DateTime;

class Proxy extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['onDeleteProxy', 'sendUpdateProxyStatus' => 'onUpdateProxyStatus'];

    public function render()
    {
        return view('livewire.admin.settings.proxy',[
            'proxies' => Proxies::orderBy('id', 'DESC')->paginate(15)
        ]);
    }

    public function onUpdateProxyStatus()
    {
        $this->render();
    }

    /**
     * -------------------------------------------------------------------------------
     *  Edit Proxy
     * -------------------------------------------------------------------------------
    **/

    public function onShowEditProxyModal($id)
    {
        $this->emit('sendDataEditProxy', ['id' => $id]);

        $this->dispatchBrowserEvent('showModal', ['id' => 'editProxy']);
    }

    /**
     * -------------------------------------------------------------------------------
     *  Delete Proxy
     * -------------------------------------------------------------------------------
    **/

    public function onDeleteProxyConfirm($id)
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);
    }

    public function onDeleteProxy($id)
    {
        try {
            $proxy = Proxies::findOrFail($id);

            $proxy->delete($id);

            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
            
        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    /**
     * -------------------------------------------------------------------------------
     *  Proxy Check
     * -------------------------------------------------------------------------------
    **/

    public function onProxyCheck($id)
    {
        $proxy = Proxies::findOrFail($id);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, 'https://www.youtube.com/');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        curl_setopt($ch, CURLOPT_PROXY, $proxy->ip);
        curl_setopt($ch, CURLOPT_PROXYPORT, $proxy->port); 
        if (!empty($proxy->username) && !empty($proxy->password)) {
            curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy->username . ":" . $proxy->password);
        }
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $data = curl_exec($ch);
        curl_close($ch);

        if ($data != "") {
            $proxy->banned = false;
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('This proxy is working!') ]);
        }
        else {
            $proxy->banned = true;
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __('This proxy is not working!') ]);
        }

        $proxy->updated_at = new DateTime();
        $proxy->save();

        $this->render();
    }

}
