<?php
/**
 * BoussoleScolaire - Toggle Save Formation
 * Fichier: ajax/toggle_save_formation.php
 * Ajouter/Retirer une formation des favoris
 */

session_start();
require_once '../config/database.php';

header('Content-Type: application/json');

if (!isLoggedIn()) {
    echo json_encode(['success' => false, 'message' => 'Non connecté']);
    exit();
}

$user_id = $_SESSION['user_id'];

// Récupérer les données JSON
$input = json_decode(file_get_contents('php://input'), true);
$id_filiere = isset($input['id_filiere']) ? (int)$input['id_filiere'] : 0;
$action = isset($input['action']) ? $input['action'] : '';

if (!$id_filiere || !in_array($action, ['add', 'remove'])) {
    echo json_encode(['success' => false, 'message' => 'Données invalides']);
    exit();
}

try {
    if ($action === 'add') {
        // Vérifier si déjà sauvegardé
        $stmt = $pdo->prepare("SELECT * FROM formation_sauvegardee WHERE id_utilisateur = ? AND id_filiere = ?");
        $stmt->execute([$user_id, $id_filiere]);
        
        if ($stmt->fetch()) {
            echo json_encode(['success' => false, 'message' => 'Déjà sauvegardé']);
            exit();
        }
        
        // Ajouter
        $stmt = $pdo->prepare("INSERT INTO formation_sauvegardee (id_utilisateur, id_filiere, date_sauvegarde) VALUES (?, ?, NOW())");
        $stmt->execute([$user_id, $id_filiere]);
        
        echo json_encode(['success' => true, 'message' => 'Formation sauvegardée']);
        
    } else { // remove
        $stmt = $pdo->prepare("DELETE FROM formation_sauvegardee WHERE id_utilisateur = ? AND id_filiere = ?");
        $stmt->execute([$user_id, $id_filiere]);
        
        echo json_encode(['success' => true, 'message' => 'Formation retirée']);
    }
    
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Erreur BDD : ' . $e->getMessage()]);
}
?>