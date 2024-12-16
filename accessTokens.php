<?php 

if (!array_key_exists('HTTP_X_TOKEN',$_SERVER)){
    die;
}

$url = 'https://'.$_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI'];

$ch = curl_init($url);
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
        "X-Token: {$_SERVER['HTTP_X_TOKEN']}"
    )
);


curl_setopt(
    $ch,
    CURLOPT_RETURNTRANSFER,
    true
);

$ret = curl_exec($ch);  

if ($ret !== 'true'){
    die;
}