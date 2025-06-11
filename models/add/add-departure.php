<?php
include("../../connexion/connexion.php");
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bill of load</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>

    <div class="container mt-5">
        <h2 class="mb-4 text-center">Details</h2>

        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Member identity</th>
                    <th scope="col">Package Cbm</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $n = 0;
                if (isset($_GET["container"]) || isset($_GET["mat"])) {
                    $container = $_GET["container"];
                    $mat = $_GET["mat"];
                }
                # Selection des informations des membres
                $Etat = 0;
                $getData = $connexion->prepare("SELECT `loading`.*, membre.matricule, membre.nom, membre.phone, membre.profil, colis.cbm FROM `loading`,colis,membre,container WHERE loading.colis=colis.id AND colis.member=membre.matricule AND loading.container=? AND membre.matricule=?;");
                $getData->execute([$container, $mat]);
                # Affichage des données
                while ($cargaison = $getData->fetch()) {
                    $n++;
                ?>
                    <tr>
                        <th scope="row"><?= $n; ?></th>
                        <td>
                            <img src="../../images/profil/<?= $cargaison["profil"] ?>" alt="" class="rounded-circle text-center" width="80px" height="75px">
                            <h6 class="mt-2"><?= $cargaison["matricule"] . " " . $cargaison["nom"] . " " . $cargaison["phone"] ?></h6>
                        </td>
                        <td><?= $cargaison["cbm"] ?> <b>Cbm</b></td>

                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <button onclick="sendWhatsApp()" class="btn btn-success btn-sm btn-100 mt-2 text-center rounded"> <i class="bi bi-send"></i> Send Notification</button>
    </div>


    <script>
        function sendWhatsApp() {
            // Données du tableau
            const tableData = [{
                nom: "<?= $_GET['nom'] ?>",
                colis: "<?= $_GET['colis'] . ' Cbm' ?>",
                container: "<?= $_GET['container'] ?>"
            }];

            // Construire le message
            let message = "📋 **Hello dear NSTcargo customer **\n\n";
            tableData.forEach((row) => {
                message += `${row.nom} About your package\n`;
                message += `   It's in the container : ${row.container}\n\n`;
                message += `   and takes  : ${row.colis}\n\n`;

            });
            message += " @NSTcargo";

            // Encoder le message pour l'URL
            const encodedMessage = encodeURIComponent(message);

            // Numéro de téléphone
            const phoneNumber = "<?= $_GET['num'] ?>"; // Sans le "+"

            // Créer le lien WhatsApp
            const whatsappLink = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;

            // Ouvrir le lien dans une nouvelle fenêtre
            window.open(whatsappLink, '_blank');
        }
    </script>

</body>

</html>