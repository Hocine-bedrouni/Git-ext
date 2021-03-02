
// déclaration des variables nécessaires aux fonctions
var formValid = document.getElementById('bouton_envoi');
var prenom = document.getElementById('prenom');
var missPrenom = document.getElementById('missPrenom');
var textValid = /^[a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+([-'\s][a-zA-ZéèîïÉÈÎÏ][a-zéèêàçîï]+)?$/;
var nom = document.getElementById('nom');
var missnom = document.getElementById('missnom');
var codepostal = document.getElementById('codepostal');
var misscodepostal = document.getElementById('misscodepostal');
var codepostalValid = /^[0-9]{2,5}$/;
var ville = document.getElementById("ville");
var missville = document.getElementById("missville");
var adresse = document.getElementById("adresse");
var missadresse = document.getElementById("missadresse");
var adresseValid = /^[0-9]{1,3}(([,. ]?){1}[a-zA-Zàâäéèêëïîôöùûüç']+)*$/;


// le bouton d'envoi lance la fonction de vérification pour chaque champ
formValid.addEventListener('click', validationPrenom);

// fonction qui vérifie le prénom
function validationPrenom(event) {
    //Si le champ est vide
    if (prenom.validity.valueMissing) {
        event.preventDefault();
        missPrenom.textContent = 'Prénom manquant';
        missPrenom.style.color = 'red';
        return false;
        //Si le format de données est incorrect
    } else if (textValid.test(prenom.value) == false) {
        event.preventDefault();
        missPrenom.textContent = 'Format incorrect';
        missPrenom.style.color = 'orange';
    } else {(prenom.value) == Number("")
    missPrenom.textContent = 'Pas de chiffre';
    missPrenom.style.color = 'jaune';}
}

formValid.addEventListener('click', validationNom);

//fonction qui vérifie le nom
function validationNom(event) {
    if (nom.validity.valueMissing) {
        event.preventDefault();
        missnom.textContent = 'nom manquant';
        missnom.style.color = 'red';
        return false;
    } else if (textValid.test(nom.value) == false) {
        event.preventDefault();
        missnom.textContent = 'Format incorrect';
        missnom.style.color = 'orange';
    } else {
    }
}


formValid.addEventListener('click', validationCodepostal);

//fonction qui vérifie le code postal
function validationCodepostal(event) {
    if (codepostal.validity.valueMissing) {
        event.preventDefault();
        misscodepostal.textContent = 'code postal manquant';
        misscodepostal.style.color = 'red';
        return false;
    } else if (codepostalValid.test(codepostal.value) == false) {
        event.preventDefault();
        misscodepostal.textContent = 'Format incorrect';
        misscodepostal.style.color = 'orange';
    } else {
    }
}

formValid.addEventListener('click', validationville);

//fonction qui vérifie la ville
function validationville(event) {
    if (ville.validity.valueMissing) {
        event.preventDefault();
        missville.textContent = 'ville manquant';
        missville.style.color = 'red';
        return false;
    } else if (textValid.test(ville.value) == false) {
        event.preventDefault();
        missville.textContent = 'Format incorrect';
        missville.style.color = 'orange';
    } else {
    }
}

formValid.addEventListener('click', validationadresse);
// fonction qui vérifie l'adresse
function validationadresse(event) {
    if (adresse.validity.valueMissing) {
        event.preventDefault();
        missadresse.textContent = 'adresse manquante';
        missadresse.style.color = 'red';
        return false;
    } else if (adresseValid.test(adresse.value) == false) {
        event.preventDefault();
        missadresse.textContent = 'Format incorrect';
        missadresse.style.color = 'orange';
    } else {
    }
}

