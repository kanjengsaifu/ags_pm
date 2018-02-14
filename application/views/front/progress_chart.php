<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
									<br>
									<?php if (isViewer() || isAdm() || isAdministrator()) { ?>
                    <div class="col-md-8">
                      <div class="bgc-white bd bdrs-3 p-20 mB-20">
                        <canvas id="myChart" width="400" height="200"></canvas>
                      </div>
                    </div>

                    <div class="col-md-8">
                      <div class="bgc-white bd bdrs-3 p-20 mB-20">
                        <canvas id="myChart2" width="400" height="200"></canvas>
                      </div>
                    </div>
                  <?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<?php
			?>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');

        var blm_sls = {
          label: 'Belum Selesai',
          data: ["<?=json_encode($belumSelesai)?>"],
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }

        var sdh_sls = {
          label: 'Sudah Selesai',
          data: ["<?=json_encode($sudahSelesai)?>"],
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }

				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
              datasets: [blm_sls, sdh_sls]
            },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }],
                    xAxes: [{
                        barPercentage: 0.4
                    }]
				        }
				    }
				});

				var ctx = document.getElementById("myChart2").getContext('2d');

        var invoiced = {
          label: 'Invoiced',
          data: ["<?=json_encode($invoiced)?>"],
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }

        var sdh_byr = {
          label: 'Sudah Dibayar',
          data: ["<?=json_encode($isbayar)?>"],
          backgroundColor: 'rgba(144, 219, 132, 0.2)',
          borderColor: 'rgba(144, 219, 132, 1)',
          borderWidth: 1
        }

        var sdh_byrclnt = {
          label: 'Sudah Dibayar Client',
          data: ["<?=json_encode($isbayarclient)?>"],
          backgroundColor: 'rgba(54, 120, 235, 0.2)',
          borderColor: 'rgba(54, 120, 235, 1)',
          borderWidth: 1
        }

        var blm_semua = {
          label: 'Belum Semua',
          data: ["<?=json_encode($belumsemua)?>"],
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          borderColor: 'rgba(255, 99, 132, 1)',
          borderWidth: 1
        }

				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
              datasets: [invoiced, sdh_byr, sdh_byrclnt, blm_semua]
            },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }],
                    xAxes: [{
                        barPercentage: 0.7
                    }]
				        }
				    }
				});
			</script>
