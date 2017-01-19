<div id="charts">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
<script>

	var profils_sections = <?php echo json_encode($profils, JSON_NUMERIC_CHECK); ?>;

	function createChartArea(id){
		var div = document.createElement('div');
		div.innerHTML =  '<canvas id="'+id+'" width="100%" height="100%"></canvas>';
		document.getElementById("charts").appendChild(div);
	}

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

	for (var sections in profils_sections) {
		createChartArea(sections);
		var labels = [];
		var results = [];
		for(var profil in profils_sections[sections]){
			labels.push(profil);
			results.push(profils_sections[sections][profil])
		}
		installChart(sections, results, labels, sections);
	};

</script>