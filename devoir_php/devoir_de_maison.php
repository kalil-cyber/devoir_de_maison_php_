<?php
// 1. Calcul du salaire moyen
$employes = [
    ['nom' => 'Ahmed', 'poste' => 'Développeur', 'salaire' => 12000],
    ['nom' => 'Fatima', 'poste' => 'Designer', 'salaire' => 10000],
    ['nom' => 'Mounir', 'poste' => 'Chef de projet', 'salaire' => 15000],
    ['nom' => 'Sara', 'poste' => 'Analyste', 'salaire' => 8000],
    ['nom' => 'Omar', 'poste' => 'Responsable RH', 'salaire' => 9000],
];

function calculerSalaireMoyen($employes) {
    $total = array_sum(array_column($employes, 'salaire'));
    return $total / count($employes);
}

// 2. Recherche dynamique
$employeTrouve = null;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['nom_employe']) && !empty($_POST['nom_employe'])) {
    $nomRecherche = trim($_POST['nom_employe']);
    foreach ($employes as $employe) {
        if (strcasecmp($employe['nom'], $nomRecherche) == 0) {
            $employeTrouve = $employe;
            break;
        }
    }
}

// 3. Formulaire de connexion
$utilisateurs = [
    ['email' => 'ahmed@example.com', 'password' => '1234'],
    ['email' => 'fatima@example.com', 'password' => '5678']
];

$connexion = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email'], $_POST['password'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    foreach ($utilisateurs as $utilisateur) {
        if ($utilisateur['email'] === $email && $utilisateur['password'] === $password) {
            $connexion = true;
            break;
        }
    }
}

// 4. Système de panier
$panier = [
    ['nom' => 'Huile d’argan', 'quantite' => 2, 'prix' => 250],
    ['nom' => 'Safran', 'quantite' => 1, 'prix' => 300],
    ['nom' => 'Tapis berbère', 'quantite' => 1, 'prix' => 2000]
];

$totalPanier = array_reduce($panier, function ($total, $article) {
    return $total + ($article['quantite'] * $article['prix']);
}, 0);

// 5. Commentaires
$commentaires = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['commentaire']) && !empty($_POST['commentaire'])) {
    $commentaire = [
        'texte' => $_POST['commentaire'],
        'date' => date('Y-m-d H:i:s')
    ];
    $commentaires[] = $commentaire;
}

// 6. Ville la plus chaude
$villes = [
    'Casablanca' => 24,
    'Rabat' => 22,
    'Marrakech' => 30,
    'Fès' => 28,
    'Tanger' => 21
];

$villePlusChaud = array_search(max($villes), $villes);

// 7. Lecture de fichier CSV
$csvData = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv']) && $_FILES['csv']['error'] == 0) {
    $file = fopen($_FILES['csv']['tmp_name'], 'r');
    while (($data = fgetcsv($file)) !== false) {
        $csvData[] = $data;
    }
    fclose($file);
}

// 8. Sélection de produits
$produits = [
    ['nom' => 'Produit A', 'prix' => 100],
    ['nom' => 'Produit B', 'prix' => 200],
    ['nom' => 'Produit C', 'prix' => 300]
];

$totalProduitSelectionne = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['produits'])) {
    foreach ($_POST['produits'] as $nomProduit) {
        foreach ($produits as $produit) {
            if ($produit['nom'] === $nomProduit) {
                $totalProduitSelectionne += $produit['prix'];
            }
        }
    }
}

// 9. Moyenne des étudiants
$etudiants = [
    'Ali' => ['maths' => 15, 'physique' => 12],
    'Salma' => ['maths' => 18, 'physique' => 16],
    'Yassine' => ['maths' => 14, 'physique' => 13]
];

$etudiantMoyenne = [];
foreach ($etudiants as $nom => $notes) {
    $etudiantMoyenne[$nom] = array_sum($notes) / count($notes);
}

// 10. Gestion des utilisateurs
$utilisateurs = [
    ['id' => 1, 'nom' => 'Ahmed', 'email' => 'ahmed@example.com'],
    ['id' => 2, 'nom' => 'Fatima', 'email' => 'fatima@example.com']
];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'ajouter') {
        $utilisateurs[] = ['id' => count($utilisateurs) + 1, 'nom' => $_POST['nom'], 'email' => $_POST['email']];
    } elseif ($action === 'modifier') {
        foreach ($utilisateurs as &$utilisateur) {
            if ($utilisateur['id'] == $_POST['id']) {
                $utilisateur['nom'] = $_POST['nom'];
                $utilisateur['email'] = $_POST['email'];
                break;
            }
        }
    } elseif ($action === 'supprimer') {
        $utilisateurs = array_filter($utilisateurs, function ($u) {
            return $u['id'] != $_POST['id'];
        });
    }
}

?>
