<div class="container">
	
	

	<div class="row">
		
        
        <div class="col-md-12">
        <h4>Voila la liste de tout les administrateurs de la plateforme</h4>
        <div class="table-responsive">

              <table id="mytable" class="table table-bordred table-striped">
                   <thead>
                   <center>
                   <th><input type="checkbox" id="checkall" /></th>
                   <th>Nom</th>
                   <th>Prenom</th>
                   <th>EMail</th>
                   <th>Modifier</th>
                   <th>Supprimer</th>
                  </center>
                   </thead>
    <tbody>
    <?php $i=0;foreach ($listeAdmin as $key => $value) {; ?>
    <center>
    <tr>

    <td><input type="checkbox" class="checkthis" /></td>
    <td><?php if(isset($value['nom_admin'])){echo $value["nom_admin"];}?></td>
    <td><?php if(isset($value['prenom_admin'])){echo $value["prenom_admin"];} ?></td>
    <td><?php if(isset($value['mail_admin'])){ ?><INPUT class="inputMail" type= "mail" name="<?php echo $i;?>" value="<?php echo $value["mail_admin"];?>" readonly="readonly" disabled ><?php } ?></td>
    <?php if ($_SESSION['login'] == $value["id_admin"]){ ?>
    <td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>	
    <td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" disabled><span class="glyphicon glyphicon-trash"></span></button></p></td>
    <?php }else{ ?>
	<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal" data-target="#edit" ><span class="glyphicon glyphicon-pencil"></span></button></p></td>
	<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
    <?php } ?>
    </tr> 
    </center>
     <?php $i++; } ?>
    </tbody>
   
        
</table>
            
        </div>
        <form method="POST" action="index.php?controller=admin&amp;action=inscription">
    <input id="submit" class="btn btn-dark btn-large" type="submit" value="Ajouter un administrateur" />
    </form>
	</div>
</div>
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Modifier les informations</h4>
        
      </div>
      	<form method="POST" action="index.php?controller=admin&amp;action=modif&amp;option=null">
          <div class="modal-body">
          <div class="form-group">

        <input class="form-control " type="text" placeholder="Nom" name="nom" id="nom" required/>
        </div>
        <div class="form-group">
        <input class="form-control " type="text" placeholder="Prenom" name="prenom" id="prenom" required/>
        </div>
        <div class="form-group">
        <?php echo'<input class="form-control " type="text" placeholder="E-mail" name="email2" id="email2" value="'.$value["mail_admin"].'" required/>'?>
        </div>
         <div class="form-group">
        <input class="form-control " type="password" placeholder="Mot de passe" name="mdp" id="mdp" required/>
        </div>
         <div class="form-group">
        <input class="form-control " type="password" placeholder="Confirmation" name="confirmPwd" id="confirmPwd" required/>
        </div>
      </div>
          <div class="modal-footer ">
        <button type="submit" class="btn btn-dark btn-lg" style="width: 100%;"><span class="glyphicon glyphicon-ok-sign"></span> Mettre à jour</button>
      </div>
      </form>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    
    
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete this entry</h4>
      </div>
          <div class="modal-body">
       
       <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Record?</div>
       
      </div>
        <div class="modal-footer ">
        <button type="button" class="btn btn-success" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
      </div>
        </div>
    
    <!-- /.modal-content --> 
  </div>
<script>
  $(document).ready(function(){
$("#mytable #checkall").click(function () {
        if ($("#mytable #checkall").is(':checked')) {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", true);
            });

        } else {
            $("#mytable input[type=checkbox]").each(function () {
                $(this).prop("checked", false);
            });
        }
    });
    
    $("[data-toggle=tooltip]").tooltip();
});
</script>
