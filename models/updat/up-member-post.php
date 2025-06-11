<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');
# Modification de données d'un Agent
if (isset($_POST['Valider']) && !empty($_GET['idMember'])) {
    $matricule = $_GET["idMember"];
    $name = htmlspecialchars($_POST['nom']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $statut = 0;
    if (is_numeric($telephone)) {
        # Deplicants verifications
        $statut = 0;
        ## Get similarity every where in inputs
        $getMemberSimilar = $connexion->prepare("SELECT * FROM `membre` WHERE `nom`=? AND `phone`=? AND statut=? AND matricule=?");
        $getMemberSimilar->execute(array($name, $telephone, $statut, $matricule));
        $Similarty = $getMemberSimilar->fetch();
        if ($Similarty > 0) {
            $msg = "The member identity has been updated successfully !";
            $_SESSION['msg'] = $msg;
            header("location:../../views/member.php");
        } else {
            ## Verification of the Number deplicant
            $getDeplicantMember = $connexion->prepare("SELECT * FROM `membre` WHERE `nom`=? AND `phone`=? AND statut=? AND matricule!=? ");
            $getDeplicantMember->execute(array($name, $telephone, $statut, $matricule));
            $existant = $getDeplicantMember->fetch();
            if ($existant['id'] >= 1) {
                # If there's similar name and phone number as they are in the input
                $msg = "There's a simillar member name in the database !";
                $_SESSION['msg'] = $msg;
                header('location:../../views/member.php');
            } else {
                # Insertion of Data in the table
                $req = $connexion->prepare("UPDATE `membre` SET `nom`=?,`phone`=? WHERE matricule=?");
                $resultat = $req->execute([$name, $telephone, $matricule]);
                if ($resultat == true) {
                    $_SESSION['msg'] = "The member identity has been updated successfully !";
                    header("location:../../views/member.php");
                } else {
                    $_SESSION['msg'] = "Modification failled!";
                    header("location:../../views/member.php");
                }
            }
        }
    } else {
        $_SESSION['msg'] = "the phone number should not contain string caraters";
        header("location:../../views/member.php");
    }
} else {
    header("location:../../views/member.php");
}
