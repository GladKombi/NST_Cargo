<?php
if (isset($_GET["idmember"])) {
    $id = $_GET["idmember"];
    $getDataMod = $connexion->prepare("SELECT * FROM membre WHERE matricule=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();
    $title = "Update member identity " . $tab['nom'];
    $btn = "Update";
    $url = "../models/updat/up-member-post.php?idMember=" . $id;
} else {
    $title = "Registrer new member";
    $btn = "Save";
    $url = "../models/add/add-Member-post.php";
}

# Selection Des données des agents
$statut=0;
$getData = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? ORDER BY `membre`.`matricule` DESC;");
$getData->execute([$statut]);

