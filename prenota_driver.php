<?php session_start(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Prenota Driver - JTL LuxeRent</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="indux">
        <a href="pag1.html"><img src="img/logo.png"></a>
    </div>
  <section class="section" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-top:-5%; margin-bottom:-1%;">Prenotazione Driver Personale</h3>

<p style="color: #ffd700; background-color: #1c1c1c; padding: 1rem; border-radius: 8px; margin-bottom: 2rem;">
  <strong>Attenzione:</strong> inserire <u>la stesse data</u> in cui hai prenotato l'auto, per garantire la disponibilità del driver nello stesso periodo.
</p>

<form method="post" class="form-container">


    <form method="post" class="form-container">
      <label>Seleziona un Driver:</label>
      <select name="driver_id" class="form-input" required>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "my_jtl_luxerent");
        $query = "SELECT * FROM driver WHERE disponibile = 1";
        $res = mysqli_query($conn, $query);

        if (mysqli_num_rows($res) === 0) {
        echo "<option disabled>Nessun driver disponibile</option>";
      } else {
      while ($row = mysqli_fetch_assoc($res)) {
        $nome = htmlspecialchars($row['nome']);
        $costo = number_format($row['costo_giornaliero'], 2, ',', '.');
        echo "<option value='{$row['id']}'>$nome - €$costo/giorno</option>";
      }
}

        ?>
      </select>

      <label>Data Inizio:</label>
      <input type="date" name="data_inizio" required class="form-input">

      <label>Data Fine:</label>
      <input type="date" name="data_fine" required class="form-input">

      <textarea name="note" placeholder="Note aggiuntive (es. destinazione, orari)" rows="4" class="form-input"></textarea>

      <input type="submit" name="invio" value="Conferma Prenotazione" class="btn">
    </form>

    <!-- Script per gestire le date -->
  <script>
    const inizioInput = document.querySelector('input[name="data_inizio"]');
    const fineInput = document.querySelector('input[name="data_fine"]');

    const today = new Date().toISOString().split("T")[0];
    inizioInput.setAttribute("min", today);
    fineInput.setAttribute("min", today);

    inizioInput.addEventListener("change", function () {
      fineInput.value = "";
      fineInput.setAttribute("min", this.value);
    });
  </script>

    <?php
    // Mostra prenotazioni esistenti dell'utente
    if (isset($_SESSION['utente'])) {
      $result = mysqli_query($conn, "
        SELECT data_inizio, data_fine FROM prenotazioni_driver 
        WHERE utente_id = '" . $_SESSION['utente'] . "'
        ORDER BY data_inizio
      ");
      if (mysqli_num_rows($result) > 0) {
        echo "<div style='margin-top: 3rem; text-align:center;'>";
        echo "<h3 style='color:#ffd700;'>Le tue prenotazioni attive</h3><ul style='list-style:none; padding:0;'>";
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<li>" . date("d/m/Y", strtotime($row['data_inizio'])) . " → " . date("d/m/Y", strtotime($row['data_fine'])) . "</li>";
        }
        echo "</ul></div>";
      }
    }
    mysqli_close($conn);
    ?>
  </section>
</body>

<?php
if (isset($_POST['invio'])) {
  $conn = mysqli_connect("localhost", "root", "", "jtl_luxerent");
  if (!$conn) {
    die("Errore connessione DB: " . mysqli_connect_error());
  }

  $utente_id  = $_SESSION["utente"];
  $driver_id  = $_POST['driver_id'];
  $inizio     = $_POST['data_inizio'];
  $fine       = $_POST['data_fine'];
  $note       = mysqli_real_escape_string($conn, $_POST['note']);

  // Verifica se quel driver è disponibile in quelle date
  $check = "SELECT * FROM prenotazioni_driver 
            WHERE driver_id = '$driver_id'
            AND (data_inizio <= '$fine' AND data_fine >= '$inizio')";
  $res_check = mysqli_query($conn, $check);

  if (mysqli_num_rows($res_check) > 0) {
    echo "<p style='text-align:center; color:#f00;'>Il driver selezionato è già occupato in quelle date. Scegli un altro driver o periodo.</p>";
  } else {
    $sql = "INSERT INTO prenotazioni_driver (utente_id, driver_id, data_inizio, data_fine, note)
            VALUES ('$utente_id', '$driver_id', '$inizio', '$fine', '$note')";
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
