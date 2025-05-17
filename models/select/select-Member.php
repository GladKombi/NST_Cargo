<?php
if (isset($_GET["idMember"])) {
    $id = $_GET["idMember"];
    $getDataMod = $connexion->prepare("SELECT * FROM membre WHERE matricule=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();
    $departementModif = $tab['departement'];
    $title = "Update member indentity " . $tab['nom'] . " " . $tab['prenom'];
    $btn = "Update";
    $url = "../models/updat/update-Agent-post.php?idAgent=" . $id;
} else {
    $title = "Registrer new member";
    $btn = "Save";
    $url = "../models/add/add-Member-post.php";
}

# Selection Des données des agents
$statut=0;
$getData = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? ORDER BY `membre`.`matricule` DESC;");
$getData->execute([$statut]);

