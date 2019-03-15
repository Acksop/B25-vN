<?php

/**
 * Class Fichier, permettant de générer une image,musique ou un document télécharger sur le serveur,
 * avec redimmensionnement et gestion de l'original
 * @author Acksop
 *
 */
class Fichier
{

    var $nom;

    var $nomOriginal;

    var $type;
 // 0:image ; 1:musique ; 2: document ; 3:video
    var $garderOriginal;
 // 1:oui ; 0:non
    var $garderNom;
 // 1:oui 0:non -- Le nom est tout de m�me modifi� en simplifiant les caract�res accuentu�s du nom et en ajoutant la date d'upload
    var $erreurs;

    var $destination;

    var $tampon;

    var $redimensionnement;
 // 0:aucun ; 1:par la largeur ; 2:par la hauteur
    var $tailleMax;

    var $tailleX;

    var $tailleY;

    /**
     * Constructeur du Fichier
     * 
     * @param string $tamponFichier            
     * @param string $RepDestination            
     * @param int $type            
     * @param int $redimentionnement            
     * @param int $tailleMax            
     * @param int $garderOriginal            
     * @param int $garderNom            
     */
    function Fichier($tamponFichier, $RepDestination, $type, $redimentionnement, $tailleMax, $garderOriginal, $garderNom)
    {
        $this->erreurs = 0;
        if (! isset($tamponFichier)) {
            $this->erreurs = - 5;
            $this->tampon == NULL;
        } else {
            $this->tampon = $tamponFichier;
            $this->erreurs = $this->tampon['error'];
        }
        if (! isset($RepDestination)) {
            $this->destination = "../upload_utilisateurs/";
        } else {
            $this->destination = $RepDestination;
        }
        if (! isset($type)) {
            $this->type = 2;
        } else {
            $this->type = $type;
        }
        if (! isset($redimentionnement)) {
            $this->redimensionnement = 0;
        } else {
            $this->redimensionnement = $redimentionnement;
        }
        if (! isset($tailleMax)) {
            $this->tailleMax = 700;
        } else {
            $this->tailleMax = $tailleMax;
        }
        if (! isset($garderOriginal)) {
            $this->garderOriginal = 0;
        } else {
            $this->garderOriginal = $garderOriginal;
        }
        if (! isset($garderNom)) {
            $this->garderNom = 0;
        } else {
            $this->garderNom = $garderNom;
        }
        return;
    }

    function testH4XORExtentionNom()
    {
        // on teste si le nom ne contient pas un caractère null qui provoquerais une faille de sécurité
        if (preg_match('#[\x00-\x1F\x7F-\x9F/\\\\]#', $this->tampon['name']) == 1) {
            $this->erreurs = - 1;
            return false;
        }
        return true;
    }

    function testExtentionMIME()
    {
        $typeFichier = $this->tampon['type'];
        $mimeImage = array(
            'image/jpeg',
            'image/gif',
            'image/png'
        );
        $extImage = array(
            'jpeg',
            'jpg',
            'JPEG',
            'JPG',
            'gif',
            'GIF',
            'PNG',
            'png'
        );
        $extMusique = array(
            'mp3',
            'MP3'
        );
        $extDocument = array(
            'txt',
            'TXT',
            'doc',
            'docx',
            'ppt',
            'pdf'
        );
        $mimeMusique = array(
            'audio/mpeg'
        );
        $mimeTexte = array(
            'application/msword',
            'application/pdf',
            'application/mspowerpoint',
            'text/plain'
        );
        $extVideo = array(
            'avi',
            'mp4',
            'ogv'
        );
        $mimeVideo = array(
            'video/avi',
            'video/mp4',
            'video/ogg'
        );
        
        $Fexp = explode(".", $this->tampon['name']);
        $extension = $Fexp[(count($Fexp) - 1)];
        
        switch ($this->type) {
            case 0:
                if (in_array($typeFichier, $mimeImage)) {
                    return true;
                } else {
                    if (in_array($extension, $extImage)) {
                        return true;
                    } else {
                        $this->erreurs = - 2;
                        return false;
                    }
                }
                break;
            case 1:
                if (! in_array($typeFichier, $mimeMusique)) {
                    if (! in_array($extension, $extMusique)) {
                        $this->erreurs = - 2;
                        return false;
                    }
                }
                break;
            case 2:
                if (! in_array($typeFichier, $mimeTexte)) {
                    if (! in_array($extension, $extDocument)) {
                        $this->erreurs = - 2;
                        return false;
                    }
                }
                break;
            case 3:
                echo $typeFichier . '__' . $extension;
                
                if (! in_array($typeFichier, $mimeVideo)) {
                    if (! in_array($extension, $extVideo)) {
                        $this->erreurs = - 2;
                        return false;
                    }
                }
                break;
        }
        
        return true;
    }

    function reecritureNom()
    {
        $nomFichier = $this->tampon['name'];
        $Fexp = explode(".", $nomFichier);
        $postExtension = $Fexp[0];
        
        // nom de l'image otés des caractères spéciaux
        $accents = array(
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "�",
            "'",
            " ",
            "&"
        );
        $noaccents = array(
            "A",
            "A",
            "A",
            "A",
            "A",
            "A",
            "a",
            "a",
            "a",
            "a",
            "a",
            "a",
            "O",
            "O",
            "O",
            "O",
            "O",
            "O",
            "o",
            "o",
            "o",
            "o",
            "o",
            "o",
            "E",
            "E",
            "E",
            "E",
            "e",
            "e",
            "e",
            "e",
            "C",
            "c",
            "I",
            "I",
            "I",
            "I",
            "i",
            "i",
            "i",
            "i",
            "U",
            "U",
            "U",
            "U",
            "u",
            "u",
            "u",
            "u",
            "y",
            "N",
            "n",
            "_",
            "_",
            "_"
        );
        $postExtension = str_replace($accents, $noaccents, $postExtension);
        // ------------------------------------------
        $dateUpLoad = date("dmY-Gis");
        
        // identifiant aléatoire de l'image
        $nouveauNom = "";
        $chaine = "abcdefghiujklmnopqrstuvwxyz0123456789";
        for ($i = 0; $i < 10; $i ++) {
            $nouveauNom .= $chaine[rand(0, 35)];
        }
        // ------------------------------------------
        
        $extension = $Fexp[(count($Fexp) - 1)];
        
        // ------------------------------------------
        
        if ($this->garderNom == 0) {
            $this->nom = "Oo--{$nouveauNom}----{$dateUpLoad}.{$extension}";
            $this->nomOriginal = $nomFichier;
        } else {
            $this->nom = "{$postExtension}---{$dateUpLoad}.{$extension}";
            $this->nomOriginal = $nomFichier;
        }
        return 0;
    }

    function redimensionnementLargeur()
    {
        if ($this->type == 0 && $this->redimensionnement == 1) {
            
            if ($this->garderOriginal == 1) {
                $Source = $this->destination . "originals/" . $this->nom;
            } else {
                $Source = $this->destination . $this->nom;
            }
            $Destination = $this->destination . $this->nom;
            $Largeur = $this->tailleMax;
            
            $Tab = getimagesize($Source);
            $SrcLarge = $Tab[0];
            $SrcHaut = $Tab[1];
            if ($Tab[2] == 1)
                $Src = @imagecreatefromGIF($Source);
            elseif ($Tab[2] == 2)
                $Src = @imagecreatefromJPEG($Source);
            elseif ($Tab[2] == 3)
                $Src = @imagecreatefromPNG($Source);
            else
                $this->erreurs = - 6;
                
                // ----------------------------------------------------------
                // Allocation de l'image destination
            $DestLarge = $Largeur;
            $DestHaut = $SrcHaut * ($Largeur / $SrcLarge);
            
            $this->tailleX = $DestLarge;
            $this->tailleY = $DestHaut;
            
            $ImgDest = @imagecreatetruecolor($DestLarge, $DestHaut);
            
            // ----------------------------------------------------------
            // Copie de la source
            @imagecopyresampled($ImgDest, $Src, 0, 0, 0, 0, $DestLarge, $DestHaut, $SrcLarge, $SrcHaut);
            
            // ----------------------------------------------------------
            // Ecriture de l'image sur le disque
            @imagejpeg($ImgDest, $Destination, 60);
            
            // ----------------------------------------------------------
            // Libération mémoire
            @imagedestroy($Src);
            @imagedestroy($ImgDest);
        }
        return 0;
    }

    function redimensionnementHauteur()
    {
        if ($this->type == 0 && $this->redimensionnement == 2) {
            
            if ($this->garderOriginal == 1) {
                $Source = $this->destination . "originals/" . $this->nom;
            } else {
                $Source = $this->destination . $this->nom;
            }
            $Destination = $this->destination . $this->nom;
            $Hauteur = $this->tailleMax;
            
            $Tab = getimagesize($Source);
            $SrcLarge = $Tab[0];
            $SrcHaut = $Tab[1];
            if ($Tab[2] == 1)
                $Src = @imagecreatefromGIF($Source);
            elseif ($Tab[2] == 2)
                $Src = @imagecreatefromJPEG($Source);
            elseif ($Tab[2] == 3)
                $Src = @imagecreatefromPNG($Source);
            else
                $this->erreurs = - 6;
                
                // ----------------------------------------------------------
                // Allocation de l'image destination
            $DestHaut = $Hauteur;
            $DestLarge = $SrcLarge * ($Hauteur / $SrcHaut);
            
            $this->tailleX = $DestLarge;
            $this->tailleY = $DestHaut;
            
            $ImgDest = @imagecreatetruecolor($DestLarge, $DestHaut);
            
            // ----------------------------------------------------------
            // Copie de la source
            @imagecopyresampled($ImgDest, $Src, 0, 0, 0, 0, $DestLarge, $DestHaut, $SrcLarge, $SrcHaut);
            
            // ----------------------------------------------------------
            // Ecriture de l'image sur le disque
            @imagejpeg($ImgDest, $Destination, 60);
            
            // ----------------------------------------------------------
            // Libération mémoire
            @imagedestroy($Src);
            @imagedestroy($ImgDest);
        }
        return 0;
    }

    function copierImage()
    {
        if ($this->type == 0) {
            
            if ($this->garderOriginal == 1) {
                $Source = $this->destination . "originals/" . $this->nom;
            } else {
                $Source = $this->destination . $this->nom;
            }
            $Destination = $this->destination . $this->nom;
            
            $Tab = getimagesize($Source);
            $SrcLarge = $Tab[0];
            $SrcHaut = $Tab[1];
            if ($Tab[2] == 1)
                $Src = @imagecreatefromGIF($Source);
            elseif ($Tab[2] == 2)
                $Src = @imagecreatefromJPEG($Source);
            elseif ($Tab[2] == 3)
                $Src = @imagecreatefromPNG($Source);
            else
                $this->erreurs = - 6;
                
                // ----------------------------------------------------------
                // Allocation de l'image destination
            $DestHaut = $SrcHaut;
            $DestLarge = $SrcLarge;
            
            $this->tailleX = $DestLarge;
            $this->tailleY = $DestHaut;
            
            $ImgDest = @imagecreatetruecolor($DestLarge, $DestHaut);
            
            // ----------------------------------------------------------
            // Copie de la source
            @imagecopyresampled($ImgDest, $Src, 0, 0, 0, 0, $DestLarge, $DestHaut, $SrcLarge, $SrcHaut);
            
            // ----------------------------------------------------------
            // Ecriture de l'image sur le disque
            @imagejpeg($ImgDest, $Destination, 60);
            
            // ----------------------------------------------------------
            // Libération mémoire
            @imagedestroy($Src);
            @imagedestroy($ImgDest);
        }
        return 0;
    }

    function ecritureSurLeServeur()
    {
        $this->reecritureNom();
        
        if ($this->erreurs == 0) {
            
            if ($this->testH4XORExtentionNom()) {
                
                if ($this->testExtentionMIME()) {
                    
                    if (! @is_uploaded_file($this->tampon['tmp_name'])) {
                        
                        $this->erreurs = - 3;
                    } else {
                        
                        if ($this->garderOriginal == 1) {
                            $destinationComplete = $this->destination . "originals/" . $this->nom;
                        } else {
                            $destinationComplete = $this->destination . $this->nom;
                        }
                        
                        if (@move_uploaded_file($this->tampon['tmp_name'], $destinationComplete)) {
                            
                            if ($this->type == 0) {
                                
                                $testdimension = getimagesize($destinationComplete);
                                switch ($this->redimensionnement) {
                                    case 1:
                                        if ($testdimension['0'] > $this->tailleMax) {
                                            $this->redimensionnementLargeur();
                                        } else {
                                            if ($this->garderOriginal == 1) {
                                                $this->copierImage();
                                            }
                                        }
                                        break;
                                    case 2:
                                        if ($testdimension['1'] > $this->tailleMax) {
                                            $this->redimensionnementHauteur();
                                        } else {
                                            if ($this->garderOriginal == 1) {
                                                $this->copierImage();
                                            }
                                        }
                                        break;
                                    default:
                                        $this->tailleX = $testdimension[0];
                                        $this->tailleY = $testdimension[1];
                                }
                            }
                        } else {
                            // echo $destinationComplete;
                            $this->erreurs = - 4;
                        }
                    }
                }
            }
        }
        
        return 0;
    }
}

?>
