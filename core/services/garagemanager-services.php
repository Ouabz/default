<?php
/**
 * GARAGE SERVICES
 * @addUsers
 * @EditUsers
 * @DeleteUsers
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
    case 'addGarage':
        $vh = new GarageManager();
        $vh->addGarage($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;

    /**
     * getGarageSelect affiche les noms des garages et leur place en select option.
     */
    case 'getGarageSelect':
        $gm = new GarageManager();
        $gm->getGarageSelect();
        header('Location' . $_SERVER['HTTP_REFERER']);
        break;
    case 'getGaragesList':
        $vh = new VehiculeManager();
        $vh->getGaragesList();
        break;

        case 'getGaragesList':
        $vh = new VehiculeManager();
        $vh->getGaragesList();
        break;
    }
?>