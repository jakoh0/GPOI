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
    <form method="post" class="form-container">
      <input type="text" name="nome" placeholder="Nome utente" required class="form-input">
      <input type="password" name="pwd" placeholder="Password" required class="form-input">
      <input type="email" name="email" placeholder="Email" required class="form-input">
      <input type="tel" name="numero" placeholder="Numero di telefono" required class="form-input">
      <input type="submit" name="invio" value="Registrati" class="btn">
    </form>
  </section>
</body>

<?php
if (isset($_POST["invio"])) {
    $nome = trim($_POST["nome"]);
    $pwd = trim($_POST["pwd"]);
    $email = trim($_POST["email"]);
    $numero = trim($_POST["numero"]);

    if ($nome == "" || $pwd == "" || $email == "" || $numero == "") {
        die("<p style='text-align:center;color:#f00;'>Compila tutti i campi</p>");
    }

    $conn = mysqli_connect("localhost", "root", "", "jtl_luxerent");
    $password = md5($pwd);

    $sql = "SELECT * FROM utenti WHERE nome = '$nome' OR email = '$email'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

    if (mysqli_num_rows($result) > 0) {
        echo "<p style='text-align:center;color:#ffcc00;'>Utente o email già registrati</p>";
    } else {
        $sql = "INSERT INTO utenti (nome, password_hash, email, telefono) 
                VALUES ('$nome', '$password', '$email', '$numero')";
        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
        echo "<p style='text-align:center;color:#0f0;'>Registrazione completata con successo</p>";
        mysqli_close($conn);
        sleep(2);
        header("Location: index.html");
    }
}
?>
</html>
