<!-- pied de page -->

<div class="row social">
  <ul class="social-icons">
    <li><a href="#"><img src="img/fb.png" alt=""></a></li>
    <li><a href="#"><img src="img/tw.png" alt=""></a></li>
    <li><a href="#"><img src="img/go.png" alt=""></a></li>
    <li><a href="#"><img src="img/pin.png" alt=""></a></li>
    <li><a href="#"><img src="img/st.png" alt=""></a></li>
    <li><a href="#"><img src="img/dr.png" alt=""></a></li>
  </ul>
</div>
<div class="footer" href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
  <div class="container">
    <p class="pull-left"><a href="http://dzyngiri.com">www.dzyngiri.com</a></p>
    <p class="pull-right"><a href="#myModal" role="button" data-toggle="modal"> <i class="icon-mail"></i> CONTACT</a></p>
  </div>
</div>
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel"><i class="icon-mail"></i> Contact Me</h3>
  </div>
  <div class="modal-body">
    <form action="#">
      <input type="text" placeholder="Yopur Name">
      <input type="text" placeholder="Your Email">
      <input type="text" placeholder="Website (Optional)">
      <textarea rows="3" style="width:80%"></textarea>
      <br>
      <button type="submit" class="btn btn-large"><i class="icon-paper-plane"></i> SUBMIT</button>
    </form>
  </div>
</div>
<script src="js/jquery-1.10.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$('#myModal').modal('hidden')
</script>
