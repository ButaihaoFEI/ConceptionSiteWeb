<?php
/*
 * perdu: 0
 * trouvé: 1
 * rendu: 2
 * abandonné: 3
 */

require_once("param.inc.php");
require_once("Database.php");

$db = new Database($db_config);
session_start();
var_dump($_SESSION);

if (isset($_GET['objet']) && isset($_GET['etat']) && (($_SESSION['droits'] == 1 && $_GET['etat'] == 2) || ($_SESSION['droits'] == 2 && $_GET['etat'] == 3))) {
    $get = [];
    foreach ($_GET as $item => $value) {
        $get[$item] = htmlentities($value);
    }

    $db->update('objet', [
        'id' => $get['objet']
    ], [
        'etat' => $get['etat']
    ]);
}

header('Location: index.php');
