<?php
class Controller
{
    private $bdd;
    public function __construct(){
        $connexion = Connexion::GetInstance();
        $this->bdd = $connexion->bdd;
       // $this->garname = Functions::Security($_POST['garage_name']);
      //  $this->gargerant = Functions::Security($_POST['gargerant']);
    }
    function isDisconnected() {
        if(!isset($_SESSION['rank'])){
            header('Location: index.php');
        }
    }
}
