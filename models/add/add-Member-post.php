<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');
require_once('../../fonctions/fonctions.php');

# creation de l'evenement sur le bouton valider
if (isset($_POST['Valider'])) {
  $name = htmlspecialchars($_POST['nom']);
  $telephone = htmlspecialchars($_POST['telephone']);
  $statut = 0;
  # Creation du matricule disk
  $getLastMAt = $connexion->prepare("SELECT * FROM `membre` ORDER BY matricule DESC LIMIT 1 ");
  $getLastMAt->execute();
  if ($mat = $getLastMAt->fetch()) {
    $valeur = $mat['matricule'];
    // echo $valeur;
    $numero = substr($valeur, 9) + 1;
    //  echo $numero;
  } else {
    $numero = 1;
  }
  $matricule = "NSTCargo-" . sprintf('%03d', $numero);
  echo $matricule;

  if (is_numeric($telephone)) {
    #verifier si l'utilisateur existe ou pas dans la bd
    $getUserDeplicant = $connexion->prepare("SELECT * FROM `membre` WHERE matricule=? AND `nom`=? AND `phone`=? AND statut=?");
    $getUserDeplicant->execute([$matricule, $name, $telephone, $statut]);
    $tab = $getUserDeplicant->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "There's a simillar member name in the database !";
      header("location:../../views/member.php");
    } else {
      $fichier_tmp = $_FILES['picture']['tmp_name'];
      $nom_original = $_FILES['picture']['name'];
      $destination = "../../images/profil/";
      // fonction permettant de recuperer la photo
      $newimage = RecuperPhoto($fichier_tmp, $nom_original, $destination);

      # Insertion data from database
      $req = $connexion->prepare("INSERT INTO `membre`(`matricule`, `nom`, `phone`, `profil`, `statut`) VALUES (?,?,?,?,?)");
      $resultat = $req->execute([$matricule, $name, $telephone, $newimage, $statut]);
      if ($resultat == true) {
        $_SESSION['msg'] = "A new member has been register succefully";
        header("location:../../views/member.php");
      } else {
        $_SESSION['msg'] = "Registration fail";
        header("location:../../views/member.php");
      }
    }
  } else {
    $_SESSION['msg'] = "the phone number should not contain string caraters";
    header("location:../../views/member.php");
  }
} else {
  header("location:../../views/member.php");
}
