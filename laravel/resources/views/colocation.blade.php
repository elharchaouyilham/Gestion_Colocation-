<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails Colocation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="navbar">
    <h1>Coloc Paris Centre</h1>
    <button>Inviter un membre</button>
</div>

<div class="container">

    <!-- Membres -->
    <div class="card">
        <h2>Membres</h2>
        <table>
            <tr>
                <th>Nom</th>
                <th>Rôle</th>
                <th>Réputation</th>
            </tr>
            <tr>
                <td>Ahmed</td>
                <td><span class="badge badge-owner">Owner</span></td>
                <td>+3</td>
            </tr>
            <tr>
                <td>Sara</td>
                <td><span class="badge badge-member">Member</span></td>
                <td>+1</td>
            </tr>
        </table>
    </div>

    <!-- Dépenses -->
    <div class="card">
        <h2>Dépenses</h2>
        <table>
            <tr>
                <th>Titre</th>
                <th>Montant</th>
                <th>Payeur</th>
                <th>Date</th>
            </tr>
            <tr>
                <td>Courses</td>
                <td>120€</td>
                <td>Ahmed</td>
                <td>01/02/2026</td>
            </tr>
            <tr>
                <td>Internet</td>
                <td>40€</td>
                <td>Sara</td>
                <td>05/02/2026</td>
            </tr>
        </table>
    </div>

    <!-- Soldes -->
    <div class="card">
        <h2>Soldes</h2>
        <p>Sara doit 20€ à Ahmed</p>
        <a href="#" class="btn">Marquer payé</a>
    </div>

</div>

</body>
</html>