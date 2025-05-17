<?php
#inclusion de la page de connexion
include('../../connexion/connexion.php');
require_once('../../fonctions/fonctions.php');

# creation de l'evenement sur le bouton valider
if (isset($_POST['Valider'])) {
  $name = htmlspecialchars($_POST['nom']);
  $telephone = htmlspecialchars($_POST['telephone']);
  # Creation du matricule disk
  $getLastMAt = $connexion->prepare("SELECT * FROM `membre` ORDER BY matricule DESC LIMIT 1 ");
  $getLastMAt->execute();
  if ($mat = $getLastMAt->fetch()) {
    $valeur = $mat['matricule'];    
    if (strlen($valeur) == 10) {
      $numero = substr($valeur, 5, 1) + 1;
      echo $numero;
    } else {
      $nb = strlen($valeur) - 10 + 1;
      $numero = substr($valeur, 5, $nb);
      echo $numero;
    }
  } else {
    $numero = 1;
  }
  $matricule = "CO" . $numero . "Date";
  echo $matricule;

  if (is_numeric($telephone)) {
    #verifier si l'utilisateur existe ou pas dans la bd
    $getUserDeplicant = $connexion->prepare("SELECT * FROM `users` WHERE mail=? AND telephone=? AND statut=?");
    $getUserDeplicant->execute([$telephone, $mail, $statut]);
    $tab = $getUserDeplicant->fetch();
    if ($tab > 0) {
      $_SESSION['msg'] = "Cet Agent existe deja dans a BD!";
      header("location:../../views/agent.php");
    } else {
      $fichier_tmp = $_FILES['picture']['tmp_name'];
      $nom_original = $_FILES['picture']['name'];
      $destination = "../../images/profil/";
      // fonction permettant de recuperer la photo
      $newimage = RecuperPhoto($fichier_tmp, $nom_original, $destination);
      # verify pwd vadity
      if ($pwd != "") {
        # Insertion data from database
        $req = $connexion->prepare("INSERT INTO `users`( `nom`, `prenom`, `genre`, `departement`, `mail`, `telephone`, `pwd`, `profil`, `statut`) VALUES (?,?,?,?,?,?,?,?,?)");
        $resultat = $req->execute([$nom, $prenom, $genre, $departement, $mail, $telephone, $passwordhacher, $newimage, $statut]);
        if ($resultat == true) {
          $_SESSION['msg'] = "Enregistrement réussi !";
          header("location:../../views/Agent.php");
        } else {
          $_SESSION['msg'] = "Echec d'enregistrement !";
          header("location:../../views/Agent.php");
        }
      } else {
        $_SESSION['msg'] = "Ajouter les modifications";
        header("location:../../views/Agent.php");
      }
    }
  } else {
    $_SESSION['msg'] = "Le numero de téléphone ne doit pas containir des lettres !";
    header("location:../../views/Agent.php");
  }
} else {
  header("location:../../views/Agent.php");
}
