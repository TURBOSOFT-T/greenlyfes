<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facture</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .invoice-header, .invoice-footer {
            text-align: center;
            margin-bottom: 20px;
        }
        .invoice-header img {
            max-width: 150px;
            margin-bottom: 20px;
        }
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .invoice-details th, .invoice-details td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f4f4f4;
        }
        .total {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="invoice-header">
        <h1>Facture</h1>
        <p>Commande #{{ $commande->id }}</p>
    </div>

    <p><strong>Nom:</strong> {{ $commande->last_name }} {{ $commande->first_name }}</p>
    <p><strong>Téléphone:</strong> {{ $commande->phone }}</p>
    <p><strong>Date de Commande:</strong> {{ $commande->created_at }}</p>

    <table class="invoice-details">
        <thead>
            <tr>
                <th>Article</th>
                <th>Quantité</th>
                <th>Prix Unitaire</th>
                <th>Sous-total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($commande->products as $product)
                <tr>
                    <td>{{ $product->products->name }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->products->price, 2)  ?? '' }} €</td>
                    <td>{{ number_format($product->products->price * $product->quantity, 2) ?? ' ' }} €</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p class="total">Total: {{ number_format($commande->products->sum(fn($product) => $product->products->price * $product->quantity), 2) }} €</p>

    <div class="invoice-footer">
        <p>Merci pour votre achat !</p>
    </div>
</body>
</html>
