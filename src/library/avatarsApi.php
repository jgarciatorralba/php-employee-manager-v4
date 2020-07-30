<?php

include_once('sessionHelper.php');

$API_key = "0A2ED4BA-4E53420C-96665B70-60C6502A";

if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $entity = $_GET["type"];
    $limit = $_GET["limit"];

    if (strpos($search, " ") == true) {
        $search = str_replace(" ", "-", $search);
    }

    $url = "https://itunes.apple.com/search?term=$search&limit=$limit&explicit=no&entity=$entity&country=ES&media=music";
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    echo $output;
    curl_close($ch);
}
