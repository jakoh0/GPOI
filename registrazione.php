<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrazione - JTL LuxeRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="section">
    <h2>Crea un nuovo account</h2>
    <form method="post" style="max-width: 400px; margin: 0 auto;">
      <input type="text" name="nome" placeholder="Nome utente" style="width: 100%; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; border: none;">
      <input type="password" name="pwd" placeholder="Password" style="width: 100%; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; border: none;">
      <input type="submit" name="invio" value="Registrati" class="btn" style="width: 100%;">
    </form>
  </section>
</body>

<?php
if (isset($_POST["invio"])) {
    if (!isset($_POST["nome"]) || trim($_POST["nome"]) == "") {
        die("<p style='text-align:center;color:#f00;'>Inserisci correttamente il nome</p>");
    }
    if (!isset($_POST["pwd"]) || trim($_POST["pwd"]) == "") {
        die("<p style='text-align:center;color:#f00;'>Inserisci correttamente la password</p>");
    }

    $conn = mysqli_connect("localhost", "root", "", "5AIT_Super");
    $user = $_POST["nome"];
    $pwd = $_POST["pwd"];
    $password = md5($pwd);

    $sql = "SELECT * FROM utenti WHERE nome = '$user' AND password = '$password'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='text-align:center;color:#ffcc00;'>Account già esistente</p>";
    } else {
        $sql = "INSERT INTO utenti(nome,password) VALUES ('$user','$password')";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        echo "<p style='text-align:center;color:#0f0;'>Registrazione completata con successo</p>";
        mysqli_close($conn);
    }
}
?>
</html>
