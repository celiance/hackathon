<script>
  $(document).ready(function() {
    setInterval(function(){
      $('#request').load("data.php").fadeIn("10000")
    }, 10000);
  });
</script>
