<?php
if (isset($_GET["loading"])) {
    # Recuperation du dernier container
    if (isset($_GET["container"])) {
        $LastestContainer = $_GET["container"];
    } else {
        $getLastMAt = $connexion->prepare("SELECT * FROM `container` ORDER BY matricule DESC LIMIT 1 ");
        $getLastMAt->execute();
        if ($mat = $getLastMAt->fetch()) {
            $LastestContainer = $mat['matricule'];
        }
    }
    $title = "Package load";
    $btn = "Save";
    $url = "../models/add/add-PackageLoad-post.php?container=" . $LastestContainer;
} else {
    $_SESSION['msg'] = "Registration fail";
    header("location:../views/cargaison.php");
}

# Selection des touts les colis non encore embarquer
$Etat = 0;
$statut = 0;
$getcolis = $connexion->prepare("SELECT * FROM `colis` WHERE colis.statut=? AND colis.Etat=?;");
$getcolis->execute([$statut, $Etat]);
# Selection Des colis deja charges
$getData = $connexion->prepare("SELECT `loading`.*,membre.matricule,membre.nom,membre.profil,colis.cbm FROM `loading`,`membre`,`colis` WHERE loading.colis=colis.id AND colis.member=membre.matricule AND loading.statut=? and loading.container=? ORDER BY `loading`.`id` DESC;");
$getData->execute([$statut, $LastestContainer]);
