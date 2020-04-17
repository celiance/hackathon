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
              <button class="category_btn" data-category="1">Marketing</button>
              <button class="category_btn" data-category="2">Technologie</button>
              <button class="category_btn" data-category="3">andere</button>
            </div>
            <div class="allrequests" id="allrequests">
              <?php foreach ($all_requests as $request) { ?>
                <div class="request" id="request">
                  <h5>
                      <?php echo $request['category_id']; ?>
                  </h5>
                  <h3><?php echo $request['title']; ?></h3>
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

  document.addEventListener("DOMContentLoaded", function(event) {
      let show_request = document.querySelector('#request');
      var category_buttons = document.getElementsByClassName('category_btn');
      const category = document.querySelector('#category');

      for(let i = 0; i < category_buttons.length; i++){
        category_buttons[i].addEventListener("click", function(){
          show_request(this.getAttribute("data-category"));
        })
      }
      function show_request(category){
        let url = category + ".json";
        fetch(url)
          .then((response) => {
            return response.json();
          })
          .then((data) => {
            mein_request = category_anzeige(data);
            show_request.removeChild(show_request.firstChild);
            show_request.appendChild(mein_request);
          })
          .catch(function(error) {
            console.log('Error: ' + error.message);
          });
      }
    });

      function category_anzeige(category) {
        const track_eigenschaften = document.createElement('ul');
        const track_titel = document.createElement('li');
        track_eigenschaften.appendChild(track_titel);
        const track_artist = document.createElement('li');
        track_eigenschaften.appendChild(track_artist);
        const track_dauer = document.createElement('li');
        track_eigenschaften.appendChild(track_dauer);
        const track_label = document.createElement('li');
        track_eigenschaften.appendChild(track_label);

        const label_liste = document.createElement('ul');
        for(let i = 0; i < track.label.length; i++){
          const label_listenpunkt = document.createElement('li');
          label_listenpunkt.textContent = track.label[i];
          label_liste.appendChild(label_listenpunkt);
        }

        track_titel.innerHTML = "Titel: <strong>" + track.titel + "</strong>";
        track_artist.textContent = "Künstler: " + track.artist;
        track_dauer.textContent = "Dauer: " + track.dauer.single;
        track_label.textContent = "Label: ";
        track_label.appendChild(label_liste);

        return track_eigenschaften;
      }


</script>

<?php
  require_once('js/request-load.js');
?>
