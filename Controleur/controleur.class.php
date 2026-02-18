<?php
require_once "Modele/Modele.php";

class Controleur {
    private $unModele;

    public function __construct() {
        $this->unModele = new Modele();
    }

    /* --- GESTION DES APPARTEMENTS --- */
    
    public function getAppartementsFiltres($station, $capacite) {
        return $this->unModele->getAppartementsFiltres($station, $capacite);
    }

    public function getAppartement($id) {
        return $this->unModele->getAppartementById($id);
    }

    public function getMesAppartements() {
        $id_proprio = isset($_SESSION['id_user']) ? $_SESSION['id_user'] : null;
        return $this->unModele->getAppartementsByProprio($id_proprio);
    }
    // À ajouter dans ton Controleur
    public function afficherCatalogue() {
        return $this->unModele->getTousLesAppartements();
    }

    /* --- UTILISATEURS / CONNEXION --- */

    public function inscrireUser($nom, $prenom, $email, $tel, $mdp, $role) {
        if ($role == 'client') {
            $this->unModele->inscrireClient($nom, $prenom, $email, $tel);
        } else {
            $this->unModele->inscrireProprietaire($nom, $prenom, $email, $tel);
        }
        $this->unModele->updatePassword($email, $mdp);
    }

    public function login($email, $mdp) {
        return $this->unModele->login($email, $mdp);
    }

    public function getUserDetails($id_user) {
        // Utilisé par ta page profil
        return $this->unModele->getUserDetails($id_user);
    }

    /* --- AUTRES --- */
    public function getMateriels() {
        return $this->unModele->getMateriels();
    }
}
?>