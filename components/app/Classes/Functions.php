<?php 
    
    use App\Models\Admin\Proxy;

    function url_get_contents($url)
    {
        $process = curl_init($url); 
        curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'); 
        curl_setopt($process, CURLOPT_TIMEOUT, 60); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($process, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($process, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($process, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($process, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function vlive_get_contents($url)
    {
        $process = curl_init($url); 
        curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36'); 
        curl_setopt($process, CURLOPT_REFERER, 'https://www.vlive.tv/');
        curl_setopt($process, CURLOPT_TIMEOUT, 60); 
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($process, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($process, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($process, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($process, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

    function fb_get_contents($url, $cookie)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'authority: www.facebook.com',
            'cache-control: max-age=0',
            'sec-ch-ua: "Google Chrome";v="89", "Chromium";v="89", ";Not A Brand";v="99"',
            'sec-ch-ua-mobile: ?0',
            'upgrade-insecure-requests: 1',
            'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.114 Safari/537.36',
            'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3;q=0.9',
            'sec-fetch-site: none',
            'sec-fetch-mode: navigate',
            'sec-fetch-user: ?1',
            'sec-fetch-dest: document',
            'accept-language: en-GB,en;q=0.9,tr-TR;q=0.8,tr;q=0.7,en-US;q=0.6',
            'cookie: ' . $cookie
        ));

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function ins_get_contents($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }

    function get_original_url($url, $max_redirs = 3)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, true);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_MAXREDIRS, $max_redirs);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_exec($ch);
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        return $url;
    }

    function remove_mfb($url)
    {
        $url = str_replace(array('m.facebook.com', 'web.facebook.com', 'fb.com'), 'www.facebook.com', $url);
        return $url;
    }

    function tiktok_get_contents($url)
    {

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');
        curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.tiktok.com/');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'tt-cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'tt-cookie.txt');

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }

        $data = curl_exec($ch);
        // $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return $data;
    }

    function tiktok_get_redirect_url($url)
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36');
        curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
        curl_setopt($ch, CURLOPT_AUTOREFERER, false);
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.tiktok.com/');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'tt-cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'tt-cookie.txt');

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
            curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }

        $data = curl_exec($ch);
        //$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        curl_close($ch);
        return $url;
    }

    function tiktok_download_video($video_url, $filename, $geturl = false)
    {
        $ch = curl_init();

        $headers = array(
            'Range: bytes=0-',
        );

        curl_setopt($ch, CURLOPT_URL, $video_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'okhttp');
        curl_setopt($ch, CURLOPT_ENCODING, "utf-8");
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, 'tt-cookie.txt');
        curl_setopt($ch, CURLOPT_COOKIEFILE, 'tt-cookie.txt');
        curl_setopt($ch, CURLOPT_REFERER, 'https://www.tiktok.com/');
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);

        //Begin::Proxy
        $proxy = Proxy::where('banned', false)->inRandomOrder()->first();
        if ( !empty($proxy) ) {
            curl_setopt($ch, CURLOPT_PROXY, $proxy['ip'] . ":" . $proxy['port']);
            curl_setopt($ch, CURLOPT_PROXYTYPE, get_proxy_type( $proxy['type'] ));
            if (!empty($proxy['username']) && !empty($proxy['password'])) {
                curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy['username'] . ":" . $proxy['password']);
            }
            $chunkSize = 1000000;
            curl_setopt($ch, CURLOPT_TIMEOUT, (int)ceil(3 * (round($chunkSize / 1048576, 2) / (1 / 8))));
        }
        //End::Proxy
        
        if (defined('CURLOPT_IPRESOLVE') && defined('CURL_IPRESOLVE_V4')) {
          curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        }

        $data = curl_exec($ch);

        //$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if ($geturl === true)
        {
            return curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
        }

        curl_close($ch);
        $filename = "videos/tiktok-" . $filename . ".mp4";
        $d = fopen($filename, "w");
        fwrite($d, $data);
        fclose($d);
        return $data;
    }

    function url_post_contents($url, $data) {
        $headers = [
            'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg',
            'Connection: Keep-Alive',
            'Content-type: application/x-www-form-urlencoded;charset=UTF-',
            'Range: bytes=0-200000'
        ];

        $process = curl_init($url);
        curl_setopt($process, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($process, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.3');
        curl_setopt($process, CURLOPT_COOKIEFILE, 'cookie.txt');
        curl_setopt($process, CURLOPT_COOKIEJAR, 'cookie.txt');
        curl_setopt($process, CURLOPT_TIMEOUT, 60);
        curl_setopt($process, CURLOPT_POSTFIELDS, $data);
        curl_setopt($process, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($process, CURLOPT_POST, 1);
        curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($process,CURLOPT_CAINFO, NULL); 
        curl_setopt($process,CURLOPT_CAPATH, NULL); 
        
        $return = curl_exec($process);
        curl_close($process);
        return $return;
    }

	function ISO8601ToSeconds($ISO8601)
	{
	    preg_match('/\d{1,2}[H]/', $ISO8601, $hours);
	    preg_match('/\d{1,2}[M]/', $ISO8601, $minutes);
	    preg_match('/\d{1,2}[S]/', $ISO8601, $seconds);
	    
	    $duration = [
	        'hours'   => $hours ? $hours[0] : 0,
	        'minutes' => $minutes ? $minutes[0] : 0,
	        'seconds' => $seconds ? $seconds[0] : 0,
	    ];

	    if ( !empty($duration['hours']) ) {
	    	$hours   = substr($duration['hours'], 0, -1);
	    } else $hours = 0;

	    if ( !empty($duration['minutes']) ) {
	    	$minutes   = substr($duration['minutes'], 0, -1);
	    } else $minutes = 0;

	    if ( !empty($duration['seconds']) ) {
	    	$seconds   = substr($duration['seconds'], 0, -1);
	    } else $seconds = 0;

	    $toltalSeconds = ($hours * 60 * 60) + ($minutes * 60) + $seconds;

	    return $toltalSeconds;
	}

    function cleanStr($str)
    {
        return html_entity_decode(strip_tags($str), ENT_QUOTES, 'UTF-8');
    }

	function get_string_between($string, $start, $end)
	{
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}

	function format_seconds($seconds)
	{
	    return gmdate(($seconds > 3600 ? "H:i:s" : "i:s"), $seconds);
	}

	function sort_by_quality($a, $b)
	{
	    return (int)$b['quality'] - (int)$a['quality'];
	}

    function get_file_size($url, $format = false) {
        $result = -1;
        // Issue a HEAD request and follow any redirects.
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_NOBODY, true);
        curl_setopt($curl, CURLOPT_HEADER, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.3');
      
        $headers = curl_exec($curl);
        if (curl_errno($curl) == 0) {
            $result = (int)curl_getinfo($curl, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
        }
        curl_close($curl);
        if ($result > 100) {
            switch ($format) {
                case true:
                    return format_size($result);
                    break;
                case false:
                    return $result;
                    break;
                default:
                    return format_size($result);
                    break;
            }
        } else {
            return "";
        }
    }

    function format_size($bytes)
    {
        switch ($bytes) {
            case $bytes < 1024:
                $size = $bytes . " B";
                break;
            case $bytes < 1048576:
                $size = round($bytes / 1024, 2) . " KB";
                break;
            case $bytes < 1073741824:
                $size = round($bytes / 1048576, 2) . " MB";
                break;
            case $bytes < 1099511627776:
                $size = round($bytes / 1073741824, 2) . " GB";
                break;
        }
        if (!empty($size)) {
            return $size;
        } else {
            return "";
        }
    }

    function get_client_ip()
    {
    	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    		$ip = $_SERVER['HTTP_CLIENT_IP'];
    	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    	} else {
    		$ip = $_SERVER['REMOTE_ADDR'];
    	}
    	return $ip;
    }

    function beautify_filename($filename)
    {
        // reduce consecutive characters
        $filename = preg_replace(array(
            // "file   name.zip" becomes "file-name.zip"
            '/ +/',
            // "file___name.zip" becomes "file-name.zip"
            '/_+/',
            // "file---name.zip" becomes "file-name.zip"
            '/-+/'
        ), '-', $filename);
        $filename = preg_replace(array(
            // "file--.--.-.--name.zip" becomes "file.name.zip"
            '/-*\.-*/',
            // "file...name..zip" becomes "file.name.zip"
            '/\.{2,}/'
        ), '.', $filename);
        // lowercase for windows/unix interoperability http://support.microsoft.com/kb/100625
        $filename = mb_strtolower($filename, mb_detect_encoding($filename));
        // ".file-name.-" becomes "file-name"
        $filename = trim($filename, '.-');
        
        return $filename;
    }

    function filter_filename($filename, $beautify = true)
    {
        // sanitize filename
        $filename = preg_replace(
            '~
            [<>:"/\\|?*]|            # file system reserved https://en.wikipedia.org/wiki/Filename#Reserved_characters_and_words
            [\x00-\x1F]|             # control characters http://msdn.microsoft.com/en-us/library/windows/desktop/aa365247%28v=vs.85%29.aspx
            [\x7F\xA0\xAD]|          # non-printing characters DEL, NO-BREAK SPACE, SOFT HYPHEN
            [#\[\]@!$&\'()+,;=]|     # URI reserved https://tools.ietf.org/html/rfc3986#section-2.2
            [{}^\~`]                 # URL unsafe characters https://www.ietf.org/rfc/rfc1738.txt
            ~x',
            '-', $filename);
        // avoids ".", ".." or ".hiddenFiles"
        $filename = ltrim($filename, '.-');
        // optional beautification
        if ($beautify) $filename = beautify_filename($filename);
        // maximize filename length to 255 bytes http://serverfault.com/a/9548/44086
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = mb_strcut(pathinfo($filename, PATHINFO_FILENAME), 0, 255 - ($ext ? strlen($ext) + 1 : 0), mb_detect_encoding($filename)) . ($ext ? '.' . $ext : '');
        return $filename;
    }

    function sanitize_filename($string)
    {
        return (filter_filename($string) ?? time() );
    }

    function get_proxy_type($type)
    {
        switch ($type ?? 'http') {
            case 'https':
                $type = CURLPROTO_HTTPS;
                break;
            case 'socks4':
                $type = CURLPROXY_SOCKS4;
                break;
            case 'socks5':
                $type = CURLPROXY_SOCKS5;
                break;
            default:
                $type = CURLPROXY_HTTP;
                break;
        }
        return $type;
    }

    function encode($pData)
    {
        $encryption_key = 'themeluxurydotcom';

        $encryption_iv = '9999999999999999';

        $ciphering = "AES-256-CTR"; 
          
        $encryption = openssl_encrypt($pData, $ciphering, $encryption_key, 0, $encryption_iv);

        return $encryption;  

    }
