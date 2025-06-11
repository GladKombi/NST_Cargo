<?php
if (isset($_GET["idDemande"])) {
    $id = $_GET["idDemande"];
    $getDataMod = $connexion->prepare("SELECT * FROM demande WHERE id=?");
    $getDataMod->execute([$id]);
    $tab = $getDataMod->fetch();
    $MentorModif = $tab["mentor"];
    $MembersModif = $tab["member"];
    $url = "../models/add/add-repayement-post.php?idCredit=" . $id;
    $statut = 0;
    $getCreditInfo = $connexion->prepare("SELECT `demande`.*, membre.nom AS memberName, membre.phone AS memberPhone, membre.profil, membre.matricule AS memberMat, parrain.member AS mentorMat FROM `demande`,`parrain`,`membre` WHERE demande.member=membre.matricule AND demande.mentor=parrain.id AND demande.statut=? AND `demande`.`id`=? ORDER BY `demande`.`id` DESC;");
    $getCreditInfo->execute([$statut, $id]);
    $Info = $getCreditInfo->fetch();
    $nom = $Info["memberName"];
    $phone = $Info["memberPhone"];
    $profil = $Info["profil"];
    $montant = $Info["montant"];
    $member = $Info["member"];
} else {
    $title = "New Credit Application";
    $btn = "Save";
    $url = "../models/add/add-Credit-post.php";
}
$statut = 0;
$etat = 1;
# Selection Des données des agents
$getData = $connexion->prepare("SELECT membre.nom as nomMebre, membre.phone as membrePhone, membre.profil as membreProfil, repayement.date, repayement.montant, demande.id FROM `demande`, membre, repayement WHERE demande.member=membre.matricule AND repayement.credit=demande.id AND repayement.statut=? ORDER BY `repayement`.`id` DESC;");
$getData->execute([$statut]);
# Selection Des creditss
$getCredit = $connexion->prepare("SELECT `demande`.*, membre.nom AS memberName, membre.phone AS memberPhone, membre.profil, membre.matricule AS memberMat, parrain.member AS mentorMat FROM `demande`,`parrain`,`membre` WHERE demande.member=membre.matricule AND demande.mentor=parrain.id AND demande.statut=? AND demande.etat!=? ORDER BY `demande`.`id` DESC;");
$getCredit->execute([$statut, $etat]);
