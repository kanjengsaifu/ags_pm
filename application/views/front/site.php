<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <button type="button" href="" onclick="add_site()" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createSite">
                    <i class="fas fa-plus"></i> &nbsp;Tambah Site
                  </button>
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="createSite" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New Site</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
                					<form class="" method="post" action="<?=site_url('site/save')?>">
                            <div class="form-group">
                              <label for="inputAddress2">Site ID</label>
                              <input type="text" class="form-control" name="id_site" placeholder="Site ID" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Site ID Telkom</label> <i>*optional</i>
                              <input type="text" class="form-control" name="id_site_telkom" placeholder="Site ID Telkom" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Nama Site</label>
                              <input type="text" class="form-control" name="nama_site" placeholder="Nama Site" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Lokasi</label>
                              <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Site" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Keterangan</label>
                              <input type="text" class="form-control" name="keterangan_site" placeholder="Keterangan Site" required>
                            </div>
                				</div>
                				<div class="modal-footer">
													<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
													<input type="submit" value="Save" class="btn btn-primary">
                				</div>
												</form>
                			</div>
                		</div>
                	</div>
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
									<table cellspacing="0" class="table table-bordered" id="site" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
												<th>Site ID</th>
												<th>Nama Site</th>
												<th>Lokasi</th>
												<th>Keterangan</th>
												<th style="white-space:nowrap;" width="250">Action</th>
											</tr>
										</thead>
									</table>
									<!-- EDIT SITE -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editSite" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New Site</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<form class="" id="form_update" action="#">
														<input type="hidden" name="id" value="">
                            <div class="form-group">
                              <label for="inputAddress2">Site ID</label>
                              <input type="text" class="form-control" name="id_site_e" placeholder="ID Site" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">ID Site Telkom</label>
                              <input type="text" class="form-control" name="id_site_telkom_e" placeholder="ID Site Telkom" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Nama Site</label>
                              <input type="text" class="form-control" name="nama_site_e" placeholder="Nama Site" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Lokasi</label>
                              <input type="text" class="form-control" name="lokasi_e" placeholder="Lokasi Site" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Keterangan</label>
                              <textarea name="keterangan_site_e" rows="8" cols="80" placeholder="Keterangan Site" class="form-control"></textarea>
                            </div>
	                				</div>
													</form>
	                				<div class="modal-footer">
														<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
														<button class="btn btn-primary" data-dismiss="modal" type="button" id="btnUpdate" onclick="update()">Update</button>
	                				</div>
                				</div>
                			</div>
                		</div>
                	</div>
									<!-- END OF EDIT SITE -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script type="text/javascript">

				var site;

				$(document).ready(function() {
				    site = $('#site').DataTable({
				        "processing": true,
				        "serverSide": true,
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('site/data')?>",
				            "type": "POST"
				        }, "columnDefs": [
					        {
					            "targets": [ -1 ],
					            "orderable": false
					        },
									{
										"class": "dt-center",
										"targets": [1, 2, 3, 4, 5]
									}
				        ],
				    });
				});

				function reload_table() {
					site.ajax.reload(null, false);
				}

				function changeValueSave() {
					$('#btnSave').text('Saving...');
					$('#btnSave').attr('disabled', true);
				}

				function add_site() {
					$('.modal-title').text('Tambah Site');
				}

				function hideModal(){
					$("#editSite").removeClass("in");
					$(".modal-backdrop").remove();
					$("#editSite").hide();
				}

				function save() {
					$('#btnSave').text('Saving...');
					$('#btnSave').attr('disabled', true);
					var url;

					url = "<?=site_url('site/save')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#form').serialize(),
						success: function(data) {
							if (data.status) {
								$('#editSite').modal('hide');
								reload_table();
							}
							$('#btnSave').text('Save');
							$('#btnSave').attr('disabled', false);
						}
					});
				}

				function edit_site(id) {
					$.ajax({
						url: "<?=site_url('site/getSiteEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.site_id);
							$('[name=id_site_e]').val(data.id_site);
							$('[name=id_site_telkom_e]').val(data.id_site_telkom);
							$('[name=nama_site_e]').val(data.nama_site);
							$('[name=lokasi_e]').val(data.lokasi);
							$('[name=keterangan_site_e]').val(data.keterangan_site);
							$('#editSite').modal('show');
							$('.modal-title').text('Update Data Site ' + data.site_id);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function update() {
					$('#btnUpdate').text('Updating...');
					$('#btnUpdate').attr('disabled', true);
					var url;

					url = "<?=site_url('site/update')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#form_update').serialize(),
						success: function(data) {
							if (data.status = 'true') {
								$('.modal').removeClass('show');
								$('.modal').removeClass('in');
	              $('.modal').attr("aria-hidden","true");
	              $('.modal-backdrop').remove();
	              $('body').removeClass('modal-open');
								$('#alert').modal('show');
								swal("Success!", "Data site berhasil diupdate!", "success");
								reload_table();
							}
							$('#btnUpdate').text('Update');
							$('#btnUpdate').attr('disabled', false);
						}
					});
				}

				function removeSite(id) {
					swal({
					  title: "Are you sure?",
					  text: "You will not be able to recover this site data!",
					  type: "warning",
					  showCancelButton: true,
					  confirmButtonClass: "btn-danger",
					  confirmButtonText: "Yes, delete it!",
					  cancelButtonText: "No, cancel pls!",
					  closeOnConfirm: false,
					  closeOnCancel: false
					},
					function(isConfirm) {
					  if (isConfirm) {
							$.ajax({
								url: "<?=site_url('site/removeSite/')?>" + id,
								type: "POST",
								data: {id: id},
								success: function(data) {
									swal("Deleted!", "Site berhasil dihapus.", "success");
									reload_table();
								}
							});
					  } else {
					    swal("Cancelled", "Site batal dihapus", "error");
					  }
					});
				}
			</script>
