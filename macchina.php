<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dettagli Auto - JTL LuxeRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="section" style="max-width: 900px; margin: 0 auto;">
    <h2>Dettagli Veicolo</h2>
    <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; align-items: flex-start;">
      <!-- Immagine auto -->
      <div style="flex: 1; min-width: 300px;">
        <img src="<?php echo "img/".$_SESSION["macchina"].".png";?>" alt="Nome Auto" style="width: 100%; border-radius: 12px; box-shadow: 0 0 15px rgba(255, 215, 0, 0.2);">
      </div>

      <!-- Info auto -->

      <div style="flex: 1; min-width: 300px;">
        <h3 style="color: #ffd700;">Nome Auto</h3>
        <p><strong>Marca:</strong> <?php echo $_SESSION["macchina"]; ?></p>
        <p><strong>Modello:</strong> Roma</p>
        <p><strong>Anno:</strong> 2023</p>
        <p><strong>Prezzo leasing:</strong> €2.300/mese</p>
        <p><strong>Caratteristiche:</strong> Cambio automatico, interni in pelle, GPS integrato, accelerazione 0-100 in 3,4s.</p>
        <a href="prenota.php?id=1" class="btn" style="margin-top: 1rem;">Prenota Ora</a>
      </div>
    </div>
  </section>
</body>
</html>
