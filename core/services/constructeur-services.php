<?php
/**
 * USERS SERVICES
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
     *  addVehicule permet d'ajouter un véhicule à la base de donnée.
     */
    case 'CountMarque':
        $vh = new Constructeur();
        $vh->CountMarque();
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
        case 'addMarque':
        $vh = new Constructeur();
        $vh->addMarque($_POST);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        break;
}
?>