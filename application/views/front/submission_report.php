<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
									<?php if (isViewer() || isAdministrator()): ?>
										<div class="">
											<a href="<?=site_url('app/backupdb')?>" class="btn btn-outline-primary">
												BACKUP DATABASE
											</a>
										</div>
										<br>
									<?php endif; ?>
									<?php if (isNotification()): ?>
										<div class="alert alert-success alert-dismissable">
										  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										  <strong>Success!</strong> <?=notificationMessage()?>
										</div>
									<?php endif; ?>
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
													<h6 class="lh-1">Sudah Diapprove</h6>
												</div>
												<div class="layer w-100">
													<div class="peers ai-sb fxw-nw">
														<div class="peer peer-greed">
															<i class="fas fa-signal"></i>
														</div>
														<div class="peer">
															<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-green-50 c-green-500">
																<?=$sudahdiapprove?>
															</span>
														</div>
													</div>
												</div>
											</div>
										</div>

										<div class="col-md-3">
											<div class="layers bd bgc-white p-20">
												<div class="layer w-100 mB-10">
													<h6 class="lh-1">Belum Diapprove</h6>
												</div>
												<div class="layer w-100">
													<div class="peers ai-sb fxw-nw">
														<div class="peer peer-greed">
															<i class="fas fa-signal"></i>
														</div>
														<div class="peer">
															<span class="d-ib lh-0 va-m fw-600 bdrs-10em pX-15 pY-15 bgc-red-50 c-red-500">
																<?=$belumdiapprove?>
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
  									<?php if (isViewer() || $this->session->userdata('username') == "stadmaresi" || isApproval()): ?>
										<!-- <div class="col-md-12" id="chart">
											<div class="col-md-6">
												<canvas id="myChart" width="400" height="200"></canvas>
											</div>
											<div class="col-md-6">
												<canvas id="myChart2" width="400" height="200"></canvas>
											</div>
										</div> -->
										<br>
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
														<b>KATEGORI</b>
														<table class="table">
															<tbody>
																<input id="id_val" type="hidden" value="">
																<tr>
																	<th width="250">Kategori Pengajuan</th>
																	<td><span id="kategori_pengajuan_val"></span></td>
																</tr>
																<tr id="jenis_pengajuan_div">
																	<th width="250">Jenis Pengajuan</th>
																	<td><span id="jenis_pengajuan_val"></span></td>
																</tr>
															</tbody>
															<br><br>
														</table>
														<br><i class="fas fa-info-circle"></i> <b> DETAIL PENGAJUAN</b><br><br>
														<table class="table">
															<tbody>
																<tr id="nama_project_div">
																	<th width="250">Nama Project</th>
																	<td><span id="nama_project_val"></span></td>
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
																<tr id="pid_div_det">
																	<th width="250">Nama Site</th>
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
																<tr id="approval_detail">
																	<th width="250">Tanggal Approval</th>
																	<td><span id="approved_by"></span></td>
																</tr>
																<tr id="bukti_src_div">
																	<th width="250">Bukti</th>
																	<td>
																		<div class="" id="bukti">

																			<div id="bukti_dokumen"></div>
																			<div id="mult_img_row1"></div>

																			<!-- <div id="myModal" style="height:100%" class="modal" data-backdrop="static" data-keyboard="false">
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
																			</div> -->
																		</div>
																	</td>
																</tr>
																<tr id="buktis_src_div">
																	<th width="250">Bukti Susulan</th>
																	<td>
																		<div class="" id="buktis">
																			<div id="buktis_dokumen"></div>
																			<div id="mult_img_row2"></div>
																		</div>
																	</td>
																</tr>
																<tr id="buktit_src_div">
																	<th width="250">Bukti Transaksi</th>
																	<td>
																		<div class="" id="buktit">

																			<div class="" id="tmult_img_row1">
																			</div>

																			<!-- <div id="myModal2" style="height:100%" class="modal" data-backdrop="static" data-keyboard="false">
																			  <span class="close cursor" onclick="closeModal2()">&times;</span>
																			  <div class="modal-content">

																			    <div class="" id="tmult_img_row2">
																			    </div>

																			    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
																			    <a class="next" onclick="plusSlides(1)">&#10095;</a>

																			    <div class="caption-container">
																			      <p id="caption"></p>
																			    </div>


																			    <div class="" id="tmult_img_row3">
																			    </div>

																					<div class="modal-footer">
																						<button class="btn btn-secondary" onclick="closeModal2()" type="button">Close</button>
																					</div>
																			  </div>
																			</div> -->
																		</div>
																		<!-- <button type="button" name="button" class="btn btn-outline-primary" id="print_bukti">PRINT BUKTI</button> -->
																	</td>
																</tr>
															</tbody>
														</table>
														<br><i class="fas fa-money-bill-alt"></i> <b>NILAI</b><br><br>
														<table class="table">
															<tbody>
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
																	<td>
																		<span id="nilai_pengajuan_val"></span>
																	</td>
																</tr>
															</tbody>
														</table>
	                				</div>
	                				<div class="modal-footer">
	                					<button id="detailClose" class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
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

															<input type="hidden" name="belum_diprint_val" id="belum_diprint_val" value="N">
															<input type="hidden" name="on_progress_val" id="on_progress_val" value="N">
															<input type="hidden" name="semua_pengajuan_val" id="semua_pengajuan_val" value="Y">
															<input type="hidden" name="history_val" id="history_val" value="N">
															<input type="hidden" name="progress_project_val" id="progress_project_val" value="N">
															<input type="hidden" name="belum_diapprove_val" id="belum_diapprove_val" value="N">
															<input type="hidden" name="sudah_diapprove_val" id="sudah_diapprove_val" value="N">
															<input type="hidden" name="reject_val" id="reject_val" value="N">

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
									<div class="bgc-white bd bdrs-3 p-20 mB-20">
										<button type="button" class="btn cur-p btn-outline-primary" onclick="reload_table()">
	                    <i class="fas fa-sync-alt"></i>
	                  </button>
										<button type="button" class="btn cur-p btn-primary" id="semua_pengajuan">
											SEMUA PENGAJUAN
										</button>
										<button type="button" class="btn cur-p btn-success" id="belum_diapprove">
	                    BELUM DIAPPROVE
	                  </button>
										<button type="button" class="btn cur-p btn-success" id="sudah_diapprove">
	                    SUDAH DIAPPROVE
	                  </button>
										<button type="button" class="btn cur-p btn-danger" id="rejected">
	                    REJECTED
	                  </button>
										<!-- <button type="button" class="btn cur-p btn-success" id="belum_diprint">
											BELUM DIPRINT
										</button> -->
										<button type="button" class="btn cur-p btn-secondary" id="on_progress">
											ON PROGRESS
										</button>
										<button type="button" class="btn cur-p btn-success" id="history_btn">
											HISTORY
										</button>
										<div class="" style="float:right">
											<button type="button" class="btn cur-p btn-outline-default" name="button">
												<a class="" href="#" target="_blank" id="exportExcel" style="text-decoration:none;color:inherit;">
													<i class="fas fa-file-excel"></i>
												</a>
											</button>
											<!-- <button type="button" class="btn cur-p btn-outline-default" id="export_print" onclick="exportPrint()">
												<i class="fas fa-print"></i>
											</button> -->
										</div>
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
													<th class="text-center">Pengajuan</th>
													<th class="text-center">Nama<br>Project</th>
													<th class="text-center">Tanggal<br>Pengajuan</th>
	                        <th class="text-center">Realisasi<br>Pengajuan</th>
	                        <th class="text-center" style="width:50px;">ACTION</th>
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
			<?php
			?>
			<script>
				var ctx = document.getElementById("myChart").getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ["Belum Selesai", "Sudah Selesai"],
				        datasets: [{
				            label: '# Progress',
				            data: ["<?=json_encode($belumSelesai)?>", <?=json_encode($sudahSelesai)?>],
				            backgroundColor: [
				                'rgba(255, 99, 132, 0.2)',
				                'rgba(54, 162, 235, 0.2)'
				            ],
				            borderColor: [
				                'rgba(255,99,132,1)',
				                'rgba(54, 162, 235, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }]
				        }
				    }
				});

				var ctx = document.getElementById("myChart2").getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: ["Invoiced", "Sudah Dibayar", "Sudah Dibayar Client", "Belum Semua"],
				        datasets: [{
				            label: '# Progress',
				            data: ["<?=json_encode($invoiced)?>", <?=json_encode($isbayar)?>, <?=json_encode($isbayarclient)?>, <?=json_encode($belumsemua)?>],
				            backgroundColor: [
				                'rgba(255, 99, 132, 0.2)',
				                'rgba(54, 162, 235, 0.2)',
				                'rgba(144, 219, 132, 0.2)',
				                'rgba(54, 162, 235, 0.2)'
				            ],
				            borderColor: [
				                'rgba(255,99,132,1)',
				                'rgba(54, 162, 235, 1)',
				                'rgba(144, 219, 132, 1)',
				                'rgba(54, 162, 235, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }]
				        }
				    }
				});
			</script>

			<script type="text/javascript">
				$(document).ready(function() {
						submission_admin = $('#submission_admin').DataTable({
								"processing": true,
								"serverSide": true,
			          dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
			               "<'row'<'col-sm-12'tr>>" +
			               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
			          "pageLength": 5,
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
											data.sudah_diapprove = $('#sudah_diapprove_val').val();
											data.reject = $('#reject_val').val();

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
										"targets"		: [2, 3, 4, 5]
									}
								],
						});

						$('#on_progress').click(function() {
							$('#menampilkan').text("Pengajuan yang Terhold");
							$("input[type=hidden]").val("N");
							document.getElementById("on_progress_val").value = "Y";
							$('#print').show();
							$('#print_c').show();
							$('#acc').show();
							submission_admin.ajax.reload();  //just reload table
						});

						$('#rejected').click(function() {
							$('#menampilkan').text("Pengajuan yang diReject");
							$("input[type=hidden]").val("N");
							document.getElementById("reject_val").value = "Y";
							submission_admin.ajax.reload();  //just reload table
						});

						$('#semua_pengajuan').click(function() {
							$('#print').hide();
							$('#menampilkan').text("Semua Pengajuan <?php if(isApproval()) { echo "Anda"; } ?>");
							document.getElementById("belum_diprint_val").value = "N";
							document.getElementById("history_val").value = "N";
							document.getElementById("on_progress_val").value = "N";
							document.getElementById("progress_project_val").value = "N";
							document.getElementById("belum_diapprove_val").value = "N";
							document.getElementById("sudah_diapprove_val").value = "N";
							document.getElementById("semua_pengajuan_val").value = "Y";
							submission_admin.ajax.reload();  //just reload table
							$('#print_c').hide();
							$('#acc').hide();
						});

						$('#belum_diprint').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum Diprint");
							$("input[type=hidden]").val("N");
							document.getElementById("belum_diprint_val").value = "Y";
							$('#print').show();
							$('#print_c').hide();
							$('#acc').hide();
							submission_admin.ajax.reload();  //just reload table
						});

						$('#belum_diapprove').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum diApprove");
							$("input[type=hidden]").val("N");
							document.getElementById("belum_diapprove_val").value = "Y";
							$('#approve_terpilih').show();
							submission_admin.ajax.reload();  //just reload table
						});

						$('#sudah_diapprove').click(function() {
							$('#menampilkan').text("Pengajuan yang Sudah diApprove");
							$("input[type=hidden]").val("N");
							document.getElementById("sudah_diapprove_val").value = "Y";
							$('#approve_terpilih').hide();
							submission_admin.ajax.reload();  //just reload table
						});

						$('#history_btn').click(function() {
							$('#menampilkan').text("History Pengajuan");
							$("input[type=hidden]").val("N");
							document.getElementById("history_val").value = "Y";
							$('#print').hide();
							$('#print_c').hide();
							$('#acc').hide();
							submission_admin.ajax.reload();  //just reload table
						});

						$('#progress_project_btn').click(function() {
							$('.stat').hide();
							$('#invoiced_stat').show();
							$('#bayar_stat').show();
							$('#client_stat').show();
							$('#print_c').hide();
							$('#acc').hide();

							$("input[type=hidden]").val("N");
							document.getElementById("progress_project_val").value = "Y";
							$('#print').hide();
							submission_admin.ajax.reload();  //just reload table
						})

						// $(document).ready(function() {
						// 	if (!isAdminTasik()) {
						// 		document.getElementById("belum_diprint_val").value = "Y";
						// 	}
						// 	submission_admin.ajax.reload();  //just reload table
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

				$(document).ready(function() {
					$('#exportExcel').click(function() {
						var on_progress = document.getElementById('on_progress_val').value;
						var belum_diprint = document.getElementById('belum_diprint_val').value;
						var history = document.getElementById('history_val').value;
						var progress_project = document.getElementById('progress_project_val').value;
						var semua_pengajuan = document.getElementById('semua_pengajuan_val').value;
						var belum_diapprove = document.getElementById('belum_diapprove_val').value;
						var sudah_diapprove = document.getElementById('sudah_diapprove_val').value;
						var reject = document.getElementById('reject_val').value;
						var pengajuan = document.getElementById('pengajuan_filter').value;
						var kategori_pengajuan = document.getElementById('kategori_pengajuan_filter').value;
						var jenis_pengajuan = document.getElementById('jenis_pengajuan_filter').value;
						var tanggal_pengajuan = document.getElementById('tanggal_pengajuan_filter').value;
						var tanggal_pengajuan_first = document.getElementById('tanggal_pengajuan_first_filter').value;
						var tanggal_pengajuan_last = document.getElementById('tanggal_pengajuan_last_filter').value;
						var realisasi_pengajuan = document.getElementById('realisasi_pengajuan_filter').value;
						var realisasi_pengajuan_first = document.getElementById('realisasi_pengajuan_first_filter').value;
						var realisasi_pengajuan_last = document.getElementById('realisasi_pengajuan_last_filter').value;
						var nama_pengaju = document.getElementById('nama_pengaju_filter').value;

						var field = {
							on_progress: on_progress,
							belum_diprint: belum_diprint,
							history: history,
							progress_project: progress_project,
							semua_pengajuan: semua_pengajuan,
							belum_diapprove: belum_diapprove,
							sudah_diapprove: sudah_diapprove,
							reject: reject
						};

						$.ajax({
							url: "<?=site_url('admin/exportExcel')?>",
							type: "POST",
							data: field,
							dataType: "json",
							beforeSend: function() {
								window.open("<?=site_url('admin/exportExcel')?>
										?on_progress="+on_progress+
										"&belum_diprint="+belum_diprint+
										"&history="+history+
										"&progress_project="+progress_project+
										"&semua_pengajuan="+semua_pengajuan+
										"&belum_diapprove="+belum_diapprove+
										"&sudah_diapprove="+sudah_diapprove+
										"&reject="+reject+
										"&pengajuan="+pengajuan+
										"&kategori_pengajuan="+kategori_pengajuan+
										"&jenis_pengajuan="+jenis_pengajuan+
										"&tanggal_pengajuan="+tanggal_pengajuan+
										"&tanggal_pengajuan_first="+tanggal_pengajuan_first+
										"&tanggal_pengajuan_last="+tanggal_pengajuan_last+
										"&realisasi_pengajuan="+realisasi_pengajuan+
										"&realisasi_pengajuan_first="+realisasi_pengajuan_first+
										"&realisasi_pengajuan_last="+realisasi_pengajuan_last+
										"&nama_pengaju="+nama_pengaju
										,'_blank');
							},
							success: function(result) {

							}
						});
						return false;
					});
				});

				function exportPrint() {

				}

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
					// if ($("#my_gallery").length > 0) {
					// 	document.getElementById("my_gallery").remove();
					// }
					$('#mult_img_row1').html("");
					$('#mult_img_row2').html("");
					$('#mult_img_row3').html("");
					$('#bukti_dokumen').html("");
					$.ajax({
					  url: "<?=site_url('submission/getPengajuanDetail/')?>/" + id,
					  type: "GET",
					  dataType: "json",
					  success: function(data) {
					    document.getElementById("id_val").value = data.pengajuan.pengajuan_id;
					    if (data.pengajuan.jenis_pengajuan == "Non Project" || data.pengajuan.jenis_pengajuan == "Operasional") {
					      $('[id=kategori_pengajuan_val]').html("NON-PROJECT");
					      $('[id=jenis_pengajuan_val]').html(data.pengajuan.jenis_pengajuan);
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
					      $('[id=jenis_pengajuan_val]').html(data.pengajuan.jenis_pengajuan);
					      if (data.pengajuan.nilai_sph != "0") {
					        $('[id=nilai_sph_val]').html("Rp. " + currency_format(data.pengajuan.nilai_sph));
					        $('[id=no_sph_val]').html(data.pengajuan.no_sph);
					        $('#nilai_sph_div_det').show();
					        $('#no_sph_div_det').show();
					      } else {
					        $('#nilai_sph_div_det').hide();
					        $('#no_sph_div_det').hide();
					      }
					      if (data.pengajuan.nilai_corr != "0") {
					        $('[id=nilai_corr_val]').html("Rp. " + currency_format(data.pengajuan.nilai_corr));
					        $('[id=no_corr_val]').html(data.pengajuan.no_corr);
					        $('#nilai_corr_div_det').show();
					        $('#no_corr_div_det').show();
					      } else {
					        $('#nilai_corr_div_det').hide();
					        $('#no_corr_div_det').hide();
					      }
					      if (data.pengajuan.nilai_po != "0") {
					        $('[id=nilai_po_val]').html("Rp. " + currency_format(data.pengajuan.nilai_po));
					        $('[id=no_po_val]').html(data.pengajuan.no_po);
					        $('#nilai_po_div_det').show();
					        $('#no_po_div_det').show();
					      } else {
					        $('#nilai_po_div_det').hide();
					        $('#no_po_div_det').hide();
					      }
					      $('[id=nama_project_val]').html(data.pengajuan.nama_project);
					      $('#jenis_pengajuan_div').show();
					      $('#nama_project_div').show();
					    }
					    $('[id=pengajuan]').html(data.pengajuan.pengajuan);
					    if (data.pengajuan.tanggal_approval != null) {
					      $('#editNilaiPengajuan').hide();
					    } else {
					      $('#editNilaiPengajuan').show();
					    }
					    $('[id=nilai_pengajuan_val]').html("Rp. " + currency_format(data.pengajuan.nilai_pengajuan));
					    $('[id=tanggal_pengajuan]').html(moment(data.pengajuan.tanggal_pengajuan).format('dddd, D MMMM Y HH:m:s'));
					    $('[id=realisasi_pengajuan]').html(moment(data.pengajuan.realisasi_pengajuan).format('dddd, D MMMM Y'));
					    if (data.pengajuan.tanggal_approval_keuangan != null) {
					      $('#tanggal_approval_keuangan_div').show();
					      $('[id=tanggal_approval_keuangan]').html(moment(data.pengajuan.tanggal_approval_keuangan).format('dddd, D MMMM Y'));
					    } else {
					      $('#tanggal_approval_keuangan_div').hide();
					    }
					    if (data.pengajuan.site_id != "") {
					      $('[id=pid_val]').html(data.pengajuan.id_site + ' ' + data.pengajuan.id_site_telkom + ' / ' + data.pengajuan.nama_site);
					      $("#pid_div_det").show();
					    } else {
					      $("#pid_div_det").hide();
					    }
					    if (data.pengajuan.no_spk != "") {
					      $('#no_spk_div_det').show();
					      $('[id=no_spk_val]').html(data.pengajuan.no_spk);
					    } else {
					      $('#no_spk_div_det').hide();
					    }
					    if (data.pengajuan.start_penawaran_dmt != null) {
					      $('#start_penawaran_dmt_div_det').show();
					      $('[id=start_penawaran_dmt_val]').html(moment(data.pengajuan.start_penawaran_dmt).format('dddd, D MMMM Y') + " (Lama Progress : " +
					        monthDiff(
					          new Date(data.pengajuan.start_penawaran_dmt),
					          new Date(data.pengajuan.tanggal_pengajuan)
					        ) + " bulan)"
					      );
					    } else {
					      $('#start_penawaran_dmt_div_det').hide();
					    }
					    if (data.pengajuan.keterangan != "") {
					      $('[id=keterangan]').html(data.pengajuan.keterangan);
					    } else {
					      $('[id=keterangan]').html("-");
					    }
              $('[id=pengaju]').html(data.pengajuan.name);
              $.ajax({
                url: "<?=site_url('submission/getTargetApproval/')?>" + data.pengajuan.target_approval,
                type: "GET",
                dataType: "json",
                success: function(apr) {
                  $('[id=target_approval]').html(apr.name);
                }
              });
							if (data.pengajuan.tanggal_approval != null) {
								$('#approval_detail').show();
								$.ajax({
									url: "<?=site_url('submission/getApprovalName/')?>" + data.pengajuan.approved_by,
									type: "GET",
									dataType: "json",
									success: function(app) {
										$('[id=approved_by]').html(moment(data.pengajuan.tanggal_approval).format('dddd, D MMMM Y') + ' by ' + app.name);
									}
								});
							} else {
								$('#approval_detail').hide();
							}
					    if (data.es.length > 0) {
								$('#buktis_src_div').show();
								$.ajax({
									url: "<?=site_url('submission/getEvidenceSusulanbyID')?>/" + data.pengajuan.pengajuan_id,
									type: "GET",
									dataType: "json",
									success: function(evi) {
										var img = '';
										var row2 = '';
											// for (var i = 0; i < evi[0].length; i++) {
												// console.log(evi[0][i].url)
														if (evi[0][0] != null) {
															$('#print_bukti').show();
															row2+= '<hr><div id="print_bukti_btn"><button class="btn btn-outline-default" type="button" name="button"><a id="print_bukti" target="_blank" href="<?=site_url('submission/print-bukti-susulan/')?>'+data.pengajuan.pengajuan_id+'"><i class="fas fa-print"></i></a></button>&nbsp;&nbsp;<button class="btn btn-outline-default" type="button" name="button"><a id="print_bukti" target="_blank" href="<?=site_url('submission/print-all-evidence/')?>'+data.pengajuan.pengajuan_id+'"><i class="fas fa-print"></i> PRINT SEMUA BUKTI</a></button></div><div id="my_gallery'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'" data-nanogallery2=\'{"thumbnailWidth": 100,"thumbnailHeight": 100}\'>';
														}

														for (var i = 0; i < evi[0][0].length; i++) {
															if (evi[0][0][i] != null) {
																row2+= '<a href="../public/assets/evidence/'+ escape(evi[0][0][i].url) +'" data-ngthumb="../public/assets/evidence/'+ escape(evi[0][0][i].url) +'" >'+evi[0][0][i].url.substring(14)+'</a>';
															}
														}

														if (evi[0][0] != null) {
															row2+= '</div>';
														}
													// row1+= (i == 0 ? '<br>' : '') + '<a href="../public/assets/evidence/'+ escape(evi[0][i].url) +'" data-ngthumb="../public/assets/evidence/'+ escape(evi[0][i].url) +'" >Title Image1</a>';

													// row2+='<div class="mySlides">'+
													// 		'<img src="../public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%">'+
													// 	'</div>';
													//
													// row3+='<div class="column">'+
													// 		'<img class="demo cursor" src="../public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][i].keterangan +'">'+
													// 	'</div>';
												// }
											// }
										$('#mult_img_row2').html(row2);
										// $('#mult_img_row2').html(row2);
										// $('#mult_img_row3').html(row3);
										$('#my_gallery'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'').nanogallery2('refresh');
									}, error: function(jqXHR, textStatus, errorThrown) {
										var err = eval("(" + jqXHR.responseText + ")");
										alert(err.Message);
									}
								});

								$.ajax({
									url: "<?=site_url('submission/getEvidenceSusulanbyIDDokumen')?>/" + data.pengajuan.pengajuan_id,
									type: "GET",
									dataType: "json",
									success: function(evi) {
										var img = '';
										var row5 = '';
										for (var i = 0; i < evi[0][0].length; i++) {
				              // console.log(evi[0][i].url)
				              if (evi[0][0][i] != null) {
				                row5+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="../public/assets/evidence/'+ escape(evi[0][0][i].url) +'" target="_blank">'+ evi[0][0][i].url.slice(14) +'</a></div>';
				              }
				            }

				            $('#buktis_dokumen').html(row5);
									}, error: function(jqXHR, textStatus, errorThrown) {
										var err = eval("(" + jqXHR.responseText + ")");
										alert(err.Message);
									}
								});
							} else {
								$('#buktis_src_div').hide();
							}

							if (data.pengajuan.evidence_id != null) {
								$('#bukti_src_div').show();
								$('#print_bukti').show();
								$.ajax({
									url: "<?=site_url('submission/getEvidencebyID')?>/" + data.pengajuan.pengajuan_id,
									type: "GET",
									dataType: "json",
									success: function(evi) {
										var img = '';
										var row1 = '';
										var row2 = '';
										var row3 = '';
										var angka = 1;
											// for (var i = 0; i < evi[0].length; i++) {
												// console.log(evi[0][i].url)
														if (evi[0][0] != null) {
															row1+= '<hr><div id="print_bukti_btn"><button class="btn btn-outline-default" type="button" name="button"><a id="print_bukti" target="_blank" href="<?=site_url('submission/print-bukti/')?>'+data.pengajuan.pengajuan_id+'"><i class="fas fa-print"></i></a></button></div><div id="my_gallerys'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'" data-nanogallery2=\'{"thumbnailWidth": 100,"thumbnailHeight": 100}\'>';
														}

														for (var i = 0; i < evi[0].length; i++) {
															if (evi[0][i] != null) {
																row1+= '<a href="../public/assets/evidence/'+ escape(evi[0][i].url) +'" data-ngthumb="../public/assets/evidence/'+ escape(evi[0][i].url) +'" >'+evi[0][i].url.substring(14)+'</a>';
															}
														}

														if (evi[0][0] != null) {
															row1+= '</div>';
														}
													// row1+= (i == 0 ? '<br>' : '') + '<a href="../public/assets/evidence/'+ escape(evi[0][i].url) +'" data-ngthumb="../public/assets/evidence/'+ escape(evi[0][i].url) +'" >Title Image1</a>';

													// row2+='<div class="mySlides">'+
													// 		'<img src="../public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%">'+
													// 	'</div>';
													//
													// row3+='<div class="column">'+
													// 		'<img class="demo cursor" src="../public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][i].keterangan +'">'+
													// 	'</div>';
												// }
												angka++;
											// }
										$('#mult_img_row1').html(row1);
										// $('#mult_img_row2').html(row2);
										// $('#mult_img_row3').html(row3);
										$('#my_gallerys'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'').nanogallery2('refresh');
									}, error: function(jqXHR, textStatus, errorThrown) {
										var err = eval("(" + jqXHR.responseText + ")");
									  alert(err.Message);
									}
								});
							} else {
								$('#bukti_src_div').hide();
							}
							if (data.pengajuan.evidence_id != null) {
								$.ajax({
									url: "<?=site_url('submission/getEvidencebyIDDokumen')?>/" + data.pengajuan.pengajuan_id,
									type: "GET",
									dataType: "json",
									success: function(evi) {
										var img = '';
										var row4 = '';
										var angka = 1;
										for (var i = 0; i < evi[0].length; i++) {
											// console.log(evi[0][i].url)
											$('#bukti_dokumen').show();
											if (evi[0][i] != null) {
												row4+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="../public/assets/evidence/'+ escape(evi[0][i].url) +'" target="_blank">'+ evi[0][i].url.slice(14) +'</a></div>';
											} else {
												$('#bukti_dokumen').hide();
											}
											angka++;
										}

										$('#bukti_dokumen').html(row4);
									}, error: function(jqXHR, textStatus, errorThrown) {
										var err = eval("(" + jqXHR.responseText + ")");
									  alert(err.Message);
									}
								})
							}

							$.ajax({
								url: "<?=base_url('submission/getEvidenceTransaksi')?>/" + data.pengajuan.pengajuan_id,
								type: "GET",
								dataType: "json",
								success: function(evi) {
									var img = '';
									var trow1 = '';
									var trow2 = '';
									var trow3 = '';
									var tangka = 1;
									if (evi[0][0].length > 0) {
										$('#buktit_src_div').show();
										for (var i = 0; i < evi[0][0].length; i++) {
											// console.log(evi[0][i].url)
												trow1+= (i == 0 ? '<br>' : '') + '<div class="column">'+
													'<img src="../public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" style="width:50%" onclick="openModal2();tcurrentSlide(\''+ tangka +'\')" class="hover-shadow cursor">'+
												'</div>';

												trow2+='<div class="mySlides">'+
														'<img src="../public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" style="width:50%">'+
													'</div>';

												trow3+='<div class="column">'+
														'<img class="demo cursor" src="../public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" style="width:50%" onclick="tcurrentSlide(\''+ tangka +'\')" alt="'+ evi[0][0][i].keterangan +'">'+
													'</div>';
											tangka++;
										}
									} else {
										$('#buktit_src_div').hide();
									}

									$('#tmult_img_row1').html(trow1);
									$('#tmult_img_row2').html(trow2);
									$('#tmult_img_row3').html(trow3);
								}, error: function(jqXHR, textStatus, errorThrown) {
									var err = eval("(" + jqXHR.responseText + ")");
									alert(err.Message);
								}
							});
							$('.modal-title').text('Pengajuan ' + "#ADP" + pad(data.pengajuan.pengajuan_id, 4));
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
