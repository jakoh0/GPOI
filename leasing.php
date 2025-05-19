<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Noleggio e Leasing - JTL LuxeRent</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="style1.css">
</head>
<body>

  <header>
    <h1>Offerta Noleggio & Leasing</h1>
  </header>
  <nav>
  <div class="indux">
    <a href="pag1.html"><img src="img/logo.png"></a>
  </div>
  <form method="post">
  <section class="section">

    <div class="car-grid">
      <div class="car-card">
            <button name="car" type="submit" value="Lamborghini Aventador">
                <img src="img/Lamborghini Aventador.png" alt="Lamborghini Aventador">
                <h3>Lamborghini Aventador</h3>
            </button>
      </div>
    </div>

    <div class="car-grid">
      <div class="car-card">
        <button name="car" type="submit" value="Ford Mustang">
                <img src="img/Ford Mustang.png" alt="Ford Mustang">
                <h3>Ford Mustang</h3>
            </button>
      </div>
    </div>

    <div class="car-grid"> 
      <div class="car-card">
        <button name="car" type="submit" value="AUDI RS3">
                <img src="img/AUDI RS3.png" alt="AUDI RS3">
                <h3>AUDI RS3</h3>
            </button>
      </div>

    </div>

     <div class="car-grid"> 
      <div class="car-card">
        <button name="car" type="submit" value="Porche Carera 911">
                <img src="img/Porche Carera 911.png" alt="Porche Carera 911">
                <h3>Porche Carera 911</h3>
            </button>
      </div>

    </div>

     <div class="car-grid"> 
      <div class="car-card">
        <button name="car" type="submit" value="Lamborghini Urus">
                <img src="img/Lamborghini Urus.png" alt="Lamborghini Urus">
                <h3>Lamborghini Urus</h3>
            </button>
      </div>

    </div>
    
  </section>
  </form>
  <?php
    session_start();
    if(isset($_POST["car"])){
        $_SESSION["macchina"]=$_POST["car"];
        echo $_POST["car"];
        header("Location: macchina.php");

    }
  ?>

  <footer>
    &copy; 2025 JTL LuxeRent. Tutti i diritti riservati.
  </footer>
</body>
</html>

