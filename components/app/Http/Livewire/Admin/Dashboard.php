<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Admin\Downloads;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Dashboard extends Component
{
    public function render()
    {
    	$downloadToday = Downloads::where('created_at', '>=', Carbon::today())->count() ?? 0;

    	$downloadThisWeek = Downloads::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek() ])->count() ?? 0;

    	$download30Days = Downloads::whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth() ])->count() ?? 0;

    	$downloadAll = Downloads::count() ?? 0;

    	//
		$getAllDays = Downloads::select( DB::raw('DATE(created_at) as date') )->groupBy('date')->get()->toArray();

		$downloadPerDay = Downloads::select( DB::raw('DATE(created_at) as date'), DB::raw('count(*) as downloads') )->groupBy('date')->get()->toArray();

		$getMaxDownloads = Downloads::select( DB::raw('DATE(created_at) as date'), DB::raw('count(*) as downloads') )->groupBy('date')->get()->max('downloads');

		//
		$getAllWebsites = Downloads::select( DB::raw('source') )->groupBy('source')->get()->toArray();

		$downloadPerWebsite = Downloads::select( 'source', DB::raw('count(*) as source') )->groupBy('source')->get()->toArray();

		$getMaxDownloadPerWebsite = Downloads::select( 'source', DB::raw('count(*) as source') )->groupBy('source')->get()->max('source');
		
		$dlPerSite = Downloads::select( DB::raw('source'), DB::raw('count(*) as downloads') )->groupBy('source')->get()->toArray();

		//dd($dlPerSite);

        return view('livewire.admin.dashboard', [
			'downloadToday'    => $downloadToday,
			'downloadThisWeek' => $downloadThisWeek,
			'download30Days'   => $download30Days,
			'downloadAll'      => $downloadAll,
			'getAllDays'       => $getAllDays,
			'downloadPerDay'   => $downloadPerDay,
			'getMaxDownloads'  => $getMaxDownloads,
			'getAllWebsites' => $getAllWebsites,
			'downloadPerWebsite' => $downloadPerWebsite,
			'getMaxDownloadPerWebsite' => $getMaxDownloadPerWebsite,
			'dlPerSite' => $dlPerSite
        ]);
    }
}
