<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\General;
use App\Models\Admin\Social;
use App\Models\Admin\User;
use App\Models\Admin\Menu;
use App\Models\Admin\Header;
use App\Models\Admin\Footer;
use App\Models\Admin\Gdpr;
use App\Models\Admin\Advanced;
use App\Models\Admin\Advertisement;
use App\Models\Admin\APIKeys;
use App\Models\Admin\Page;
use App\Models\Admin\FooterTranslation;
use App\Models\Admin\Redirect;
use App\Models\Admin\SupportedSite;

class PagesController extends Controller
{
    //
    public function store($page){

         $pageTrans = Page::withTranslation()->translatedIn( app()->getLocale() )->whereTranslation('page_id', $page->id)->first();

         if ( !empty($pageTrans) ) {

             return view('frontend.pages', [
                'page'            => $page,
                'pageTrans'       => $pageTrans,
                'homeTitle'       => Page::where('type', 'home')->first()->title,
                'general'         => General::orderBy('id', 'DESC')->first(),
                'profile'         => User::with('user_socials')->orderBy('id', 'DESC')->first(),
                'menus'           => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
                'header'          => Header::orderBy('id', 'DESC')->first(),
                'footer'          => FooterTranslation::where('locale', app()->getLocale())->first(),
                'notice'          => Gdpr::orderBy('id', 'DESC')->first(),
                'supported_sites' => SupportedSite::orderBy('id', 'DESC')->get()->toArray(),
                'advanced'        => Advanced::orderBy('id', 'DESC')->first(),
                'advertisement'   => Advertisement::orderBy('id', 'DESC')->first(),
                'api_key'         => APIKeys::orderBy('id', 'DESC')->first(),
                'socials'         => Social::orderBy('id', 'ASC')->get()->toArray(),
                'twitter'         => Social::where('name', 'twitter')->get('url')->first()
            ]);

         } else return redirect()->route('page', ['slug' => Page::where('type', '404')->first()->slug]);

    }

    public function index($slug)
    {
        try {

            if ( Redirect::where('old_slug', $slug)->first() ) {
                
                return redirect( Redirect::where('old_slug', $slug)->first()->new_slug );

            } else {

                $page = Page::where('slug', $slug)->first();
                
                if ( isset($page->type) && $page->type != 'home') {
                    
                    return $this->store($page);         

                } else return redirect()->route('page', ['slug' => Page::where('type', '404')->first()->slug]);

            }

        } catch (\Exception $e) {
            return redirect()->route('sw_install');
        }

    }

    public function home()
    {
        try {

            $page = Page::where('type', 'home')->first();
            
            return $this->store($page);

        } catch (\Exception $e) {
            return redirect()->route('sw_install');
        }

    }

}
