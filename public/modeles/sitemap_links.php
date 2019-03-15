<?php

function LancerAffichageDuCorps()
{
    cadreMultiplesDebut(2);
    $modeles = dir("modeles/");
    while (false !== ($entry = $modeles->read())) {
        if ($entry == "." || $entry == "..") {
            continue;
        }
        $entry = explode(".", $entry);
        echo "<a href='index.php?page={$entry[0]}'>Page = {$entry[0]}</a><br />";
    }
    echo "ok";
    $modeles->close();
    cadreMultiplesFin(2);
}