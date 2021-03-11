<?php
include("./header.php");

require "../modele/connexion.php";

$result = $pdo->query("SELECT * FROM categories ORDER BY cat_id"); // Requête pour avoir les cat_id
$categories = $result->fetchAll(PDO::FETCH_OBJ);

date_default_timezone_set('Europe/Paris');
$date = date("d-m-Y H:i:s");
?>

<div class="row">

<form class="col-lg-12" action="../modele/script_ajout.php" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="référence">Référence :</label>
    <input type="text" class="form-control" name="reference" id="reference"> <!-- Le name et l'id doivent être identiques --> 
    <span id="alert12"></span>
    <span id="reference_manquante"></span>
</div>
<?php
    
                                if (isset($_GET["erreur1"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >La référence n'est pas renseignée</div>
                                    <?php
                                }
                                else if (isset($_GET["erreur1b"]))
                                {
                                    ?>
                                    <div class = "alert alert-warning" >Le format de la référence n'est pas correct</div>
                                    <?php
                                }

?>

<div class="form-group">
    <label for="pro_cat_id">Catégorie :</label>
    <select class="custom-select" name="pro_cat_id" id="pro_cat_id">
    <option value="">-- Veuillez sélectionner une catégorie --</option> 
    <?php
    foreach($categories as $c) // Permet l'affichage du menu déroulant pour obtenir la liste des catégories
    {
        ?>
        <option value =  "<?= $c->cat_id?>"><?=$c->cat_id."-".$c->cat_nom?></option>
        <?php
    }
    ?>
    </select>
    <span id="alert13"></span> 
    <span id="categorie_manquante"></span>
</div>
<?php 
                                if (isset($_GET["erreur2"]))
                                {
                                    ?>
                                    <div class="alert alert-danger">La catégorie n'est pas renseignée</div>
                                    <?php
                                }
?>

<div class="form-group">
    <label for="libellé">Libellé :</label>   
    <input type="text" class="form-control" name="libelle" id="libelle">
    <span id="alert14"></span>
    <span id="libelle_manquant"></span> 
</div>
<?php
    
                                if (isset($_GET["erreur3"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >Le libellé n'est pas renseigné</div>
                                    <?php
                                }
?>

<div class="form-group">
    <label for="description">Description :</label>
    <input type="text" class="form-control" name="description" id="description">
    <span id="alert15"></span>
    <span id="description_manquante"></span>    
</div>
<?php
    
                                if (isset($_GET["erreur4"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >La description n'est pas renseignée</div>
                                    <?php
                                }
?>

<div class="form-group">
    <label for="prix">Prix :</label> 
    <input type="text" class="form-control" name="prix" id="prix">
    <span id="alert16"></span>
    <span id="prix_manquant"></span>       
</div>
<?php
    
                                if (isset($_GET["erreur5"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >Le prix n'est pas renseigné</div>
                                    <?php
                                }
                                else if (isset($_GET["erreur5b"]))
                                {
                                    ?>
                                    <div class = "alert alert-warning" >Le format du prix n'est pas correct</div>
                                    <?php
                                }
?>

<div class="form-group">
    <label for="stock">Stock :</label>  
    <input type="text" class="form-control" name="stock" id="stock">
    <span id="alert17"></span>
    <span id="stock_manquant"></span>    
</div>
<?php
    
                                if (isset($_GET["erreur6"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >Le stock n'est pas renseigné</div>
                                    <?php
                                }
                                else if (isset($_GET["erreur6b"]))
                                {
                                    ?>
                                    <div class = "alert alert-warning" >Le format du stock n'est pas correct</div>
                                    <?php
                                }
?>

<div class="form-group">
    <label for="couleur">Couleur :</label>
    <input type="text" class="form-control" name="couleur" id="couleur">   
    <span id="alert18"></span>
    <span id="couleur_manquante"></span>   
</div>
<?php
    
                                if (isset($_GET["erreur7"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >La couleur n'est pas renseignée</div>
                                    <?php
                                }
?>


<p>Produit bloqué ? :</p>

<div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" id="bloque_oui" name="bloque" value = 1> <!-- On récupère la valeur 1 quand le produit est bloqué -->
  <label class="form-check-label" for="bloque">Oui</label>
</div>

<div class="form-check form-check-inline">
  <input type="radio" class="form-check-input" id="bloque_non" name="bloque" value = 0> <!-- On récupère la valeur 0 quand le produit n'est pas bloqué -->
  <label class="form-check-label" for="bloque">Non</label>
</div>

</div><br>
<span id="alert19"></span>
<span id="bloque_manquant"></span>
    
                        <?php
    
                                if (isset($_GET["erreur8"]))
                                {
                                    ?>
                                    <div class = "alert alert-danger" >Vous devez cocher une des deux cases</div>
                                    <?php
                                }
?>

<!-- TELECHARGEMENT IMAGE -->

<p>Photo du produit :</p>

<input type="hidden" name="MAX_FILE_SIZE" value="104857600" />
    
<p><input type="file" name="fichier" id="fichier"></p> 

<div class="form-group">
    <label for="ajout">Date d'ajout :</label>
    <input type="text" class="form-control" id="ajout" name="ajout" value ="<?=$date?>" readonly>  <!-- On récupère la date du jour : value ="<?=$date?> que l'on met en readonly pour empêcher toute modification -->
</div>


<div class="form-group">
    <!-- Quand on clique sur le bouton retour on affiche le tableau -->
    <a href="list.php" class="btn btn-dark m-0">Retour</a>
    <input type="submit" class="btn btn-success" value="Ajouter" id="bouton_envoi2">
    <input type="reset" onclick='document.location.reload(false)' class="btn btn-danger" value="Annuler">
</div>

</form>

<?php
include("./footer.php");
?>
<!-- Script JavaScript -->
<!-- <script src="js\ajout_script.js"></script> -->

<!-- Script jQuery -->
<!-- <script src="jquery\ajout_script.js"></script> -->