<header>
    <div class="logo">Neige & Soleil</div>
    <nav>
        <ul>
            <li><a href="index.php?page=accueil">Accueil</a></li>
            <li><a href="index.php?page=appartements">Appartements</a></li>
            <li><a href="index.php?page=materiel">Matériel</a></li>

            <?php if (isset($_SESSION['id_user'])): ?>
                <?php if ($_SESSION['role'] == 'proprietaire'): ?>
                    <li><a href="index.php?page=mes_apparts">Mes Appartements</a></li>
                    <li><a href="index.php?page=contrats">Mes Contrats</a></li>
                <?php else: ?>
                    <li><a href="index.php?page=panier">Mon Panier</a></li>
                <?php endif; ?>

                <li><a href="index.php?page=profil" class="btn-nav">Mon Profil</a></li>
                <li><a href="index.php?page=deconnexion" class="btn-connexion logout">Déconnexion</a></li>
            
            <?php else: ?>
                <li><a href="index.php?page=connexion" class="btn-connexion">Connexion</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>