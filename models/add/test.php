<?php
if(isset($_GET["cargaison"])){
    $container=$_GET["cargaison"];
}
header('Content-Type: application/json'); // Indique que la réponse est du JSON

// Remplace ces informations par celles de ta base de données
$dbHost = 'localhost';
$dbName = 'nst_cargo_bd';
$dbUser = 'root';
$dbPass = '';

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8", $dbUser, $dbPass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Requête SQL pour récupérer les numéros et les messages
    // Adapte cette requête à la structure de ta table
    // Exemple : supposons une table 'messages_whatsapp' avec les colonnes 'numero_telephone' et 'contenu_message'
    $stmt = $pdo->prepare("SELECT `loading`.*, membre.matricule, membre.nom, membre.phone, membre.profil, colis.cbm FROM `loading`,colis,membre,container WHERE loading.colis=colis.id AND colis.member=membre.matricule AND loading.container=?");
    $stmt->execute([$container]);
    $data = $stmt->fetchAll();

    echo json_encode($data); // Encode les données en JSON et les affiche
} catch (PDOException $e) {
    echo json_encode(['error' => 'Erreur de connexion ou de requête : ' . $e->getMessage()]);
}
?>
<script>
    async function sendWhatsApp() {
        // Optionnel : Message de confirmation ou de chargement
        console.log("Préparation des messages WhatsApp...");

        try {
            // Requête AJAX pour récupérer les données depuis le serveur PHP
            // Assure-toi que le chemin vers ton fichier PHP est correct
            const response = await fetch('get_messages_data.php'); // Remplace 'get_messages_data.php' par le chemin correct si nécessaire
            
            if (!response.ok) {
                throw new Error(`Erreur HTTP: ${response.status}`);
            }

            const recipientsData = await response.json(); // Analyse la réponse JSON

            if (recipientsData.error) {
                console.error("Erreur côté serveur :", recipientsData.error);
                alert("Impossible de récupérer les données des destinataires. Vérifiez le serveur.");
                return;
            }

            if (recipientsData.length === 0) {
                alert("Aucun destinataire trouvé dans la base de données pour l'envoi.");
                return;
            }

            // Boucle pour envoyer un message personnalisé à chaque numéro
            recipientsData.forEach((recipient) => {
                const phoneNumber = recipient.numero_telephone; // Assure-toi que le nom de la colonne correspond à ta DB
                const customMessage = recipient.contenu_message; // Assure-toi que le nom de la colonne correspond à ta DB

                // Encoder le message pour l'URL
                const encodedMessage = encodeURIComponent(customMessage);

                // Vérification basique du numéro (optionnel mais recommandé)
                if (phoneNumber && phoneNumber.length > 5) { // Une longueur minimale pour éviter les numéros vides ou très courts
                    const whatsappLink = `https://wa.me/${phoneNumber}?text=${encodedMessage}`;
                    window.open(whatsappLink, '_blank');
                } else {
                    console.warn(`Numéro de téléphone invalide trouvé : ${phoneNumber}. Message non envoyé.`);
                }
            });

            alert(`${recipientsData.length} messages WhatsApp ont été générés et ouverts dans de nouveaux onglets. Vérifiez vos fenêtres/onglets pop-up.`);

        } catch (error) {
            console.error("Erreur lors de l'envoi des messages WhatsApp :", error);
            alert("Une erreur est survenue lors de l'envoi des messages. Consultez la console pour plus de détails.");
        }
    }
</script>

<button onclick="sendWhatsApp()">Envoyer les messages personnalisés</button>