<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
                    Create New Team
                  </button>
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">New Team</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
                					<form class="" action="<?=site_url('team/save')?>" method="post">
                            <!-- <div class="form-group">
                              <label for="inputAddress2">Select Staff</label>
															<br>
															<input type="text" class="form-control" value="" data-role="tagsinput" />
															<script>
															var staffnames = new Bloodhound({
															  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
															  queryTokenizer: Bloodhound.tokenizers.whitespace,
															  prefetch: {
															    url: 'assets/stafflist.json',
															    filter: function(list) {
															      return $.map(list, function(staffname) {
															        return { name: nama }; });
															    }
															  }
															});
															staffnames.initialize();

															$('input').tagsinput({
															  typeaheadjs: {
															    name: 'staffnames',
															    displayKey: 'nama',
															    valueKey: 'staff_id',
															    source: staffnames.ttAdapter()
															  }
															});
															</script>
                            </div> -->
														<div class="form-group">
															<label for="">Pilih Cluster</label>
															<select class="selectpicker form-control" name="cluster" data-live-search="true">
																<option selected>SELECT CLUSTER</option>
																<?php foreach ($cluster_list->result() as $cluster_data): ?>
																	<option value="<?=$cluster_data->cluster_id?>"><?=$cluster_data->wilayah?> / <?=$cluster_data->homebase?></option>
																<?php endforeach; ?>
															</select>
														</div>
														<div class="form-group">
															<label for="">MAC Address</label>
															<input type="text" class="form-control" name="mac_address" value="">
														</div>
														<div class="form-group">
															<label for="">Jumlah Genset 7,5 KVA</label>
															<input type="text" class="form-control" name="genset_mobile_75" value="">
														</div>
														<div class="form-group">
															<label for="">Jumlah Genset 10 KVA</label>
															<input type="text" class="form-control" name="genset_mobile_10" value="">
														</div>
														<div class="form-group">
															<label for="">Jumlah Genset 12 KVA</label>
															<input type="text" class="form-control" name="genset_mobile_12" value="">
														</div>
														<div class="form-group">
															<label for="">Kendaraan</label>
															<select style="width:100%;" class="form-control" id="kendaraan" name="kendaraan[]" multiple="multiple">
																<?php foreach ($kendaraan_list->result() as $kendaraan_data): ?>
																	<option value="<?=$kendaraan_data->kendaraan_id?>"><?=$kendaraan_data->plat_kendaraan?></option>
																<?php endforeach; ?>
															</select>
														</div>
                				</div>
                				<div class="modal-footer">
                					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button> <input type="submit" name="" value="Save" class="btn btn-primary">
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
									<table cellspacing="0" class="table table-striped table-bordered" id="team" width="100%">
										<thead>
                      <tr>
                        <th style="border:#fff"></th>
                        <th width="4" style="border:#fff"></th>
                        <th style="border:#fff"></th>
                        <th colspan="3" class="text-center">GENSET</th>
                        <!-- <th colspan="3" class="text-center">GENSET FIX</th> -->
                        <th style="border:#fff"></th>
                      </tr>
											<tr>
												<th class="text-center" width="30">NO</th>
												<th class="text-center" width="250">Cluster</th>
												<th class="text-center">MAC Address</th>
												<th class="text-center">Total<br>Genset</th>
                        <th class="text-center">Genset<br>7,5 KVA</th>
                        <th class="text-center">Genset<br>10 KVA</th>
                        <th class="text-center">Genset<br>12 KVA</th>
                        <!-- <th class="text-center">Genset<br>7,5 KVA</th>
                        <th class="text-center">Genset<br>10 KVA</th>
												<th class="text-center">Genset<br>12 KVA</th> -->
												<?php if (isAdministrator() || isApproval()): ?>
                          <th class="text-center" width="150">Action</th>
                        <?php endif; ?>
											</tr>
										</thead>
									</table>
									<!-- DETAIL TEAM -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detailTeam" role="dialog" tabindex="-1">
										<div class="modal-dialog modal-lg" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLabel">New Staff</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
												</div>
												<div class="modal-body">
													<table class="table">
														<tbody>
															<tr>
																<th width="250">Cluster</th>
																<td><span id="cluster"></span></td>
															</tr>
															<tr>
																<th width="250">MAC Address</th>
																<td><span id="mac_add"></span></td>
															</tr>
															<tr>
																<th width="250">Jumlah Genset 7,5 KVA</th>
																<td><span id="genset_75"></span></td>
															</tr>
															<tr>
																<th width="250">Jumlah Genset 10 KVA</th>
																<td><span id="genset_10"></span></td>
															</tr>
															<tr>
																<th width="250">Jumlah Genset 12 KVA</th>
																<td><span id="genset_12"></span></td>
															</tr>
															<tr>
																<th width="250">Anggota Tim</th>
																<td><span id="anggota"></span></td>
															</tr>
															<tr>
																<th width="250">Nomor Telepon</th>
																<td><span id="telpon"></span></td>
															</tr>
															<tr>
																<th width="250">Kendaraan</th>
																<td><span id="kendaraan"></span></td>
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
									<!-- END OF DETAIL TEAM -->
									<!-- EDIT STAFF -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editTeam" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Edit Team</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<form class="" id="form_update" action="#">
														<input type="hidden" name="id" value="">
                            <div class="form-group">
                              <label for="inputAddress2">Mac Address</label>
                              <input type="text" class="form-control" name="mac_address_e" placeholder="Mac Address" required>
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Genset 7.5</label>
                              <input type="text" class="form-control" name="genset_mobile_75_e" placeholder="Genset 7.5" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Genset 10</label>
                              <input type="text" class="form-control" name="genset_mobile_10_e" placeholder="Genset 10" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Genset 12</label>
                              <input type="text" class="form-control" name="genset_mobile_12_e" placeholder="Genset 12" required>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Cluster</label>
                              <select class="form-control selectpicker" id="cluster_id_e" name="cluster_id_e" data-live-search="true">
																<?php foreach ($cluster_list->result() as $key => $value): ?>
																	<option value="<?=$value->cluster_id?>"><?=$value->homebase . " - " . $value->wilayah?></option>
																<?php endforeach; ?>
                              </select>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Kendaraan</label>
															<select style="width:100%;" class="form-control" id="kendaraan_e" name="kendaraan_e[]" multiple="multiple">
																<?php foreach ($kendaraan_list->result() as $kendaraan_data): ?>
																	<option value="<?=$kendaraan_data->kendaraan_id?>"><?=$kendaraan_data->plat_kendaraan?></option>
																<?php endforeach; ?>
															</select>
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
				$(document).ready(function() {
					$("#kendaraan").select2({
						placeholder: "Pilih Kendaraan"
					});
					$("#kendaraan_e").select2({
						placeholder: "Pilih Kendaraan"
					});
				});

				var team;

				$(document).ready(function() {
				    team = $('#team').DataTable({
				        "processing": true,
				        "serverSide": true,
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('team/data')?>",
				            "type": "POST"
				        },
								"columnDefs": [
						      {
						          "targets": [ -1 ],
						          "orderable": false
						      },
									{
										"class": "dt-center",
										"targets": [1, 2, 3, 4, 5, 6, 7]
									}
				        ],
				    });
				});

				function edit_team(id) {
					$.ajax({
						url: "<?=base_url('team/getTeamData/')?>"+id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.team_id);
							$('[name=mac_address_e]').val(data.mac_address);
							$('[name=genset_mobile_75_e]').val(data.genset_mobile_75);
							$('[name=genset_mobile_10_e]').val(data.genset_mobile_10);
							$('[name=genset_mobile_12_e]').val(data.genset_mobile_12);
							$('#cluster_id_e option[value='+data.cluster_id+']').attr('selected', true);
							$('.selectpicker').selectpicker('render');
							var input = data.kendaraan_id;
							var output = input.replace(",", "\",\"");
							var akhir = output;
							// console.log("\[\""+akhir+"\"\]");
							console.log(akhir);
							$('#kendaraan_e').select2("val", '["'+akhir+'"]');
						}
					});
				}

				function reload_table() {
					team.ajax.reload(null, false);
				}

				function update() {
					$('#btnUpdate').text('Updating...');
					$('#btnUpdate').attr('disabled', true);
					var url;

					url = "<?=site_url('team/update')?>";

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
								console.log($('#kendaraan_e').val());
								swal("Success!", "Data team berhasil diupdate!", "success");
								reload_table();
							}
							$('#btnUpdate').text('Update');
							$('#btnUpdate').attr('disabled', false);
						}
					});
				}

				function removeTeam(id) {
					swal({
					  title: "Are you sure?",
					  text: "You will not be able to recover this team data!",
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
								url: "<?=site_url('team/removeTeam/')?>" + id,
								type: "POST",
								data: {id: id},
								success: function(data) {
									swal("Deleted!", "Team berhasil dihapus.", "success");
									reload_table();
								}
							});
					  } else {
					    swal("Cancelled", "Team batal dihapus", "error");
					  }
					});
				}

				function detailTeam(id) {
					$.ajax({
						url: "<?=site_url('team/getTeamDetail/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('id').html(data.id);
							$('[id=cluster]').html(data.homebase+" - "+data.wilayah);
							if (data.mac_address != null) {
								$('[id=mac_add]').html(data.mac_address);
							} else {
								$('[id=mac_add]').html("-");
							}
							$('[id=genset_75]').html(data.genset_mobile_75);
							$('[id=genset_10]').html(data.genset_mobile_10);
							$('[id=genset_12]').html(data.genset_mobile_12);
							$('[id=kendaraan]').html(data.plat);
							$.ajax({
								url: "<?=site_url('team/getAnggota/')?>" + id,
								type: "GET",
								dataType: "json",
								success: function(ang) {
									$('[id=anggota]').html(ang.join(", "));
								}
							});
							$.ajax({
								url: "<?=site_url('team/getAnggotaTelp/')?>" + id,
								type: "GET",
								dataType: "json",
								success: function(telp) {
									$('[id=telpon]').html(telp.join(", "));
								}
							});
							$('.modal-title').text('CLUSTER ' + data.homebase);
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}
			</script>
