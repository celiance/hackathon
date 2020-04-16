<?php
  session_start();

  require_once('system/config.php');
  require_once('system/data.php');
  require_once('templates/column-left.php');
  require_once('templates/navi.php');
  require_once('js/mouse-cursor-gradient.js');


  if(isset($_SESSION['userid'])) {
    unset($_SESSION['userid']);
    session_destroy();
    }

  $logged_in = false;
  $log_in_out_text = "Login";


  if(isset($_POST['login_submit'])){
    $login_valid = true;

    $msg = "";

    if(!empty($_POST['username'])){
      $username = $_POST['username'];
    }else{
      $msg .= "Du hast vergessen deinen Nutzernamen einzugeben.<br>";
      $login_valid = false;
    }

    if(!empty($_POST['password'])){
      $password = $_POST['password'];
    }else{
      $msg .= "Du hast vergessen dein Passwort einzugeben.<br>";
      $login_valid = false;
    }

    if($login_valid){
      $result = login($username , $password);

      if($result){
        $user = $result;
        $_SESSION['userid'] = $user['id'];

        header('Location: http://166363-13.web1.fh-htwchur.ch');


      }else{
        $msg = "Überprüfe deine Angaben.";
      }
    }
  }
?>
          <!-- LOGIN -->
          <main>
            <div class="login">
              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="username">Nutzername</label></br>
                <input type="text" name="username" value="" id="username"></br>
                <label for="password">Passwort</label></br>
                <input type="password" name="password" value="" id="password"></br>
                <button type="submit" name="login_submit" value="einloggen">Anmelden</button>
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
