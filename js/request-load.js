<script>
  $(document).ready(function() {
    setInterval(function(){
      $('#request').load("data.php").fadeIn("slow")
    }, 2000);
  });
</script>
