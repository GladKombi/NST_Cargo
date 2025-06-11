<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');
# Modification de données d'un Agent
if (isset($_POST["Valider"]) && !empty($_GET["idCredit"])) {
    $id = $_GET["idCredit"];
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
                $InsertData = $connexion->prepare("UPDATE demande SET member=?, mentor=?, montant=? WHERE id=?");
                $resultat = $InsertData->execute(array($member, $mentor, $amount, $id));
                if ($resultat == true) {
                    $_SESSION['msg'] = "A credit application has been updated successfuly !";
                    header("location:../../views/demande.php");
                } else {
                    $_SESSION['msg'] = "The update failled !";
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
