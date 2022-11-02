<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use App\Models\Admin\User;
use App\Models\Admin\Report;
use Auth;
use Request;
use Illuminate\Support\Facades\Http;
use Livewire\WithPagination;
class Showlist extends Component
{

    use WithPagination;
    
    public $searchQuery = '';
    
    protected $paginationTheme = 'bootstrap';

    protected $listeners = ['onDeleteReport'];
    
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {

        return view('livewire.admin.report.showlist', [
            'reports' => Report::orderBy('id', 'DESC')->paginate(15)
        ]);

    }

    public function onDeleteConfirm( $id )
    {

        $this->dispatchBrowserEvent('swal:modal', ['id' => $id, 'type' => 'warning', 'title' => __('Are you sure?'), 'text' => __('You won\'t be able to revert this!') ]);

    }

    public function onDeleteReport( $id )
    {

        $report = Report::findOrFail($id);

        $report->delete($id);

        $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => __('Data deleted successfully!') ]);
    }

}
