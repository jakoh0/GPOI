<?php
  session_start();
  $conn = mysqli_connect("localhost", "root", "", "my_jtl_luxerent");
  $car = $_SESSION["macchina"];
  $sql ="SELECT * FROM automobili WHERE marca = '$car'";
  $result = mysqli_query($conn, $sql);
 
  $row = mysqli_fetch_assoc($result);
  $_SESSION["idcar"]= $row["id"];
  $marca= $row["marca"];
  $anno= $row["anno"];
  $prezzo= $row["prezzo_giornaliero"];
  $descrizione= $row["descrizione"];
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
      <div class="indux">
        <a href="pag1.html"><img src="img/logo.png"></a>
      </div>
      <!-- Info auto -->

      <div style="flex: 1; min-width: 300px;">
        <h3 style="color: #ffd700;">Nome Auto</h3>
        <p><strong>Marca:</strong> <?php echo $marca?></p>
        <p><strong>Anno:</strong> <?php echo $anno?></p>
        <p><strong>Prezzo leasing:</strong> <?php echo $prezzo."€"?></p>
        <p><strong>Caratteristiche:</strong> <?php echo $descrizione?></p>
        <form method="post"><button class="btn"name="prenota" type="submit" value="prenota">Prenota ora</button></form>

        <?php
          if(isset($_POST["prenota"])){
            header("Location: prenotazione.php");
          }
        ?>
      </div>
    </div>
  </section>
</body>
</html>
