<?php
include("../../connexion/connexion.php");
if (isset($_GET["Mentor"]) && !empty($_GET["Mentor"])) {
    $idMember = $_GET["Mentor"];
    $statut = 0;
    #verifier si l'utilisateur existe ou pas dans la bd
    $getMentorDeplicant = $connexion->prepare("SELECT * FROM `parrain` WHERE member=? AND statut=?");
    $getMentorDeplicant->execute([$idMember, $statut]);
    $tab = $getMentorDeplicant->fetch();
    if ($tab > 0) {
        $_SESSION['msg'] = "The operation failled, the selected member is already a mentor !";
        header("location:../../views/parrain.php");
    } else {
        $req = $connexion->prepare("INSERT INTO `parrain`(`member`, `statut`) VALUES (?,?)");
        $test = $req->execute(array($idMember, $statut));
        if ($test == true) {
            $_SESSION['msg'] = "a new mentor has been registed succefully !";
            header("location:../../views/parrain.php");
        } else {
            $_SESSION['msg'] = "Registration fail !";
            header("location:../../views/parrain.php");
        }
    }
} else {
    header("location:../../views/parrain.php");
}
