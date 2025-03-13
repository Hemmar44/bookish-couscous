<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
    <?php
    session_start();
    ?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Czatex</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link active" aria-current="page" href="login.php">Logowanie</a>
            <a class="nav-link active" href="rejestracja.php">Rejestracja</a>
            <a class="nav-link" href="logout.php">Wyloguj</a>
          </div>
        </div>
      </div>
    </nav>

    <div class="container">
    <div class="container w-25">
        <h1 class="mb-5">Login</h1>
        <form method="post">
            <div class="mb-3">
              <label for="InputEmail" class="form-label">Email address</label>
              <input type="email" class="form-control" id="InputEmail" name="email">
            </div>
            <div class="mb-3">
                <label for="InputPassword" class="form-label">Password</label>
                <input type="password" class="form-control" id="InputPassword" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
    
    
    <?php
    if(!empty($_POST['email']) && !empty($_POST['password'])){
      $email = $_POST['email']; // zmienne z formularza
      $password = $_POST['password'];
      
      $conn = new mysqli("localhost", "root", "", "login_system"); // baza danych
      
      function czyDobreHaslo($email, $conn, $password){
        $query = "select email from users where password='$password' and email='$email';";
        $result = $conn->query($query);

        if($result->num_rows == 0){
            print("<div class='alert alert-danger' role='alert'>
            złe hasło
            </div>"); // brak emaila z haslem
        }
        else{
            print("<div class='alert alert-success' role='alert'>
            dobre hasło
            </div>"); // znalazlo emaila z haslem
            
            $query = "select first_name from users where email='$email';";
            $result = $conn->query($query);
            $table = $result->fetch_assoc();
            $username = $table['first_name'];

            $_SESSION['zalogowany'] = True;
            $_SESSION['user'] = $username;

            header("location: dashboard.php");
        }
      }

      function czyIstniejeEmail($email, $conn, $password){
        $query = "select email from users;"; // zapytanie o email
        $result = $conn->query($query);
        if($result->num_rows == 0){
            print("<div class='alert alert-danger' role='alert'>
            nie ma konta z takim emailem
            </div>");
          // jezeli nie ma emaili w bazie
        }
        else{
          while($table = $result->fetch_assoc()){
            if($table['email'] == $email){
              // jezeli jest ten sam email
              
              czyDobreHaslo($email, $conn, $password);        
              return;
            }
          }
          print("<div class='alert alert-danger' role='alert'>
            nie ma konta z takim emailem
            </div>");
          // jezeli nie ma emaili w bazie
        }
      }
      czyIstniejeEmail($email, $conn, $password);
    }
    else{
      
    }
    ?>
    </div>
    </div>
    
</body>
</html>