<?php
    $appartements = $unControleur->afficherCatalogue();
?>

<link rel="stylesheet" href="Style/style_appartement.css">

<div class="container">
    <h1 style="text-align: center; margin: 20px 0;">Nos Locations</h1>

    <div class="apparts-grid">
        
        <?php foreach ($appartements as $unAppart) : ?>
            
            <article class="appart-card">
                
                <div class="appart-image">
                    <span class="price"><?php echo $unAppart['type_appart']; ?></span>
                    
                    <img src="images/chalets/<?php echo $unAppart['image']; ?>" 
                         alt="Appartement" 
                         onerror="this.src='images/background-montagne.jpg';">
                </div>

                <div class="appart-details">
                    <h3><?php echo $unAppart['type_appart']; ?> - <?php echo $unAppart['num_appart']; ?></h3>
                    <p class="location">📍 Station Neige & Soleil</p>
                    
                    <div class="specs">
                        <span><i class="fas fa-expand"></i> <?php echo $unAppart['surface']; ?> m²</span>
                        <span><i class="fas fa-users"></i> <?php echo $unAppart['capacite_accueil']; ?> pers.</span>
                    </div>
                    
                    <a href="index.php?page=vue_detail&id=<?php echo $unAppart['id_appart']; ?>" class="btn-view">
                        Voir les détails
                    </a>
                </div>
                
            </article>

        <?php endforeach; ?>

    </div> </div>