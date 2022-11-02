<?php
namespace App\Classes;
use App\Models\Admin\General;

class Vimeo
{

    function download($url)
    {
		preg_match('%^https?:\/\/(?:www\.|player\.)?vimeo.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)(?:$|\/|\?)(?:[?]?.*)$%im', $url, $vmID);

		$ranServer = rand(1,15);

		$web_page = url_post_contents('https://us'.$ranServer.'.proxysite.com/includes/process.php?action=update', 'server-option=us'.$ranServer.'&d='.urlencode('https://player.vimeo.com/video/'.$vmID[3]).'');
		
        if (preg_match_all('/window.vimeo.clip_page_config.player\s*=\s*({.+?})\s*;\s*\n/', $web_page, $match)) {

            $config_url = json_decode($match[1][0], true)["config_url"];

            $result = json_decode(url_get_contents($config_url), true);

        } else {

            $result = json_decode(get_string_between($web_page, "var config = ", "; if (!config.request)"), true);
        }
        if (empty($result)) {

            return false;

        }

        $video['title'] = $result['video']['title'];

        $video['source'] = 'Vimeo';

        $video['duration'] = format_seconds($result['video']['duration']);

        $thumbnail = file_get_contents( reset($result['video']['thumbs']) );

        $dataBase64 = 'data:image/jpeg;base64,' . base64_encode($thumbnail);

        $video['thumbnail'] = $dataBase64;

        $i = 0;

        foreach ($result['request']['files']['progressive'] as $current) {

            $token['url']      = $current['url'];
            $token['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename($result['video']['title']);
            $token['type']     = 'mp4';
            $dlLink = url('/') . '/dl.php?token=' . encode( json_encode($token) );

            $video['links'][$i]['url']      = $dlLink;
            $video['links'][$i]['filename'] = General::orderBy('id', 'DESC')->first()->prefix . sanitize_filename($result['video']['title']);
            $video['links'][$i]['type']     = 'mp4';
            $video['links'][$i]['bytes']    = get_file_size( $current['url'] );
            $video['links'][$i]['size']     = format_size($video['links'][$i]['bytes']);
            $video['links'][$i]['quality']  = $current['quality'];
            $video['links'][$i]['mute']     = false;

            $i++;
        }

        usort($video['links'], 'sort_by_quality');

        return $video;
    }

}