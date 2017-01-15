<div class="container">
    <div class="row">
        
        
        <div class="col-md-12">
        <h4>Liste des promos de 4e année</h4>
        <div class="table-responsive">

                
              <table id="mytable" class="table table-bordred table-striped">
                   
                   <thead>
                   
                   <th>Code Département</th>
                    <th>Libéllé Département</th>
                     <th>Année</th>
                     <th>Code test</th>
                   </thead>
    <tbody>
    <?php foreach($promotion as $info=>$value){ ?>
        <tr>
        <td><?php if(isset($value['id_section'])){echo $value['id_section'];}?></td>
        <td><?php if(isset($value['libelle_section'])){echo $value['libelle_section'];}?></td>
        <td><?php if(isset($value['annee'])){echo $value['annee'];}?></td>
        <td><?php if(isset($value['mdp_test'])){echo $value['mdp_test'];}?></td>
        </tr>
    <?php } ?>
    </tbody>
        
</table>

                
            </div>
            
        </div>
    </div>
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