<?php

  require_once('system/config.php');
  require_once('system/data.php');


 ?>

<!DOCTYPE html>
<html lang="de" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Request-Box</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
  </head>
  <body>
    <div class="center">
      <!-- LINKE SPALTE -->
      <div class="left">
        <a href="index.php"><img src="img/logo.png" alt="logo" class="logo" width="200px" height="auto"></a>

        <!-- FORMULAR -->

          <div class="formular">
            <h3>Add suggestion</h3>
            <p>Let us know how we can make Business IT even better!</p></br>
            <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
              <label for="titel">Titel</label></br>
              <input type="text" name="title" value="" class="ideeInput"></br>
              <label for="description">Beschreibung</label></br>
              <textarea class="beschreibungInput" id="description" name="description" cols="35" rows="4"></textarea></br>
              <button type="submit" name="request_submit">Senden</button>
            </form>
          </div>
        </div>
      </div>
