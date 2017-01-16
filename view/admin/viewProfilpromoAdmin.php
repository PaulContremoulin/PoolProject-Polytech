<canvas id="chartIG" width="100%" height="100%" ></canvas>
<canvas id="chartMEA" width="100%" height="100%" ></canvas>
<canvas id="chartSTE" width="100%" height="100%" ></canvas>
<canvas id="chartGBA" width="100%" height="100%" ></canvas>
<canvas id="charMAT" width="100%" height="100%" ></canvas>
<canvas id="charMI" width="100%" height="100%" ></canvas>

<script>
	var var_labels = <?php echo json_encode($labels); ?>;
	var var_profil_ig = <?php echo json_encode($profil_ig, JSON_NUMERIC_CHECK); ?>;
	var var_profil_mea = <?php echo json_encode($profil_mea, JSON_NUMERIC_CHECK); ?>;
	var var_profil_ste = <?php echo json_encode($profil_ste, JSON_NUMERIC_CHECK); ?>;
	var var_profil_gba = <?php echo json_encode($profil_gba, JSON_NUMERIC_CHECK); ?>;
	var var_profil_mat = <?php echo json_encode($profil_mat, JSON_NUMERIC_CHECK); ?>;
	var var_profil_mi = <?php echo json_encode($profil_mi, JSON_NUMERIC_CHECK); ?>;

	function installChart(idhtml, tab_section, labels, nom_sec){

		var ctx = document.getElementById(idhtml);
		var data = {
		    labels: labels,
		    datasets: [
		        {
		            label: nom_sec,
		            backgroundColor: "rgba(0,0,0,0.4)",
		            borderColor: "rgba(0,0,0,1)",
		            pointBackgroundColor: "rgba(0,0,0,1)",
		            pointBorderColor: "rgba(0,0,0,0)",
		            pointHoverBackgroundColor: "#fff",
		            pointHoverBorderColor: "rgba(0,0,0,1)",
		            data: tab_section;
		        }
		    ]
		};
		var myChart = new Chart(ctx, {
		    type: "radar",
		    data: data,
		    
		    options: {
		            scale: {
		                ticks: {
		                    beginAtZero: true
		                }
		            }
		    }
		});
	}

	installChart("chartIG", var_porfil_ig, var_labels, "IG");
	installChart("chartMEA", var_porfil_mea, var_labels, "MEA");
	installChart("charSTE", var_porfil_ste, var_labels, "STE");
	installChart("charGBA", var_porfil_gba, var_labels, "GBA");
	installChart("charMAT", var_porfil_mat, var_labels, "MAT");
	installChart("charMI", var_porfil_mi, var_labels, "MI");



</script>