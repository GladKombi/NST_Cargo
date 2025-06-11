<?php
include("../../connexion/connexion.php");
if (isset($_GET["MtMentor"]) && !empty($_GET["MtMentor"])) {
    $id=$_GET["MtMentor"];
    $statut=1;
    $req = $connexion->prepare("UPDATE `parrain` SET `statut`=? WHERE member=?");
    $test = $req->execute(array($statut, $id));
    if ($test == true) {
        $_SESSION['msg'] = "A mentoring has been deleted succefully !";
        header("location:../../views/mentors-list.php");
    } else {
        $_SESSION['msg'] = "Failled canceling";
        header("location:../../views/mentors-list.php");
    }
} else {
    header("location:../../views/mentors-list.php");
}
