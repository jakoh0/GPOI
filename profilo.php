<?php
session_start();

if (!isset($_SESSION['utente'])) {
  header("Location: login.php");
  exit;
}

$conn = mysqli_connect("localhost", "root", "", "jtl_luxerent");

$utente_id = $_SESSION["utente"];
$sql = "SELECT * FROM utenti WHERE id = '$utente_id'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
  die("<p style='text-align:center; color:red;'>Utente non trovato.</p>");
}

$utente = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profilo Utente - JTL LuxeRent</title>
  <link rel="stylesheet" href="style.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
      display: flex;
      flex-direction: column;
    }

    .content {
      flex: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
    }

    .logout-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 10;
    }

    footer {
      background-color: #111;
      text-align: center;
      color: #999;
      padding: 1rem;
      position: fixed;
      bottom: 0;
      width: 100%;
    }

    .card {
      background: #1c1c1c;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(255, 215, 0, 0.2);
      text-align: left;
      color: #fff;
      border: 1px solid #ffd70033;
    }

    .card p {
      margin: 0.8rem 0;
      font-size: 1.1rem;
    }

    .section h2 {
      color: #fff;
      margin-bottom: 2rem;
    }
  </style>
</head>
<body>

  <div class="logout-btn">
    <a href="pag1.html" class="btn">Torna indietro</a>
  </div>

  <div class="content">
    <section class="section" style="width: 100%; max-width: 600px; text-align: center;">
      <h2>Il tuo profilo</h2>
      <div >
        <p><strong>Nome utente:</strong> <?= $utente['nome'] ?></p>
        <p><strong>Email:</strong> <?= $utente['email'] ?></p>
        <p><strong>Numero di telefono:</strong> <?= $utente['telefono'] ?></p>
      </div>
    </section>
  </div>

  <footer>
    &copy; 2025 JTL LuxeRent. Tutti i diritti riservati.
  </footer>

</body>
</html>
