<?php
# Se connecter à la BD
include '../connexion/connexion.php';
# Appel du script de selection
require_once('../models/select/select-Credit.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nst-Cargo</title>
    <?php require_once('style.php') ?>
</head>

<body>
    <div class="container-scroller">
        <!-- Navbar Start -->
        <?php require_once('navbar.php') ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- right-sidebar -->
            <!-- <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                            <p class="text-gray mb-0">The total number of sessions</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>

                </div>
            </div> -->


            <?php require_once('aside.php'); ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <h4>Credit application</h4>
                        </div>
                        <!-- pour afficher les massage  -->
                        <?php
                        if (isset($_SESSION['msg']) && !empty($_SESSION['msg'])) {
                        ?>
                            <button type="button" class="btn btn-outline-primary btn-lg btn-block"><?= $_SESSION['msg'] ?></button>
                        <?php  }
                        #Cette ligne permet de vider la valeur qui se trouve dans la session message  
                        unset($_SESSION['msg']);
                        # Confirmation de la suppression
                        if (isset($_GET['SupCredit'])) {
                            $id = $_GET["SupCredit"];
                        ?>
                            <div class="col-xl-12 px-3 card mt-4 px-4 pt-3">
                                <h3 class="bi bi-shield-exclamation text-danger text-center">Confirmation Required</h3> <br>
                                <p class="text-center">
                                    Do you really want to delete this Credit application? This is dangerous! <br>
                                    This action is irreversible. Please ensure this is the action you wish to perform! It will delete a credit application from the database along with all data linked to it.
                                </p>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <a href="demande.php" class="btn btn-primary  w-100"> cancel</a>
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-md-6  col-sm-6 p-3">
                                        <a href="../models/delete/delete-credit.php?SupCredit=<?= $id ?>" class="btn btn-danger bi bi-trash w-100"> Delete the credit application</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            if (isset($_GET['NewCredit']) || isset($_GET["idDemande"])) {
                            ?>
                                <!-- Le form qui enregistrer les données  -->
                                <div class="col-md-4 grid-margin ">
                                    <form action="<?= $url ?>" class="shadow p-3" method="POST" enctype="multipart/form-data">
                                        <h5 class="text-center"><?= $title ?></h5>
                                        <div class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12  col-sm-6 p-3">
                                                <label for="">Member <span class="text-danger">*</span></label>
                                                <select required id="" name="member" class="js-example-basic-single w-100">
                                                    <?php
                                                    while ($Members = $getMember->fetch()) {
                                                        if (isset($_GET['idDemande'])) {
                                                    ?>
                                                            <option <?php if ($MembersModif == $Members['matricule']) { ?>Selected <?php } ?> value="<?= $Members['matricule'] ?>"><?= $Members['matricule'] . " - " . $Members['nom'] ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?= $Members['matricule'] ?>"><?= $Members['matricule'] . " - " . $Members['nom'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12  col-sm-6 p-3">
                                                <label for="">Mentor <span class="text-danger">*</span></label>
                                                <select required id="" name="mentor" class="js-example-basic-single w-100">
                                                    <?php
                                                    while ($Mentor = $getMentors->fetch()) {
                                                        if (isset($_GET['idDemande'])) {
                                                    ?>
                                                            <option <?php if ($MentorModif == $Mentor['id']) { ?>Selected <?php } ?> value="<?= $Mentor['id'] ?>"><?= $Mentor['member'] . " - " . $Mentor['nom'] ?></option>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <option value="<?= $Mentor['id'] ?>"><?= $Mentor['member'] . " - " . $Mentor['nom'] ?></option>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12  col-sm-6 p-3">
                                                <label for="">Credit application Amount <span class="text-danger">*</span></label>
                                                <input required autocomplete="off" type="text" name="amount" class="form-control" placeholder="E.g: 243" <?php if (isset($_GET['idDemande'])) { ?>value="<?= $tab['montant'] ?>" <?php } ?>>
                                            </div>

                                            <?php if (isset($_GET['idDemande'])) {
                                            ?>
                                                <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                                    <input type="submit" name="Valider" class="btn btn-primary w-100" value="Update">
                                                </div>
                                                <div class="col-xl-6 col-lg-6 col-md-6 mt-4 col-sm-6 p-3 ">
                                                    <a href="demande.php" class="btn btn-danger w-100">Cancel</a>
                                                </div>
                                            <?php
                                            } else {
                                            ?>
                                                <div class="col-12 p-3">
                                                    <input type="submit" class="btn btn-primary w-100" name="Valider" value="<?= $btn ?>">
                                                </div>
                                            <?php
                                            }
                                            ?>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-8 grid-margin">
                                    <div class="row text-center">
                                        <h4 class="text-center">Credit application list List</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Member</th>
                                                    <th>Mentor</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n = 0;
                                                while ($member = $getData->fetch()) {
                                                    $n++;
                                                    $mentoratMat = $member["mentorMat"];
                                                    # Selection Des données des mentors
                                                    $getMentorsInfo = $connexion->prepare("SELECT membre.nom, membre.phone,membre.profil FROM `membre` WHERE membre.matricule=?;");
                                                    $getMentorsInfo->execute([$mentoratMat]);
                                                    if ($mentor = $getMentorsInfo->fetch()) {
                                                        $NomMentor = $mentor["nom"];
                                                        $mentorPhone = $mentor["phone"];
                                                        $mentorprofil = $mentor["profil"];
                                                    }
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?= $n; ?></th>
                                                        <th><?= $member["date"] ?></th>
                                                        <td>
                                                            <img src="../images/profil/<?= $member["profil"] ?>" alt="" class="rounded-circle text-center" width="80px" height="75px">
                                                            <h6 class="mt-2"><?= $member["memberName"] . " " . $member["memberPhone"] ?></h6>
                                                        </td>
                                                        <td>
                                                            <img src="../images/profil/<?= $member["profil"] ?>" alt="" class="rounded-circle text-center" width="80px" height="75px">
                                                            <h6 class="mt-2"><?= $NomMentor . " " . $mentorPhone ?></h6>
                                                        </td>
                                                        <td><?= $member["montant"] ?></td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            <?php
                            } else {
                            ?>


                                <div class="add-items d-flex mb-0 mt-2 p-2">
                                    <a href="demande.php?NewCredit" class="add btn btn text-primary bg-transparent border">
                                        <i class="icon-circle-plus"> </i> New credit application
                                    </a>

                                </div>


                                <!-- La table qui affiche les données  -->
                                <div class="col-xl-12 col-lg-12 col-md-6 table-responsive px-3 pt-3">
                                    <div class="row text-center">
                                        <h4 class="text-center">Credit application List</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Member</th>
                                                    <th>Mentor</th>
                                                    <th>Amount</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $n = 0;
                                                while ($member = $getData->fetch()) {
                                                    $n++;
                                                    $mentoratMat = $member["mentorMat"];
                                                    # Selection Des données des mentors
                                                    $getMentorsInfo = $connexion->prepare("SELECT membre.nom, membre.phone,membre.profil FROM `membre` WHERE membre.matricule=?;");
                                                    $getMentorsInfo->execute([$mentoratMat]);
                                                    if ($mentor = $getMentorsInfo->fetch()) {
                                                        $NomMentor = $mentor["nom"];
                                                        $mentorPhone = $mentor["phone"];
                                                        $mentorprofil = $mentor["profil"];
                                                    }
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?= $n; ?></th>
                                                        <th><?= $member["date"] ?></th>
                                                        <td>
                                                            <img src="../images/profil/<?= $member["profil"] ?>" alt="" class="rounded-circle text-center" width="80px" height="75px">
                                                            <h6 class="mt-2"><?= $member["memberName"] . " " . $member["memberPhone"] ?></h6>
                                                        </td>
                                                        <td>
                                                            <img src="../images/profil/<?= $member["profil"] ?>" alt="" class="rounded-circle text-center" width="80px" height="75px">
                                                            <h6 class="mt-2"><?= $NomMentor . " " . $mentorPhone ?></h6>
                                                        </td>
                                                        <td><?= $member["montant"] ?></td>
                                                        <td>
                                                            <a href='demande.php?idDemande=<?= $member['id'] ?>' class="btn btn-sm btn-success mt-1">
                                                                <i class="bi bi-pencil-square"></i>
                                                            </a>
                                                            <a href="demande.php?SupCredit=<?= $member['id'] ?>" class="btn btn-danger btn-sm mt-1">
                                                                <i class="bi bi-trash"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <?php require_once('footer.php') ?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php require_once('script.php') ?>
</body>

</html>