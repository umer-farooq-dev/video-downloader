<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Page;

class SitemapController extends Controller
{
    public function index()
    {
		$pages = Page::all()->sortDesc();

		return response()->view('frontend.sitemap', [
		  'pages' => $pages
		])->header('Content-Type', 'text/xml');
    }
}
