<?php
include("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $member = htmlspecialchars($_POST['member']);
    $mentor = htmlspecialchars($_POST['mentor']);
    $amount = htmlspecialchars($_POST['amount']);
    $statut = 0;
    #verifier si le memntor veut se parrainer
    $getMentors = $connexion->prepare("SELECT parrain.member FROM `parrain` WHERE parrain.id=? ;");
    $getMentors->execute([$mentor]);
    if ($selectedMentor = $getMentors->fetch()) {
        $parrain = $selectedMentor['member'];
        if ($member == $parrain) {
            $_SESSION['msg'] = "The operation failled, a mentor can't support him credit application !";
            header("location:../../views/demande.php");
        } else {
            if (is_numeric($amount)) {
                $req = $connexion->prepare("INSERT INTO `demande`(`date`, `member`, `mentor`, `montant`, `statut`) VALUES (now(),?,?,?,?)");
                $test = $req->execute(array($member, $mentor, $amount, $statut));
                if ($test == true) {
                    $_SESSION['msg'] = "A new credit application has been registed succefully !";
                    header("location:../../views/demande.php");
                } else {
                    $_SESSION['msg'] = "Registration fail !";
                    header("location:../../views/demande.php");
                }
            } else {
                $_SESSION['msg'] = "The amount should not contain string caraters";
                header("location:../../views/demande.php");
            }
        }
    }
} else {
    header("location:../../views/demande.php");
}
