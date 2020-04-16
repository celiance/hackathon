<?php
  session_start();

  require_once('system/config.php');
  require_once('system/data.php');
  require_once('templates/column-left.php');
  require_once('templates/navi.php');

  if(isset($_SESSION['userid'])){
    $user = get_user_by_id($_SESSION['userid']);
    $user_id = $user['id'];
    $logged_in = true;
    $log_in_out_text = "Logout";

  }else{
    $logged_in = false;
    $log_in_out_text = "Anmelden";
  }

  $all_requests = get_request();


?>


          <!-- CONTENT -->
          <main>
            <div class="allrequests">
              <?php foreach ($all_requests as $request) { ?>
              <div class="request">
                  <h5><?php echo $autor['username']; ?></h5>
                <h3><?php echo $request['title']; ?></h3>
                <p>
                  <?php echo $request['description']; ?>
                </p>
              </div>
            <?php }?>
              <div class="request">
                <h5>Celia Rogg</h5>
                <h3>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam</h3>
                <p>
                  Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.
                </p>
              </div>
            </div>
          </main>
        </div>
    </div>
  </body>
</html>
