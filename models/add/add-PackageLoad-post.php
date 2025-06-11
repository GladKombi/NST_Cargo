<?php
include("../../connexion/connexion.php");
if (isset($_POST["Valider"]) && isset($_GET["container"])) {
    $container = $_GET["container"];
    $package = htmlspecialchars($_POST['package']);
    $statut = 0;
    #verifier si le cbm ne pas alphanumeric
    $req = $connexion->prepare("INSERT INTO `loading`(`date`, `colis`, `container`, `statut`) VALUES (now(),?,?,?)");
    $test = $req->execute(array($package, $container, $statut));
    if ($test == true) {
        $Etat = 1;
        $InsertData = $connexion->prepare("UPDATE colis SET Etat=? WHERE id=?");
        $resultat = $InsertData->execute(array($Etat, $package));
        if ($resultat == true) {
            $_SESSION['msg'] = "A new loading package has been registed succefully !";
            header("location:../../views/package-load.php?loading");
        } else {
            $_SESSION['msg'] = "The update failled !";
            header("location:../../views/package-load.php");
        }
    } else {
        $_SESSION['msg'] = "Registration faill !";
        header("location:../../views/package-load.php?loading");
    }
} else {
    header("location:../../views/package-load.php");
}
