<?php
  require_once('js/mouse-cursor-gradient.js');


  if(isset($_SESSION['userid'])){
    $user = get_user_by_id($_SESSION['userid']);
    $user_id = $user['id'];
    $logged_in = true;
    $log_in_out_text = "Logout";

  }else{
    $logged_in = false;
    $log_in_out_text = "Anmelden";
  }

 ?>
<!-- RECHTE SPALTE -->
<div class="right">
  <!-- HEADER -->
  <header>
    <nav class="untermenu">
      <ul>
        <!--<li class="navipunkt"><a href="index.php">Alle Einträge</a></li>
        <li class="navipunkt"><a href="#">Meine Ideen</a></li>-->

          <li class="register">
            <?php if(!isset($user_id)){?>
              <a href="register.php">Registrieren</a>
            <?php }else{?>
              <a href="#"><?php echo $user['username']; ?></a>
            <?php } ?>
          </li>

        <li class="login mouse-cursor-gradient-tracking"><span><a href="login.php"><?php echo $log_in_out_text; ?></a></span></li>

      </ul>
    </nav>
  </header>
