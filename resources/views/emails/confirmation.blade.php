<!DOCTYPE html>
<html>
<head>
    <title>Confirmation de votre inscription</title>
</head>
<body>
    <h1>Bonjour {{ $consultation->prenom }} {{ $consultation->nom }},</h1>
    <p>Merci de vous être inscrit. Voici les détails de votre inscription :</p>
    <ul>
        <li>Email: {{ $consultation->email }}</li>
        <li>Téléphone: {{ $consultation->telephone }}</li>
        <li>Message: {{ $consultation->message }}</li>
        <li>Filières: {{ implode(', ', $consultation->filieres()->pluck('title')->toArray()) }}</li>
    </ul>
    <p>Nous vous contacterons bientôt.</p>
</body>
</html>
