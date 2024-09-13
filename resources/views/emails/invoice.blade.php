<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Votre Facture</title>
</head>
<body>
    <h1>Bonjour {{ $commande->first_name }} {{ $commande->last_name }},</h1>
    <p>Merci pour votre commande. Veuillez trouver ci-joint votre facture.</p>
    <p>Si vous avez des questions, n'hésitez pas à nous contacter.</p>
    <p>Cordialement,<br>Votre équipe {{ config('app.name') }}</p>
</body>
</html>
