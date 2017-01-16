<canvas id="chartIG" width="100%" height="100%" ></canvas>
<canvas id="chartMEA" width="100%" height="100%" ></canvas>
<canvas id="chartSTE" width="100%" height="100%" ></canvas>
<canvas id="chartGBA" width="100%" height="100%" ></canvas>
<canvas id="charMAT" width="100%" height="100%" ></canvas>
<canvas id="charMI" width="100%" height="100%" ></canvas>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
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
		            data: tab_section
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

	installChart("chartIG", var_profil_ig, var_labels, "IG");
	installChart("chartMEA", var_profil_mea, var_labels, "MEA");
	installChart("charSTE", var_profil_ste, var_labels, "STE");
	installChart("charGBA", var_profil_gba, var_labels, "GBA");
	installChart("charMAT", var_profil_mat, var_labels, "MAT");
	installChart("charMI", var_profil_mi, var_labels, "MI");



</script>