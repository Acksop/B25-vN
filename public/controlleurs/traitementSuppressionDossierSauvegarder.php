<?php
session_start();
include '../scriptPHP/sessions.php';
$sql = "DELETE FROM dossiersTemporaires WHERE id_dossier = '{$_POST['id']}'";
check_session();

faireUneRequeteOffLine($sql);
header('location:../index.php?page=archiveDossiersSauvegardeJournaliste');