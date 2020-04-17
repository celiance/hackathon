<?php

  require_once('system/config.php');
  require_once('system/data.php');
  require_once('js/request-load.js');

  if(isset($_SESSION['userid'])){
    $user = get_user_by_id($_SESSION['userid']);
    $user_id = $user['id'];
    $logged_in = true;
    $log_in_out_text = "Logout";

  }else{
    $logged_in = false;
    $log_in_out_text = "Anmelden";
  }

  if(isset($_POST['request_submit'])){
    $msg = "";
    $reguest_valid = true;

    if(!empty($_POST['title'])){
      $title = $_POST['title'];
    }else{
      $msg .= "Bitte gib einen Titel ein.<br>";
      $reguest_valid = false;
    }

    if(!empty($_POST['description'])){
      $description = $_POST['description'];
    }else{
      $msg .= "Bitte gib eine Beschreibung ein.<br>";
      $reguest_valid = false;
    }

    // Category Check

    if(isset($_POST['category1'])){
      $category_id = 'Marketing';
    }elseif(isset($_POST['category2'])){
      $category_id = 'Technologien';
    }elseif(isset($_POST['category3'])){
      $category_id ='andere';
    }else{
      $msg .= "Bitte gib eine Kategorie ein.<br>";
      $reguest_valid = false;
    }




    // Daten in die Datenbank

   if($reguest_valid){
        $result = request_input($title, $description, $user_id, $category_id);


        if($result){
          unset($_POST);
          $msg = "Du hast deine Idee erfolgreich abgeschickt.</br>";


        }else{
          $msg .= "Etwas hat nicht geklappt. Versuche es nochmal.</br>";
        }
      }
    }else{
    }
  $all_categories = get_category();

 ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Request-Box</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.5.0.min.js" integrity="sha256-xNzN2a4ltkB44Mc/Jz3pT4iU1cmeR0FkXs4pru/JxaQ=" crossorigin="anonymous"></script>


  </head>
  <body>
    <div class="center">
      <!-- LINKE SPALTE -->
      <div class="left">
        <a href="index.php"><img src="img/logo.png" alt="logo" class="logo" width="200px" height="auto"></a>

        <!-- FORMULAR -->

          <div class="formular">
            <h3>Add suggestion</h3>
            <?php if(isset($user_id)){?>
            <p>Let us know how we can make Business IT even better!</p></br>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                <label for="titel">Titel</label></br>
                <input type="text" name="title" id="title" value="" class="ideeInput"></br>
                <label for="description">Beschreibung</label></br>
                <textarea class="beschreibungInput" id="description" name="description" cols="35" rows="4"></textarea></br>

                    <label for="titel">Marketing</label>
                    <input type="radio" name="category1" id="category" value="">
                    <label for="titel">Technologie</label>
                    <input type="radio" name="category2" id="category" value="">
                    <label for="titel">andere</label>
                    <input type="radio" name="category3" id="category" value="">



                <button type="submit" name="request_submit" id="request_submit">Senden</button>
              <?php }else{ ?>
                <p>Please log in to add a request!</p></br>
                <li class="login mouse-cursor-gradient-tracking"><span><a href="login.php"><?php echo $log_in_out_text; ?></a></span></li>
              <?php } ?>
            </form>
          </div>
        <?php if(!empty($msg)){ ?>
        <div class="nachricht" role="alert">
          <p><?php echo $msg ?></p>
        </div>
        <?php } ?>
      </div>

      <script>

      </script>
