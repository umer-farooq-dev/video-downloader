<?php

namespace App\Classes;
require_once __DIR__ . "/vendor/autoload.php";
use YouTube\YouTubeDownloader;
use App\Models\Admin\General;

class Youtube
{
    public $m4a_mp3          = true;
    public $hide_dash_videos = false;

    function download($url)
    {
        $yt = new YouTubeDownloader();

        $data = $yt->getDownloadLinks($url);

        $links = $data["links"];

        $json = $data["json"];

        $video["title"] = $json["videoDetails"]["title"];

        $video["thumbnail"] = "https://i.ytimg.com/vi/" . $json["videoDetails"]["videoId"] . "/mqdefault.jpg";

        $video["duration"] = format_seconds($json["videoDetails"]["lengthSeconds"]);

        $video["source"] = "Youtube";

        $video["links"] = array();

        $itags = array(18 => array('type' => 'mp4', 'itag' => 18, 'quality' => '360p', 'mute' => false), 22 => array('type' => 'mp4', 'itag' => 22, 'quality' => '720p', 'mute' => false), 91 => array('type' => 'ts', 'itag' => 91, 'quality' => '144p', 'mute' => false), 92 => array('type' => 'ts', 'itag' => 92, 'quality' => '240p', 'mute' => false), 93 => array('type' => 'ts', 'itag' => 93, 'quality' => '360p', 'mute' => false), 94 => array('type' => 'ts', 'itag' => 94, 'quality' => '480p', 'mute' => false), 95 => array('type' => 'ts', 'itag' => 95, 'quality' => '720p', 'mute' => false), 96 => array('type' => 'ts', 'itag' => 96, 'quality' => '1080p', 'mute' => false), 133 => array('type' => 'mp4', 'itag' => 133, 'quality' => '240p', 'mute' => true), 134 => array('type' => 'mp4', 'itag' => 134, 'quality' => '360p', 'mute' => true), 135 => array('type' => 'mp4', 'itag' => 135, 'quality' => '480p', 'mute' => true), 136 => array('type' => 'mp4', 'itag' => 136, 'quality' => '720p', 'mute' => true), 137 => array('type' => 'mp4', 'itag' => 137, 'quality' => '1080p', 'mute' => true), 138 => array('type' => 'mp4', 'itag' => 138, 'quality' => '4320p', 'mute' => true), 139 => array('type' => 'm4a', 'itag' => 139, 'quality' => '48kbps', 'mute' => false), 140 => array('type' => 'm4a', 'itag' => 140, 'quality' => '128kbps', 'mute' => false), 160 => array('type' => 'mp4', 'itag' => 160, 'quality' => '144p', 'mute' => true), 242 => array('type' => 'webm', 'itag' => 242, 'quality' => '240p', 'mute' => true), 243 => array('type' => 'webm', 'itag' => 243, 'quality' => '360p', 'mute' => true), 244 => array('type' => 'webm', 'itag' => 244, 'quality' => '480p', 'mute' => true), 247 => array('type' => 'webm', 'itag' => 247, 'quality' => '720p', 'mute' => true), 248 => array('type' => 'webm', 'itag' => 248, 'quality' => '1080p', 'mute' => true), 249 => array('type' => 'webm', 'itag' => 249, 'quality' => '48kbps', 'mute' => false), 250 => array('type' => 'webm', 'itag' => 250, 'quality' => '64kbps', 'mute' => false), 251 => array('type' => 'webm', 'itag' => 251, 'quality' => '160kbps', 'mute' => false), 264 => array('type' => 'mp4', 'itag' => 264, 'quality' => '1440p', 'mute' => true), 266 => array('type' => 'mp4', 'itag' => 266, 'quality' => '2160p', 'mute' => true), 271 => array('type' => 'webm', 'itag' => 271, 'quality' => '1440p', 'mute' => true), 272 => array('type' => 'webm', 'itag' => 272, 'quality' => '4320p60', 'mute' => true), 278 => array('type' => 'webm', 'itag' => 278, 'quality' => '144p', 'mute' => true), 298 => array('type' => 'mp4', 'itag' => 298, 'quality' => '720p60', 'mute' => true), 299 => array('type' => 'mp4', 'itag' => 299, 'quality' => '1080p60', 'mute' => true), 300 => array('type' => 'mp4', 'itag' => 300, 'quality' => '720p60', 'mute' => false), 301 => array('type' => 'mp4', 'itag' => 301, 'quality' => '1080p60', 'mute' => false), 302 => array('type' => 'webm', 'itag' => 302, 'quality' => '720p60', 'mute' => true), 303 => array('type' => 'webm', 'itag' => 303, 'quality' => '1080p60', 'mute' => true), 304 => array('type' => 'mp4', 'itag' => 304, 'quality' => '1440p60', 'mute' => true), 305 => array('type' => 'mp4', 'itag' => 305, 'quality' => '2160p60', 'mute' => true), 308 => array('type' => 'webm', 'itag' => 308, 'quality' => '1440p60', 'mute' => true), 313 => array('type' => 'webm', 'itag' => 313, 'quality' => '2160p', 'mute' => true), 315 => array('type' => 'webm', 'itag' => 315, 'quality' => '2160p60', 'mute' => true), 327 => array('type' => 'm4a', 'itag' => 327, 'quality' => 'kbps', 'mute' => false), 330 => array('type' => 'webm', 'itag' => 330, 'quality' => '144p60 HDR', 'mute' => true), 331 => array('type' => 'webm', 'itag' => 331, 'quality' => '240p60 HDR', 'mute' => true), 332 => array('type' => 'webm', 'itag' => 332, 'quality' => '360p60 HDR', 'mute' => true), 333 => array('type' => 'webm', 'itag' => 333, 'quality' => '480p60 HDR', 'mute' => true), 334 => array('type' => 'webm', 'itag' => 334, 'quality' => '720p60 HDR', 'mute' => true), 335 => array('type' => 'webm', 'itag' => 335, 'quality' => '1080p60 HDR', 'mute' => true), 336 => array('type' => 'webm', 'itag' => 336, 'quality' => '1440p60 HDR', 'mute' => true), 337 => array('type' => 'webm', 'itag' => 337, 'quality' => '2160p60 HDR', 'mute' => true), 338 => array('type' => 'webm', 'itag' => 338, 'quality' => 'kbps', 'mute' => false), 386 => array('type' => 'm4a', 'itag' => 386, 'quality' => 'kbps', 'mute' => false), 387 => array('type' => 'm4a', 'itag' => 387, 'quality' => 'kbps', 'mute' => false), 394 => array('type' => 'mp4', 'itag' => 394, 'quality' => '144p', 'mute' => true), 395 => array('type' => 'mp4', 'itag' => 395, 'quality' => '240p', 'mute' => true), 396 => array('type' => 'mp4', 'itag' => 396, 'quality' => '360p', 'mute' => true), 397 => array('type' => 'mp4', 'itag' => 397, 'quality' => '480p', 'mute' => true), 398 => array('type' => 'mp4', 'itag' => 398, 'quality' => '720p60', 'mute' => true), 399 => array('type' => 'mp4', 'itag' => 399, 'quality' => '1080p60', 'mute' => true), 400 => array('type' => 'mp4', 'itag' => 400, 'quality' => '1440p60', 'mute' => true), 401 => array('type' => 'mp4', 'itag' => 401, 'quality' => '2160p60', 'mute' => true), 402 => array('type' => 'mp4', 'itag' => 402, 'quality' => '4320p60', 'mute' => true), 571 => array('type' => 'mp4', 'itag' => 571, 'quality' => '4320p60', 'mute' => true));
        
        foreach ($links as $link) {

            if (!empty($itags[($link["itag"] ?? "")])) {

                if ($itags[$link["itag"]]["mute"] && $this->hide_dash_videos) {
                    $is_hidden = true;
                } else {

                    $token['url']      = $link["url"];
                    $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $json["videoDetails"]["title"] );
                    $token['type']     = ( $this->m4a_mp3 && $itags[$link["itag"]]["type"] == "m4a" ) ? 'mp3' : $itags[$link["itag"]]["type"];
                    $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

                    array_push($video["links"], array(
                        "url"      => $dlLink,
                        "filename" => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $json["videoDetails"]["title"] ),
                        "type"     => $itags[$link["itag"]]["type"],
                        "itag"     => $link["itag"],
                        "quality"  => $itags[$link["itag"]]["quality"],
                        "mute"     => $itags[$link["itag"]]["mute"],
                        "size"     => !empty($link['contentLength']) ? format_size($link['contentLength']) : format_size(get_file_size($link["url"]))
                    ));

                    if ($this->m4a_mp3 && $itags[$link["itag"]]["type"] == "m4a") {
                        array_push($video["links"], array(
                            "url"      => $dlLink,
                            "filename" => General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( $json["videoDetails"]["title"] ),
                            "type"     => "mp3",
                            "itag"     => $link["itag"],
                            "quality"  => $itags[$link["itag"]]["quality"],
                            "mute"     => $itags[$link["itag"]]["mute"],
                            "size"     => !empty($link['contentLength']) ? format_size($link['contentLength']) : format_size(get_file_size($link["url"]))
                        ));
                    }

                }
            }
        }

        usort($video["links"], 'sort_by_quality');

        return $video;

    }
    //
}