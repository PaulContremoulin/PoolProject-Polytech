<!-- pied de page -->
<footer>
  <div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3 id="myModalLabewrapperl"><i class="icon-mail"></i> Contact Me</h3>
    </div>
    <div class="modal-body">
      <form action="#">
        <input type="text" placeholder="Your Name">
        <input type="text" placeholder="Your Email">
        <input type="text" placeholder="Website (Optional)">
        <textarea rows="3" style="width:80%"></textarea>
        <br>
        <button type="submit" class="btn btn-large"><i class="icon-paper-plane"></i> SUBMIT</button>
      </form>
    </div>
  </div>
  <script src="js/jquery.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script>
    // Closes the sidebar menu
    $("#menu-close").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
    // Opens the sidebar menu
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#sidebar-wrapper").toggleClass("active");
    });
  </script>
  <script>
    $('#myModal').modal('hidden')
  </script>
  <script type="text/javascript">
  $('input[type=radio]').click(function(){
    $(this).parent().parent().find('input[type=radio]').prop('checked',false);
    $(this).prop('checked',true);
  });
</script>
</footer>