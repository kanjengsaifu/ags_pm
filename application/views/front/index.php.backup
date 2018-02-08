<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
									<div class="row gap-20">
										<div class="col-md-3">
											<div class="layers bd bgc-white p-20">
												<div class="layer w-100 mB-10">
													<h6 class="lh-1">Total Pengajuan</h6>
												</div>
												<div class="layer w-100">
													<div class="peers ai-sb fxw-nw">
														<div class="peer peer-greed">
															<i class="fas fa-signal"></i>
															<!-- <span id="sparklinedash"></span> -->
															<!-- <canvas height="20" style="display: inline-block; width: 45px; height: 20px; vertical-align: top;" width="45">
																<span id="sparklinedash"></span>
															</canvas> -->
														</div>
														<div class="peer">
															<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">
																<?=$totalpengajuan?>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-3">
											<div class="layers bd bgc-white p-20">
												<div class="layer w-100 mB-10">
													<h6 class="lh-1">Pengajuan Terhold</h6>
												</div>
												<div class="layer w-100">
													<div class="peers ai-sb fxw-nw">
														<div class="peer peer-greed">
															<i class="fas fa-signal"></i>
														</div>
														<div class="peer">
															<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">
																<?=$pengajuanterhold?>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<br>
									<?php if (isViewer()): ?>
										<button type="button" name="button" class="btn btn-outline-primary" id="custom_filter_btn">SHOW CUSTOM FILTER</button>
										<br>

										<!-- PENGAJUAN DETAIL -->
										<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detailPengajuan" role="dialog" tabindex="-1">
	                		<div class="modal-dialog modal-lg" role="document" id="modalDetail">
	                			<div class="modal-content">
	                				<div class="modal-header">
	                					<h5 class="modal-title" id="exampleModalLabel">Pengajuan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
	                				</div>
	                				<div class="modal-body">
														<table class="table">
															<tbody>
																<tr>
																	<th width="250">Kategori Pengajuan</th>
																	<td><span id="kategori_pengajuan_val"></span></td>
																</tr>
																<tr id="nama_project_div">
																	<th width="250">Nama Project</th>
																	<td><span id="nama_project_val"></span></td>
																</tr>
																<tr id="jenis_pengajuan_div">
																	<th width="250">Jenis Pengajuan</th>
																	<td><span id="jenis_pengajuan_val"></span></td>
																</tr>
																<tr>
																	<th width="250">Pengajuan</th>
																	<td><span id="pengajuan"></span></td>
																</tr>
																<tr>
																	<th width="250">Diajukan pada</th>
																	<td><span id="tanggal_pengajuan"></span></td>
																</tr>
																<tr>
																	<th width="250">Realisasi Pengajuan</th>
																	<td><span id="realisasi_pengajuan"></span></td>
																</tr>
																<tr id="tanggal_approval_keuangan_div">
																	<th width="250">Tanggal Approval Keuangan</th>
																	<td><span id="tanggal_approval_keuangan"></span></td>
																</tr>
																<tr id="nilai_sph_div_det">
																	<th width="250">Nilai SPH</th>
																	<td><span id="nilai_sph_val"></span></td>
																</tr>
																<tr id="no_sph_div_det">
																	<th width="250">Nomor SPH</th>
																	<td><span id="no_sph_val"></span></td>
																</tr>
																<tr id="nilai_corr_div_det">
																	<th width="250">Nilai Corr</th>
																	<td><span id="nilai_corr_val"></span></td>
																</tr>
																<tr id="no_corr_div_det">
																	<th width="250">Nomor Corr</th>
																	<td><span id="no_corr_val"></span></td>
																</tr>
																<tr id="nilai_po_div_det">
																	<th width="250">Nilai PO</th>
																	<td><span id="nilai_po_val"></span></td>
																</tr>
																<tr id="no_po_div_det">
																	<th width="250">Nomor PO</th>
																	<td><span id="no_po_val"></span></td>
																</tr>
																<tr id="nilai_pengajuan_div_det">
																	<th width="250">Nilai Pengajuan</th>
																	<td><span id="nilai_pengajuan_val"></span></td>
																</tr>
																<tr id="pid_div_det">
																	<th width="250">PID (Site ID)</th>
																	<td><span id="pid_val"></span></td>
																</tr>
																<tr id="no_spk_div_det">
																	<th width="250">Nomor SPK</th>
																	<td><span id="no_spk_val"></span></td>
																</tr>
																<tr id="start_penawaran_dmt_div_det">
																	<th width="250">Start Penawaran DMT</th>
																	<td><span id="start_penawaran_dmt_val"></span></td>
																</tr>
																<tr>
																	<th width="250">Keterangan</th>
																	<td><span id="keterangan"></span></td>
																</tr>
																<tr>
																	<th width="250">Pengaju</th>
																	<td><span id="pengaju"></span></td>
																</tr>
																<tr id="bukti_src_div">
																	<th width="250">Bukti</th>
																	<td>
																		<div class="" id="bukti">

																			<div id="bukti_dokumen"></div>

																			<div class="" id="mult_img_row1">
																			</div>

																			<div id="myModal" style="height:100%" class="modal" data-backdrop="static" data-keyboard="false">
																			  <span class="close cursor" onclick="closeModal()">&times;</span>
																			  <div class="modal-content">

																			    <div class="" id="mult_img_row2">
																			    </div>

																			    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
																			    <a class="next" onclick="plusSlides(1)">&#10095;</a>

																			    <div class="caption-container">
																			      <p id="caption"></p>
																			    </div>


																			    <div class="" id="mult_img_row3">
																			    </div>

																					<div class="modal-footer">
																						<button class="btn btn-secondary" onclick="closeModal()" type="button">Close</button>
																					</div>
																			  </div>
																			</div>
																		</div>
																		<!-- <button type="button" name="button" class="btn btn-outline-primary" id="print_bukti">PRINT BUKTI</button> -->
																	</td>
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
										<!-- END OF PENGAJUAN DETAIL -->


	                </div>
	                <br>
									<!-- CUSTOM FILTER -->
									<div id="custom_filter" class="bgc-white bd bdrs-3 p-20 mB-20">
										<h4 class="c-grey-900 mB-20">Custom Filter : </h4>
					                <form id="form-filter" class="form-horizontal">

															<input type="hidden" name="belum_diapprove_val" id="belum_diapprove_val" value="N">
															<input type="hidden" name="belum_diprint_val" id="belum_diprint_val" value="N">
															<input type="hidden" name="on_progress_val" id="on_progress_val" value="N">
															<input type="hidden" name="semua_pengajuan_val" id="semua_pengajuan_val" value="N">
															<input type="hidden" name="history_val" id="history_val" value="N">
															<input type="hidden" name="progress_project_val" id="progress_project_val" value="N">

					                    <div class="form-group">
					                        <label for="FirstName" class="col-sm-2 control-label">Pengajuan</label>
					                        <div class="col-sm-6">
					                            <input type="text" name="pengajuan" class="form-control" id="pengajuan_filter">
					                        </div>
					                    </div>
															<div class="form-group">
																<label for="LastName" class="col-sm-2 control-label">Kategori Pengajuan</label>
																<div class="col-sm-6">
																	<select id="kategori_pengajuan_filter" style="width:100%;" class="form-control selectpicker" name="kategori_pengajuan_filter">
																		<option value="" selected disabled readonly>KATEGORI PENGAJUAN</option>
																		<option value="Project">Project</option>
																		<option value="Non Project">Non Project</option>
																	</select>
																</div>
															</div>
															<div class="form-group">
																<label for="LastName" class="col-sm-2 control-label">Jenis Pengajuan</label>
																<div class="col-sm-6">
																	<select id="jenis_pengajuan_filter" style="width:100%;" class="form-control selectpicker" name="jenis_pengajuan_filter">
																		<option value="" selected disabled readonly>JENIS PENGAJUAN</option>
																		<?php foreach ($kategori_pengajuan as $data_k): ?>
																			<option value="<?=$data_k?>"><?=strtoupper($data_k)?></option>
																		<?php endforeach; ?>
																	</select>
																</div>
															</div>
					                    <div class="form-group">
																<label for="LastName" class="col-sm-2 control-label">Tanggal Pengajuan</label>
																<div class="col-sm-6">
																	<select class="form-control selectpicker" name="" id="tanggal_pengajuan_jns_op">
																		<option value="" selected disabled readonly>JENIS SELECTOR</option>
																		<option value="satuan_val">Per Tanggal</option>
																		<option value="range_val">Range</option>
																	</select>
																	<div style="padding:5px 0px;" id="tanggal_pengajuan_satuan">
																		<input name="tanggal_pengajuan" type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_pengajuan_filter" id="tanggal_pengajuan_filter">
																	</div>
																	<div style="padding:5px 0px;" id="tanggal_pengajuan_range">
																		<input name="tanggal_pengajuan_first" type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_pengajuan_first_filter" id="tanggal_pengajuan_first_filter" placeholder="Dari Tanggal">
																		<input name="tanggal_pengajuan_last" type="text" class="form-control datepicker-here" style="z-index: 99999 !important;margin-top:5px;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_pengajuan_last_filter" id="tanggal_pengajuan_last_filter" placeholder="ke Tanggal">
																	</div>
																</div>
					                    </div>
															<div class="form-group">
																<label for="LastName" class="col-sm-2 control-label">Realisasi Pengajuan</label>
																<div class="col-sm-6">
																	<select class="form-control selectpicker" name="" id="realisasi_pengajuan_jns_op">
																		<option value="" selected disabled readonly>JENIS SELECTOR</option>
																		<option value="r_satuan_val">Per Tanggal</option>
																		<option value="r_range_val">Range</option>
																	</select>
																	<div style="padding:5px 0px;" id="realisasi_pengajuan_satuan">
																		<input name="realisasi_pengajuan" type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="realisasi_pengajuan_filter" id="realisasi_pengajuan_filter">
																	</div>
																	<div style="padding:5px 0px;" id="realisasi_pengajuan_range">
																		<input name="realisasi_pengajuan_first" type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="realisasi_pengajuan_first_filter" id="realisasi_pengajuan_first_filter" placeholder="Dari Tanggal">
																		<input name="realisasi_pengajuan_last" type="text" class="form-control datepicker-here" style="z-index: 99999 !important;margin-top:5px;" data-date-format="yyyy-mm-dd" data-language='en' name="realisasi_pengajuan_last_filter" id="realisasi_pengajuan_last_filter" placeholder="ke Tanggal">
																	</div>
																</div>
					                    </div>
															<?php if (!isAdminTasik()): ?>
																<div class="form-group">
						                        <label for="LastName" class="col-sm-2 control-label">Nama Pengaju</label>
						                        <div class="col-sm-6">
						                            <select class="form-control selectpicker" id="nama_pengaju_filter">
																					<option value="" selected disabled readonly>SELECT PENGAJU</option>
																					<?php foreach ($getPengajuUser->result() as $key => $value): ?>
																						<option value="<?=$value->user_id?>"><?=$value->name?></option>
																					<?php endforeach; ?>
						                            </select>
						                        </div>
						                    </div>
															<?php endif; ?>
															<!-- <div class="form-group">
																<label for="LastName" class="col-sm-2 control-label">Progress Pengajuan</label>
																<div class="col-sm-6">
																	<label for=""> <input type="checkbox" id="check_invoiced" name="check_invoiced" value="Y"> Invoiced </label> &nbsp;&nbsp;&nbsp;
																	<label for=""> <input type="checkbox" id="check_bayar" name="check_bayar" value="Y"> Sudah Dibayar </label> &nbsp;&nbsp;&nbsp;
																	<label for=""> <input type="checkbox" id="check_bayarclient" name="check_bayarclient" value="Y"> Sudah Dibayar Client </label> &nbsp;&nbsp;&nbsp;
																</div>
															</div> -->
															<div class="form-group">
					                        <label for="LastName" class="col-sm-2 control-label"></label>
					                        <div class="col-sm-4">
					                            <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
					                            <button type="button" id="btn-reset" class="btn btn-default">Reset</button>
					                        </div>
					                    </div>
					                </form>
					        </div>
									<!-- END OF CUSTOM FILTER -->
									<?php if (isNotification()): ?>
										<div class="alert alert-success alert-dismissable">
										  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Success!</strong> <?=notificationMessage()?>
										</div>
									<?php endif; ?>
									<div class="bgc-white bd bdrs-3 p-20 mB-20">

										<?php if (isApproval()): ?>
											<button type="button" class="btn cur-p btn-success" id="belum_diapprove">
		                    BELUM DIAPPROVE
		                  </button>
										<?php endif; ?>
										<?php if (isAdminJakarta()): ?>
											<button type="button" class="btn cur-p btn-success" id="belum_diprint">
		                    BELUM DIPRINT
		                  </button>
											<button type="button" class="btn cur-p btn-secondary" id="on_progress">
		                    ON PROGRESS
		                  </button>
											<!-- <button type="button" class="btn cur-p btn-success" id="progress_project_btn">
		                    PROGRESS PROJECT
		                  </button> -->
											<button type="button" class="btn cur-p btn-success" id="history_btn">
												HISTORY
											</button>
										<?php endif; ?>
										<button type="button" class="btn cur-p btn-outline-primary" onclick="reload_table()">
	                    Reload Data
	                  </button>
										<?php if (isApproval()): ?>
											<br><br>
											<button type="button" class="btn cur-p btn-success" onclick="approveTerpilih()">
		                    APPROVE YANG TERPILIH
		                  </button>
											<button type="button" class="btn cur-p btn-success" onclick="approveSemuaPengajuan()">
		                    APPROVE SEMUA PENGAJUAN
		                  </button>
										<?php endif; ?>
										<br>
										<?php if (isAdminJakarta()): ?>
											<br>
											<!-- <button type="button" class="btn cur-p btn-secondary" onclick="reload_table()">
		                    EXPORT TO EXCEL
		                  </button> -->
											<a id="print" class="btn btn-outline-primary" target="_blank" href="<?=site_url('submission/print')?>">PRINT</a>
											<a id="print_c" class="btn btn-outline-primary" target="_blank" href="<?=site_url('submission/printTerpilih')?>">PRINT ULANG YANG TERPILIH</a>
											<a id="acc" class="btn btn-outline-primary" onclick="accTerpilih()">ACC YANG TERPILIH</a>
										<?php endif; ?>
										<hr>
										Menampilkan <span id="menampilkan">Semua Pengajuan <?php if(isApproval()) { echo "Anda"; } ?></span>
										<br><br>
										<table cellspacing="0" class="table table-striped table-bordered" id="submission_admin" width="100%">
											<thead>
												<tr>
													<th class="text-center" style="width:30px">NO</th>
													<th class="text-center" style="width:100px">KODE<br>PENGAJUAN</th>
													<th class="text-center">Pengajuan</th>
	                        <th class="text-center">Tanggal<br>Pengajuan</th>
													<?php if (!(isAdminJakarta() || isApproval())): ?>
														<th class="text-center">Tanggal<br>Approval</th>
														<th class="text-center">Tanggal<br>Approval Keuangan</th>
													<?php endif; ?>
	                        <th class="text-center">Realisasi<br>Pengajuan</th>
													<!-- <th class="text-center" id="invoiced_stat">Invoiced</th>
													<th class="text-center" id="bayar_stat">Bayar</th>
													<th class="text-center" id="client_stat">Bayar<br>Client</th> -->
	                        <th class="text-center" style="width:200px;">ACTION</th>
												</tr>
											</thead>
										</table>
									<?php endif; ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

			<script type="text/javascript">
				$(document).ready(function() {
						submission_admin = $('#submission_admin').DataTable({
								"processing": true,
								"serverSide": true,
								// "language"	: {
								// 	"info": "Menampilkan halaman _PAGE_ of _PAGES_"
								// },
								"order": [],
								"ajax": {
										"url": "<?php echo site_url('admin/data')?>",
										"type": "POST",
										"data": function(data) {
											data.on_progress = $('#on_progress_val').val();
											data.belum_diprint = $('#belum_diprint_val').val();
											data.history = $('#history_val').val();
											data.progress_project = $('#progress_project_val').val();
											data.semua_pengajuan = $('#semua_pengajuan_val').val();
											data.belum_diapprove = $('#belum_diapprove_val').val();

											data.is_printed = $('#hold').val();
											data.pengajuan = $('#pengajuan_filter').val();
											data.tanggal_pengajuan = $('#tanggal_pengajuan_filter').val();
											data.tanggal_pengajuan_first = $('#tanggal_pengajuan_first_filter').val();
											data.tanggal_pengajuan_last = $('#tanggal_pengajuan_last_filter').val();
											data.realisasi_pengajuan = $('#realisasi_pengajuan_filter').val();
											data.realisasi_pengajuan_first = $('#realisasi_pengajuan_first_filter').val();
											data.realisasi_pengajuan_last = $('#realisasi_pengajuan_last_filter').val();
											data.nama_pengaju = $('#nama_pengaju_filter').val();
											data.check_invoiced = $('#check_invoiced').val();
											data.check_bayar = $('#check_bayar').val();
											data.check_bayarclient = $('#check_bayarclient').val();
											data.jenis_pengajuan = $('#jenis_pengajuan_filter').val();
											data.kategori_pengajuan = $('#kategori_pengajuan_filter').val();
										}
								}, "columnDefs": [
									// {
									// 	"className": "stat",
									// 	"targets": [6,7,8]
									// },
									{
										"targets": 0,
										"checkboxes": true,
										"orderable": false
									},
									{
										"targets": [ -1 ],
										"orderable": false
									}, {
										"className"	: "dt-center",
										"targets"		: [1, 2, 4, 5, 6, 7]
									}
								],
						});

						// $(document).ready(function() {
						// 	if (!isAdminTasik()) {
						// 		document.getElementById("belum_diprint_val").value = "Y";
						// 	}
						// 	submission.ajax.reload();  //just reload table
						// });

						$('#btn-filter').click(function() { //button filter event click
							submission_admin.ajax.reload();  //just reload table
						});
				});

				$('#custom_filter').hide();

				$(document).ready(function() {
					$('#custom_filter_btn').click(function() {
						if ($('#custom_filter_btn').text() === "SHOW CUSTOM FILTER") {
							$('#custom_filter').show();
						} else {
							$('#custom_filter').hide();
						}

						$('#custom_filter_btn').text(function(i, v) {
							return v === 'SHOW CUSTOM FILTER' ? 'HIDE CUSTOM FILTER' : 'SHOW CUSTOM FILTER'
						});
					});
				});


				$('#tanggal_pengajuan_satuan').hide();
				$('#tanggal_pengajuan_range').hide();
				$('#realisasi_pengajuan_satuan').hide();
				$('#realisasi_pengajuan_range').hide();

				$(document).ready(function() {
					$('#tanggal_pengajuan_jns_op').change(function() {
						if ($(this).val() === 'satuan_val') {
							$('#tanggal_pengajuan_satuan').show();
							$('#tanggal_pengajuan_range').hide();
							document.getElementById('tanggal_pengajuan_filter').value = "";
							document.getElementById('tanggal_pengajuan_first_filter').value = "";
							document.getElementById('tanggal_pengajuan_last_filter').value = "";
						} else {
							$('#tanggal_pengajuan_satuan').hide();
							$('#tanggal_pengajuan_range').show();
							document.getElementById('tanggal_pengajuan_filter').value = "";
							document.getElementById('tanggal_pengajuan_first_filter').value = "";
							document.getElementById('tanggal_pengajuan_last_filter').value = "";
						}
					});
				});

				$(document).ready(function() {
					$('#realisasi_pengajuan_jns_op').change(function() {
						if ($(this).val() === 'r_satuan_val') {
							$('#realisasi_pengajuan_satuan').show();
							$('#realisasi_pengajuan_range').hide();
							document.getElementById('realisasi_pengajuan_filter').value = "";
							document.getElementById('realisasi_pengajuan_first_filter').value = "";
							document.getElementById('realisasi_pengajuan_last_filter').value = "";
						} else {
							$('#realisasi_pengajuan_satuan').hide();
							$('#realisasi_pengajuan_range').show();
							document.getElementById('realisasi_pengajuan_filter').value = "";
							document.getElementById('realisasi_pengajuan_first_filter').value = "";
							document.getElementById('realisasi_pengajuan_last_filter').value = "";
						}
					});
				});

				function monthDiff(d1, d2) {
					var months;
					months = (d2.getFullYear() - d1.getFullYear()) * 12;
					months -= d1.getMonth() + 1;
					months += d2.getMonth();
					return months <= 0 ? 0 : months;
				}

				function pad(num, places) {
					var zero = places - num.toString().length + 1;
					return Array(+(zero > 0 && zero)).join("0") + num;
				}

				function currency_format(num) {
					return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
				}

				$('#btn-filter').click(function() { //button filter event click
					submission_admin.ajax.reload();  //just reload table
				});

				$('#btn-reset').click(function() { //button reset event click
					$('#form-filter')[0].reset();
					$("#nama_pengaju_filter").val('default');
					$("#nama_pengaju_filter").selectpicker("refresh");
					$("#kategori_pengajuan_filter").val('default');
					$("#kategori_pengajuan_filter").selectpicker("refresh");
					$("#jenis_pengajuan_filter").val('default');
					$("#jenis_pengajuan_filter").selectpicker("refresh");
					$('#tanggal_pengajuan_satuan').hide();
					$('#tanggal_pengajuan_range').hide();
					$('#realisasi_pengajuan_satuan').hide();
					$('#realisasi_pengajuan_range').hide();
					submission_admin.ajax.reload();  //just reload table
				});

				function reload_table() {
					submission_admin.ajax.reload(null, false);
				}

				function detailPengajuan(id) {
					$('#mult_img_row1').html("");
					$('#mult_img_row2').html("");
					$('#mult_img_row3').html("");
					$('#bukti_dokumen').html("");
					$.ajax({
						url: "<?=site_url('submission/getPengajuanDetail/')?>/" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('id').html(data.pengajuan_id);
							if (data.jenis_pengajuan == "Non Project" || data.jenis_pengajuan == "Operasional") {
								$('[id=kategori_pengajuan_val]').html("NON-PROJECT");
								$('[id=jenis_pengajuan_val]').html(data.jenis_pengajuan);
								$('#no_spk_div_det').hide();
								$('#start_penawaran_dmt_div_det').hide();
								$('#nilai_sph_div_det').hide();
								$('#nilai_corr_div_det').hide();
								$('#nilai_po_div_det').hide();
								$('#nama_project_div').hide();
								$('#nilai_sph_div_det').hide();
								$('#no_sph_div_det').hide();
								$('#nilai_corr_div_det').hide();
								$('#no_corr_div_det').hide();
								$('#nilai_po_div_det').hide();
								$('#no_po_div_det').hide();
								$('#no_spk_div_det').hide();
							} else {
								$('[id=kategori_pengajuan_val]').html("PROJECT");
								$('[id=jenis_pengajuan_val]').html(data.jenis_pengajuan);
								if (data.nilai_sph != "0") {
									$('[id=nilai_sph_val]').html("Rp. " + currency_format(data.nilai_sph));
									$('[id=no_sph_val]').html(data.no_sph);
								} else {
									$('#nilai_sph_div_det').hide();
									$('#no_sph_div_det').hide();
								}
								if (data.nilai_corr != "0") {
									$('[id=nilai_corr_val]').html("Rp. " + currency_format(data.nilai_corr));
									$('[id=no_corr_val]').html(data.no_corr);
								} else {
									$('#nilai_corr_div_det').hide();
									$('#no_corr_div_det').hide();
								}
								if (data.nilai_po != "0") {
									$('[id=nilai_po_val]').html("Rp. " + currency_format(data.nilai_po));
									$('[id=no_po_val]').html(data.no_po);
								} else {
									$('#nilai_po_div_det').hide();
									$('#no_po_div_det').hide();
								}
								$('[id=nama_project_val]').html(data.nama_project);
								$('#jenis_pengajuan_div').show();
								$('#nama_project_div').show();
							}
							$('[id=pengajuan]').html(data.pengajuan);
							$('[id=nilai_pengajuan_val]').html("Rp. " + currency_format(data.nilai_pengajuan));
							$('[id=tanggal_pengajuan]').html(moment(data.tanggal_pengajuan).format('dddd, D MMMM Y HH:m:s'));
							$('[id=realisasi_pengajuan]').html(moment(data.realisasi_pengajuan).format('dddd, D MMMM Y'));
							if (data.tanggal_approval_keuangan != null) {
								$('#tanggal_approval_keuangan_div').show();
								$('[id=tanggal_approval_keuangan]').html(moment(data.tanggal_approval_keuangan).format('dddd, D MMMM Y'));
							} else {
								$('#tanggal_approval_keuangan_div').hide();
							}
							$('[id=pid_val]').html(data.id_site + ' / ' + data.nama_site);
							if (data.no_spk != "") {
								$('#no_spk_div_det').show();
								$('[id=no_spk_val]').html(data.no_spk);
							} else {
								$('#no_spk_div_det').hide();
							}
							if (data.start_penawaran_dmt != null) {
								$('#start_penawaran_dmt_div_det').show();
								$('[id=start_penawaran_dmt_val]').html(moment(data.start_penawaran_dmt).format('dddd, D MMMM Y') + " (Lama Progress : " +
								monthDiff(
									new Date(data.start_penawaran_dmt),
									new Date(data.tanggal_pengajuan)
								) + " bulan)"
							);
							}
							if (data.keterangan != "") {
								$('[id=keterangan]').html(data.keterangan);
							} else {
								$('[id=keterangan]').html("-");
							}
							$('[id=pengaju]').html(data.name);
							if (data.evidence_id != null) {
								$('#bukti_src_div').show();
								$('#print_bukti').show();
								$.ajax({
									url: "<?=site_url('submission/getEvidencebyID')?>/" + data.pengajuan_id,
									type: "GET",
									dataType: "json",
									success: function(evi) {
										var img = '';
										var row1 = '';
										var row2 = '';
										var row3 = '';
										var angka = 1;
											for (var i = 0; i < evi[0].length; i++) {
												// console.log(evi[0][i].url)
												if (evi[0][i] != null) {

													row1+= (i == 0 ? '<br>' : '') + '<div class="column">'+
														'<img src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%" onclick="openModal();currentSlide(\''+ angka +'\')" class="hover-shadow cursor">'+
													'</div>';

													row2+='<div class="mySlides">'+
															'<img src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%">'+
														'</div>';

													row3+='<div class="column">'+
															'<img class="demo cursor" src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][i].keterangan +'">'+
														'</div>';
												}
												angka++;
											}

										$('#mult_img_row1').html(row1);
										$('#mult_img_row2').html(row2);
										$('#mult_img_row3').html(row3);
									}, error: function(jqXHR, textStatus, errorThrown) {
										var err = eval("(" + jqXHR.responseText + ")");
									  alert(err.Message);
									}
								});
							} else {
								$('#bukti_src_div').hide();
								$('#print_bukti').hide();
							}
							if (data.evidence_id != null) {
								$.ajax({
									url: "<?=site_url('submission/getEvidencebyIDDokumen')?>/" + data.pengajuan_id,
									type: "GET",
									dataType: "json",
									success: function(evi) {
										var img = '';
										var row4 = '';
										var angka = 1;
										for (var i = 0; i < evi[0].length; i++) {
											// console.log(evi[0][i].url)
											if (evi[0][i] != null) {
												row4+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="public/assets/evidence/'+ escape(evi[0][i].url) +'" target="_blank">'+ evi[0][i].url.slice(14) +'</a></div>';
											}
											angka++;
										}

										$('#bukti_dokumen').html(row4);
									}, error: function(jqXHR, textStatus, errorThrown) {
										var err = eval("(" + jqXHR.responseText + ")");
									  alert(err.Message);
									}
								})
							} else {
								$('#bukti_src_div').hide();
								$('#print_bukti').hide();
							}
							$('.modal-title').text('Pengajuan ' + "#ADP" + pad(data.pengajuan_id, 4));
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function openModal() {
				  document.getElementById('myModal').style.display = "block";
				}

				function closeModal() {
				  document.getElementById('myModal').style.display = "none";
				}

				var slideIndex = 1;
				showSlides(slideIndex);

				function plusSlides(n) {
				  showSlides(slideIndex += n);
				}

				function currentSlide(n) {
				  showSlides(slideIndex = n);
				}

				function showSlides(n) {
				  var i;
				  var slides = document.getElementsByClassName("mySlides");
				  var dots = document.getElementsByClassName("demo");
				  var captionText = document.getElementById("caption");
				  if (n > slides.length) {slideIndex = 1}
				  if (n < 1) {slideIndex = slides.length}
				  for (i = 0; i < slides.length; i++) {
				      slides[i].style.display = "none";
				  }
				  for (i = 0; i < dots.length; i++) {
				      dots[i].className = dots[i].className.replace(" active", "");
				  }
				  slides[slideIndex-1].style.display = "block";
				  dots[slideIndex-1].className += " active";
				  captionText.innerHTML = dots[slideIndex-1].alt;
				}
			</script>
