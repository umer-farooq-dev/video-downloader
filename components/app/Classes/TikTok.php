<?php
namespace App\Classes;
use App\Models\Admin\General;

class TikTok
{

    function download($url)
    {
        preg_match('/#\/@\w{2,32}\/video\/\d{2,32}/', $url, $matches);

        if (count($matches) === 1) {

            $url = "https://www.tiktok.com" . ltrim($matches[0], "#");

        }
        if (!$this->check_host($url)) {

            $url = get_original_url($url);

            if ($this->check_host($url)) {

                $url = get_original_url($url);

            }
        }

        preg_match('/\/video\/([0-9]+)/', $url, $matches);

        if (count($matches) < 2) {
            return false;
        }

        $share_url = "https://www.tiktok.com/node/share/video/@" . $matches[1] . "/" . $matches[1];

        $share_data = tiktok_get_contents($share_url);

        $share_data = json_decode($share_data, true);

        if (!isset($share_data["itemInfo"]["itemStruct"]["video"]) || empty($share_data["itemInfo"]["itemStruct"]["video"])) {
            return false;
        }

        $video["source"] = "TikTok";

        $video["title"] = $share_data["itemInfo"]["itemStruct"]["desc"];

        if (empty($video["title"])) {
            $video["title"] = $share_data["metaParams"]["title"];
        }

        $thumbnail = file_get_contents( "https://www.tiktok.com/api/img/?itemId=" . $matches[1] . "&location=0" );

        $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

        $video['thumbnail'] = $dataBase64;

        $video["duration"] = format_seconds($share_data["itemInfo"]["itemStruct"]["video"]["duration"]);

        $video["links"] = array();

        $i = 0;

        if (!empty($share_data["itemInfo"]["itemStruct"]["video"]["downloadAddr"])) {

            $time = time();

            tiktok_download_video($share_data["itemInfo"]["itemStruct"]["video"]["downloadAddr"], $time);

            $temp_link = asset("videos/tiktok-" . $time . ".mp4");

            $video_key = $this->get_video_key(file_get_contents($temp_link));

            $token['url']      = $temp_link;
            $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $share_data["itemInfo"]["itemStruct"]["desc"] );
            $token['type']     = 'mp4';
            $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

            $video["links"][$i]["url"] = $dlLink;

            $video["links"][$i]["filename"] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $share_data["itemInfo"]["itemStruct"]["desc"] );

            $video["links"][$i]["type"] = "mp4";

            $video["links"][$i]["quality"] = $share_data["itemInfo"]["itemStruct"]["video"]["ratio"];

            $video["links"][$i]["bytes"] = get_file_size($temp_link);

            $video["links"][$i]["size"] = format_size( get_file_size($temp_link) );

            $video["links"][$i]["mute"] = false;

            $video["links"][$i]["watermark"] = false;

            $i++;

            if (!empty($video_key)) {

                $nwm_video = "https://api2-16-h2.musical.ly/aweme/v1/play/?video_id=$video_key&vr_type=0&is_play_url=1&source=PackSourceEnum_PUBLISH&media_type=4";

                $nwm_video = tiktok_get_redirect_url($nwm_video);

                $nwm_time = time();

                tiktok_download_video($nwm_video, $nwm_time);

                $nwm_temp_link = asset("videos/tiktok-" . $nwm_time . ".mp4");

                if (filter_var($nwm_video, FILTER_VALIDATE_URL)) {

                    $token['url']      = $nwm_video;
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $share_data["itemInfo"]["itemStruct"]["desc"] );
                    $token['type']     = 'mp4';
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    $video["links"][$i]["url"] = $dlLink;

                    $video["links"][$i]["filename"] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $share_data["itemInfo"]["itemStruct"]["desc"] );

                    $video["links"][$i]["type"] = "mp4";

                    $video["links"][$i]["quality"] = $video["links"][$i - 1]["quality"];

                    $video["links"][$i]["bytes"] = get_file_size($nwm_temp_link);

                    $video["links"][$i]["size"] = format_size($video["links"][$i]["bytes"]);

                    $video["links"][$i]["mute"] = false;

                    $video["links"][$i]["watermark"] = true;

                    $i++;
                }
            }
        }

        usort($video['links'], 'sort_by_quality');
        
        return $video;

    }

    function get_video_key($file_data)
    {
        $key = "";
        preg_match("/vid:([a-zA-Z0-9]+)/", $file_data, $matches);
        if (isset($matches[1])) {
            $key = $matches[1];
        }
        return $key;
    }

    function check_host($url)
    {
        $host = str_replace("www.", "", parse_url($url, PHP_URL_HOST));
        return $host == "tiktok.com";
    }

}