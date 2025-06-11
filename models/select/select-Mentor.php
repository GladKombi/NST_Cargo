<?php
if (isset($_GET["Mentor"]) && !empty($_GET["Mentor"])) {
    $matricule=$_GET["Mentor"];
    $url = "../models/add/Add-Mentor.php?Mentor=" . $matricule;
    # Selection Des données du membre cible
    $getMemberInfo = $connexion->prepare("SELECT * FROM `membre` WHERE `membre`.`matricule`=? ;");
    $getMemberInfo->execute([$matricule]);
}
if (isset($_GET["MtMentor"]) && !empty($_GET["MtMentor"])) {
    $MtMentor=$_GET["MtMentor"];
    $url = "../models/delete/delete-mentoring.php?MtMentor=" . $MtMentor;
    # Selection Des données du membre cible
    $getMemberInfo = $connexion->prepare("SELECT * FROM `membre` WHERE `membre`.`matricule`=? ;");
    $getMemberInfo->execute([$MtMentor]);
}

# Selection Des données des membres
$statut = 0;
$getData = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? AND membre.matricule NOT IN(SELECT parrain.member FROM parrain WHERE parrain.statut=?)ORDER BY `membre`.`matricule` DESC;");
$getData->execute([$statut,$statut]);

# Selection Des données des mentors
$getMentors = $connexion->prepare("SELECT membre.*,parrain.member FROM `parrain`,`membre` WHERE parrain.statut=? AND membre.matricule=parrain.member ORDER BY `parrain`.`id` DESC;");
$getMentors->execute([$statut]);
