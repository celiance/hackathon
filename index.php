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
            <div class="category_buttons">
              <button class="category_btn active" data-category="1" onclick="filterSelection('all')">Alle</button>
              <button class="category_btn" data-category="1" onclick="filterSelection('marketing')">Marketing</button>
              <button class="category_btn" data-category="2" onclick="filterSelection('technologien')">Technologie</button>
              <button class="category_btn" data-category="3" onclick="filterSelection('andere')">andere</button>
            </div>
            <div class="allrequests" id="allrequests">
              <?php foreach ($all_requests as $request) { ?>
                <div class="request <?php echo $request['category_id']; ?>">
                  <h5>
                      <?php echo $request['category_id']; ?>
                  </h5>
                  <h3 id="test-titel">
                    <?php echo $request['title']; ?>
                  </h3>
                  <p>
                    <?php echo $request['description']; ?>
                  </p>
                </div>
              <?php }?>
            </div>
          </main>
        </div>
    </div>
  </body>
</html>


<script type="text/javascript">


filterSelection("all")
function filterSelection(c) {
  var x, i;
  x = document.getElementsByClassName("request");
  if (c == "all") c = "";
  // Add the "show" class (display:block) to the filtered elements, and remove the "show" class from the elements that are not selected
  for (i = 0; i < x.length; i++) {
    RemoveClass(x[i], "show");
    if (x[i].className.indexOf(c) > -1) AddClass(x[i], "show");
  }
}

// gefilterte Elemnte
function AddClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    if (arr1.indexOf(arr2[i]) == -1) {
      element.className += " " + arr2[i];
    }
  }
}

// Hide Elemente ohne Classennamen
function RemoveClass(element, name) {
  var i, arr1, arr2;
  arr1 = element.className.split(" ");
  arr2 = name.split(" ");
  for (i = 0; i < arr2.length; i++) {
    while (arr1.indexOf(arr2[i]) > -1) {
      arr1.splice(arr1.indexOf(arr2[i]), 1);
    }
  }
  element.className = arr1.join(" ");
}

// Add active class to the current control button (highlight it)
var btnContainer = document.getElementById("category_buttons");
var btns = btnContainer.getElementsByClassName("category_btn");
for (var i = 0; i < btns.length; i++) {
  btns[i].addEventListener("click", function() {
    var current = document.getElementsByClassName("active");
    current[0].className = current[0].className.replace(" active", "");
    this.className += " active";
  });
}


</script>

<?php
  require_once('js/request-load.js');
?>
