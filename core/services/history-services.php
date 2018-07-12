<?php
/**
 * HISTORY SERVICES
 *
 */
session_start();
require_once('../autoloader.php');
$action;
if (isset($_GET["action"])) {
    $action = $_GET["action"];
} elseif (isset($_POST["action"])) {
    $action = $_POST["action"];
} else {
    header('Location:../index.php');
}
switch ($action) {
   /**
     * addGarage permet d'ajouter les garages à la base de donnée (gar_name,gar_space).
     */
    case 'getHistoryConnexion':
        $ht = new History();
        $ht->getHistoryConnexion();
      //  header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
        case 'getHistoryVehiculesAdd':
        $ht = new History();
        $ht->getHistoryVehiculesAdd();
    }
?>