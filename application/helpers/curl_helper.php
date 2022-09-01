<?php
function curl_post($path, $fields = array())
{
    $postvars = http_build_query($fields);
    $ch = curl_init(API_URL($path));
    curl_setopt($ch, CURLOPT_POST, 1);                //0 for a get request
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);
    curl_close($ch);
    return response_parser($response);
}

function curl_get($path, $fields = array())
{
    $request_url = API_URL($path) . "?" . http_build_query($fields);
    $ch = curl_init($request_url);
    curl_setopt($ch, CURLOPT_POST, 0);                //0 for a get request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);
    curl_close($ch);
    return response_parser($response);
}

function curlPost($url, $fields = array(), $files = NULL)
{
    $ch = curl_init();
    $CI = &get_instance();
    $postvars = http_build_query($fields);

    if ($files != NULL) {
        foreach ($files as $file => $value) {
            $cfile = new CURLFile($value['tmp_name'], $value['type'], $value['name']);
            $postfile[$file] = $cfile;
        }

        $postvars = (object) array_merge((array) $fields, (array) $postfile);
    }
    curl_setopt($ch, CURLOPT_URL, API_URL($url));
    curl_setopt($ch, CURLOPT_POST, 1);                //0 for a get request
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response);
}

function curlGet($url, $fields = array())
{
    $request_url = API_URL($url) . "?" . http_build_query($fields);
    $ch = curl_init($request_url);
    curl_setopt($ch, CURLOPT_POST, 0);                //0 for a get request
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    $response = curl_exec($ch);
    curl_close($ch);
    return json_decode($response);
}
function response_parser($response)
{
    $res = json_decode($response);
    if (isset($res->error)) {
        $error = $res->error;
    } else {
        $error = NULL;
    }
    if (isset($res->message)) {
        $message = $res->message;
    } else {
        $message = NULL;
    }
    if (isset($res->status)) {
        $status = $res->status;
    } else {
        $status = NULL;
    }
    if (isset($res->data)) {
        $data = $res->data;
    } else {
        $data = NULL;
    }
    return [
        $error,
        $message,
        $status,
        $data,
    ];
}

function API_URL($path = null)
{
    $uri = 'https://sd.klasq.id/api/wali/';
    if ($path != null) {
        $uri .= $path;
    }
    return $uri;
}
