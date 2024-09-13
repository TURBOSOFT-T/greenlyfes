<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre consultation</title>
</head>
<body>
    <h1>Bonjour {{ $consultation->prenom }},</h1>
    <p>Merci d'avoir réservé une consultation. Voici les détails :</p>

    <ul>
        <li><strong>Nom :</strong> {{ $consultation->nom }}</li>
        <li><strong>Prénom :</strong> {{ $consultation->prenom }}</li>
        <li><strong>Email :</strong> {{ $consultation->email }}</li>
        <li><strong>Âge :</strong> {{ $consultation->age }}</li>
        <li><strong>Taille :</strong> {{ $consultation->taille }} cm</li>
        <li><strong>Poids :</strong> {{ $consultation->poids }} kg</li>
        <li><strong>Message :</strong> {{ $consultation->message }}</li>
    </ul>

    <p>Nous vous contacterons bientôt pour confirmer les détails de votre rendez-vous.</p>

    <p>Cordialement,<br>L'équipe de l'hôpital</p>
</body>
</html>
