<?php
Class VehiculeManager{
    // Propriétés
    private $bdd;
    // constructor
    public function __construct(){
       $connexion = Connexion::getInstance();
      $this->bdd = $connexion->bdd; 
    	
    }
        // methodes
        /**
        * 
        */
        // Getter/Setter
  
   
   
    /**
     * Cette function permet d'ajouter un véhicule a la base de donnée.
     */

    public function addVehicule($pPost) {
        $achat_price = $pPost['achat_price'];
        $vente_price = $pPost['vente_price'];
       // $other = $pPost['other'];
        $plaque = $pPost['immatriculation'];
        $poster = $_SESSION['firstname'].' '.$_SESSION['lastname'];
        $date = date("Y-m-d H:i:s");
        $etat = 1;
        $statut = 1;
        $modele = $pPost['modele'];
        $garage = $pPost['garage'];
        $date = date("Y-m-d H:i:s");


        $selectVehicule = $this->bdd->prepare('SELECT * FROM vehicules WHERE veh_immat = "'.$plaque.'"');
        $selectVehicule->execute();
        $VehiculeRowCount = $selectVehicule->rowCount();
        if($VehiculeRowCount == 0) {
$query = $this->bdd->prepare('INSERT INTO vehicules (veh_date_post,veh_gar_id,veh_immat,veh_price_achat,veh_price_vente,veh_poster,veh_mod) VALUES ("'.$date.'", "'.$garage.'", "'.$plaque.'", "'.$achat_price.'", "'.$vente_price.'", "'.$poster.'", "'.$modele.'")');
$query->execute();       
}else{
   return('Error fdp');
}



    }

    public function addUser($pPost){
    $usr_pics = "assets/img/avatar.png";

    $insert = $this->bdd->prepare('INSERT INTO users (usr_pics,usr_email,usr_password,usr_firstname,usr_lastname) VALUES ()');
    }
    public function addGarage($pPost){
        $garname = $pPost['garage_name'];
        $garspace = $pPost['garage_space'];

        $insert = $this->bdd->prepare('INSERT INTO garages (gar_name,gar_space) VALUES ("'.$garname.'", "'.$garspace.'")');
        $insert->execute();
    }
    public function getModeleSelect(){
    	$constructeur = null;
    	if(!empty($_POST['constructeur'])){
    		$constructeur = $_POST['constructeur'];
    	}
    	if($constructeur == null){
    		   $query = $this->bdd->prepare('SELECT * FROM modele');
    	}else{
    		   $query = $this->bdd->prepare('SELECT * FROM modele WHERE mod_const_id = "'.$constructeur.'"');
    	}
           
            $query->execute();
            //
            $results = $query->fetchAll();
            $response = '';
            //

            foreach($results as $modele){
                $response.='<option value="'.$modele['mod_id'].'">'.$modele['mod_name'].'</option>';
            }

            //
            // $response .= '</select>';
          //  return $response;  
            echo $response;
            
    }
    public function getVehiculeList(){
    	$query = $this->bdd->prepare('SELECT * FROM vehicules ORDER BY id DESC');
    	$join = $this->bdd->prepare('SELECT * FROM vehicules v JOIN modele m ON v.veh_mod = m.mod_id JOIN constructeur c ON m.mod_const_id = c.const_id JOIN garages g ON v.veh_gar_id = g.gar_id');
    	$join->execute();
     	$query->execute();

    	$results = $join->fetchAll();
    	 // $response = 'Partie 1';
        //$benef = ($results['veh_price_achat']) - ($results['veh_price_vente']);
    	foreach($results as $vehicule){
         $benef =  $vehicule['veh_price_vente'] - $vehicule['veh_price_achat'];
            $response.=' <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkSingle"
                                                           id="user_id_1" required><label
                                                            class="custom-control-label" for="user_id_1"></label>
                                                </div>
                                            </td>
                                                    <td>'.$vehicule['veh_id'].'</td>
                                            <td>
                                                <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                    <span class="avatar-letter avatar-letter-a  avatar-md circle"></span>
                                                </div>
                                                <div>
                                                    <div>
                                                        <strong>'.$vehicule['veh_immat'].'</strong>
                                                    </div>
                                                    <small>'.$vehicule['const_name'].' '.$vehicule['mod_name'].'</small>
                                                </div>
                                            </td>

                                            <td>'.$vehicule['veh_price_achat'].' €</td>
                                            <td>'.$vehicule['veh_price_vente'].' €</td>
                                            

                                            <td>'.$vehicule['gar_name'].'</td>
                                            <td>'.$benef.'</td>
                                            <td>'.$vehicule['veh_etat'].'</td>
                                            <td><span class="r-3 badge statut'.$vehicule['veh_statut'].'">'.$vehicule['veh_statut'].'</span></td>
                                            <td>
                                           <a href="./core/services/services.php?action=SetVendu&id='.$vehicule['veh_id'].'" <button type="submit">Vendu?</button></a>
                                                </form>
                                                <a href="panel-page-profile.html"><i class="icon-pencil"></i></a>
                                                </form>
                                            </td>
                                        </tr>';
     //       $response.='Re Teste';
    	}
    //	 $response .= 'Fin du code';
    	 return $response;
    }

    public function getGaragesList(){
        $query = $this->bdd->prepare('SELECT * FROM garages');
        $join = $this->bdd->prepare('SELECT * FROM vehicules v JOIN modele m ON v.veh_mod = m.mod_id JOIN constructeur c ON m.mod_const_id = c.const_id');
        $join->execute();
        $query->execute();

        $results = $query->fetchAll();
         $response = '             <div class="table-responsive">
                                <form>

                                    <table class="table table-striped table-hover r-0">
                                        <thead>
                                        <tr class="no-b">
                                            <th style="width: 30px">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" id="checkedAll" class="custom-control-input"><label
                                                        class="custom-control-label" for="checkedAll"></label>
                                                </div>
                                            </th>
                                            <th>NOM</th>
                                            <th>NOMBRE DE PLACE</th>
                                            <th>PLACE DISPONIBLE</th>

                                            <th>ETAT</th>
                                            <th>Statut</th>
                                            <th></th>
                                        </tr>
                                        </thead>

                                        <tbody>';
        foreach($results as $garage){

            $response.=' 
 
 <tr>
                                            <td>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input checkSingle"
                                                           id="user_id_1" required><label
                                                            class="custom-control-label" for="user_id_1"></label>
                                                </div>
                                            </td>

                                            <td>
                                                <div class="avatar avatar-md mr-3 mt-1 float-left">
                                                    <span class="avatar-letter avatar-letter-a  avatar-md circle"></span>
                                                </div>
                                                <div>
                                                    <div>
                                                        <strong>'.$garage['gar_name'].'</strong>
                                                    </div>
                                                   
                                                </div>
                                            </td>

                                            <td>'.$garage['gar_space'].'</td>
                                            <td> 10 places réstantes</td>
                                            

                                         
                                            <td>Bonne état
                                            <td><span class="r-3 badge statut'.$garage['gar_statut'].'">'.$garage['gar_statut'].'</span></td>
                                            <td>
                                                <a href="panel-page-profile.html"><i class="icon-done_all"></i></a>
                                                <a href="panel-page-profile.html"><i class="icon-pencil"></i></a>
                                            </td>
                                        </tr>';
            //       $response.='Re Teste';
        }
        //	 $response .= 'Fin du code';
        echo $response;
    }

    /**
     * Cette function permet de passer un véhicule de non vendu à vendu
     */
    public function SetVendu() {
        $update = $this->bdd->prepare('UPDATE vehicules SET veh_statut = "Vendu" WHERE veh_id ='.$_GET['id']);
        $update->execute();
    }
    /**
     *
     * La function CountVehicule permet de compté le nombre de véhicule.
     */
           public function CountVehicule(){

        $query = $this->bdd->prepare('SELECT * FROM vehicules');
       $query->execute();

       $nb_ligne = $query->rowCount();
       return $nb_ligne;
//        $row = $query->fetchAll();
//        $nb = count($row);
//        echo $nb;

    }
    /**
     *
     * La function CountMarque permet de compté le nombre de marque (constructeur).
     */


    /**
     *
     * La function CountVehiculeSell permet de compté le nombre de véhicule VENDU.
     */
    public function CountVehiculeSell(){

        $query = $this->bdd->prepare('SELECT * FROM vehicules WHERE veh_statut = "Vendu"');
        $query->execute();

        $nb_ligne = $query->rowCount();
        return $nb_ligne;
//        $row = $query->fetchAll();
//        $nb = count($row);
//        echo $nb;

    }
    /**
     *
     * La function CountAchat permet de compté les dépenses.
     * A RE-TRAVAILLAIR !!!!!
     */
        public function CountAchat() {
            $req = $this->bdd->prepare('SELECT SUM(veh_price_achat) AS nb FROM vehicules');
            $req->execute();
            $fetch = $req->fetch();

            $value = $fetch['nb'];

            return $value;
            }

    /**
     * La function CountVente permet de compté le chiffre d'affaire
     */
    public function CountVente()
    {
        $req = $this->bdd->prepare('SELECT SUM(veh_price_vente) AS nb2 FROM vehicules WHERE veh_statut = "Vendu"');
        $req->execute();
        $fetch = $req->fetch();

        $value = $fetch['nb2'];
        return $value;

    }

    /**
     * La function CountBenefice devras soustraire le prix de vente par le prix d'achat.
     * Exemple : On n'achete un véhicule a 2500 € et on le revend à 5000 €
     * Ducoup on feras 5000 - 2500
     */


     /**
     * Cette fonction permet a select une category
     */
    
public function getMyArtwork(){
        $idman = $_SESSION['id'];
    $query = $this->bdd->prepare('SELECT * FROM artwork WHERE art_artist = "'.$idman.'"');
    $query->execute();
    $results = $query->fetchAll();
    $response = '';

    foreach($results as $artworklist){
        $response.='<div class="card mr-sm-2" style="width: 18rem;">
        <img class="card-img-top" src="images/'.$artworklist['art_media'].'">
        <div class="card-body">
        <h5 class="card-title">'.$artworklist['art_title'].'</h5>';
        $response.='<p class="card-text description"><div class="fixheight">'.$artworklist['art_desc'].'</p></div><a href="/insta/'.$artworklist['art_id'].'" class="btn btn-primary">Visit</a> <div class="card-footer pb-2">
  <small class="text-muted">Publié le : '.$artworklist['art_uploaded_at'].'</small></div>  </div>
        </div>';
    }
    $response .= '';
    return $response;
}
/** 
 * Permet de récuperé l'id de chaque article pour l'afficher dans une page.
 */
    public function getArticlId($id){
            $query = $this->bdd->prepare('SELECT * FROM artwork WHERE art_id = ?');
            $query->execute(array($id));
            while($d = $query->fetch()){
                echo ''.$d['art_title'].'';
                echo '<img src="images/'.$d['art_media'].'" alt=""/>';
                echo ''.$d['art_desc'].'';
            }
    }
    /**
     * Cette fonction permet a select les 4 dernier postes
     */
    public function getArtworkalllist()
    {
        $query = $this->bdd->prepare('SELECT * FROM artwork WHERE art_active=1 ORDER BY art_uploaded_at DESC');
        $query->execute();
        //
        $results = $query->fetchAll();
        $response = '<div class="containpost">';
        //

        foreach ($results as $artworklist) {
            $response .= '<div class="card mr-sm-2" style="width: 18rem;">
            <img class="card-img-top" src="images/' . $artworklist['art_media'] . '">
            <div class="card-body">

            <h5 class="card-title">' . $artworklist['art_title'] . '</h5>';
            $response .= '<p class="card-text description"><div class="fixheight">' . $artworklist['art_desc'] . '</p></div><a href="/insta/' . $artworklist['art_id'] . '" class="btn btn-primary">Visit</a>  </div>
            </div>';
        }

        //
        $response .= ' </div> 
         ';

        return $response;
    }
      public function getArtistid($id2){
            $query = $this->bdd->prepare('SELECT * FROM artist WHERE id = ?');
            $query->execute(array($id));
            while($d = $query->fetch()){
                echo ''.$d['pseudo'].'';
                echo '<img src="images/'.$d['art_media'].'" alt=""/>';
                echo ''.$d['art_desc'].'';
            }
    }

}