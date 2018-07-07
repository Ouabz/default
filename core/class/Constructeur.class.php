<?php
/**
 * Created by PhpStorm.
 * Developper : Mokhtar ZIZANI
 * Date: 06/07/2018
 * Time: 14:11
 */

class Constructeur
{
    // Propr
private $bdd;
// Constructor
public function __construct()
{
    $connexion = Connexion::GetInstance();
    $this->bdd = $connexion->bdd;

}
    // meth
    //get set
    public function CountMarque() 
    {
        $query = $this->bdd->prepare('SELECT * FROM constructeur');
        $query->execute();
        $nb = $query->rowCount();
        return $nb;
    }    
public function addMarque($pPost)
{
    if(!empty($pPost['name'])){
        $name = $pPost['name'];
        $query = $this->bdd->prepare('INSERT INTO constructeur (const_name) VALUES ("'.$name.'")');
        $query->execute();
    }else{
        echo "Error occurred";
    }
}

}