<link rel="stylesheet" href="Style/style_details.cs

<div class="container-detail">
    <a href="index.php?page=appartements" class="btn-back">
        <i class="fas fa-arrow-left"></i> Retour aux appartements
    </a>

    <div class="detail-grid">
        <div class="detail-gallery">
            <div class="main-photo">
                <img src="images/chalets/<?= $unAppart['id_appart'] ?>.jpg" alt="Façade">
            </div>
            <div class="secondary-photos">
                <div class="photo-item">
                    <img src="images/chalets/details/<?= $unAppart['id_appart'] ?>/1.jpg" 
                         onerror="this.style.display='none'">
                </div>
                <div class="photo-item">
                    <img src="images/chalets/details/<?= $unAppart['id_appart'] ?>/2.jpg" 
                         onerror="this.style.display='none'">
                </div>
            </div>
        </div>

        <div class="detail-side-bar">
            <h1><?= $unAppart['type_appart'] ?> - <?= $unAppart['num_appart'] ?></h1>
            <p class="location"><i class="fas fa-map-marker-alt"></i> Secteur Queyras, Alpes</p>
            
            <div class="price-tag">
                <span class="amount">À partir de 450€</span> / semaine
            </div>

            <hr>

            <form action="index.php?page=panier" method="POST" class="form-resa">
    <input type="hidden" name="id_appart" value="<?= $unAppart['id_appart'] ?>">
    
    <div class="input-group">
        <label>Date d'arrivée</label>
        <input type="date" name="date_debut" required>
    </div>
    
    <div class="input-group">
        <label>Date de départ</label>
        <input type="date" name="date_fin" required>
    </div>

    <?php if(isset($_SESSION['id_user'])): ?>
        <button type="submit" name="btnReserver" class="btn-reserve">
            <i class="fas fa-shopping-cart"></i> Ajouter au panier
        </button>
    <?php else: ?>
        <a href="index.php?page=connexion" class="btn-warn">
            Connectez-vous pour réserver
        </a>
    <?php endif; ?>
</form>
        </div>
    </div>

    <div class="detail-description">
        <h2>Description du logement</h2>
        <div class="specs-icons">
            <span><i class="fas fa-expand"></i> <?= $unAppart['surface'] ?> m²</span>
            <span><i class="fas fa-users"></i> <?= $unAppart['capacite_accueil'] ?> personnes</span>
            <span><i class="fas fa-bed"></i> 2 Chambres</span>
        </div>
        
        <div class="rooms-list">
            <div class="room-item">
                <i class="fas fa-utensils"></i>
                <strong>Cuisine :</strong> Équipée (Four, Micro-onde, Lave-vaisselle)
            </div>
            <div class="room-item">
                <i class="fas fa-couch"></i>
                <strong>Salon :</strong> Grand séjour avec TV et accès Terrasse
            </div>
            <div class="room-item">
                <i class="fas fa-sun"></i>
                <strong>Extérieur :</strong> Terrasse de 10m² vue montagne
            </div>
            <div class="room-item">
                <i class="fas fa-shower"></i>
                <strong>Salle de bain :</strong> Douche à l'italienne et WC séparés
            </div>
        </div>
    </div>
</div>