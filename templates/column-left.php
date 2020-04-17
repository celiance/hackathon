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


    // Daten in die Datenbank schreiben ********

   if($reguest_valid){
        $result = request_input($title, $description, $user);


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
                <?php foreach ($all_categories as $category) { ?>
                    <label for="titel"><?php echo $category['category']; ?></label>
                    <input type="radio" name="category<?php echo $category['id']; ?>" id="category<?php echo $category['id']; ?>" value="">
                  <?php }?>


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
        $(document).ready(function() {
          $('#request_submit').click(function(){
            var title_txt = $('#title').val();
            if($.trim(title_txt) != ''){
              alert (title_txt);
            }
        });
        var description_txt = $('#description').val();
        if($.trim(description_txt) != ''){
          alert (description_txt);
        }
      });
        });
      </script>
