<?php
include('header.php')
?>
               
        
                <br>
                <p>*Ces zones sont obligatoires</p>
                <br>
                <form action="http://bienvu.net/script.php" method="Get" id="formcontact">
                    <fieldset>
                        <legend>
                            <H2>Vos coordonnées</H2>
                        </legend>
        
                        <div class="form-group">
                            <label for="nom">Nom*</label>
                            <input type="text" required class="form-control" id="nom" placeholder="Veuillez saisir votre nom">
                            <span id='missnom'></span><br>
                        </div>
                        <div class="form-group">
                            <label for="Prenom">Prénom*</label>
                            <input type="text" required class="form-control" id="prenom" placeholder="Veuillez saisir votre prénom">
                            <span id='missPrenom'></span><br>
                        </div>
                      
                       
        
        
        
        
                        <label for="sexe">Sexe*:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                value="Féminin">
                            <label class="form-check-label" for="inlineRadio1">Féminin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                value="Masculin">
                            <label class="form-check-label" for="inlineRadio2">Masculin</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3"
                                value="Neutre">
                            <label class="form-check-label" for="inlineRadio3">Neutre</label>
                        </div>
                        <br>
                        <br>
        
        
                        <div class="form-group">
                            <label for="ddn">Date de naissance:*</label>
                            <input type="date" class="form-control" id="date" placeholder="Veuillez saisir votre nom">
                        </div>
        
                        <div class="form-group">
                            <label for="codepostal">Code postal:*</label>
                            <input type="text" required class="form-control" id="codepostal" placeholder="">
                            <span id='misscodepostal'></span><br>
                        </div>
        
                        <div class="form-group">
                            <label for="adresse">Adresse:*</label>
                            <input type="text" required class="form-control" id="adresse" placeholder="">
                            <span id='missadresse'></span><br>
                        </div>
        
                        <div class="form-group">
                            <label for="ville">Ville:*</label>
                            <input type="text" required class="form-control" id="ville" placeholder="">
                            <span id='missville'></span><br>
                        </div>
        
                        <div class="form-group">
                            <label for="email">Email:*</label>
                            <input type="email" required class="form-control" id="email" placeholder="Daveloper@afpa.fr">
                            <span id='missemail'></span><br>
                        </div>
        
        
                    </fieldset><br>
                    <fieldset>
                        <legend>Votre demande</legend>
                        <div class="form-group">
                            <label for="text">Sujet:*</label>
                            <select class="form-control" id="Sujet">
                                <option selected>Veuillez sélectionner un sujet</option>
                                <option>Mes commandes</option>
                                <option>Question sur un produit</option>
                                <option>Réclamation</option>
                                <option>Autres</option>
                            </select>
                        </div>
        
                        <div class="form-group">
                            <label for="textarea">Votre question:*</label>
                            <textarea class="form-control" style="min-width:100%" id="textarea" rows="2"></textarea>
                        </div>
                        <input type="checkbox" name="accepte" value="Oui" required> * J'acceptre le traitement informatique de
                        ce formulaire<br>
                        <br>
        
                        <button type="submit" id= "bouton_envoi" class="btn btn-dark btn-outline-primary">Envoyer</button>
                        <button type="reset" class="btn btn-dark btn-outline-primary"> Annuler</button>
                    </fieldset>
                    <br>
        
        

        <?php
        include("footer.php");
        ?>