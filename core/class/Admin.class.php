<?php
class Admin
{
private $bdd;
public function __construct(){
    $connexion = Connexion::GetInstance();
    $this->bdd = $connexion->bdd;
    $this->garname = Functions::Security($_POST['garage_name']);
    $this->gargerant = Functions::Security($_POST['gargerant']);
}
public function AdminUpdateSet(){
//    $update = $this->bdd->prepare('UPDATE adminsettings SET ')
}
public function Adminsetshow(){
    error_reporting(0);
    $select = $this->bdd->prepare('SELECT * FROM adminsettings');
    $select->execute();
    $resp = $select->fetchAll();
    foreach($resp as $adm){
        $resp.='<form method="post" action="core/services/admin-services.php?action=AdminUpdateSet">';
        $resp.='   
        
        <label for="validationCustom04">Nom du garage : </label>
        <input type="text" name="garage_name"class="form-control" id="validationCustom04" value="'.$adm['adm_name'].'"
               required>
</div>
<div class="col-md-6 mb-3">
        <label for="validationCustom04">Version : </label>
        <input type="text" name="garage_space"class="form-control" id="validationCustom04" value="'.$adm['adm_vers'].'"
               disabled>
    </div>
    <div class="col-md-6 mb-3">
        <label for="validationCustom04">Nom du gérant : </label>
    <input type="text" name="gargerant"class="form-control" id="" value="'.$adm['adm_gerant'].'"
               required>
    </div>
    <div class="col-md-6 mb-3">
        <label for="validationCustom04">Développeur : </label>
        <input type="text" name="garage_space"class="form-control" id="validationCustom04" value="Mokhtar ZIZANI"
               disabled>
               <div class="col-md-3 mb-3">
               <button type="submit" class="btn btn-primary btn-lg btn-block">Add to base</button>
           </div>';
        //       $response.='Re Teste';
    }
    $resp.='</form>';
    return $resp;
}
}