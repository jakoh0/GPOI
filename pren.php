<?php
session_start();

// Se non loggato, reindirizza
if (!isset($_SESSION["utente"])) {
  header("Location: login.php");
  exit;
}

// Connessione DB
$conn = mysqli_connect("localhost", "root", "", "jtl_luxerent");
if (!$conn) {
  die("Errore connessione: " . mysqli_connect_error());
}

$utente_id = $_SESSION["utente"];

// Recupero prenotazioni utente con marca e modello dell'auto
$sql = "SELECT p.*, a.marca
        FROM prenotazioni AS p
        JOIN automobili AS a ON p.automobile_id = a.id
        WHERE p.utente_id = '$utente_id'
        ORDER BY p.data_inizio DESC";

$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Le mie prenotazioni - JTL LuxeRent</title>
  <link rel="stylesheet" href="style.css">
  <style>
    .table-container {
      max-width: 900px;
      margin: 3rem auto;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #1c1c1c;
      color: #fff;
      border: 1px solid #444;
    }
    th, td {
      padding: 1rem;
      border-bottom: 1px solid #333;
      text-align: center;
    }
    th {
      background-color: #111;
      color: #ffd700;
    }
    tr:hover {
      background-color: #2a2a2a;
    }
  </style>
</head>
<body>

<div class="logout-btn" style="position: absolute; top: 20px; left: 20px;">
  <a href="pag1.html" class="btn">Torna indietro</a>
</div>

<section class="section table-container">
  <h2>Le tue prenotazioni</h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <table>
      <thead>
        <tr>
          <th>Auto</th>
          <th>Data Inizio</th>
          <th>Data Fine</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?= $row['marca'] ?></td>
            <td><?= date("d/m/Y", strtotime($row['data_inizio'])) ?></td>
            <td><?= date("d/m/Y", strtotime($row['data_fine'])) ?></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p style="text-align: center;">Non hai ancora effettuato prenotazioni.</p>
  <?php endif; ?>

</section>

<footer>
  &copy; 2025 JTL LuxeRent. Tutti i diritti riservati.
</footer>
</body>
</html>
<?php
mysqli_close($conn);
?>
