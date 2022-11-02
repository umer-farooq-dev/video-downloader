<?php 

namespace App\Classes;
use Illuminate\Support\Facades\Cache;
use App\Models\Admin\General;

class SoundCloud {

    public $jsFiles = ["https://a-v2.sndcdn.com/assets/2-de6d2802-3.js", "https://a-v2.sndcdn.com/assets/2-5e4e4418-3.js", "https://a-v2.sndcdn.com/assets/2-6b083daa-3.js"];

    public function get_api_key()
    {

        $cacheAPIKey = Cache::get('soundcloud_api_key');

        if ($cacheAPIKey == null) {

            $get_source = url_get_contents( "https://soundcloud.com" );

            preg_match_all('/src="(.*?sndcdn\.com.*?js)/', $get_source, $matches);

            $api_key = "";

            if (isset($matches[1]) != "") {

                $this->jsFiles = $matches[1];

                foreach ($this->jsFiles as $jsFile) {

                    if (!empty($api_key)) {
                        break;
                    }

                    $jsContent = url_get_contents( $jsFile );

                    $api_key = get_string_between($jsContent, '"web-auth?client_id=', '&device_id=');

                    if (empty($api_key)) {

                        $api_key = get_string_between($jsContent, 'client_id:"', '",env:"');
                    }

                    if (!empty($api_key)) {

                        break;
                    }
                }
            }

            Cache::put('soundcloud_api_key', $api_key, now()->addMinutes(180) );

        } else $api_key = $cacheAPIKey;

        return $api_key;
    }

	public function download($url)
	{
        if (parse_url($url, PHP_URL_HOST) == 'm.soundcloud.com') {
            $url = str_replace('m.soundcloud.com', 'soundcloud.com', $url);
        }

        $get_source = url_get_contents($url);

        $track_id = get_string_between($get_source, 'content="soundcloud://sounds:', '">');

        $track['title'] = get_string_between($get_source, 'property="og:title" content="', '"');

        $track['source'] = "SoundCloud";

        $thumbnail = file_get_contents( get_string_between($get_source, 'property="og:image" content="', '"') );

        $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

        $track['thumbnail'] = $dataBase64;

        $track['duration'] = format_seconds(get_string_between($get_source, '"full_duration":', ',') / 1000);

        $track['links'] = array();

        $data = url_get_contents( 'https://api-v2.soundcloud.com/tracks?ids='.$track_id.'&client_id='.$this->get_api_key().'&app_version=1605107988&app_locale=en' );

        $data = json_decode($data, true);

        if (isset($data[0]) != '') {

            foreach ($data[0]['media']['transcodings'] as $stream) {

                $mp3_url = json_decode(url_get_contents($stream['url'] . "?client_id=" . $this->get_api_key() ), true)['url'];

                $mp3_size = get_file_size( $mp3_url );

                if (!empty($mp3_size)) {

                    $token['url']      = $mp3_url;
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( get_string_between($get_source, 'property="og:title" content="', '"') );
                    $token['type']     = 'mp3';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );      

                    array_push($track['links'], array(
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( get_string_between($get_source, 'property="og:title" content="', '"') ),
                        'type'    => 'mp3',
                        'quality' => '128 kbps',
                        'bytes'   => $mp3_size ,
                        'size'    => format_size( $mp3_size ),
                        'mute'    => false
                    ));
                }

            }

        } else return;
        
        return $track;
	}
}