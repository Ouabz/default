<?php
/**
 * Created by PhpStorm.
 * Developper : Mokhtar ZIZANI
 * Date: 06/07/2018
 * Time: 14:11
 */

class GarageManager
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
    public function getGarageSelect(){
        $query = $this->bdd->prepare('SELECT * FROM garages');
        $query->execute();
        $results = $query->fetchAll();
        $response = '<select class="form-control custom-select" id="garage" name="garage">';

        foreach($results as $garage){
            $response.='<option value="'.$garage['gar_id'].'">'.$garage['gar_name'].'</option>';
        }
        $response .= '</select>';
        echo $response;
    }
    public function addGarage($pPost){
        $garname = $pPost['garage_name'];
        $garspace = $pPost['garage_space'];

        $insert = $this->bdd->prepare('INSERT INTO garages (gar_name,gar_space) VALUES ("'.$garname.'", "'.$garspace.'")');
        $insert->execute();
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


}