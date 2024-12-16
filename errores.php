<?php

$ch= curl_init($argv[1]);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
$httpCode= curl_getinfo($ch, CURLINFO_HTTP_CODE);

switch ($httpCode) {
    case 200:
        echo "OK\n";
        break;
    case 404:
        echo "Not Found\n";
        break;
    case 500:
        echo "Internal Server Error\n";
        break;
    default:
        echo "Unknown Error\n";
        break;
}