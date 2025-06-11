<?php
if (isset($_GET["idcolis"])) {
    $id = $_GET["idcolis"];
    $getDataMod = $connexion->prepare("SELECT * FROM colis WHERE id=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();
    $MembersModif=$tab["member"];
    $title = "Update the package information" ;
    $btn = "Update";
    $url = "../models/updat/up-colis-post.php?idColis=" . $id;
} else {
    $title = "New Package";
    $btn = "Save";
    $url = "../models/add/add-Package-post.php";
}

# Selection Des données des membres
$statut=0;
$getMember = $connexion->prepare("SELECT * FROM `membre` WHERE membre.statut=? ORDER BY `membre`.`matricule` DESC;");
$getMember->execute([$statut]);
# Selection des touts les colis non encore embarquer
$Etat=0;
$getData = $connexion->prepare("SELECT * FROM `colis` WHERE colis.statut=? AND colis.Etat=?;");
$getData->execute([$statut,$Etat]);
