<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <button type="button" href="" onclick="add_cluster()" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createvehicles">
                    <i class="fas fa-plus"></i> &nbsp;Tambah Data Kendaraan
                  </button>
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="createvehicles" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Tambah Data Kendaraan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
                					<form class="" method="post" action="<?=site_url('kendaraan/save')?>">
                            <div class="form-group">
                              <label for="inputAddress2">Nomor Polisi</label>
                              <input type="text" class="form-control" name="plat_kendaraan" placeholder="" >
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Jenis Kendaraan</label>
                              <select class="form-control selectpicker" name="jenis_kendaraan">
																<option value="" selected disabled readonly>PILIH JENIS KENDARAAN</option>
                                <option value="Motor">Motor</option>
                                <option value="Mobil">Mobil</option>
                              </select>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tipe Kendaraan</label>
                              <input type="text" class="form-control" name="tipe_kendaraan" placeholder="" >
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Masa KIR</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="masa_kir" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">KM Akhir</label>
                              <input type="text" class="form-control" name="km_akhir" placeholder="" >
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tanggal Pajak</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_pajak" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tanggal STNK</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_stnk" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tanggal Service</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_service" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Keterangan</label>
                              <textarea name="keterangan" class="form-control" rows="8" cols="80"></textarea>
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
									<table cellspacing="0" class="table table-bordered" id="vehicles" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
												<th>Jenis<br>Kendaraan</th>
												<th>Tipe<br>Kendaraan</th>
												<th>NO POL</th>
												<th>TGL PAJAK</th>
												<th>TGL STNK</th>
												<th>TGL SERVICE</th>
                        <!-- <th>Posisi</th> -->
												<th style="white-space:nowrap;" width="100">Action</th>
											</tr>
										</thead>
									</table>
									<!-- EDIT vehicles -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editVehicle" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Ubah Data Kendaraan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<form class="" id="form_update" action="#">
														<input type="hidden" name="id" value="">
                            <div class="form-group">
                              <label for="inputAddress2">Nomor Polisi</label>
                              <input type="text" class="form-control" name="plat_kendaraan_e" placeholder="" >
                            </div>
                            <div class="form-group">
                              <label for="inputAddress2">Jenis Kendaraan</label>
															<select class="form-control selectpicker" name="jenis_kendaraan_e" id="jenis_kendaraan_e">
																<option value="Motor">Motor</option>
																<option value="Mobil">Mobil</option>
															</select>
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tipe Kendaraan</label>
                              <input type="text" class="form-control" name="tipe_kendaraan_e" placeholder="" >
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Masa KIR</label>
                              <input type="text" class="form-control" name="masa_kir_e" placeholder="" >
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">KM Akhir</label>
                              <input type="text" class="form-control" name="km_akhir_e" placeholder="" >
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tanggal Pajak</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_pajak_e" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tanggal STNK</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_stnk_e" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Tanggal Service</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_service_e" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Keterangan</label>
                              <textarea name="keterangan_e" class="form-control" rows="8" cols="80"></textarea>
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
									<!-- END OF EDIT vehicles -->
									<!-- SERVICE -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="service" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Ubah Data Kendaraan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<form class="" id="form_service" action="#">
														<input type="hidden" name="ids" value="">
                            <div class="form-group">
                              <label for="inputAddress2">Tanggal Service</label>
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="tgl_service_s" placeholder="" />
                            </div>
														<div class="form-group">
                              <label for="inputAddress2">Keterangan Service</label>
                              <textarea name="keterangan_service_s" class="form-control" rows="8" cols="80"></textarea>
                            </div>
	                				</div>
													</form>
	                				<div class="modal-footer">
														<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
														<button class="btn btn-primary" data-dismiss="modal" type="button" id="btnService" onclick="servicePressed()">Submit</button>
	                				</div>
                				</div>
                			</div>
                		</div>
                	</div>
									<!-- END OF SERVICE -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
			<script type="text/javascript">

				var vehicles;

				$(document).ready(function() {
				    vehicles = $('#vehicles').DataTable({
				        "processing": true,
				        "serverSide": true,
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('kendaraan/data')?>",
				            "type": "POST"
				        }, "columnDefs": [
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

        $('#new_site_div').hide();

        $(document).ready(function() {
					$('#site_id').change(function() {
						if ($(this).val() === 'new_site') {
							$('#new_site_div').show();
						} else {
							$('#new_site_div').hide();
						}
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

				function service(id) {
					$.ajax({
						url: "<?=base_url('kendaraan/getVehiclesData/')?>"+id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=ids]').val(data.kendaraan_id);
							$('[name=tgl_service_s]').val("");
							$('[name=keterangan_service_s]').val("");
						}
					});
				}

				function edit_vehicle(id) {
					$.ajax({
						url: "<?=base_url('kendaraan/getVehiclesData/')?>"+id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.kendaraan_id);
							$('[name=plat_kendaraan_e]').val(data.plat_kendaraan);
							$('[name=tipe_kendaraan_e]').val(data.tipe_kendaraan);
							if (data.tgl_pajak != null) {
								$('[name=tgl_pajak_e]').val(data.tgl_pajak);
							} else {
								$('[name=tgl_pajak_e]').val("");
							}
							if (data.tgl_stnk != null) {
								$('[name=tgl_stnk_e]').val(data.tgl_stnk);
							} else {
								$('[name=tgl_stnk_e]').val("");
							}
							if (data.tgl_service != null) {
								$('[name=tgl_service_e]').val(data.tgl_service);
							} else {
								$('[name=tgl_service_e]').val("");
							}
							if (data.masa_kir != null) {
								$('[name=masa_kir_e]').val(data.masa_kir);
							} else {
								$('[name=masa_kir_e]').val("");
							}
							$('[name=km_akhir_e]').val(data.km_akhir);
							if (data.keterangan != "") {
								$('[name=keterangan_e]').val(data.keterangan);
							} else {
								$('[name=keterangan_e]').val("");
							}
							$('#jenis_kendaraan_e option[value='+data.jenis_kendaraan+']').attr('selected', true);
							$('.selectpicker').selectpicker('render');
						}
					});
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

					url = "<?=site_url('kendaraan/update')?>";

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
								swal("Success!", "Data kendaraan berhasil diupdate!", "success");
								reload_table();
							}
							$('#btnUpdate').text('Update');
							$('#btnUpdate').attr('disabled', false);
						}
					});
				}

				function servicePressed() {
					$('#btnService').text('Updating...');
					$('#btnService').attr('disabled', true);
					var url;

					url = "<?=site_url('kendaraan/serviceUpdate')?>";

					$.ajax({
						url: url,
						type: "POST",
						data: $('#form_service').serialize(),
						success: function(data) {
							if (data.status = 'true') {
								$('.modal').removeClass('show');
								$('.modal').removeClass('in');
	              $('.modal').attr("aria-hidden","true");
	              $('.modal-backdrop').remove();
	              $('body').removeClass('modal-open');
								$('#alert').modal('show');
								swal("Success!", "Data service kendaraan berhasil disubmit!", "success");
								reload_table();
							}
							$('#btnService').text('Update');
							$('#btnService').attr('disabled', false);
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

				// function removeVehicle(id) {
				// 	swal({
				// 	  title: "Are you sure?",
				// 	  text: "You will not be able to recover this site data!",
				// 	  type: "warning",
				// 	  showCancelButton: true,
				// 	  confirmButtonClass: "btn-danger",
				// 	  confirmButtonText: "Yes, delete it!",
				// 	  cancelButtonText: "No, cancel pls!",
				// 	  closeOnConfirm: false,
				// 	  closeOnCancel: false
				// 	},
				// 	function(isConfirm) {
				// 	  if (isConfirm) {
				// 			$.ajax({
				// 				url: "<?=site_url('kendaraan/removeVehicle/')?>" + id,
				// 				type: "POST",
				// 				data: {id: id},
				// 				success: function(data) {
				// 					swal("Deleted!", "Kendaraan berhasil dihapus.", "success");
				// 					reload_table();
				// 				}
				// 			});
				// 	  } else {
				// 	    swal("Cancelled", "Site batal dihapus", "error");
				// 	  }
				// 	});
				// }

				function reload_table() {
					vehicles.ajax.reload(null, false);
				}
			</script>
