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
        <img src="img/logo.png" alt="logo" class="logo" width="200px" height="auto">

        <!-- FORMULAR -->
        <div class="formular">
          <h3>Add suggestion</h3>
          <p>Let us know how we can make Business IT even better!</p></br>
          <form action="index.html" method="post">
            <label for="titel">Titel</label></br>
            <input type="text" name="titel" value="" class="ideeInput"></br>
            <label for="details">Details</label></br>
            <textarea class="beschreibungInput" id="text" name="text" cols="35" rows="4"></textarea></br>
            <button type="submit" name="senden">Senden</button>
          </form>
        </div>
      </div>
      <!-- RECHTE SPALTE -->
      <div class="right">
        <!-- HEADER -->
        <header>
          <nav class="untermenu">
            <ul>
              <li class="navipunkt"><a href="#">Alle Einträge</a></li>
              <li class="navipunkt"><a href="#">Meine Ideen</a></li>
              <li class="login mouse-cursor-gradient-tracking"><span><a href="#">Login</a></span></li>
              <li class="register"><a href="#">Registrieren</a></li>
            </ul>
          </nav>
        </header>

          <!-- CONTENT -->
          <main>
            <div class="allrequests">
              <div class="request">
                <h5>Celia Rogg</h5>
                <h3>Lorem ipsum dolor sit</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>

              </div>
              <div class="request">
                <h5>Celia Rogg</h5>
                <h3>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
              </div>
              <div class="request">
                <h5>Celia Rogg</h5>
                <h3>Trinkflaschen für alle</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                </p>
              </div>
            </div>
          </main>
        </div>
    </div>
  </body>
</html>
