<?php
include("../../connexion/connexion.php");
if (isset($_POST["Valider"])) {
    $member = htmlspecialchars($_POST['member']);
    $cbm = htmlspecialchars($_POST['cbm']);
    $Etat = 0;
    $statut = 0;
    #verifier si le cbm ne pas alphanumeric
    if (is_numeric($cbm)) {
        $req = $connexion->prepare("INSERT INTO `colis`(`date`, `member`, `cbm`, `statut`, `Etat`) VALUES (now(),?,?,?,?)");
        $test = $req->execute(array($member, $cbm, $statut, $Etat));
        if ($test == true) {
            $_SESSION['msg'] = "A new package has been registed succefully !";
            header("location:../../views/colis.php");
        } else {
            $_SESSION['msg'] = "Registration faill !";
            header("location:../../views/colis.php");
        }
    } else {
        $_SESSION['msg'] = "The package CMB's should not contain string caraters";
        header("location:../../views/colis.php");
    }
} else {
    header("location:../../views/colis.php");
}
