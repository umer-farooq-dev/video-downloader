<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Classes\SoundCloud;
use App\Classes\Vimeo;
use App\Classes\Twitter;
use App\Classes\VLive;
use App\Classes\TikTok;
use App\Classes\Facebook;
use App\Classes\Instagram;
use App\Classes\Youtube;

use App\Models\Admin\APIKeys;
use App\Models\Admin\Downloads;
use DateTime;
use App\Models\Admin\Json;

class JsonController extends Controller
{
    public function index(Request $request)
    {
        try {

            $json = Json::findOrFail(1);

            if ( $json->status == true ) {

                if ( !empty($request->url) ) {
                
                    $host = parse_url($request->url, PHP_URL_HOST);

                    $domain = str_ireplace('www.', '', $host);

                    include app_path() . '/Classes/Functions.php';

                    switch ( $domain ) {

                        case 'soundcloud.com':

                                include app_path() . '/Classes/SoundCloud.php';

                                $sc = new SoundCloud();

                                $data = $sc->download( $request->url );

                            break;

                        case 'vimeo.com':

                                include app_path() . '/Classes/Vimeo.php';

                                $vm = new Vimeo();

                                $data = $vm->download( $request->url );

                            break;

                        case 'twitter.com':

                                include app_path() . '/Classes/Twitter.php';

                                $tw = new Twitter();

                                $data = $tw->download( $request->url );

                            break;

                        case 'vlive.tv':

                                include app_path() . '/Classes/VLive.php';

                                $vl = new VLive();

                                $data = $vl->download( $request->url );

                            break;

                        case 'tiktok.com':

                                include app_path() . '/Classes/TikTok.php';

                                $tt = new TikTok();

                                $data = $tt->download( $request->url );

                            break;

                        //case 'fb.watch':
                        case 'm.facebook.com':
                        case 'facebook.com':

                                include app_path() . '/Classes/Facebook.php';

                                $fb = new Facebook();

                                $data = $fb->download( $request->url );

                            break;

                        case 'instagram.com':

                                include app_path() . '/Classes/Instagram.php';

                                $ig = new Instagram();

                                $data = $ig->download( $request->url );

                            break;

                        case 'youtu.be':
                        case 'youtube.com':

                                include app_path() . '/Classes/Youtube.php';

                                $yt = new Youtube();

                                $data = $yt->download( $request->url );

                            break;

                        default:
                                $data = __('The link you sent is not on the supported sites.');
                            break;
                    }

                    if ( !empty($data) ) {

                        $dl             = new Downloads;
                        $dl->source     = $data['source'];
                        $dl->thumbnail  = $data['thumbnail'];
                        $dl->link       = $request->url;
                        $dl->client_ip  = get_client_ip();
                        $dl->created_at = new DateTime();
                        $dl->save();
                    }

                    return $data;

                } else return __( 'Missing URL!' );

            } else return redirect()->route('home');

        } catch (\Exception $e) {
            return __('Oops, Something Went Wrong!');
        }

    }
}
