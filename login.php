<?php session_start(); session_destroy(); ?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - JTL LuxeRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <section class="section">
    <h2>Accedi al tuo account</h2>
    <form method="post" style="max-width: 400px; margin: 0 auto;">
      <input type="text" name="nome" placeholder="Email" style="width: 100%; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; border: none;">
      <input type="password" name="pwd" placeholder="Password" style="width: 100%; padding: 1rem; margin-bottom: 1rem; border-radius: 8px; border: none;">
      <input type="submit" name="invio" value="Accedi" class="btn" style="width: 100%;">
    </form>
  </section>
</body>

<?php
if (isset($_POST["invio"])) {
    if (!isset($_POST["nome"]) || trim($_POST["nome"]) == "") {
        die("Inserisci correttamente l'email");
    }
    if (!isset($_POST["pwd"]) || trim($_POST["pwd"]) == "") {
        die("Inserisci correttamente la password");
    }

    $conn = mysqli_connect("localhost", "root", "", "my_jtl_luxerent");
    $user = $_POST["nome"];
    $pwd = $_POST["pwd"];
    $password = md5($pwd);

    $sql = "SELECT * FROM utenti WHERE email = '$user' AND password_hash = '$password'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='text-align:center; color: #0f0;'>Accesso effettuato</p>";
        session_start();
        $row = mysqli_fetch_row($result);
        $_SESSION["utente"] = $row[0];
        mysqli_close($conn);
        header("Location: pag1.html");
        exit;
    } else {
        echo "<p style='text-align:center; color: #f00;'>Utente non trovato. Prova a registrarti prima.</p>";
    }
}
?>
</html>
