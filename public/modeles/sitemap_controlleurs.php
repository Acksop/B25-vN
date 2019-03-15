<?php

function LancerAffichageDuCorps()
{
    cadreMultiplesDebut(2);
    $modeles = dir("controlleurs/");
    while (false !== ($entry = $modeles->read())) {
        if ($entry == "." || $entry == "..") {
            continue;
        }
        $entry = explode(".", $entry);
        echo "Controlleur = {$entry[0]}</a><br />";
    }
    echo "ok";
    $modeles->close();
    cadreMultiplesFin(2);
}