<?php
  session_start();

  require_once('system/config.php');
  require_once('system/data.php');
  require_once('templates/column-left.php');
  require_once('templates/navi.php');
  require_once('js/mouse-cursor-gradient.js');


  $logged_in = false;
  $log_in_out_text = "Anmelden";

  if(isset($_POST['register_submit'])){
    $msg = "";
    $register_valid = true;

    if(!empty($_POST['username'])){
      $username = $_POST['username'];
    }else{
      $msg .= "Bitte gib einen Nutzernamen ein.<br>";
      $register_valid = false;
    }

    if(!empty($_POST['email'])){
      $email = $_POST['email'];
    }else{
      $msg .= "Bitte gib eine E-Mailadresse  ein.<br>";
      $register_valid = false;
    }

    if(!empty($_POST['password'])){
      $password = $_POST['password'];
    }else{
      $msg .= "Bitte gib ein Passwort ein.<br>";
      $register_valid = false;
    }

    // Daten in die Datenbank schreiben ********

    if($register_valid){

      if(email_check($email)){
        $msg = "Diese E-Mail-Adresse ist bereits vergeben.</br>";
      }else{
        $result = register($username, $email, $password);

        if($result){
          unset($_POST);
          $msg = "Du hast dich erfolgreich registriert.</br>";
          header('Location: http://166363-13.web1.fh-htwchur.ch/login.php');


        }else{
          $msg .= "Etwas hat nicht geklappt. Versuche es nochmal.</br>";
        }
      }
    }else{
      $alert_type = "alert-warning";
    }

  }

?>
          <!-- REGISTER -->
          <main>
            <div class="register">
              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="user">Nutzername</label></br>
                <input type="text" name="username" value="" class="username"></br>
                <label for="email">E-Mail</label></br>
                <input type="email" name="email" value="<?php if(isset($email)) echo $email; ?>" class="email"></br>
                <label for="password">Passwort</label></br>
                <input type="password" name="password" value="" class="password"></br>
                <button type="submit" name="register_submit" value="registrieren">Registrieren</button>
              </form>
              <!-- Nachricht -->
              <?php if(!empty($msg)){ ?>
              <div class="nachricht" role="alert">
                <p><?php echo $msg ?></p>
              </div>
              <?php } ?>
            </div>
          </main>
        </div>
    </div>
  </body>
</html>
