<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <button type="button" href="" onclick="add_cluster()" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createcluster">
                    <i class="fas fa-plus"></i> &nbsp;Tambah cluster
                  </button>
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="createcluster" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New cluster</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
                					<form class="" method="post" action="<?=site_url('cluster/save')?>">
                            <!-- <div id="site_id_div">
															<div class="form-group">
																<label for="">Pilih Site</label>
																<select class="selectpicker form-control" name="site_id" id="site_id" data-live-search="true">
																	<option selected disabled readonly>PILIH SITE</option>
																	<option value="new_site">New Site</option>
																	<?php foreach ($site_list->result() as $site_data): ?>
																		<option value="<?=$site_data->site_id?>"><?=$site_data->id_site?> / <?=$site_data->lokasi?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<div class="" id="new_site_div">
																<div class="form-group">
																	<label for="">Site ID</label>
																	<input type="text" class="form-control" name="id_site" value="" placeholder="ID Site">
																</div>
																<div class="form-group">
																	<label for="">Site ID Telkom</label> <i>*optional</i>
																	<input type="text" class="form-control" name="id_site_telkom" value="" placeholder="ID Site Telkom">
																</div>
																<div class="form-group">
																	<label for="">Nama Site</label>
																	<input type="text" class="form-control" name="nama_site" value="" placeholder="Nama Site">
																</div>
																<div class="form-group">
																	<label for="">Lokasi</label>
																	<input type="text" class="form-control" name="lokasi_site" value="" placeholder="Lokasi Site">
																</div>
																<div class="form-group">
																	<label for="">Keterangan Site</label>
																	<textarea name="keterangan_site" class="form-control" rows="8" cols="80" placeholder="Keterangan Site"></textarea>
																</div>
															</div>
														</div> -->
                            <!-- <hr> -->
                            <div class="form-group">
                              <label for="inputAddress2">Homebase</label>
                              <input type="text" class="form-control" name="homebase" placeholder="Homebase" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Wilayah</label>
                              <input type="text" class="form-control" name="wilayah" placeholder="Wilayah" required>
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
									<table cellspacing="0" class="table table-bordered" id="cluster" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
												<th>Homebase</th>
                        <th>Wilayah</th>
												<!-- <th>Site</th> -->
												<th style="white-space:nowrap;" width="50">Action</th>
											</tr>
										</thead>
									</table>
									<!-- EDIT cluster -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editCluster" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New cluster</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<form class="" id="form_update" action="#">
														<input type="hidden" name="id_e" value="">
														<!-- <div class="form-group">
															<label for="">Site ID</label>
															<select class="form-control selectpicker" id="siteide" name="site_id_e" data-live-search="true">
																<option value="new_site">New Site</option> -->
																<?php //foreach ($site_list->result() as $site_data): ?>
																	<!-- <option value="<?=$site_data->site_id?>"><?=$site_data->id_site?> / <?=$site_data->lokasi?></option> -->
																<?php //endforeach; ?>
															<!--</select>
														</div> -->
                            <div class="form-group">
                              <label for="inputAddress2">Homebase</label>
                              <input type="text" class="form-control" name="homebase_e" placeholder="Homebase" required>
                            </div>
														<div class="form-group">
															<label for="inputAddress2">Wilayah</label>
															<input type="text" class="form-control" name="wilayah_e" placeholder="Wilayah" required>
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
									<!-- END OF EDIT cluster -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script type="text/javascript">

				var cluster;

				$(document).ready(function() {
				    cluster = $('#cluster').DataTable({
				        "processing": true,
				        "serverSide": true,
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('cluster/data')?>",
				            "type": "POST"
				        }, "columnDefs": [
					        {
					            "targets": [ -1 ],
					            "orderable": false
					        },
									{
										"class": "dt-center",
										"targets": [3]
									}
				        ],
				    });
				});

        // $('#new_site_div').hide();
				//
        // $(document).ready(function() {
				// 	$('#site_id').change(function() {
				// 		if ($(this).val() === 'new_site') {
				// 			$('#new_site_div').show();
				// 		} else {
				// 			$('#new_site_div').hide();
				// 		}
				// 	});
				// });

				function changeValueSave() {
					$('#btnSave').text('Saving...');
					$('#btnSave').attr('disabled', true);
				}

				function add() {
					$('#btnAdd').text('Saving...');
					$('#btnAdd').attr('disabled', true);
					var url;

					url = "<?=site_url('cluster/add_toteam')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#form_addtoteam').serialize(),
						success: function(data) {
							if (data.status = 'true') {
								$('.modal').removeClass('show');
								$('.modal').removeClass('in');
	              $('.modal').attr("aria-hidden","true");
	              $('.modal-backdrop').remove();
	              $('body').removeClass('modal-open');
								$('#alert').modal('show');
								swal("Success!", "cluster berhasil ditambahkan ke team!", "success");
								reload_table();
							}
							$('#btnAdd').text('Save');
							$('#btnAdd').attr('disabled', false);
						}
					});
				}

				function change() {
					$('#btnChange').text('Saving...');
					$('#btnChange').attr('disabled', true);
					var url;

					url = "<?=site_url('cluster/add_toteam')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#formChange').serialize(),
						success: function(data) {
							if (data.status = 'true') {
								$('.modal').removeClass('show');
								$('.modal').removeClass('in');
	              $('.modal').attr("aria-hidden","true");
	              $('.modal-backdrop').remove();
	              $('body').removeClass('modal-open');
								$('#alert').modal('show');
								swal("Success!", "Perubahan berhasil disimpan!", "success");
								reload_table();
							}
							$('#btnChange').text('Save');
							$('#btnChange').attr('disabled', false);
						}
					});
				}

				function remove() {
					$.ajax({
						url: "<?=site_url('cluster/removefromteam')?>",
						type: "POST",
						data: $('#formChange').serialize(),
						success: function(data) {
							if (data.status = 'true') {
								$('.modal').removeClass('show');
								$('.modal').removeClass('in');
	              $('.modal').attr("aria-hidden","true");
	              $('.modal-backdrop').remove();
	              $('body').removeClass('modal-open');
								$('#alert').modal('show');
								swal("Success!", "Perubahan berhasil disimpan!", "success");
								reload_table();
							}
						}
					});
				}

				function add_cluster() {
					save_method = 'add';
			    $('#form')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string
			    $('#createcluster').modal('show'); // show bootstrap modal
			    $('.modal-title').text('Add New cluster');
				}

				function save() {
					$('#btnSave').text('Saving...');
					$('#btnSave').attr('disabled', true);
					var url;

					url = "<?=site_url('cluster/save')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#form').serialize(),
						success: function(data) {
							if (data.status) {
								$('#editCluster').modal('hide');
								reload_table();
							}
							$('#btnSave').text('Save');
							$('#btnSave').attr('disabled', false);
						}
					});
				}

				function update() {
					$('#btnUpdate').text('Updating...');
					$('#btnUpdate').attr('disabled', true);
					var url;

					url = "<?=site_url('cluster/update')?>";

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
								swal("Success!", "Data cluster berhasil diupdate!", "success");
								reload_table();
							}
							$('#btnUpdate').text('Update');
							$('#btnUpdate').attr('disabled', false);
						}
					});
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

				function viewclusterDetail(id) {
					$.ajax({
						url: "<?=site_url('cluster/getclusterDetail/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('id').html(data.id);
							$('[id=name]').html(data.nama);
							$('[id=position]').html(data.posisi);
							$('[id=telp]').html(data.telp);
							$('[id=address]').html(data.alamat);
							$('[id=information]').html(data.keterangan);
							$('[id=dob]').html(data.dob);
							$('[id=kybd]').html(data.keluarga_yg_bisa_dihub);
							$('[id=telp_kybd]').html(data.telp_keluarga_yg_bisa_dihub);
							if (data.team_id != "") {
								$('[id=team_pos]').html("#ADT" + pad(data.team_id, 3));
							} else {
								$('[id=team_pos]').html("-");
							}
							$('.modal-title').text('cluster ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function add_toteam(id) {
					$.ajax({
						url: "<?=site_url('cluster/getclusterEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.cluster_id);
							$('#addToTeam').modal('show');
							$('.modal-title').text('Update Data cluster ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function removecluster(id) {
					swal({
					  title: "Are you sure?",
					  text: "You will not be able to recover this cluster data!",
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
								url: "<?=site_url('cluster/removecluster/')?>" + id,
								type: "POST",
								data: {id: id},
								success: function(data) {
									swal("Deleted!", "cluster berhasil dihapus.", "success");
									reload_table();
								}
							});
					  } else {
					    swal("Cancelled", "cluster batal dihapus", "error");
					  }
					});
				}

				function change_toteam(id) {
					$.ajax({
						url: "<?=site_url('cluster/getclusterEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.cluster_id);
							$('[name=team_id]').val(data.team_id);
							$('#changeTeam').modal('show');
							$('.modal-title').text('Update Team Position ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function edit_cluster(id) {
					$.ajax({
						url: "<?=site_url('cluster/getClusterEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id_e]').val(data.cluster_id);
							$('[name=homebase_e]').val(data.homebase);
							$('[name=wilayah_e]').val(data.wilayah);
							// $('#siteide option[value='+data.site_id+']').attr('selected', true);
							$('.selectpicker').selectpicker('render');
							$('#editCluster').modal('show');
							$('.modal-title').text('Update Data Cluster ' + data.homebase);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function reload_table() {
					cluster.ajax.reload(null, false);
				}

				function removeCluster(id) {
					swal({
					  title: "Are you sure?",
					  text: "You will not be able to recover this cluster data!",
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
								url: "<?=site_url('cluster/removeCluster/')?>" + id,
								type: "POST",
								data: {id: id},
								success: function(data) {
									swal("Deleted!", "Cluster berhasil dihapus.", "success");
									reload_table();
								}
							});
					  } else {
					    swal("Cancelled", "Cluster batal dihapus", "error");
					  }
					});
				}
			</script>
