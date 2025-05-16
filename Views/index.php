<?php
# Se connecter à la BD
include '../connexion/connexion.php';
# Appel du script de selection
require_once('../models/select/select-Agent.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>NST-cargo</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <?php require_once('style.php') ?>

</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <?php
        require_once('Active.php');
        $ActiveHome = 1;
        require_once('aside.php');
        ?>
        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php require_once('navbar.php') ?>

            <!-- main content Start -->
            <div class="container-fluid pt-4 px-4">
                <main class="main d-flex justify-content-center align-items-center" id="main" style="min-height: 80vh;">
                    <div class="row">
                        <H1>Home</H1>
                    </div>
                </main>
            </div>
            <!-- main content End -->

            <!-- Footer Start -->
            <?php require_once('footer.php') ?>
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <?php require_once('script.php') ?>
</body>

</html>