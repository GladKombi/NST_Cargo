<?php
include("../../connexion/connexion.php");
if (isset($_GET["SupMember"]) && !empty($_GET["SupMember"])) {
    $id=$_GET["SupMember"];
    $statut=1;
    $req = $connexion->prepare("UPDATE `membre` SET `statut`=? WHERE matricule=?");
    $test = $req->execute(array($statut, $id));
    if ($test == true) {
        $_SESSION['msg'] = "A member has been deleted succefully !";
        header("location:../../views/member.php");
    } else {
        $_SESSION['msg'] = "Failed to delete";
        header("location:../../views/member.php");
    }
} else {
    header("location:../../views/member.php");
}
