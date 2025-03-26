<?php
//metody w php nazywamy małymi literami
function NoEmail() {
    print("<div class='alert alert-danger' role='alert'>Nie ma konta z takim emailem</div>");
  }

  function BadPassword() {
    print("<div class='alert alert-danger' role='alert'>Złe hasło</div>");
  }
//na przyszłość pomyśl o strukturze try {} catch {} finally {} umożliwia obsługę wyjątków, błędów i ich logowania.
  function IsGoodPassword($pdo, $email, $password) {
    //warto dodać limit 1 do zapytki, pytanie czy na mailu masz w tabeli klucz UNIQUE, warto go dodać.
    $stmt = $pdo->prepare("SELECT password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $table = $stmt->fetch();
    //PDO może zwrócić false zamiast tablicy, wtedy tu będzie poważny błąd bo bedzies próbował pobrać klucz z bool, warto dodać dodatkowe sprawdzenie
    if ($table === false) {
        return false; // Użytkownik o podanym emailu nie istnieje
    }
    $hashedPassword = $table['password'];
    
    return password_verify($password, $hashedPassword);
  }

  function LogInToSite($pdo, $email) {
      //to loggedIn ustawiałbym dopiero po pobraniu danych. Reszta uwag taka jak powyżej.
    $_SESSION['loggedIn'] = true;
    $_SESSION['account'] = $email;
    
    $stmt = $pdo->prepare("SELECT first_name FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $table = $stmt->fetch();
    $_SESSION['user'] = $table['first_name'];
    
    header("Location: dashboard.php");
    exit();
  }

  function InvalidEmail(){
    print("<div class='alert alert-danger' role='alert'>Email nieprawidłowy</div>");
  }

  function CheckLoginData($pdo, $email, $password) {
    $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $stmt->execute([$email]);
    //tu można też pozbyć się zagnieżdżenia
    //np 

    if (empty($stmt->rowCount) {
        return NoEmail();
    }

    if (IsGoodPassword($pdo, $email, $password)) {
        return LogInToSite($pdo, $email);
    }

    return BadPassword();

    //     if ($stmt->rowCount() > 0) {
    //     if (IsGoodPassword($pdo, $email, $password)) {
    //         LogInToSite($pdo, $email);
    //     } else {
    //         BadPassword();
    //     }
    // } else {
        
    // }
    // if ($stmt->rowCount() > 0) {
    //     if (IsGoodPassword($pdo, $email, $password)) {
    //         LogInToSite($pdo, $email);
    //     } else {
            
    //     }
    // } else {
    //     NoEmail();
    // }
  }

?>
