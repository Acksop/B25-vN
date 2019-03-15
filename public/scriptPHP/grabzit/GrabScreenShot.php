<?php
include dirname(__FILE__) . "/lib/GrabzItClient.class.php";
include dirname(__FILE__) . "/config.php";

function grabOrPutIMGonHTML($url)
{
    global $grabzItApplicationKey;
    global $grabzItApplicationSecret;
    
    $grabzIt = new GrabzItClient($grabzItApplicationKey, $grabzItApplicationSecret);
    $grabzIt->SetImageOptions($url);
    
    $tab = explode("/", $url);
    $tab = explode(".", $tab[2]);
    
    if (file_exists(dirname(__FILE__) . "/results/" . $tab[0] . ".jpg")) {
        echo "<img src='scriptPHP/grabzit/results/" . $tab[0] . ".jpg' alt='apercu du site " . $url . "' >";
    } else {
        // wait a certain amount of time and retrieve the screenshot
        $filepath = dirname(__FILE__) . "/results/" . $tab[0] . ".jpg";
        $grabzIt->SaveTo($filepath);
    }
}