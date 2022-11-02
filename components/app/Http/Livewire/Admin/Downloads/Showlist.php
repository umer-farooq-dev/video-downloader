<?php

namespace App\Http\Livewire\Admin\Downloads;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Admin\Downloads;
use Auth;
use Request;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;
class Showlist extends Component
{
    use WithPagination;
    
    public $searchQuery = '';
    
    protected $paginationTheme = 'bootstrap';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.admin.downloads.showlist', [
            'downloads' => Downloads::orderBy('id', 'DESC')->paginate(15)
        ]);
    }
}
