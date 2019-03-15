<?php

function LancerAffichageDuCorps()
{
    $sql0 = "SELECT * FROM Alerte_H4X0R";
    $req0 = faireUneRequeteOffLine($sql0);
    $data0 = exploiterNombreLigneResultatBDD($req0);
    
    $sql1 = "SELECT * FROM Alerte_H4X0R WHERE type = '1'";
    $sql2 = "SELECT * FROM Alerte_H4X0R WHERE type = '2'";
    $sql3 = "SELECT * FROM Alerte_H4X0R WHERE type = '3'";
    $sql4 = "SELECT * FROM Alerte_H4X0R WHERE type = '4'";
    $sql5 = "SELECT * FROM Alerte_H4X0R WHERE type = '5'";
    
    $req1 = faireUneRequeteOffLine($sql1);
    $req2 = faireUneRequeteOffLine($sql2);
    $req3 = faireUneRequeteOffLine($sql3);
    $req4 = faireUneRequeteOffLine($sql4);
    $req5 = faireUneRequeteOffLine($sql5);
    
    $data1 = exploiterNombreLigneResultatBDD($req1);
    $data2 = exploiterNombreLigneResultatBDD($req2);
    $data3 = exploiterNombreLigneResultatBDD($req3);
    
    /*
     * $sql31 = "SELECT id_alerte,type,'a1' AS IP1, 'a2' AS IP1 FROM Alerte_H4X0R WHERE type='3' and a1 != a2;";
     * $req31 = faireUneRequeteOffLine($sql31);
     */
    $ipDifferentes = array();
    $tentatives = array();
    $jours = array();
    $jour_count = array();
    $jour_indice = - 1;
    $ipDifferentes2 = array();
    $dateDifferente = array();
    $heureDifferenteSelonJour = array();
    $minutesDifferenteSelonHeure = array();
    $compte_tentatives = array();
    $ind_jour = - 1;
    $ind_heure = - 1;
    while ($data31 = exploiterLigneResultatBDD($req3)) {
        // Nombre d'ips différentes par jours
        if (! in_array($data31['IP1'], $ipDifferentes)) {
            array_push($ipDifferentes, $data31['IP1']);
            if (! in_array($data31['compte'], $tentatives)) {
                array_push($tentatives, $data31['compte']);
            }
            $smallDay = explode(' - ', $data31['date']);
            if (! in_array($smallDay[0], $jours)) {
                array_push($jours, $smallDay[0]);
                $jour_indice ++;
                $jour_count[$jour_indice] = 0;
            }
            $jour_count[$jour_indice] ++;
        }
        $date_tab = explode(' - ', $data31['date']);
        $heure_tab = explode(':', $date_tab[0]);
        // Nombre d'heures par jour et par ip
        if (! in_array($date_tab[0], $dateDifferente) && ! in_array($heure_tab[0], $heureDifferenteSelonJour[$ind_jour]) && ! in_array($data31['IP1'], $ipDifferentes2)) 

        {
            if (! in_array($date_tab[0], $dateDifferente)) {
                $ind_jour ++;
                array_push($dateDifferente, $date_tab[0]);
                $heureDifferenteSelonJour[$ind_jour] = array();
                $compte_tentatives[$ind_jour] = array();
                $ipDifferentes2[$ind_jour] = array();
            }
            if (! in_array($heure_tab[0], $heureDifferenteSelonJour[$ind_jour])) {
                array_push($heureDifferenteSelonJour[$ind_jour], $heure_tab[0]);
                // $j++;
            }
            /*
             * if(!in_array($heure_tab[1],$minutesDiferenteSelonHeure[$ind_heure])){
             * array_push($heure_tab[1],$minutesDiferenteSelonHeure[$ind_heure]);
             * }
             */
            if (! in_array($data31['IP1'], $ipDifferentes2[$ind_jour])) {
                array_push($ipDifferentes2[$ind_jour], $data31['IP1']);
            }
            $compte_tentatives[$ind_jour] ++;
        }
        /*
         * $smallDay = explode(' - ',$data31['date']);
         * $lasthours = explode(':',$smallDay[1]);
         * if(!in_array($smallDay[0],$jours)){
         * array_push($jours,$smallDay[0]);
         * $jour_indice++;
         * $jours[$jour_indice] = array();
         * $jour_count[$jour_indice] = 0;
         * $jours[$jour_indice][0] = 0;
         * }
         * $jour_count[$jour_indice]++;
         * if(!in_array($lasthours[0],$heures)){ array_push($heures,$lasthours[0]);$heure_indice++;$heure_count[$heure_indice] = 0;}
         * if(!in_array($lasthours[0],$jours[$jour_indice])){ array_push($jours[$jour_indice],$lasthours[0]);}
         * $heure_count[$heure_indice]++;
         *
         * $jours[$jour_indice][0]++;
         */
    }
    $data31 = count($ipDifferentes);
    $data32 = count($tentatives);
    $data32 = count($jours);
    $data32 = count($heures);
    
    $data4 = exploiterNombreLigneResultatBDD($req4);
    $data5 = exploiterNombreLigneResultatBDD($req5);
    
    echo "Nombre de bruteForce : " . $data1;
    echo "<br /><br />Nombre de duplication d'identités :" . $data2;
    echo "<br /><br />Nombre d'intrusions page var :" . $data3;
    echo "<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;Nombre d'ip différentes:" . $data31;
    echo "<br /><br />&nbsp;&nbsp;&nbsp;&nbsp;Nombre de tentatives différentes:" . $data32;
    echo "<table><thead><td>Jour</td><td>nbIP</td><td>NbHeures</td><td>nbTentatives</td></thead>";
    echo "<tbody>";
    $i = 0;
    foreach ($dateDifferente as $val) {
        echo "<tr>";
        echo "<td>" . $val . "</td><td>" . count($ipDifferentes2[$i]) . "</td>";
        echo "<td>" . count($heureDiferenteSelonJour[$i]) . "</td><td>$compte_tentatives[$i]</td>";
        $i ++;
        echo "</tr>";
    }
    echo "</tbody></table>";
    
    echo "<table><thead><td>Jours</td><td>nbTentatives d'ips différentes</td></thead>";
    echo "<tbody>";
    $i = 0;
    foreach ($jours as $val) {
        echo "<tr>";
        echo "<td>$val</td><td>$jour_count[$i]</td>";
        echo "</tr>";
        $i ++;
    }
    echo "</tbody></table>";
    
    echo "<br /><br />Nombre d'erreurVidéos : " . $data4;
    echo "<br /><br />Nombre d'erreurs inconnues à l'heure actuelles : " . $data5;
    
    echo "<br /><br /><br /><br />Total: " . ($data1 + $data2 + $data3 + $data4 + $data5) . " sur " . $data0;
}