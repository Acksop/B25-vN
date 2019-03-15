<?php

function LancerAffichageDuCorps()
{
    cadreMultiplesDebut(2);
    $modeles = dir("controlleursAJAX/");
    while (false !== ($entry = $modeles->read())) {
        if ($entry == "." || $entry == "..") {
            continue;
        }
        $entry = explode(".", $entry);
        echo "AJAX Controlleur = {$entry[0]}</a><br />";
    }
    echo "ok";
    $modeles->close();
    cadreMultiplesFin(2);
}