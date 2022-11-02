<?php

if ( !empty($_GET['data']) ) {

    if (! function_exists('http_get_request_headers')) {
        function http_get_request_headers()
        {
            $arh = [];
            $rx_http = '/\AHTTP_/';
            foreach ($_SERVER as $key => $val) {
                if (preg_match($rx_http, $key)) {
                    $arh_key = preg_replace($rx_http, '', $key);
                    $rx_matches = [];
                    // do some nasty string manipulations to restore the original letter case
                    // this should work in most cases
                    $rx_matches = explode('_', $arh_key);
                    if (count($rx_matches) > 0 && strlen($arh_key) > 2) {
                        foreach ($rx_matches as $ak_key => $ak_val) {
                            $rx_matches[$ak_key] = ucfirst(strtolower($ak_val));
                        }
                        $arh_key = implode('-', $rx_matches);
                    }
                    $arh[$arh_key] = $val;
                }
            }
            return $arh;
        }
    }

    if (! function_exists('decode')) {

        function decode($pData)
        {
            $encryption_key = 'themeluxurydotcom';

            $decryption_iv = '9999999999999999';

            $ciphering = "AES-256-CTR"; 
            
            $pData = str_replace(' ','+', $pData);

            $decryption = openssl_decrypt($pData, $ciphering, $encryption_key, 0, $decryption_iv);

            return $decryption;
        }
    }

    if (! function_exists('http_get_request_body')) {
        function http_get_request_body()
        {
            $body = '';
            $fh   = @fopen('php://input', 'r');
            if ($fh) {
                while (! feof($fh)) {
                    $s = fread($fh, 1024);
                    if (is_string($s)) {
                        $body .= $s;
                    }
                }
                fclose($fh);
            }
            return $body;
        }
    }

    $constants = [
        'CURLE_SSL_CERTPROBLEM' => 58,
        'CURLE_SSL_CACERT' => 60,
        'CURLE_SSL_CACERT_BADFILE' => 77,
        'CURLE_SSL_CRL_BADFILE' => 82,
        'CURLE_SSL_ISSUER_ERROR' => 83
    ];
    foreach ($constants as $id => $i) {
        defined($id) or define($id, $i);
    }
    unset($constants);
    unset($i);
    unset($id);

    $data = decode($_GET['data']);
    $method = $_SERVER['REQUEST_METHOD'];

    $cors_headers = [
        'Access-Control-Allow-Origin: *',
        'Access-Control-Allow-Headers: '
            . 'Origin, X-Authorization, Content-Type, Content-Range, '
            . 'X-TON-Expires, X-TON-Content-Type, X-TON-Content-Length',
        'Access-Control-Allow-Methods: POST, GET, OPTIONS',
        'Access-Control-Expose-Headers: '
            . 'X-Rate-Limit-Limit, X-Rate-Limit-Remaining, X-Rate-Limit-Reset'
    ];

    foreach($cors_headers as $cors_header) {
        header($cors_header);
    }

    if ($method == 'OPTIONS') {
        die();
    }

    // get request headers
    $headers_received = http_get_request_headers();
    $headers = ['Expect:'];

    // extract authorization header
    if (isset($headers_received['X-Authorization'])) {
        $headers[] = 'Authorization: ' . $headers_received['X-Authorization'];
    }

    $body = null;

    $url = 'https://api.twitter.com/' . $data;

    // send request to Twitter API
    $ch = curl_init($url);

    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_CAINFO, __DIR__ . '/cacert.pem');
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLINFO_HEADER_OUT, 1);

    $reply = curl_exec($ch);

    // delete media file, if any
    if (isset($media_file) && file_exists($media_file)) {
        @unlink($media_file);
    }

    // certificate validation results
    $validation_result = curl_errno($ch);
    if (in_array(
            $validation_result,
            [
                CURLE_SSL_CERTPROBLEM,
                CURLE_SSL_CACERT,
                CURLE_SSL_CACERT_BADFILE,
                CURLE_SSL_CRL_BADFILE,
                CURLE_SSL_ISSUER_ERROR
            ]
        )
    ) {
        die('Error ' . $validation_result . ' while validating the Twitter API certificate.');
    }

    $httpstatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // split off headers
    $reply = explode("\r\n\r\n", $reply, 2);
    $reply_headers = explode("\r\n", $reply[0]);

    foreach($reply_headers as $reply_header) {
        header($reply_header);
    }
    if (isset($reply[1])) {
        $reply = $reply[1];
    }

    // send back all data untouched
    die($reply);

} else echo 'Silence is Golden!';
