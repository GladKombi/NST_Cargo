<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');
# Modification de données d'un Agent
if (isset($_POST["Valider"]) && !empty($_GET["idColis"])) {
    $id = $_GET["idColis"];
    $member = htmlspecialchars($_POST['member']);
    $cbm = htmlspecialchars($_POST['cbm']);
    #verifier si le cbm ne pas alphanumeric
    if (is_numeric($cbm)) {
        $InsertData = $connexion->prepare("UPDATE colis SET member=?, cbm=? WHERE id=?");
        $resultat = $InsertData->execute(array($member, $cbm, $id));
        if ($resultat == true) {
            $_SESSION['msg'] = "A Package has been updated successfuly !";
            header("location:../../views/colis.php");
        } else {
            $_SESSION['msg'] = "The update failled !";
            header("location:../../views/colis.php");
        }
    } else {
        $_SESSION['msg'] = "The package CMB's should not contain string caraters";
        header("location:../../views/colis.php");
    }
} else {
    header("location:../../views/colis.php");
}
