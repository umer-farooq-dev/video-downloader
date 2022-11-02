<?php
namespace App\Classes;
use App\Models\Admin\APIKeys;
use App\Models\Admin\General;

class Facebook
{

    function download($url)
    {

        $api_key = APIKeys::findOrFail(1);

        if ( !empty($api_key->facebook_cookies) ) {

            $url = get_original_url(remove_mfb($url));
            
            $url = 'https://www.facebook.com/' . $this->getID(urldecode($url));

            $get_source = fb_get_contents($url, $api_key->facebook_cookies);

            preg_match_all('/<script type="application\/ld\+json" nonce="\w{3,10}">(.*?)<\/script><link rel="canonical"/', $get_source, $matches);

            preg_match_all('/"video":{(.*?)},"video_home_www_injection_related_chaining_section"/', $get_source, $matches2);

            preg_match_all('/"playable_url":"(.*?)"/', $get_source, $matches3);

            $video['source'] = 'Facebook';

            $video['duration']  = ( $this->getDuration($get_source) )  ? format_seconds(ISO8601ToSeconds( $this->getDuration($get_source) ) ) : '';
            
            $video['links'] = [];

            if (!empty($matches[1][0])) {

                $data = json_decode($matches[1][0], true);

                if (empty($data) || $data['@type'] != 'VideoObject') {

                    return false;
                }

                $video['title'] = $data['name'];

                $thumbnail = file_get_contents( $data['thumbnailUrl'] );

                $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

                $video['thumbnail'] = $dataBase64;

                if (!empty($data['contentUrl'])) {

                    $bytes = get_file_size($data['contentUrl']);

                    $token['url']      = $data['contentUrl'];
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['name'] );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );              

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['name'] ),
                        'type'    => 'mp4',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => '360p',
                        'mute'    => false
                    ]);
                }

                $hd_link = get_string_between($get_source, 'hd_src:"', '"');

                if (!empty($hd_link)) {

                    $bytes = get_file_size($hd_link);

                    $token['url']      = $hd_link;
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['name'] );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['name'] ),
                        'type'    => 'mp4',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => '720p',
                        'mute'    => false
                    ]);
                }
            } else if (!empty($matches2[1][0])) {

                $json = "{" . $matches2[1][0] . "}";

                $data = json_decode($json, true);

                if (empty($data) || !!empty($data['story']['attachments'][0]['media']['__typename']) || $data['story']['attachments'][0]['media']['__typename'] != 'Video') {

                    return false;
                }

                $video['title']     = $data['story']['message']['text'];

                $thumbnail = file_get_contents( $data['story']['attachments'][0]['media']['thumbnailImage']['uri'] );

                $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

                $video['thumbnail'] = $dataBase64;

                if (!empty($data['story']['attachments'][0]['media']['playable_url'])) {

                    $bytes = get_file_size($data['story']['attachments'][0]['media']['playable_url']);

                    $token['url']      = $data['story']['attachments'][0]['media']['playable_url'];
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['story']['message']['text'] );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['story']['message']['text'] ),
                        'type'    => 'mp4',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => '360p',
                        'mute'    => false
                    ]);
                }
                if (!empty($data['story']['attachments'][0]['media']['playable_url_quality_hd'])) {

                    $bytes = get_file_size($data['story']['attachments'][0]['media']['playable_url_quality_hd']);

                    $token['url']      = $data['story']['attachments'][0]['media']['playable_url_quality_hd'];
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['story']['message']['text'] );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $data['story']['message']['text'] ),
                        'type'    => 'mp4',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => '720p',
                        'mute'    => false
                    ]);
                }
            } else if (!empty($matches3[1][0])) {

                preg_match('/"preferred_thumbnail":{"image":{"uri":"(.*?)"/', $get_source, $thumbnail);

                preg_match_all('/"playable_url_quality_hd":"(.*?)"/', $get_source, $hd_link);

                $video['title'] = 'Facebook Video';

                $thumbnail = file_get_contents( !empty($thumbnail[1]) ? $this->decode_json_text($thumbnail[1]) : '' );

                $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

                $video['thumbnail'] = $dataBase64;

                $sd_link = $this->decode_json_text($matches3[1][0]);

                $bytes = get_file_size($sd_link);

                $token['url']      = $sd_link;
                $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( 'Facebook Video' );
                $token['type']     = 'mp4';
                $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                array_push($video['links'], [
                    'url'     => $dlLink,
                    'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( 'Facebook Video' ),
                    'type'    => 'mp4',
                    'bytes'   => $bytes,
                    'size'    => format_size($bytes),
                    'quality' => '360p',
                    'mute'    => false
                ]);

                if (!empty($hd_link[1][0])) {

                    $hd_link = $this->decode_json_text($hd_link[1][0]);

                    $bytes = get_file_size($hd_link);

                    $token['url']      = $hd_link;
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( 'Facebook Video' );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( 'Facebook Video' ),
                        'type'    => 'mp4',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => '720p',
                        'mute'    => false
                    ]);
                }
            } else {
                return false;
            }

            usort($video['links'], 'sort_by_quality');
            return $video;

        } else{

            session()->flash('status', 'error');
            session()->flash('message', 'Invalid Cookies!');
            return;
        }

    }

    function getID($url)
    {
        if (preg_match('/\/(.*)\/videos\/(.*)\/(.*)\/([0-9]+)/U', $url, $matches)) {
            //https://www.facebook.com/username/videos/vb.user_id/video_id/
            $id = $matches[3];

        } elseif (preg_match('/\/(.*)\/videos\/(.*)\/([0-9]+)/', $url, $matches)) {
            //https://www.facebook.com/username/videos/video_id
            $id = $matches[3];

        } elseif (preg_match('/\/(.*)\/videos\/(.*)\/([0-9]+)/U', $url, $matches)) {
            //https://www.facebook.com/username/videos/video_id
            $id = $matches[2];

        } elseif (preg_match('/\/video\.php\?v\=([0-9]+)/', $url, $matches)) {
            //https://www.facebook.com/video.php?v=video_id
            $id = $matches[1];

        } elseif (preg_match('/\/watch\/\?v\=([0-9]+)/', $url, $matches)) {
            //https://www.facebook.com/watch/?v=video_id
            $id = $matches[1];

        } elseif (preg_match('/^(?:(?:https?:)?\/\/)?(?:www\.)?facebook\.com\/[a-zA-Z0-9\.]+\/videos\/(?:[a-zA-Z0-9\.]+\/)?([0-9]+)/', $url, $matches)) {

            $id = $matches[1];

        } elseif ( preg_match('/(?:\.?\d+)(?:\/videos)?\/?(\d+)?(?:[v]\=)?(\d+)?/i', $url, $matches) ) {

            $id = $matches[0];
        }

        return $id;
    }

    function decode_json_text($text)
    {
        $json = '{"text":"' . $text . '"}';
        $json = json_decode($json, 1);
        return $json["text"];
    }
    
    function getDuration($curl_content)
    {
        $regexDuration = '/"duration":"(.*?)"/';

        if (preg_match($regexDuration, $curl_content, $match)) {

            return str_replace('\/', '/', $match[1]);

        } else return;
    }

}