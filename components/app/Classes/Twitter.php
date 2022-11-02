<?php
namespace App\Classes;
use App\Models\Admin\General;

class Twitter
{
    function codebird_request($path)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => url('/') . "/components/app/Classes/codebird.php?data=" . encode($path),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-authorization: Bearer AAAAAAAAAAAAAAAAAAAAANRILgAAAAAAnNwIzUejRCOuH5E6I8xnZz4puTs%3D1Zv7ttfk8LF81IUq16cHjhLTvJu4FA33AGWWjCpTnA"
            ),
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);

        curl_close($curl);

        if ($err)  return false;

        else return $response;
    }

    function tweet_data($tweet_id)
    {
        return $this->codebird_request("1.1/statuses/show/$tweet_id.json?tweet_mode=extended&include_entities=true");
    }

    function broadcast_data($broadcast_id)
    {
        return $this->codebird_request("1.1/broadcasts/show.json?ids=$broadcast_id&include_events=true");
    }

    function find_id($url)
    {
        $domain = str_ireplace("www.", "", parse_url($url, PHP_URL_HOST));
        $last_char = substr($url, -1);
        if ($last_char == "/") {
            $url = substr($url, 0, -1);
        }
        switch ($domain) {
            case "twitter.com":
                $arr = explode("/", $url);
                return end($arr);
                break;
            case "mobile.twitter.com":
                $arr = explode("/", $url);
                return end($arr);
                break;
            default:
                $arr = explode("/", $url);
                return end($arr);
                break;
        }
    }

    function download($url)
    {   

        $response = $this->tweet_data( $this->find_id($url) );

        if (!isset($tweet_data["entities"]["media"]) && isset($tweet_data["entities"]["urls"][0]["expanded_url"]) && is_contains($tweet_data["entities"]["urls"][0]["expanded_url"], "https://twitter.com/i/broadcasts/")) {
            
            preg_match('/https:\/\/twitter.com\/i\/broadcasts\/(.*)/', $tweet_data["entities"]["urls"][0]["expanded_url"], $matches);
            
            if (count($matches) < 2) {
                return false;
            }

            $broadcast_id = $matches[1];

            print_r($this->broadcast_data($broadcast_id));
        }

        $deJson = json_decode($response);

        if( !empty($deJson->extended_entities->media[0]->video_info->variants) )
        {
            $data['title'] = $deJson->full_text;

            $data['thumbnail'] = $deJson->extended_entities->media[0]->media_url_https;

            $data['duration'] = format_seconds( $deJson->extended_entities->media[0]->video_info->duration_millis / 1000);

            $data['source'] = "Twitter";

            $media = $deJson->extended_entities->media[0]->video_info->variants;

            $data['links'] = array();

            $i = 0;

            foreach ($media as $key => $value) 
            {

                switch ($media[$key]->content_type) 
                {
                    case 'application/x-mpegURL':

                        $data['links'][$i]['quality'] = 'm3u8';

                        $data['links'][$i]['type'] = 'm3u8';

                    break;

                    case 'application/dash+xml':

                        $data['links'][$i]['quality'] = 'dash';

                        $data['links'][$i]['type'] = 'dash';

                    break;
                    
                    default:

                        preg_match('/\/vid\/[0-9]*x(.*?)\/.*.mp4/', $media[$key]->url, $matchQuality);

                        $data['links'][$i]['quality'] = $matchQuality[1] . 'p';

                        $data['links'][$i]['type']    = 'mp4';

                    break;
                }

                    $bytes                      = get_file_size( $media[$key]->url );

                    $token['url']      = $media[$key]->url;
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $deJson->full_text );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    $data['links'][$i]['url']      = $dlLink;
                    $data['links'][$i]['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $deJson->full_text );
                    $data['links'][$i]['bytes']    = $bytes;
                    $data['links'][$i]['size']     = format_size( $data['links'][$i]['bytes'] );
                    $data['links'][$i]['mute']     = false;

                    $i++;

            }

        } else return;

        usort($data['links'], 'sort_by_quality');

        return $data;     

    }

    function clean_title($string)
    {
        $title = preg_replace('/(https?:\/\/([-\w\.]+[-\w])+(:\d+)?(\/([\w\/_\.#-]*(\?\S+)?[^\.\s])?).*$)|(\n)/', '', $string);
        return !empty($title) ? $title : $string;
    }

    function get_quality($url)
    {
        preg_match_all('/vid\/(.*?)x(.*?)\//', $url, $output);
        if (!empty($output[2][0])) {
            return $output[2][0] . "p";
        } else {
            return "gif";
        }
    }

}