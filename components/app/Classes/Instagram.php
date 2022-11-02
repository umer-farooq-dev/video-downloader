<?php
namespace App\Classes;
use App\Models\Admin\APIKeys;
use App\Models\Admin\General;

class Instagram
{
    private $get_source;

    function download($url)
    {
        $api_key = APIKeys::findOrFail(1);

        if ( !empty($api_key->instagram_cookies) ) {

            $url = $url = strtok($url, '?');

            if (substr($url, -1) != '/') {

                $url .= "/";

            }

            $this->get_source = fb_get_contents($url, $api_key->instagram_cookies);

            preg_match('/window.__additionalDataLoaded\(\'.*\'\,(.*?)\)\;<\/script>/', $this->get_source, $matches);

            if (isset($matches[1])) {

                $video['links'] = array();

                $video['source'] = "Instagram";

                $deJson = json_decode($matches[1], true);

                $video['title'] = "Instagram Post from " . $deJson['graphql']['shortcode_media']['owner']['username'];

                $video['source'] = "Instagram";

                $thumbnail = file_get_contents( $deJson['graphql']['shortcode_media']['display_url'] );

                $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

                $video['thumbnail'] = $dataBase64;

                if ($deJson['graphql']['shortcode_media']['__typename'] == 'GraphVideo') {

                    $bytes = get_file_size( $deJson['graphql']['shortcode_media']['video_url'] );

                    $token['url']      = $deJson['graphql']['shortcode_media']['video_url'];
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( "Instagram Post from " . $deJson['graphql']['shortcode_media']['owner']['username'] );;
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );          

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( "Instagram Post from " . $deJson['graphql']['shortcode_media']['owner']['username'] ),
                        'type'    => 'mp4',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => 'HD',
                        'mute'    => false
                    ]);

                } else {

                    $bytes = get_file_size( $deJson['graphql']['shortcode_media']['display_url'] );

                    $token['url']      = $deJson['graphql']['shortcode_media']['display_url'];
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( "Instagram Post from " . $deJson['graphql']['shortcode_media']['owner']['username'] );;
                    $token['type']     = 'jpg';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );       

                    array_push($video['links'], [
                        'url'     => $dlLink,
                        'filename' => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( "Instagram Post from " . $deJson['graphql']['shortcode_media']['owner']['username'] ),
                        'type'    => 'jpg',
                        'bytes'   => $bytes,
                        'size'    => format_size($bytes),
                        'quality' => 'HD',
                        'mute'    => false
                    ]);

                }
                
                return $video;

            } else{

                session()->flash('status', 'error');
                session()->flash('message', __('Oops! We cannot get the download link.'));
                return;
            }
           
            
        } else{

            session()->flash('status', 'error');
            session()->flash('message', 'Invalid Cookies!');
            return;
        }

    }

}