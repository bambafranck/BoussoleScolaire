<?php
/**
 * Diagnostic COMPLET - formations.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h1> Diagnostic formations.php</h1>";
echo "<style>body{font-family:Arial;padding:20px;} .success{color:green;font-weight:bold;} .error{color:red;font-weight:bold;} pre{background:#1a1a2e;color:#00c878;padding:15px;border-radius:5px;overflow-x:auto;} table{border-collapse:collapse;width:100%;margin:20px 0;} th,td{border:1px solid #ddd;padding:12px;text-align:left;} th{background:#4f86f7;color:white;}</style>";

// Test 1: Connexion BDD
echo "<h2>1️ Test Connexion BDD</h2>";
try {
    $pdo = new PDO("mysql:host=localhost;dbname=boussolescolaire", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "<p class='success'> Connexion MySQL OK</p>";
} catch (PDOException $e) {
    echo "<p class='error'> Erreur : " . $e->getMessage() . "</p>";
    exit();
}

// Test 2: Requête formations.php EXACTE
echo "<h2>2️ Test Requête formations.php</h2>";
echo "<p>Requête utilisée dans formations.php :</p>";

$query = "
    SELECT 
        o.id_offre,
        o.titre_offre,
        o.type_formation,
        o.duree,
        o.cout,
        o.places_disponibles,
        f.nom_filiere,
        f.icone,
        e.nom_etablissement,
        e.localisation,
        e.type as type_etablissement
    FROM offre_formation o
    JOIN filiere f ON o.id_filiere = f.id_filiere
    JOIN etablissement e ON o.id_etablissement = e.id_etablissement
    WHERE o.actif = 1
    ORDER BY e.nom_etablissement ASC
";

echo "<pre>" . htmlspecialchars($query) . "</pre>";

try {
    $stmt = $pdo->query($query);
    $formations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "<p class='success'> Requête réussie ! Nombre de résultats : " . count($formations) . "</p>";
    
    if (count($formations) > 0) {
        echo "<h3>Premier résultat :</h3>";
        echo "<pre>" . print_r($formations[0], true) . "</pre>";
    } else {
        echo "<p class='error'> Aucune formation trouvée !</p>";
    }
    
} catch (PDOException $e) {
    echo "<p class='error'> Erreur SQL : " . $e->getMessage() . "</p>";
    
    // Test sans e.type
    echo "<h3>🔧 Test SANS e.type :</h3>";
    $query2 = "
        SELECT 
            o.id_offre,
            o.titre_offre,
            o.type_formation,
            o.duree,
            o.cout,
            o.places_disponibles,
            f.nom_filiere,
            f.icone,
            e.nom_etablissement,
            e.localisation
        FROM offre_formation o
        JOIN filiere f ON o.id_filiere = f.id_filiere
        JOIN etablissement e ON o.id_etablissement = e.id_etablissement
        WHERE o.actif = 1
        LIMIT 5
    ";
    
    try {
        $stmt2 = $pdo->query($query2);
        $formations2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        echo "<p class='success'> SANS e.type ça marche ! Résultats : " . count($formations2) . "</p>";
        
        if (count($formations2) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Titre</th><th>Filière</th><th>Établissement</th><th>Durée</th><th>Coût</th></tr>";
            foreach ($formations2 as $f) {
                echo "<tr>";
                echo "<td>" . $f['id_offre'] . "</td>";
                echo "<td>" . htmlspecialchars($f['titre_offre']) . "</td>";
                echo "<td>" . htmlspecialchars($f['nom_filiere']) . "</td>";
                echo "<td>" . htmlspecialchars($f['nom_etablissement']) . "</td>";
                echo "<td>" . htmlspecialchars($f['duree']) . "</td>";
                echo "<td>" . number_format($f['cout'], 0, ',', ' ') . " FCFA</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
    } catch (PDOException $e2) {
        echo "<p class='error'> Erreur même sans e.type : " . $e2->getMessage() . "</p>";
    }
}

// Test 3: Structure table etablissement
echo "<h2>3️ Colonnes de la table etablissement</h2>";
$stmt = $pdo->query("DESCRIBE etablissement");
$cols = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo "<table>";
echo "<tr><th>Nom Colonne</th><th>Type</th></tr>";
foreach ($cols as $col) {
    $highlight = (stripos($col['Field'], 'type') !== false) ? "style='background:yellow;font-weight:bold;'" : "";
    echo "<tr $highlight><td>" . $col['Field'] . "</td><td>" . $col['Type'] . "</td></tr>";
}
echo "</table>";

// Test 4: Vérifier le fichier formations.php
echo "<h2>4️ Test fichier formations.php</h2>";
$formations_path = __DIR__ . '/formations.php';

if (file_exists($formations_path)) {
    echo "<p class='success'> Le fichier formations.php existe</p>";
    echo "<p>Chemin : $formations_path</p>";
    
    // Lire les 50 premières lignes
    $content = file_get_contents($formations_path);
    $lines = explode("\n", $content);
    $preview = implode("\n", array_slice($lines, 0, 50));
    
    echo "<h3>Aperçu du fichier (50 premières lignes) :</h3>";
    echo "<pre style='max-height:300px;overflow-y:auto;'>" . htmlspecialchars($preview) . "</pre>";
    
    // Chercher e.type dans le fichier
    if (strpos($content, 'e.type') !== false) {
        echo "<p class='error'> PROBLÈME TROUVÉ : Le fichier contient 'e.type' qui cause l'erreur !</p>";
        echo "<p><strong>Solution :</strong> Remplacer formations.php par la version corrigée sans e.type</p>";
    } else {
        echo "<p class='success'> Le fichier ne contient pas e.type</p>";
    }
    
} else {
    echo "<p class='error'> Le fichier formations.php n'existe PAS à : $formations_path</p>";
}

// Test 5: Accès direct
echo "<h2>5️ Liens de test</h2>";
echo "<p><a href='formations.php' target='_blank' style='padding:10px 20px;background:#4f86f7;color:white;text-decoration:none;border-radius:5px;display:inline-block;margin:5px;'>Ouvrir formations.php</a></p>";
echo "<p><a href='detail_formation.php?id=1' target='_blank' style='padding:10px 20px;background:#ff8c3a;color:white;text-decoration:none;border-radius:5px;display:inline-block;margin:5px;'>Ouvrir detail_formation.php?id=1</a></p>";

echo "<hr>";
echo "<h2> RÉSUMÉ DU PROBLÈME</h2>";
echo "<ol>";
echo "<li>Si vous voyez une erreur SQL avec 'e.type' → La colonne n'existe pas dans votre BDD</li>";
echo "<li>Si la requête SANS e.type fonctionne → Utilisez la version corrigée de formations.php</li>";
echo "<li>Si formations.php existe mais contient 'e.type' → Remplacez-le par la version corrigée</li>";
echo "</ol>";

?>