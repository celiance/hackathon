<?php
  session_start();

  require_once('system/config.php');
  require_once('system/data.php');
  require_once('templates/column-left.php');
  require_once('templates/navi.php');


?>
          <!-- REGISTER -->
          <main>
            <div class="register">
              <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="user">Nutzername</label></br>
                <input type="text" name="username" value="" class="username"></br>
                <label for="email">E-Mail</label></br>
                <input type="email" name="email" value="" class="email"></br>
                <label for="password">Passwort</label></br>
                <input type="password" name="password" value="" class="password"></br>
                <button type="submit" name="register_submit" value="registrieren">Registrieren</button>
              </form>

            </div>
          </main>
        </div>
    </div>
  </body>
</html>
