<?php
include("../../connexion/connexion.php");
if (isset($_GET["SupCredit"]) && !empty($_GET["SupCredit"])) {
    $id=$_GET["SupCredit"];
    $statut=1;
    $req = $connexion->prepare("UPDATE `demande` SET `statut`=? WHERE demande.id=?");
    $test = $req->execute(array($statut, $id));
    if ($test == true) {
        $_SESSION['msg'] = "A credit has been deleted succefully !";
        header("location:../../views/demande.php");
    } else {
        $_SESSION['msg'] = "Faill to delete";
        header("location:../../views/demande.php");
    }
} else {
    header("location:../../views/demande.php");
}
