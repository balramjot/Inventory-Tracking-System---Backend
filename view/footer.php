<footer class="container-fluid footer_stl1">
    <p class="text-right">© Boston University</p>
</footer>

<script>
// calling ajax function for the header notification after clicking on cross button

$(function () {
    
    $( ".markasread" ).click(function(e) {
        var trnsid = $(this).attr('alt');
        
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: '<?php echo APP_URL; ?>/transactions/index.php',
            data: {id: trnsid, action : 'markAsReadAjax'},
            success: function(response)
            {
              var jsonData = JSON.parse(response);
             
              if(response == '2@')
              {
                  alert('something went wrong');
                  return false;
              }
              else
              {
                  $("#remcnt").html(response);
                  $(".hideli-"+trnsid).hide();
              }
              
           }
       });

    });

});
</script>

</body>
</html>
<?php
    // unsetting session
	if(!empty($_SESSION['error'])) { unset($_SESSION['error']); }
	if(!empty($_SESSION['success'])) { unset($_SESSION['success']); }
?>