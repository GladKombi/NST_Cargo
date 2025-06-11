<?php
if (isset($_GET["idDemande"])) {
    $id = $_GET["idDemande"];
    $getDataMod = $connexion->prepare("SELECT * FROM demande WHERE id=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();
    $MentorModif=$tab["mentor"];
    $MembersModif=$tab["member"];
    $title = "Update a credit application" ;
    $btn = "Update";
    $url = "../models/updat/up-credit-post.php?idCredit=" . $id;
} else {
    $title = "New Credit Application";
    $btn = "Save";
    $url = "../models/add/add-Credit-post.php";
}

# Selection Des données des membres
$statut=0;
$getMember = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? ORDER BY `membre`.`matricule` DESC;");
$getMember->execute([$statut]);

# Selection Des données des mentors
$getMentors = $connexion->prepare("SELECT membre.*,parrain.id,parrain.member FROM `parrain`,`membre` WHERE parrain.statut=? AND membre.matricule=parrain.member ORDER BY `parrain`.`id` DESC;");
$getMentors->execute([$statut]);

# Selection Des données des agents
$getData = $connexion->prepare("SELECT `demande`.*, membre.nom AS memberName, membre.phone AS memberPhone, membre.profil, membre.matricule AS memberMat, parrain.member AS mentorMat FROM `demande`,`parrain`,`membre` WHERE demande.member=membre.matricule AND demande.mentor=parrain.id AND demande.statut=? ORDER BY `demande`.`id` DESC;");
$getData->execute([$statut]);
