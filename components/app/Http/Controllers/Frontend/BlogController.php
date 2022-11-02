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

class BlogController extends Controller
{

    public function index()
    {
        try {

             return view('frontend.blog', [
                'page'          => Page::where('type', 'home')->first(),
                'pageTrans'     => Page::withTranslation()->translatedIn( app()->getLocale() )->where('type', 'default')->orderByTranslation('id', 'DESC')->paginate(6),
                'homeTitle'     => Page::where('type', 'home')->first()->title,
                'general'       => General::orderBy('id', 'DESC')->first(),
                'profile'       => User::with('user_socials')->orderBy('id', 'DESC')->first(),
                'menus'         => Menu::with('children')->where(['parent_id' => 'id'])->orderBy('sort','ASC')->get()->toArray(),
                'header'        => Header::orderBy('id', 'DESC')->first(),
                'footer'        => FooterTranslation::where('locale', app()->getLocale())->first(),
                'notice'        => Gdpr::orderBy('id', 'DESC')->first(),
                'advanced'      => Advanced::orderBy('id', 'DESC')->first(),
                'advertisement' => Advertisement::orderBy('id', 'DESC')->first(),
                'api_key'       => APIKeys::orderBy('id', 'DESC')->first(),
                'socials'       => Social::orderBy('id', 'DESC')->get()->toArray(),
                'twitter'       => Social::where('name', 'twitter')->get('url')->first()
            ]);

        } catch (\Exception $e) {
            return redirect()->route('sw_install');
        }

    }

}
