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
									<table cellspacing="0" class="table table-bordered" id="evidence_tdoc" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
                        <th width="150">Image Preview</th>
                        <th>Pengajuan</th>
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

				var evidence_tdoc;

				$(document).ready(function() {
				    evidence_tdoc = $('#evidence_tdoc').DataTable({
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
				            "url": "<?php echo site_url('transaksi/data_doc')?>",
				            "type": "POST"
				        }, "columnDefs": [
					        {
					            "targets": [ -1 ],
					            "orderable": false
					        },
									{
										"class": "dt-center",
										"targets": [1, 2, 3, 4]
									}
				        ],
				    });
				});

        function reload_table() {
					evidence_tdoc.ajax.reload(null, false);
				}

			</script>
