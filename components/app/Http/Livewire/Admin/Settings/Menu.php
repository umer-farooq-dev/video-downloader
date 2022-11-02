<?php

namespace App\Http\Livewire\Admin\Settings;

use Livewire\Component;
use Auth;
use DateTime;
use App\Models\Admin\Menu as MS;
use App\Models\Admin\Page;
use GrahamCampbell\Security\Facades\Security;
use Illuminate\Support\Facades\Storage;

class Menu extends Component
{
    public $menu_items;
    public $icon;
    public $fontawesome = [];

    public $text;
    public $url  = '#';
    public $type = 'link';
    public $class;
    public $itemID;

    public $menus = [];
    public $pages = [];
    protected $listeners = ['onUpdateMenu'];

    public function mount()
    {
        $this->menus       = MS::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray();
        $this->pages       = Page::orderBy('id', 'DESC')->get()->toArray();
        $this->fontawesome = Storage::disk('local')->get('fontawesome.json');
    }

    public function render()
    {
        return view('livewire.admin.settings.menu');
    }

    private function resetInputFields()
    {
		$this->reset(['text', 'menu_items', 'url', 'icon', 'type', 'class', 'itemID']);
    }

    public function addToMenu()
    {
        try {

            if ( $this->itemID != null ) {

                $ms             = MS::findOrFail($this->itemID);
                $ms->text       = Security::clean( $this->text );
                $ms->menu_items = ($this->menu_items == 'custom') ? Security::clean( $this->menu_items ) : Security::clean( $this->url );
                $ms->url        = ($this->menu_items == 'custom') ? Security::clean( $this->url ) : Security::clean( $this->menu_items );
                $ms->icon       = ($this->icon) ? Security::clean( $this->icon ) : null;
                $ms->type       = $this->type;
                $ms->class      = $this->class;
                $ms->updated_at = new DateTime();
                $ms->save();

                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);

            } else{

                $ms             = new MS;           
                $ms->text       = Security::clean( $this->text );
                $ms->menu_items = ($this->menu_items == 'custom') ? Security::clean( $this->menu_items ) : Security::clean( $this->url );
                $ms->url        = ($this->menu_items == 'custom') ? Security::clean( $this->url ) : Security::clean( $this->menu_items );
                $ms->icon       = ($this->icon) ? Security::clean( $this->icon ) : null;
                $ms->type       = $this->type;
                $ms->class      = $this->class;
                $ms->created_at = new DateTime();
                $ms->save();
                $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data created successfully!')]);
            }

            $this->mount();
            $this->resetInputFields();
        
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function editMenu($id)
    {
        try {

            $this->itemID     = $id;
            $ms               = MS::findOrFail($id);
            $this->text       = $ms->text;
            $this->menu_items = ($ms->menu_items == 'custom') ? $ms->menu_items : $ms->url;
            $this->url        = ($ms->menu_items == 'custom') ? $ms->url : $ms->menu_items;
            $this->icon       = ($ms->icon) ? $ms->icon : null;
            $this->type       = $ms->type;
            $this->class      = $ms->class;

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function removeMenu($id)
    {

        try {
            $ms = MS::findOrFail($id);

            $ms->delete($id);
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!')]);
            $this->mount();
            $this->resetInputFields();

        } catch (\Exception $e) {
           $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    }

    public function parseJsonArray($jsonArray, $parentID = 0) {

      $return = array();

      foreach ($jsonArray as $subArray) {

        $returnSubSubArray = array();

        if (isset($subArray['children'])) {

            $returnSubSubArray = $this->parseJsonArray($subArray['children'], $subArray['id']);
        }

        $return[] = array('id' => $subArray['id'], 'parentID' => $parentID);

        $return = array_merge($return, $returnSubSubArray);
      }
      return $return;
    }

    public function onUpdateMenu($data)
    {

        try {

            $data = $this->parseJsonArray($data);

            $i = 0;

            foreach ($data as $row) {

                $i++;
                $ms             = MS::findOrFail($row['id']);
                $ms->parent_id  = $row['parentID'];
                $ms->sort       = $i;
                $ms->updated_at = new DateTime();
                $ms->save();
            }
            
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data updated successfully!')]);
            $this->mount();

        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('alert', ['type' => 'error', 'message' => __($e->getMessage()) ]);
        }

    	
    }
}
