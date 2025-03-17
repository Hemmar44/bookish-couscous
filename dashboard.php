<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <?php
    session_start();
    //Sesja  ['loggedIn'], ['user'], ['account']
    
    if($_SESSION['loggedIn'] == False){
        header("location:niezalogowany.php");
    }
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Czatex</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link" aria-current="page" href="login.php">Logowanie</a>
            <a class="nav-link" href="rejestracja.php">Rejestracja</a>
            <a class="nav-link active" href="logout.php">Wyloguj</a>
          </div>
        </div>
      </div>
    </nav>
    <div class="container d-flex justify-content-center">
        <h1>Witaj <?php print($_SESSION['user']); ?></h1>
    </div>

    <div class="container d-flex justify-content-center flex-column"> <!-- Wiadomości -->

      <div class="container d-flex flex-row-reverse align-items-center justify-content-center">
        <div class="container" style="width: 100px; height: 100px">
          <img src="images/ziutek.jpg" class="border" style="width: 100px; height: 100px;">
        </div>
        <div class="alert alert-secondary w-25" role="alert">
          Message
        </div>
        <div class="w-50" role="alert">
          
        </div>
      </div>

      <div class="container d-flex flex-row align-items-center justify-content-center">
        <div class="container" style="width: 100px; height: 100px">
          <img src="images/chat.jpg" class="border" style="width: 100px; height: 100px;">
        </div>
        <div class="alert alert-primary w-25" role="alert">
          Response
        </div>
        <div class="w-50" role="alert">
          
        </div>
      </div>

    </div>

    <div class="container d-flex justify-content-center">
      <form action="askChat.php">
        <button type="submit" class="btn btn-primary">Send</button>
      </form>
    </div>
</body>
</html>