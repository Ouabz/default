<?php

class History 
{
private $bdd;
public function __construct()
{
    $connexion = Connexion::GetInstance();
    $this->bdd = $connexion->bdd;
}

public function getHistoryConnexion()
{

    $query = $this->bdd->prepare('SELECT * FROM history_connexion');
   // $join = $this->bdd->prepare('SELECT * FROM vehicules v JOIN modele m ON v.veh_mod = m.mod_id JOIN constructeur c ON m.mod_const_id = c.const_id');
   // $join->execute();
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
                                        <th>EMAIL</th>
                                        <th>DATE</th>
                                        <th>IP</th>

                                      
                                    </tr>
                                    </thead>

                                    <tbody>';
    foreach($results as $histo){

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
                                                    <strong>'.$histo['con_email'].'</strong>
                                                </div>
                                               
                                            </div>
                                        </td>

                                        <td>'.$histo['con_date'].'</td>
                                        <td><span class="badge badge-success">'.$histo['con_ip'].'</span></td>
                                        

                                     
                                     
                                    </tr>';
        //       $response.='Re Teste';
    }
    //	 $response .= 'Fin du code';
    echo $response;
}
public function getHistoryVehiculesAdd()
{

    $query = $this->bdd->prepare('SELECT * FROM history_vehicules_post');
   // $join = $this->bdd->prepare('SELECT * FROM vehicules v JOIN modele m ON v.veh_mod = m.mod_id JOIN constructeur c ON m.mod_const_id = c.const_id');
   // $join->execute();
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
                                        <th>EMAIL</th>
                                        <th>DATE</th>
                                        <th>IP</th>
                                        <th>IMMATRICULATION</th>

                                      
                                    </tr>
                                    </thead>

                                    <tbody>';
    foreach($results as $histo){

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
                                                    <strong>'.$histo['vpost_email'].'</strong>
                                                </div>
                                               
                                            </div>
                                        </td>

                                        <td>'.$histo['vpost_date'].'</td>
                                        <td><span class="badge badge-success">'.$histo['vpost_ip'].'</span></td>
                                        <td><span class="badge badge-danger">'.$histo['vpost_veh_immat'].'</span></td>
                                        

                                     
                                     
                                    </tr>';
        //       $response.='Re Teste';
    }
    //	 $response .= 'Fin du code';
    echo $response;
}
}