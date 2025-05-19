<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prenota Veicolo - JTL LuxeRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="indux">
      <a href="pag1.html"><img src="img/logo.png"></a>
    </div>
  <section class="section" style="max-width: 600px; margin: 0 auto;">
    <h2>Prenotazione Veicolo</h2>

    <form method="post" style="display: flex; flex-direction: column; gap: 1rem;">
      <input type="hidden" name="veicolo_id" value="<?= htmlspecialchars($_GET['id'] ?? '') ?>">

      <input type="text" name="utente_nome" placeholder="Il tuo nome" required
             style="width: 100%; padding: 1rem; border-radius: 8px; border: none;">

      <label>Data Inizio:</label>
      <input type="date" name="data_inizio" required
             style="padding: 1rem; border-radius: 8px; border: none;">

      <label>Data Fine:</label>
      <input type="date" name="data_fine" required
             style="padding: 1rem; border-radius: 8px; border: none;">

      <textarea name="note" placeholder="Note aggiuntive (opzionale)" rows="4"
                style="padding: 1rem; border-radius: 8px; border: none;"></textarea>

      <input type="submit" name="invio" value="Conferma Prenotazione" class="btn">
    </form>

    <?php
    if (isset($_GET['id'])) {
      $conn = mysqli_connect("localhost", "root", "", "5AIT_Super");
      $veicolo_id = $_GET['id'];

      $result = mysqli_query($conn, "SELECT data_inizio, data_fine FROM prenotazioni WHERE veicolo_id = '$veicolo_id' ORDER BY data_inizio");

      if (mysqli_num_rows($result) > 0) {
        echo "<div style='margin-top: 3rem; text-align:center;'>";
        echo "<h3 style='color:#ffd700;'>Date Occupate</h3>";
        echo "<ul style='list-style:none; padding:0;'>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<li style='margin-bottom: 0.5rem;'>" .
            date("d/m/Y", strtotime($row['data_inizio'])) . " → " .
            date("d/m/Y", strtotime($row['data_fine'])) .
            "</li>";
        }
        echo "</ul></div>";
      }

      mysqli_close($conn);
    }
    ?>
  </section>
</body>

<?php
if (isset($_POST['invio'])) {
  session_start();

  // Connessione al DB
  $conn = mysqli_connect("localhost", "root", "", "jtl_luxerent");
  if (!$conn) {
    die("Errore di connessione: " . mysqli_connect_error());
  }

  // Variabili da sessione e form
  $veicolo_id = $_SESSION["idcar"];
  $utente_id  = $_SESSION["utente"];
  $inizio     = $_POST['data_inizio'];
  $fine       = $_POST['data_fine'];

  // Verifica disponibilità (date sovrapposte)
  $check = "SELECT * FROM prenotazioni 
            WHERE automobile_id = '$veicolo_id'
            AND (data_inizio <= '$fine' AND data_fine >= '$inizio')";
  $check_result = mysqli_query($conn, $check);

  if (mysqli_num_rows($check_result) > 0) {
    echo "<p style='text-align:center; color:#f00;'>Il veicolo è già prenotato nelle date selezionate. Scegli un altro periodo.</p>";
  } else {
    // Calcolo opzionale del prezzo (es: 100€/giorno)
    $giorni = (strtotime($fine) - strtotime($inizio)) / (60 * 60 * 24);
    $prezzo_giornaliero = 100; 

    // Inserimento prenotazione
    $sql = "INSERT INTO prenotazioni (utente_id, automobile_id, data_inizio, data_fine)
            VALUES ('$utente_id', '$veicolo_id', '$inizio', '$fine')";
    
    if (mysqli_query($conn, $sql)) {
      echo "<p style='text-align:center; color:#0f0;'>Prenotazione confermata!</p>";
    } else {
      echo "<p style='text-align:center; color:#f00;'>Errore: " . mysqli_error($conn) . "</p>";
    }
  }

  mysqli_close($conn);
}
?>

</html>
