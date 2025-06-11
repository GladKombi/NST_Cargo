<?php

# Selection Des données des membres
$statut=0;
$getMember = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? ORDER BY `membre`.`matricule` DESC;");
$getMember->execute([$statut]);
# Selection des touts les colis non encore embarquer
$Etat=0;
$getData = $connexion->prepare("SELECT * FROM `container` WHERE container.statut=? AND container.Etat=?;");
$getData->execute([$statut,$Etat]);
