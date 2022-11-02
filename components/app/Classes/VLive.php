<?php
namespace App\Classes;
use App\Models\Admin\General;

class VLive
{

    function download($url)
    {
        $get_source = url_get_contents($url);

        preg_match('/\"momentable\"\:true\,\"vodId\"\:\"(.*?)\"\,\"playTime\"\:([0-9]*)\,/', $get_source, $matchVodId);

        preg_match('/"videoSeq":([0-9]*),/', $get_source, $matchID);

        $video['title'] = get_string_between($get_source, 'property="og:title" content="', '"');

        $video['source'] = "VLive";

        $thumbnail = file_get_contents( get_string_between($get_source, 'property="og:image" content="', '"') );

        $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

        $video['thumbnail'] = $dataBase64;

        $video['duration'] = format_seconds( $matchVodId[2] );

        $getkey = vlive_get_contents('https://www.vlive.tv/globalv-web/vam-web/video/v1.0/vod/'.$matchID[1].'/inkey?appId=8c6cc7b45d2568fb668be6e05b6e5a3b&gcc=KR&platformType=PC');

        $deJson = json_decode($getkey, true);

        $web_page = vlive_get_contents('https://apis.naver.com/rmcnmv/rmcnmv/vod/play/v2.0/'.$matchVodId[1].'?key=' . $deJson['inkey']);

        $result = json_decode($web_page, true);

        $i = 0;

        foreach ($result['videos']['list'] as $current) {

            $token['url']      = $current['source'];
            $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( get_string_between($get_source, 'property="og:title" content="', '"') );
            $token['type']     = 'mp4';
            $dlLink            = url('/') . '/dl.php?token=' . encode( json_encode($token) );

            $video['links'][$i]['url']      = $dlLink;
            $video['links'][$i]['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename( get_string_between($get_source, 'property="og:title" content="', '"') );
            $video['links'][$i]['type']     = 'mp4';
            $video['links'][$i]['bytes']    = $current['size'];
            $video['links'][$i]['size']     = format_size( $current['size'] );
            $video['links'][$i]['quality']  = $current['encodingOption']['name'];
            $video['links'][$i]['mute']     = false;

            $i++;
        }

        usort($video['links'], 'sort_by_quality');

        return $video;
    }

}