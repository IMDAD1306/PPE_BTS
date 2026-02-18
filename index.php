<?php
    session_start();
    
    // 1. CHARGEMENT DU CONTROLEUR
    // Vérifie bien que le nom du fichier est "controleur.class.php" dans ton dossier
    require_once("Controleur/controleur.class.php"); 
    $unControleur = new Controleur(); 

    // 2. GESTION DE LA VARIABLE PAGE
    $page = (isset($_GET['page'])) ? $_GET['page'] : 'accueil';

    // 3. LOGIQUE DE DÉCONNEXION
    if ($page == 'deconnexion') {
        session_destroy(); 
        header("Location: index.php?page=connexion"); 
        exit();
    }

    // 4. SÉCURITÉ PROFIL
    if ($page == 'profil' && !isset($_SESSION['email'])) {
        header("Location: index.php?page=connexion");
        exit();
    }

    // --- TRAITEMENT DE LA CONNEXION ---
    if (isset($_POST['btnConnexion'])) {
        // On utilise $unControleur ici aussi !
        $user = $unControleur->login($_POST['email'], $_POST['mdp']);
        
        if ($user) {
            $_SESSION['id_user'] = $user['id_perso']; 
            $_SESSION['role']    = $user['role']; 
            $_SESSION['email']   = $user['email'];
            $_SESSION['nom']     = $user['nom'];
            $_SESSION['prenom']  = $user['prenom'];

            header("Location: index.php?page=accueil");
            exit();
        }
    }

    // --- TRAITEMENT DE L'INSCRIPTION ---
    if (isset($_POST['btnInscription'])) {
        // L'erreur disparaît car $unControleur est bien défini en haut
        $unControleur->inscrireUser(
            $_POST['nom'], 
            $_POST['prenom'], 
            $_POST['email'], 
            $_POST['tel'], 
            $_POST['mdp'],
            $_POST['role']
        );
        header("Location: index.php?page=connexion");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Neige & Soleil</title>
    <link rel="stylesheet" href="Style/style_index.css">
    <link rel="stylesheet" href="Style/style_connexion.css"> 
</head>
<body>

    <?php 
    if ($page != 'connexion' && $page != 'inscription') {
        require_once("Vue/vue_header.php"); 
        ?>
        <section class="hero-container">
            <a href="index.php?page=accueil" class="hero-link">
                <img src="images/background-montagne.jpg" alt="Montagnes enneigées">
            </a>
        </section>
        <?php 
    } 
    ?>

    <main>
        <?php if (isset($_SESSION['success'])): ?>
            <div class="container" style="margin-top:20px;">
                <p class="msg-success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></p>
            </div>
        <?php endif; ?>

        <?php if ($page == 'accueil'): ?>
            <section class="intro">
                <h1>Nos Locations de Vacances</h1>
            </section>

            <div class="container chalet-list">
                <article class="card">
                    <img src="images/chalets/chalet_marmoton.jpg" alt="Chalet Neige">
                    <div class="card-body">
                        <h3>Chalet "Le Marmoton"</h3>
                        <p style="color:#888;">📍 Molines-en-Queyras</p>
                        <a href="index.php?page=detail&id=1" class="btn-blue">Voir les détails</a>
                    </div>
                </article>
            </div>

        <?php else: ?>
            <?php 
            // TOUS LES APPELS PASSENT MAINTENANT PAR LE CONTROLEUR
            if ($page == 'detail' && isset($_GET['id'])) {
                $unAppart = $unControleur->getAppartement($_GET['id']);
            }

            if ($page == 'materiel') {
                $lesMateriels = $unControleur->getMateriels();
            }

            if ($page == 'profil') {
                $infosUser = $unControleur->getUserDetails($_SESSION['email']);
            }

            if ($page == 'appartements') {
                $lesApparts = $unControleur->getAppartementsFiltres("", ""); 
            }

            $file = "Vue/vue_" . $page . ".php";
            if(file_exists($file)) {
                include($file); 
            } else {
                echo "<center><h2 style='margin-top:50px;'>Page non disponible.</h2></center>";
            }
            ?>
        <?php endif; ?>
    </main>
</body>
</html>