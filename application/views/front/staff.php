<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createStaff">
                    <i class="fas fa-plus"></i> &nbsp;Add New Staff
                  </button>
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="createStaff" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New Staff</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
                					<form class="" method="post" action="<?=site_url('staff/save')?>">
                            <div class="form-group">
                              <label for="inputAddress2">Full Name</label>
                              <input type="text" class="form-control" name="nama" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Telp</label>
                              <input type="text" class="form-control" name="telp" placeholder="Telp" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Position</label>
                              <input type="text" class="form-control" name="posisi" placeholder="Position" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Date of Birth</label>
															<input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="dob"/>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Address</label>
                              <textarea class="form-control" name="alamat" rows="8" cols="80" placeholder="Address" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Additional Information</label>
                              <input type="text" class="form-control" name="keterangan" placeholder="Additional Information" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Keluarga yang Bisa Dihubungi</label>
                              <input type="text" class="form-control" name="keluarga_yg_bisa_dihub" placeholder="Nama Kelurga yang Bisa Dihubungi" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Kontak Keluarga</label>
                              <input type="text" class="form-control" name="telp_keluarga_yg_bisa_dihub" placeholder="Kontak Keluarga" required>
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
									<table cellspacing="0" class="table table-bordered" id="staff" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
												<th>Full Name</th>
												<th>Position</th>
												<th style="white-space:nowrap;" width="250">Action</th>
											</tr>
										</thead>
									</table>
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detailStaff" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New Staff</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<table class="table">
														<tbody>
															<tr>
																<th width="250">Full Name</th>
																<td><span id="name"></span></td>
															</tr>
															<tr>
																<th>Position</th>
																<td><span id="position"></span></td>
															</tr>
															<tr>
																<th>Contact</th>
																<td><span id="telp"></span></td>
															</tr>
															<tr>
																<th>Address</th>
																<td><span id="address"></span></td>
															</tr>
															<tr>
																<th>Date of Birth</th>
																<td><span id="dob"></span></td>
															</tr>
															<tr>
																<th>Keluarga yang Bisa Dihubungi</th>
																<td><span id="kybd"></span></td>
															</tr>
															<tr>
																<th>Contact Keluarga</th>
																<td><span id="telp_kybd"></span></td>
															</tr>
															<tr>
																<th>Keterangan</th>
																<td><span id="information"></span></td>
															</tr>
															<tr>
																<th>Current Team Position</th>
																<td><span id="team_pos"></span></td>
															</tr>
														</tbody>
													</table>
                				</div>
                				<div class="modal-footer">
                					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                				</div>
                			</div>
                		</div>
                	</div>
									<!-- ADD TO TEAM -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="addToTeam" role="dialog" tabindex="-1">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">New Staff</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
												</div>
												<div class="modal-body">
													<form class="" id="form_addtoteam" action="#">
														<input type="hidden" name="id" value="">
														<div class="form-group">
															<label for="">Select Team</label>
															<select style="width:100%;" class="form-control" id="team_id" name="team_id">
																<option value="" selected>SELECT TEAM</option>
																<?php foreach ($team_list->result() as $team_data): ?>
																	<option value="<?=$team_data->team_id?>">#ADT<?=sprintf('%03d', $team_data->team_id)?></option>
																<?php endforeach; ?>
															</select>
														</div>
													</div>
													</form>
													<div class="modal-footer">
														<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
														<button class="btn btn-primary" data-dismiss="modal" type="button" id="btnAdd" onclick="add()">Add</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- END OF ADD TO TEAM -->
									<!-- CHANGE TEAM -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="changeTeam" role="dialog" tabindex="-1">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">New Staff</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
												</div>
												<div class="modal-body">
													<form class="" id="formChange" action="#">
														<input type="hidden" name="id" value="">
														<div class="form-group">
															<label for="">Select Team</label>
															<select style="width:100%;" class="form-control" id="team_id" name="team_id">
																<option value="" selected>SELECT TEAM</option>
																<?php foreach ($team_list->result() as $team_data): ?>
																	<option value="<?=$team_data->team_id?>">#ADT<?=sprintf('%03d', $team_data->team_id)?></option>
																<?php endforeach; ?>
															</select>
															<hr>
															or <button onclick="remove()" id="btnRemove" class="btn btn-danger" type="button" name="button">REMOVE FROM CURRENT TEAM</button>
														</div>
													</div>
													</form>
													<div class="modal-footer">
														<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
														<button class="btn btn-primary" data-dismiss="modal" type="button" id="btnChange" onclick="change()">Save</button>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- END OF CHANGE TEAM -->
									<!-- EDIT STAFF -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editStaff" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New Staff</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<form class="" id="form_update" action="#">
														<input type="hidden" name="id" value="">
                            <div class="form-group">
                              <label for="inputAddress2">Full Name</label>
                              <input type="text" class="form-control" name="nama" placeholder="Full Name" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Telp</label>
                              <input type="text" class="form-control" name="telp" placeholder="Telp" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Position</label>
                              <input type="text" class="form-control" name="posisi" placeholder="Position" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Date of Birth</label>
															<input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="dob"/>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Address</label>
                              <textarea class="form-control" name="alamat" rows="8" cols="80" placeholder="Address" required></textarea>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Additional Information</label>
                              <input type="text" class="form-control" name="keterangan" placeholder="Additional Information" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Keluarga yang Bisa Dihubungi</label>
                              <input type="text" class="form-control" name="keluarga_yg_bisa_dihub" placeholder="Nama Kelurga yang Bisa Dihubungi" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Kontak Keluarga</label>
                              <input type="text" class="form-control" name="telp_keluarga_yg_bisa_dihub" placeholder="Kontak Keluarga" required>
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
									<!-- END OF EDIT STAFF -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script type="text/javascript">

				var staff;

				$(document).ready(function() {
				    staff = $('#staff').DataTable({
				        "processing": true,
				        "serverSide": true,
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('staff/data')?>",
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

				function changeValueSave() {
					$('#btnSave').text('Saving...');
					$('#btnSave').attr('disabled', true);
				}

				function add() {
					$('#btnAdd').text('Saving...');
					$('#btnAdd').attr('disabled', true);
					var url;

					url = "<?=site_url('staff/add_toteam')?>";

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
								swal("Success!", "Staff berhasil ditambahkan ke team!", "success");
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

					url = "<?=site_url('staff/add_toteam')?>";

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
						url: "<?=site_url('staff/removefromteam')?>",
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

				function add_staff() {
					save_method = 'add';
			    $('#form')[0].reset(); // reset form on modals
			    $('.form-group').removeClass('has-error'); // clear error class
			    $('.help-block').empty(); // clear error string
			    $('#createStaff').modal('show'); // show bootstrap modal
			    $('.modal-title').text('Add New Staff');
				}

				function save() {
					$('#btnSave').text('Saving...');
					$('#btnSave').attr('disabled', true);
					var url;

					url = "<?=site_url('staff/save')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#form').serialize(),
						success: function(data) {
							if (data.status) {
								$('#editStaff').modal('hide');
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

					url = "<?=site_url('staff/update')?>";

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
								swal("Success!", "Data staff berhasil diupdate!", "success");
								reload_table();
							}
							$('#btnUpdate').text('Update');
							$('#btnUpdate').attr('disabled', false);
						}
					});
				}

				function hideModal(){
					$("#editStaff").removeClass("in");
					$(".modal-backdrop").remove();
					$("#editStaff").hide();
				}

				function pad(num, places) {
					var zero = places - num.toString().length + 1;
					return Array(+(zero > 0 && zero)).join("0") + num;
				}

				function viewStaffDetail(id) {
					$.ajax({
						url: "<?=site_url('staff/getStaffDetail/')?>/" + id,
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
							if (data.team_id != null) {
								$('[id=team_pos]').html("#ADT" + pad(data.team_id, 3));
							} else {
								$('[id=team_pos]').html("-");
							}
							$('.modal-title').text('Staff ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function add_toteam(id) {
					$.ajax({
						url: "<?=site_url('staff/getStaffEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.staff_id);
							$('#addToTeam').modal('show');
							$('.modal-title').text('Update Data Staff ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function removeStaff(id) {
					swal({
					  title: "Are you sure?",
					  text: "You will not be able to recover this staff data!",
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
								url: "<?=site_url('staff/removeStaff/')?>" + id,
								type: "POST",
								data: {id: id},
								success: function(data) {
									swal("Deleted!", "Staff berhasil dihapus.", "success");
									reload_table();
								}
							});
					  } else {
					    swal("Cancelled", "Staff batal dihapus", "error");
					  }
					});
				}

				function change_toteam(id) {
					$.ajax({
						url: "<?=site_url('staff/getStaffEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.staff_id);
							$('[name=team_id]').val(data.team_id);
							$('#changeTeam').modal('show');
							$('.modal-title').text('Update Team Position ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function edit_staff(id) {
					$.ajax({
						url: "<?=site_url('staff/getStaffEditData/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.staff_id);
							$('[name=nama]').val(data.nama);
							$('[name=posisi]').val(data.posisi);
							$('[name=telp]').val(data.telp);
							$('[name=alamat]').val(data.alamat);
							$('[name=keterangan]').val(data.keterangan);
							$('[name=dob]').val(data.dob);
							$('[name=keluarga_yg_bisa_dihub]').val(data.keluarga_yg_bisa_dihub);
							$('[name=telp_keluarga_yg_bisa_dihub]').val(data.telp_keluarga_yg_bisa_dihub);
							$('#editStaff').modal('show');
							$('.modal-title').text('Update Data Staff ' + data.nama);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function reload_table() {
					staff.ajax.reload(null, false);
				}
			</script>
