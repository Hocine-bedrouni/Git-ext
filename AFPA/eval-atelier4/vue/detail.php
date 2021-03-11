<?php 
    include("header.php");
    require "../modele/connexion.php"; // Inclusion de notre bibliothèque de fonctions

    $pro_id = $_GET["pro_id"];
    $requete = "SELECT * FROM produits INNER JOIN categories ON categories.cat_id = produits.pro_cat_id WHERE pro_id=".$pro_id; // Construction de la requête SQL
    $result = $pdo->query($requete); // $db->query($requete) revient à appeler la fonction query() de l'objet $db en lui passant la requête SQL en argument. Le résultat $db->query() est stocké dans un objet $result.
    $article = $result->fetch(PDO::FETCH_OBJ); // Renvoi de l'enregistrement sous forme d'un objet
?>

  


<Body>
<br><br>
<form action ="..//atelier4/modele/script_modif.php" method="post">

    <div class="text-center">
    <img src="../images/<?=$article->pro_id?>" width="300" alt="produit"> <!-- Pour ajouter la photo du produit : width="300 permet de redimensionner la photo et en n'indiquant qu'un seul paramètre le navigateur se charge de calculer le deuxième c'est à dire height en conservant les proportions de départ -->
    </div>

    <label for="ref">Référence : </label>
    <input type="text"  name="ref" class="form-control" readonly placeholder="<?= $article->pro_ref; ?>"><br>
  
    
    <label for="catégorie">Catégorie :</label>
    <input type="text"  name="categorie" class="form-control" readonly placeholder="<?= $article->pro_libelle; ?>"><br>
   
    <label for="nom">Libellé :</label>
    <input type="text" class="form-control" name="libelle" readonly placeholder="<?= $article->pro_libelle; ?>"><br>
   
    <label for="textarea">Description :</label>
    <textarea class="form-control" style="min-width:100%" id="textarea" rows="3" readonly placeholder="<?= $article->pro_description; ?>"></textarea><br>

    <label for="nom">Prix :</label>
    <input type="text" required class="form-control" name="prix" readonly placeholder="<?= $article->pro_prix; ?>"><br>
 
    <label for="nom">Stock</label>
    <input type="text" required class="form-control" name="stock" readonly placeholder="<?= $article->pro_stock; ?>"><br>

    <label for="nom">Couleur</label>
    <input type="text" required class="form-control" name="couleur" readonly placeholder="<?= $article->pro_couleur; ?>"><br>
   
    <label for="produit bloque">Produit bloqué?</label><br>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="inlineRadioOptions" disabled id="inlineRadio1" value=1 <?php if ($article->pro_bloque == 1) { echo "checked"; } ?>>
    <label class="form-check-label" for="inlineRadio1">Oui</label>
    </div>
    <div class="form-check form-check-inline">
    <input class="form-check-input" type="radio" name="inlineRadioOptions" disabled id="inlineRadio2" value=0 <?php if ($article->pro_bloque == NULL) { echo "checked"; } ?>>
    <label class="form-check-label" for="inlineRadio2">Non</label>
    </div><br><br>
 
    <label for="Date_ajout">Date d'ajout :</label>
    <input type="text" required class="form-control" name="date_ajout" readonly placeholder="<?= $article->pro_d_ajout; ?>"><br>

    <label for="date_modif">Date de modification :</label>
    <input type="text" required class="form-control" name="date_modif" readonly placeholder="<?= $article->pro_d_modif; ?>"><br>
  
    <div class="text-center">
    <!-- Quand on clique sur le bouton retour on affiche le tableau -->
    <a href="./list.php" class="btn btn-dark m-0 ">Retour</a>
    <!-- <a href="/php/produits_modif_script.php?id=<?php echo $r['pro_id']?>" class="btn btn-warning">EDITER</a> -->
    <!-- Quand on clique sur le bouton modifier on exécute le script du fichier sur lequel on fait un lien et on récupère l'ID avec ?pro_id=<?= $article->pro_id?> -->
    <a href="form_modif.php?pro_id=<?= $article->pro_id?>" class="btn btn-warning m-0">Modifier</a>
    <!-- Quand on clique sur le bouton supprimer on exécute le script du fichier sur lequel on fait un lien et on récupère l'ID avec ?pro_id=<?= $article->pro_id?> -->
    <a href="../modele/script_supp.php?pro_id=<?= $article->pro_id?>" class="btn btn-danger m-0" onclick="return confirm('Etes-vous certain(e) de vouloir supprimer le produit ?')">Supprimer</a>
        


<?php 
    include("footer.php");

?>

</body>






