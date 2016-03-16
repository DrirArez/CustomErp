<?php
include('ressources.php');
include('menu.php');
include('patient.php');

function chargerClasse($className){
   require $className.'.php';
}
spl_autoload_register('chargerClasse');
session_start();

$db = new PDO('mysql:host=localhost;dbname=patients', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

$manager = new PatientManager($db);
$malade  = new Patient();

if(isset($_POST['creer']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['age']) && isset($_POST['nDossier'])){
   echo 'Validate';
   $manager->add($malade);
}



 ?>
 <div class="row">
   <div class="col-md-7" id="formAjoutPatient">

     <div class="box">
       <div class="box-header">
         <span class="title"><i class="icon-plus-sign"></i> Formulaire ajout de patient </span>
       </div>

       <div class="box-content">

         <form class="form-horizontal fill-up validatable" method="post" action="">

           <div class="padded">
             <div class="form-group">
               <ul class="padded separate-sections">
                  <li id="civilite">
                     <label>Civitlite :</label>
                        <select class="chzn-select" name="colors" >
                           <option value="Monsieur" name='civilite'>Mr</option>
                           <option value="Madame"   name='civilite'>Mme</option>
                           <option value="Mlle"     name='civilite'>Mlle</option>
                        </select>
                  </li>
               </ul>
             </div>
            <div class="form-group">
               <label class="control-label col-lg-2">Nom</label>
                  <div class="col-lg-10">
                    <input name="nom" type="text" class="validate[required]" data-prompt-position="topLeft"/>
                  </div>
             </div>

             <div class="form-group">
               <label class="control-label col-lg-2">Prenom : </label>
               <div class="col-lg-10">
                 <input name="prenom" type="text" class="validate[required]" data-prompt-position="topLeft"/>
               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-lg-2">Date de naissance : </label>
               <div class="col-lg-10">
                  <input name="date_naissance" type="text"  class="validate[required]">
               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-lg-2">Age :</label>
               <div class="col-lg-10">
                 <input name="age" type="text"  class="validate[required]">
                 <span class="help-block note">
               </div>
             </div>

             <div class="form-group">
               <label class="control-label col-lg-2">N°Dossier : </label>
               <div class="col-lg-10">
                 <input name="nDossier" type="text"  class="validate[required]"/>
               </div>
             </div>

           </div>

           <div class="form-actions">
             <input type="submit" class="btn btn-blue" name="creer" value="Ajouter"/>
             <button type="reset" class="btn btn-default">Annuler</button>
           </div>
         </form>

       </div>
     </div>

   </div>
 </div>
