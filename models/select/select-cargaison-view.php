<?php
if(isset($_GET['cargaison-view'])){
    $container=$_GET['cargaison-view'];
}
# Selection Des données des membres
$statut=0;
$getMember = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? ORDER BY `membre`.`matricule` DESC;");
$getMember->execute([$statut]);
# Selection des touts les colis non encore embarquer
$Etat=0;
$getData = $connexion->prepare("SELECT `loading`.*, membre.matricule, membre.nom, membre.phone, membre.profil, colis.cbm FROM `loading`,colis,membre,container WHERE loading.colis=colis.id AND colis.member=membre.matricule AND loading.container=?;");
$getData->execute([$container]);