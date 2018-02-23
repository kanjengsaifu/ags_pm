<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">

                </div>
                <br>
								<?php if (isNotification()): ?>
									<div class="alert alert-success alert-dismissable">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <strong>Success!</strong> <?=notificationMessage()?>
									</div>
								<?php endif; ?>
								<div class="bgc-white bd bdrs-3 p-20 mB-20">
									<button type="button" class="btn cur-p btn-outline-primary" style="" onclick="reload_table()">
										<i class="fas fa-sync-alt"></i>
                  </button>
									<hr>
									<table cellspacing="0" class="table table-bordered" id="evidence_pdoc" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
                        <th>Filename</th>
                        <th>Extension</th>
												<th>Pengajuan ID</th>
												<th style="white-space:nowrap;" width="100">Action</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script type="text/javascript">

				var evidence_pdoc;

				$(document).ready(function() {
				    evidence_pdoc = $('#evidence_pdoc').DataTable({
				        "processing": true,
				        "serverSide": true,
			          dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
			               "<'row'<'col-sm-12'tr>>" +
			               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
			          "pageLength": 5,
                "language": {
                  "infoFiltered": ""
                },
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('submission/data_doc')?>",
				            "type": "POST"
				        }, "columnDefs": [
					        {
					            "targets": [ -1 ],
					            "orderable": false
					        },
									{
										"class": "dt-center",
										"targets": [2, 3, 4]
									}
				        ],
				    });
				});

        function reload_table() {
					evidence_pdoc.ajax.reload(null, false);
				}

				function hideModal(){
					$("#editCluster").removeClass("in");
					$(".modal-backdrop").remove();
					$("#editCluster").hide();
				}

				function pad(num, places) {
					var zero = places - num.toString().length + 1;
					return Array(+(zero > 0 && zero)).join("0") + num;
				}

			</script>
