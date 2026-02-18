<?php
class Modele {
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=localhost;dbname=neige_soleil;charset=utf8", "root", "");
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    /* --- APPARTEMENTS --- */
    public function getAppartementsFiltres($station, $capacite) {
        $sql = "SELECT * FROM APPARTEMENT WHERE 1=1";
        $params = [];
        if ($capacite !== "") {
            if ($capacite == 8) {
                $sql .= " AND capacite_accueil >= 8";
            } else {
                $sql .= " AND capacite_accueil = ?";
                $params[] = $capacite;
            }
        }
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppartementById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM APPARTEMENT WHERE id_appart = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTousLesAppartements() {
        $stmt = $this->pdo->prepare("SELECT * FROM APPARTEMENT");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAppartementsByProprio($id_proprio) {
        $stmt = $this->pdo->prepare("SELECT * FROM APPARTEMENT WHERE id_proprio = ?");
        $stmt->execute([$id_proprio]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* --- UTILISATEURS / CONNEXION --- */
    public function inscrireClient($nom, $prenom, $email, $tel) {
        $sql = "INSERT INTO CLIENT (nom, prenom, email, tel) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $tel]);
    }

    public function inscrireProprietaire($nom, $prenom, $email, $tel) {
        $sql = "INSERT INTO PROPRIETAIRE (nom, prenom, email, tel) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $tel]);
    }

    public function updatePassword($email, $mdp) {
        $sql = "UPDATE User SET mdp = ? WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$mdp, $email]);
    }

    public function login($email, $mdp) {
        $stmt = $this->pdo->prepare("SELECT * FROM User WHERE email = ? AND mdp = ?");
        $stmt->execute([$email, $mdp]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserDetails($email) {
        $stmt = $this->pdo->prepare("SELECT * FROM User WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* --- MATÉRIEL --- */
    public function getMateriels() {
        $stmt = $this->pdo->prepare("SELECT * FROM MATERIEL");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>