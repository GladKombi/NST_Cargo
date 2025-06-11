<?php
include("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    if (isset($_GET['idCredit'])) {
        $idCredit = $_GET['idCredit'];
    }
    $amount = htmlspecialchars($_POST['amount']);
    $statut = 0;
    # verifier le montant du credit
    $getCreditAmount = $connexion->prepare("SELECT demande.montant FROM `demande` WHERE demande.id=? ;");
    $getCreditAmount->execute([$idCredit]);
    $CreditAmount = $getCreditAmount->fetch();
    $CreditAmount = $CreditAmount[0];
    if ($CreditAmount < $amount) {
        $_SESSION['msg'] = "The enter amount is not sufficient for this credit , chec the enter amount !";
        header("location:../../views/paiement-credit.php?idDemande=$idCredit");
    } else {
        if (is_numeric($amount)) {
            $req = $connexion->prepare("INSERT INTO `repayement`(`date`, `credit`, `montant`, `statut`) VALUES (now(),?,?,?)");
            $test = $req->execute(array($idCredit, $amount, $statut));
            if ($test == true) {
                $etat = 1;
                $UpdatDemand = $connexion->prepare("UPDATE demande SET etat=? WHERE id=?");
                $resultat = $UpdatDemand->execute(array($etat, $idCredit));
                if ($resultat == true) {
                    $_SESSION['msg'] = "Your payement has been registed succefully !";
                    header("location:../../views/paiement-credit.php");
                }
            } else {
                $_SESSION['msg'] = "Registration fail !";
                header("location:../../views/paiement-credit.php");
            }
        } else {
            $_SESSION['msg'] = "The amount should not contain string caraters";
            header("location:../../views/paiement-credit.php");
        }
    }
} else {
    header("location:../../views/paiement-credit.php");
}
