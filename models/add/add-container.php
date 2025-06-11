<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');

# Récuperation de la date
$date = date("d/m/y");

# Creation du matricule du container
$getLastMAt = $connexion->prepare("SELECT * FROM `container` WHERE container.date=? ORDER BY matricule DESC LIMIT 1 ");
$getLastMAt->execute([$date]);
if ($mat = $getLastMAt->fetch()) {
    $valeur = $mat['matricule'];
    // echo $valeur;
    if (strlen($valeur) == 14) {
        $numero = substr($valeur, 4, 1) + 1;
        echo $numero;
    } else {
        $nb = strlen($valeur) - 14 + 1;
        $numero = substr($valeur, 4, $nb);
        echo $numero;
    }
} else {
    $numero = 1;
}
$prefixe = "NST-" . $numero . "-";
$dateCode = date("d/m/y"); // Format JJ/MM/AA

$matricule = $prefixe . $dateCode;
echo $matricule;
$statut=0;
$etat=0;
# Insertion data from database
$req = $connexion->prepare("INSERT INTO `container`(`matricule`, `date`, `statut`, `etat`) VALUES (?,?,?,?)");
$resultat = $req->execute([$matricule, $date, $statut, $etat]);
if ($resultat == true) {
    $_SESSION['msg'] = "A new container has been registered succefuly ! Now regiter all package loadings";
    header("location:../../views/package-load.php?loading");
} else {
    $_SESSION['msg'] = "Registration fail";
    header("location:../../views/container.php");
}

