<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <?php if (isAdminTasik() || isAdministrator() || isApproval()): ?>
										<button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
	                  	<i class="fas fa-plus"></i>&nbsp; Buat Pengajuan Baru
	                  </button>
                  <?php endif; ?>
									<button type="button" name="button" class="btn btn-outline-primary" id="custom_filter_btn">
										<i class="fas fa-filter"></i>&nbsp; SHOW CUSTOM FILTER
									</button>
									<br>
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Pengajuan Baru</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
                					<form class="" action="<?=site_url('submission/save')?>" method="post"  enctype="multipart/form-data">
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
														<?php if (isAdminTasik()): ?>
															<div class="form-group">
																<label for="">Target Approval</label>
																<select id="target_approval" style="width:100%" class="form-control selectpicker" name="target_approval">
																	<option value="" selected disabled readonly>PILIH TARGET APPROVAL</option>
																	<?php foreach ($approval_list->result() as $key => $value): ?>
																		<option value="<?=$value->user_id?>"><?=$value->name?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<hr>
														<?php endif; ?>

														<div class="form-group">
															<label for="">Kategori Pengajuan</label>
															<select id="kategori_pengajuan" style="width:100%;" class="form-control selectpicker" name="kategori_pengajuan" >
																<option value="" selected disabled readonly>PILIH KATEGORI PENGAJUAN</option>
																<option id="project" value="project">PROJECT</option>
																<option id="non_project" value="non_project">NON PROJECT</option>
															</select>
														</div>

														<div class="form-group" id="project_id_div">
															<label for="">Pilih Project</label>
															<select class="selectpicker form-control" name="project_id" id="project_id" data-live-search="true">
																<option selected disabled readonly>PILIH PROJECT</option>
																<option value="new_project">New Project</option>
																<?php foreach ($project_list->result() as $project_data): ?>
																	<option value="<?=$project_data->project_id?>"><?=$project_data->nama_project?></option>
																<?php endforeach; ?>
															</select>
														</div>
														<div class="" id="new_project_div">
															<div class="form-group">
																<label for="">Nama Project</label>
																<input type="text" class="form-control" name="nama_project" value="" placeholder="Nama Project">
															</div>
														</div>

														<div class="form-group" id="jenis_nilai_div">
															<label for="">Jenis Nilai</label>
															<select style="width:100%;" class="form-control selectpicker" id="jenis_nilai" name="jenis_nilai">
																<option value="" selected disabled readonly>PILIH JENIS NILAI</option>
																<!-- <option id="jenis_sph" value="jenis_sph">SPH</option> -->
																<option id="jenis_corr" value="jenis_corr">Corr / SPH</option>
																<option id="jenis_po" value="jenis_po">PO</option>
															</select>
														</div>
														<div class="form-group" id="nilai_sph_div">
															<label for="">Nilai SPH</label>
															<div class="input-group mb-2 mr-sm-2 mb-sm-0">
																<div class="input-group-addon" style="width: 40px;">Rp.</div>
																<input id="nilai_sph" name="nilai_sph" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai SPH">
															</div>
														</div>
														<div class="form-group" id="no_sph_div">
															<label for="">Nomor SPH</label>
															<input type="text" class="form-control" name="no_sph" value="" placeholder="Nomor SPH" >
														</div>

														<div class="form-group" id="nilai_corr_div">
															<label for="">Nilai Corr</label>
															<div class="input-group mb-2 mr-sm-2 mb-sm-0">
																<div class="input-group-addon" style="width: 40px;">Rp.</div>
																<input name="nilai_corr" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai Corr">
															</div>
														</div>
														<div class="form-group" id="no_corr_div">
															<label for="">Nomor Corr</label>
															<input type="text" class="form-control" name="no_corr" value="" placeholder="Nomor Corr" >
														</div>

														<div class="form-group" id="nilai_po_div">
															<label for="">Nilai PO</label>
															<div class="input-group mb-2 mr-sm-2 mb-sm-0">
																<div class="input-group-addon" style="width: 40px;">Rp.</div>
																<input name="nilai_po" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai PO">
															</div>
														</div>
														<div class="form-group" id="no_po_div">
															<label for="">Nomor PO</label>
															<input type="text" class="form-control" name="no_po" value="" placeholder="Nomor PO" >
														</div>

														<div class="form-group" id="no_spk_div">
															<label for="">Nomor SPK</label>
															<input type="text" class="form-control" name="no_spk" placeholder="Nomor SPK" >
														</div>

														<div class="form-group" id="start_penawaran_dmt_div">
															<label for="">Start Penawaran DMT</label> <i>*optional</i>
															<input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="start_penawaran_dmt" placeholder="Start Penawaran DMT" />
														</div>

														<!-- SITE -->
														<hr>
														<div id="site_id_div">
															<div class="form-group">
																<label for="">Pilih Site</label>
																<select class="selectpicker form-control" name="site_id" id="site_id" data-live-search="true">
																	<option selected disabled readonly>PILIH SITE</option>
																	<option value="new_site">New Site</option>
																	<?php foreach ($site_list->result() as $site_data): ?>
																		<option value="<?=$site_data->site_id?>"><?=$site_data->id_site?> <?=$site_data->id_site_telkom?> / <?=$site_data->lokasi?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<div class="" id="new_site_div">
																<div class="form-group">
																	<label for="">Site ID</label>
																	<input type="text" class="form-control" name="id_site" value="" placeholder="Site ID">
																</div>
																<div class="form-group">
																	<label for="">PID</label> <i></i>
																	<input type="text" class="form-control" name="id_site_telkom" value="" placeholder="PID">
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

															<!-- PENGAJUAN -->
															<hr>
														</div>

														<div class="form-group">
															<label for="">Nama Pengajuan</label>
															<input type="text" class="form-control" name="pengajuan" value="" placeholder="Nama Pengajuan" >
														</div>

														<div class="form-group">
															<label for="">Jenis Pengajuan </label>
															<select id="jenis_pengajuan" style="width:100%;" class="form-control selectpicker" style="width:100% !important;" name="jenis_pengajuan">
																<option value="" selected disabled readonly>PILIH JENIS PENGAJUAN</option>
																<?php foreach ($kategori_pengajuan as $data_k): ?>
																	<option value="<?=$data_k?>"><?=strtoupper($data_k)?></option>
																<?php endforeach; ?>
															</select>
														</div>

														<div class="form-group" id="nilai_pengajuan" >
															<label for="">Nilai Pengajuan</label>
															<div class="input-group mb-2 mr-sm-2 mb-sm-0">
														    <div class="input-group-addon" style="width: 40px;">Rp.</div>
														    <input name="nilai_pengajuan" type="number" class="form-control currency" id="c1" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai Pengajuan">
														  </div>
														</div>
														<div class="form-group" id="biaya_penyelesaian" >
															<label for="">Biaya Penyelesaian</label>
															<div class="input-group mb-2 mr-sm-2 mb-sm-0">
														    <div class="input-group-addon" style="width: 40px;">Rp.</div>
														    <input name="biaya_penyelesaian" type="number" class="form-control currency" id="c1" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Biaya Penyelesaian">
														  </div>
														</div>
														<div class="form-group">
															<label for="">Realisasi Pengajuan</label>
															<input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="realisasi_pengajuan" placeholder="Realisasi Pengajuan" />
														</div>
														<div class="form-group">
															<label for="">Keterangan Pengajuan</label>
															<textarea name="keterangan" id="keterangan" class="form-control" rows="8" cols="80" placeholder="Keterangan Pengajuan"></textarea>
														</div>
														<!-- <div class="form-group">
															<label for="">Bukti (Gambar) *optional</label>
															<div class="">
																<input type="file" name="bukti[]" style="display:none" id="upload-image" multiple></input>
																<button id="upload" type="button" name="button" class="btn btn-primary">Browse</button>
																<div id="thumbnail"></div>
															</div>
														</div> -->
				                    <div class="form-group">
															 <label for="">Bukti (allowed file types: .jpg, .jpeg, .png, .pdf, .doc/x, .xls/x, .txt)</label> <i>*optional</i>
															 <!-- <div class="input-files">
															 	<input type="file" name="file_upload-1">
															 </div>
															 <a id="add_more"><i class="fas fa-plus"></i> Add More</a> -->
															 <div class="file-loading">
																 <input id="input-ke-1" name="bukti[]" type="file" multiple>
															 </div>
				                    </div>

                				</div>
                				<div class="modal-footer">
                					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
													<input id="reset" type="reset" name="" value="Reset" class="btn btn-outline-primary">
													<input type="submit" name="" value="Save" class="btn btn-primary">
                				</div>
												</form>
                			</div>
                		</div>
                	</div>

									<!-- PENGAJUAN DETAIL -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detailPengajuan" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document" id="modalDetail">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Pengajuan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<b>Remark</b><br>
													<table class="table">
														<tbody>
															<input id="id_val" type="hidden" value="">
															<div id="history_k"></div>
														</tbody>
														<br><br>
													</table>
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
															<!-- <tr id="buktit_src_div">
																<th width="250">Bukti Transaksi</th>
																<td>
																	<div class="" id="buktit">

																		<div class="" id="tmult_img_row1">
																		</div>
																	</div>
																</td>
															</tr> -->
															<tr id="buktit_src_div">
																<th width="250">Bukti Transaksi</th>
																<td>
																	<div class="" id="buktit">
																		<div id="mult_img_row_t"></div>
																	</div>
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
																	<?php if (isApproval()): ?>
																		<a id="editNilaiPengajuan" href="#" style="float:right;text-decoration:underline;">edit</a>
																		<a id="doneNilaiPengajuan" href="#" style="float:right;text-decoration:underline;">done</a>
																		<div id="nilai_pengajuan_val_edit" style="width:100% !important">
																			<input style="width:100%;" name="nilai_pengajuan_edit" type="number" class="form-control currency" id="c1" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai Pengajuan">
																		</div>
																	<?php endif; ?>
																</td>
															</tr>
															<tr id="biaya_penyelesaian_div_det">
																<th width="250">Biaya Penyelesaian</th>
																<td>
																	<span id="biaya_penyelesaian_val"></span>
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
									<!-- PENGAJUAN DETAIL -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="remarkPengajuan" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document" id="modalDetail">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Remark Pengajuan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<?php if (isApproval()): ?>
														<form class="" action="<?=site_url('submission/saveRemark')?>" method="post">
															<input type="hidden" name="idp_r" id="idp_r" value="">
															<div class="form-group">
																<label>Remark</label>
																<textarea class="form-control" name="remark" rows="8" cols="80"></textarea>
															</div>
															<div class="form-group">
																<input style="float:right" type="submit" class="btn btn-primary" name="" value="Submit">
															</div>
														</form>
														<br><br><hr>
													<?php endif; ?>
													<table class="table">
														<tbody>
															<input id="id_val" type="hidden" value="">
															<div id="history"></div>
														</tbody>
														<br><br>
													</table>
                				</div>
                				<div class="modal-footer">
                					<button id="detailClose" class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                				</div>
                			</div>
                		</div>
                	</div>
									<!-- END OF PENGAJUAN DETAIL -->
									<!-- CAPTURE EVIDENCE -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="captureEvidence" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document" id="modalDetail">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Capture Evidence</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<div class="text-center">
														<div id="my_camera" style="margin: 0 auto;"></div>
														<br>
														<div class="">
															<i>*take snapshot first</i>
															<br>
															<input class="btn btn-outline-primary" type=button value="Take Snapshot" onClick="take_snapshot()">
															<input class="btn btn-outline-primary" type=button value="Upload Evidence" onClick="saveSnap()">
														</div>
														<div id="results"></div>
													</div>
                				</div>
                				<div class="modal-footer">
                					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                				</div>
                			</div>
                		</div>
                	</div>
									<!-- END OF CAPTURE EVIDENCE -->
									<!-- UPDATE PROGRESS -->
									<div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="updateProgress" role="dialog" tabindex="-1">
                		<div class="modal-dialog modal-lg" role="document" id="modalDetail">
                			<div class="modal-content">
                				<div class="modal-header">
                					<h5 class="modal-title" id="exampleModalLabel">Update Progress dari Pengajuan #ADP</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                				</div>
                				<div class="modal-body">
													<table class="table">
														<tbody>
															<tr>
																<td style="width:100px;text-align:center;">SUDAH DIAPPROVE</td>
																<td style="width:100px;text-align:center;">INVOICED</td>
																<td style="width:100px;text-align:center;">SUDAH DIBAYAR</td>
																<td style="width:100px;text-align:center;">SUDAH DIBAYAR CLIENT</td>
															</tr>
															<tr>
																<form class="" action="index.html" method="post" id="form_update">
																	<input type="hidden" name="id" value="">
																	<td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="done" name="done" value="<?=date('Y-m-d', time())?>"></label> </td>
																	<td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="invoiced" name="invoiced" value="Y"></label> </td>
																	<td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="bayar" name="bayar" value="Y"></label> </td>
																	<td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="bayarclient" name="bayarclient" value="Y"></label> </td>
																</form>
															</tr>
														</tbody>
													</table>
                				</div>
                				<div class="modal-footer">
													<button class="btn btn-primary" data-dismiss="modal" type="button" id="btnUpdate" onclick="update()">Update</button>
                					<button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                				</div>
                			</div>
                		</div>
                	</div>
									<!-- END OF UPDATE PROGRESS -->
									<!-- EVIDENCE PROGRESS -->
			            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="uploadBukti" role="dialog" tabindex="-1">
			              <div class="modal-dialog modal-lg" role="document">
			                <div class="modal-content">
			                  <div class="modal-header">
			                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Susulan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
			                  </div>
			                  <div class="modal-body">
			                    <form class="" id="form_updatep" action="<?=site_url('submission/saveEvidence')?>" method="post" enctype="multipart/form-data">
			                      <input type="hidden" name="idp" value="">
			                      <div class="form-group">
			                         <label for="">Bukti Susulan (allowed file types: .jpg, .jpeg, .png, .pdf, .doc/x, .xls/x, .txt)</label>
			                         <!-- <div class="input-files">
			                          <input type="file" name="file_upload-1">
			                         </div>
			                         <a id="add_more"><i class="fas fa-plus"></i> Add More</a> -->
			                         <!-- <div class="file-loading">
			                           <input id="buktisusulan" name="buktisusulan[]" type="file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt" multiple="multiple">
			                         </div> -->
															 <br>
															 <a class="file_input btn btn-outline-primary" data-jfiler-name="buktisusulan" data-jfiler-extensions="jpg, jpeg, png, pdf, doc, docx, xls, xlsx, txt">
									             <i class="icon-jfi-paperclip"></i> Attach a file</a>
			                      </div>
			                      <div class="modal-footer">
			                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
															<!-- <input type="reset" name="" value="Reset" class="btn btn-primary"> -->
			                        <input type="submit" name="" value="Upload Bukti (SUSULAN)" class="btn btn-outline-primary">
			                      </div>
			                    </form>
			                  </div>
			                </div>
			              </div>
			            </div>
			            <!-- END OF EVIDENCE PROGRESS -->
									<!-- EVIDENCE PROGRESS -->
			            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="uploadBuktiTransaksi" role="dialog" tabindex="-1">
			              <div class="modal-dialog modal-lg" role="document">
			                <div class="modal-content">
			                  <div class="modal-header">
			                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Transaksi</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
			                  </div>
			                  <div class="modal-body">
			                    <form class="" id="form_updatep" action="<?=site_url('submission/saveTransaksi')?>" method="post" enctype="multipart/form-data">
			                      <input type="hidden" name="idp" value="">
			                      <div class="form-group">
			                         <label for="">Bukti Transaksi (allowed file types: .jpg, .jpeg, .png)</label>
			                         <!-- <div class="input-files">
			                          <input type="file" name="file_upload-1">
			                         </div>
			                         <a id="add_more"><i class="fas fa-plus"></i> Add More</a> -->
			                         <!-- <div class="file-loading">
			                           <input id="input-ke-3" name="buktitransaksi[]" type="file" accept=".jpg,.jpeg,.png" multiple>
			                         </div> -->
															 <br>
															 <a class="file_input btn btn-outline-primary" data-jfiler-name="buktitransaksi" data-jfiler-extensions="jpg, jpeg, png">
									             <i class="icon-jfi-paperclip"></i> Attach a file</a>
			                      </div>
			                      <div class="modal-footer">
			                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
			                        <input type="submit" name="" value="Upload Bukti Transaksi" class="btn btn-outline-primary">
			                      </div>
			                    </form>
			                  </div>
			                </div>
			              </div>
			            </div>
			            <!-- END OF EVIDENCE PROGRESS -->
                </div>
                <br>
								<!-- CUSTOM FILTER -->
								<div id="custom_filter" class="bgc-white bd bdrs-3 p-20 mB-20">
									<h4 class="c-grey-900 mB-20">Custom Filter : </h4>
				                <form id="form-filter" class="form-horizontal">

														<input type="hidden" name="reject_val" id="reject_val" value="N">
														<input type="hidden" name="belum_diapprove_val" id="belum_diapprove_val" value="N">
														<input type="hidden" name="sudah_diapprove_val" id="sudah_diapprove_val" value="N">
														<input type="hidden" name="belum_diproses_val" id="belum_diproses_val" value="N">
														<input type="hidden" name="sudah_diproses_val" id="sudah_diproses_val" value="N">
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
														<!-- <div class="form-group">
															<label for="LastName" class="col-sm-2 control-label">Kategori Pengajuan</label>
															<div class="col-sm-6">
																<select id="kategori_pengajuan_filter" style="width:100%;" class="form-control selectpicker" name="kategori_pengajuan_filter">
																	<option value="" selected disabled readonly>KATEGORI PENGAJUAN</option>
																	<option value="Project">Project</option>
																	<option value="Non Project">Non Project</option>
																</select>
															</div>
														</div> -->
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
								<?php if (isApproval()): ?>
									<div class="alert alert-success alert-dismissable">
										Pastikan membaca detail pengajuan dengan teliti sebelum memproses.
									</div>
								<?php endif; ?>
								<div class="bgc-white bd bdrs-3 p-20 mB-20">
									<button type="button" class="btn cur-p btn-outline-primary" style="" onclick="reload_table()">
										<i class="fas fa-sync-alt"></i>
                  </button>
									<?php if (isAdminJakarta()): ?>
										<!-- <button type="button" class="btn cur-p btn-primary" id="semua_pengajuan">
	                    SEMUA PENGAJUAN
	                  </button> -->
									<?php endif; ?>
									<?php if (isApproval()): ?>
										<?php if ($this->session->userdata('username') == "stadmaresi"): ?>
											<button type="button" class="btn cur-p btn-primary" id="semua_pengajuan">
		                    SEMUA PENGAJUAN
		                  </button>
										<?php endif; ?>
										<button type="button" class="btn cur-p btn-success" id="belum_diapprove">
	                    MENUNGGU APPROVE ANDA
	                  </button>
										<?php if ($this->session->userdata('username') == "stadmaresi"): ?>
											<button type="button" class="btn cur-p btn-success" id="belum_diproses">
												BELUM DIPROSES
											</button>
										<?php endif; ?>
										<button type="button" class="btn cur-p btn-danger" id="rejected">
	                    REJECTED
	                  </button>
										<?php if ($this->session->userdata('username') == "stadmaresi") { ?>
											<button type="button" class="btn cur-p btn-secondary" id="sudah_diproses">
		                    SUDAH DIAPPROVE / HISTORY
		                  </button>
										<?php } else { ?>
											<button type="button" class="btn cur-p btn-secondary" id="sudah_diapprove">
												SUDAH DIAPPROVE / HISTORY
											</button>
										<?php } ?>
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
									<?php endif; ?>
									<?php if (isAdminTasik()): ?>
										<button type="button" class="btn cur-p btn-primary" id="semua_pengajuan">
											SEMUA PENGAJUAN
										</button>
										<button type="button" class="btn cur-p btn-success" id="belum_diapprove">
	                    BELUM DIAPPROVE
	                  </button>
										<button type="button" class="btn cur-p btn-success" id="belum_diprint">
											PENDING KEUANGAN
										</button>
										<button type="button" class="btn cur-p btn-secondary" id="on_progress">
	                    ON PROGRESS
	                  </button>
										<button type="button" class="btn cur-p btn-danger" id="rejected">
	                    REJECTED
	                  </button>
										<button type="button" class="btn cur-p btn-success" id="history_btn">
											HISTORY
										</button>
									<?php endif; ?>
									<?php if (isApproval()): ?>
										<div class="" id="approve_terpilih" style="display:none">
											<br>
											<button type="button" class="btn cur-p btn-success" onclick="approveTerpilih()">
		                    APPROVE YANG TERPILIH
		                  </button>
										</div>
										<!-- <button type="button" class="btn cur-p btn-success" onclick="approveSemuaPengajuan()">
	                    APPROVE SEMUA PENGAJUAN
	                  </button> -->
									<?php endif; ?>
									<br>
									<?php if (isAdminJakarta()): ?>
										<!-- <button type="button" class="btn cur-p btn-secondary" onclick="reload_table()">
	                    EXPORT TO EXCEL
	                  </button> -->
										<br>
										<a id="print" class="btn btn-outline-primary" target="_blank" href="<?=site_url('submission/print')?>"><i class="fas fa-print"></i>&nbsp; PRINT</a>
										<a id="print_evi" class="btn btn-outline-primary" target="_blank" href="<?=site_url('submission/print-evidences')?>"><i class="fas fa-print"></i>&nbsp; PRINT EVIDENCES <i>*exclude document files</i></a>
										<a id="print_c" class="btn btn-outline-primary" target="_blank" href="<?=site_url('submission/printTerpilih')?>"><i class="fas fa-print"></i>&nbsp; PRINT ULANG YANG TERPILIH</a>
										<a id="acc" class="btn btn-outline-primary" onclick="accTerpilih()">ACC YANG TERPILIH</a>
										<button type="button" class="btn cur-p btn-outline-primary" id="check_all">
											CHECK ALL
										</button>
										<button type="button" class="btn cur-p btn-outline-primary" id="uncheck_all">
											UNCHECK ALL
										</button>
										<button type="button" class="btn cur-p btn-outline-primary" id="h_check_all">
											CHECK ALL
										</button>
										<button type="button" class="btn cur-p btn-outline-primary" id="h_uncheck_all">
											UNCHECK ALL
										</button>
									<?php endif; ?>
									<hr>
									<?php if (isApproval() || isAdminJakarta()) { ?>
										Menampilkan <span id="menampilkan">Pengajuan yang Belum <?php if(isApproval()) { echo "diApprove"; } else { echo "diPrint"; } ?></span>
									<?php } else { ?>
										Menampilkan Pengajuan Anda
									<?php } ?>
									<br><br>
									<table cellspacing="0" class="table table-striped table-bordered" id="submission" width="100%">
										<thead>
											<tr>
												<?php if (isAdminJakarta() || isApproval()): ?>
													<th class="text-center" style="width:20px">
														<!-- <input type="checkbox" name="checkall" id="checkall" value="" onclick="checkall()"> -->
													</th>
												<?php endif; ?>
												<th class="text-center" style="width:30px">NO</th>
												<th class="text-center">Pengajuan</th>
												<th class="text-center">Tanggal<br>Pengajuan</th>
												<?php if (isApproval()): ?>
													<th class="text-center">Nama<br>Project</th>
												<?php endif; ?>
												<!-- <th class="text-center">Tanggal<br>Pengajuan</th> -->
												<?php if (!(isAdminJakarta() || isApproval())): ?>
													<th class="text-center">Tanggal<br>Approval</th>
													<th class="text-center">Tanggal<br>Approval Keuangan</th>
												<?php endif; ?>
                        <th class="text-center">Realisasi<br>Pengajuan</th>
												<!-- <th class="text-center" id="invoiced_stat">Invoiced</th>
												<th class="text-center" id="bayar_stat">Bayar</th>
												<th class="text-center" id="client_stat">Bayar<br>Client</th> -->
                        <th class="text-center" style="width:250px;">ACTION</th>
											</tr>
										</thead>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

			<script>

				CKEDITOR.replace('keterangan', {
					toolbarGroups: [
						{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
						{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
						{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
						{ name: 'forms', groups: [ 'forms' ] },
						'/',
						{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
						{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
						{ name: 'links', groups: [ 'links' ] },
						{ name: 'insert', groups: [ 'insert' ] },
						'/',
						{ name: 'styles', groups: [ 'styles' ] },
						{ name: 'colors', groups: [ 'colors' ] },
						{ name: 'tools', groups: [ 'tools' ] },
						{ name: 'others', groups: [ 'others' ] },
						{ name: 'about', groups: [ 'about' ] }
					],
					removeButtons: 'Image,Flash,Link,Unlink,BidiRtl,BidiLtr,JustifyLeft,CreateDiv,Blockquote,JustifyCenter,Indent,Outdent,NumberedList,BulletedList,RemoveFormat,CopyFormatting,Bold,Underline,Italic,Strike,Subscript,Superscript,Form,Checkbox,Radio,TextField,Textarea,Select,ImageButton,Button,Scayt,SelectAll,Find,Replace,Redo,Undo,Cut,Copy,Paste,PasteText,PasteFromWord,JustifyBlock,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,JustifyRight,Language,Anchor,Styles,TextColor,Maximize,About,ShowBlocks,BGColor,Format,Font,FontSize,Source,Save,NewPage,Preview,Print,Templates,HiddenField'
				});

				$(document).on({'show.bs.modal': function () {
                 $(this).removeAttr('tabindex');
      	}}, '.modal');

				$(document).ready(function() {
							$('#input1').filer();
							$('.file_input').filer({
									showThumbs: true,
									templates: {
											box: '<ul class="jFiler-item-list"></ul>',
											item: '<li class="jFiler-item">\
																	<div class="jFiler-item-container">\
																			<div class="jFiler-item-inner">\
																					<div class="jFiler-item-thumb">\
																							<div class="jFiler-item-status"></div>\
																							<div class="jFiler-item-info">\
																									<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
																							</div>\
																							{{fi-image}}\
																					</div>\
																					<div class="jFiler-item-assets jFiler-row">\
																							<ul class="list-inline pull-left">\
																									<li><span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span></li>\
																							</ul>\
																							<ul class="list-inline pull-right">\
																									<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
																							</ul>\
																					</div>\
																			</div>\
																	</div>\
															</li>',
											itemAppend: '<li class="jFiler-item">\
																	<div class="jFiler-item-container">\
																			<div class="jFiler-item-inner">\
																					<div class="jFiler-item-thumb">\
																							<div class="jFiler-item-status"></div>\
																							<div class="jFiler-item-info">\
																									<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
																							</div>\
																							{{fi-image}}\
																					</div>\
																					<div class="jFiler-item-assets jFiler-row">\
																							<ul class="list-inline pull-left">\
																									<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
																							</ul>\
																							<ul class="list-inline pull-right">\
																									<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
																							</ul>\
																					</div>\
																			</div>\
																	</div>\
															</li>',
											progressBar: '<div class="bar"></div>',
											itemAppendToEnd: true,
											removeConfirmation: true,
											_selectors: {
													list: '.jFiler-item-list',
													item: '.jFiler-item',
													progressBar: '.bar',
													remove: '.jFiler-item-trash-action',
											}
									},
									addMore: true,
									files: []
							});

							$('#buktisusulan').filer({
									limit: null,
									maxSize: null,
									extensions: null,
									changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
									showThumbs: true,
									appendTo: null,
									theme: "dragdropbox",
									templates: {
											box: '<ul class="jFiler-item-list"></ul>',
											item: '<li class="jFiler-item">\
																	<div class="jFiler-item-container">\
																			<div class="jFiler-item-inner">\
																					<div class="jFiler-item-thumb">\
																							<div class="jFiler-item-status"></div>\
																							<div class="jFiler-item-info">\
																									<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
																							</div>\
																							{{fi-image}}\
																					</div>\
																					<div class="jFiler-item-assets jFiler-row">\
																							<ul class="list-inline pull-left">\
																									<li>{{fi-progressBar}}</li>\
																							</ul>\
																							<ul class="list-inline pull-right">\
																									<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
																							</ul>\
																					</div>\
																			</div>\
																	</div>\
															</li>',
											itemAppend: '<li class="jFiler-item">\
																	<div class="jFiler-item-container">\
																			<div class="jFiler-item-inner">\
																					<div class="jFiler-item-thumb">\
																							<div class="jFiler-item-status"></div>\
																							<div class="jFiler-item-info">\
																									<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
																							</div>\
																							{{fi-image}}\
																					</div>\
																					<div class="jFiler-item-assets jFiler-row">\
																							<ul class="list-inline pull-left">\
																									<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
																							</ul>\
																							<ul class="list-inline pull-right">\
																									<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
																							</ul>\
																					</div>\
																			</div>\
																	</div>\
															</li>',
											progressBar: '<div class="bar"></div>',
											itemAppendToEnd: false,
											removeConfirmation: false,
											_selectors: {
													list: '.jFiler-item-list',
													item: '.jFiler-item',
													progressBar: '.bar',
													remove: '.jFiler-item-trash-action',
											}
									},
									uploadFile: {
											url: "upload.php",
											data: {},
											type: 'POST',
											enctype: 'multipart/form-data',
											beforeSend: function(){},
											success: function(data, el){
													var parent = el.find(".jFiler-jProgressBar").parent();
													el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
															$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
													});
											},
											error: function(el){
													var parent = el.find(".jFiler-jProgressBar").parent();
													el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
															$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
													});
											},
											statusCode: {},
											onProgress: function(){},
									},
									dragDrop: {
											dragEnter: function(){},
											dragLeave: function(){},
											drop: function(){},
									},
									addMore: true,
									clipBoardPaste: true,
									excludeName: null,
									beforeShow: function(){return true},
									onSelect: function(){},
									afterShow: function(){},
									onRemove: function(){},
									onEmpty: function(){},
									captions: {
											button: "Choose Files",
											feedback: "Choose files To Upload",
											feedback2: "files were chosen",
											drop: "Drop file here to Upload",
											removeConfirmation: "Are you sure you want to remove this file?",
											errors: {
													filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
													filesType: "Only Images are allowed to be uploaded.",
													filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
													filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
											}
									}
							});


							$('#buktitransaksi').filer({
									limit: null,
									maxSize: null,
									extensions: null,
									changeInput: '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-icon"><i class="icon-jfi-cloud-up-o"></i></div><div class="jFiler-input-text"><h3>Drag&Drop files here</h3> <span style="display:inline-block; margin: 15px 0">or</span></div><a class="jFiler-input-choose-btn blue">Browse Files</a></div></div>',
									showThumbs: true,
									appendTo: null,
									theme: "dragdropbox",
									templates: {
											box: '<ul class="jFiler-item-list"></ul>',
											item: '<li class="jFiler-item">\
																	<div class="jFiler-item-container">\
																			<div class="jFiler-item-inner">\
																					<div class="jFiler-item-thumb">\
																							<div class="jFiler-item-status"></div>\
																							<div class="jFiler-item-info">\
																									<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
																							</div>\
																							{{fi-image}}\
																					</div>\
																					<div class="jFiler-item-assets jFiler-row">\
																							<ul class="list-inline pull-left">\
																									<li>{{fi-progressBar}}</li>\
																							</ul>\
																							<ul class="list-inline pull-right">\
																									<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
																							</ul>\
																					</div>\
																			</div>\
																	</div>\
															</li>',
											itemAppend: '<li class="jFiler-item">\
																	<div class="jFiler-item-container">\
																			<div class="jFiler-item-inner">\
																					<div class="jFiler-item-thumb">\
																							<div class="jFiler-item-status"></div>\
																							<div class="jFiler-item-info">\
																									<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name | limitTo: 25}}</b></span>\
																							</div>\
																							{{fi-image}}\
																					</div>\
																					<div class="jFiler-item-assets jFiler-row">\
																							<ul class="list-inline pull-left">\
																									<span class="jFiler-item-others">{{fi-icon}} {{fi-size2}}</span>\
																							</ul>\
																							<ul class="list-inline pull-right">\
																									<li><a class="icon-jfi-trash jFiler-item-trash-action"></a></li>\
																							</ul>\
																					</div>\
																			</div>\
																	</div>\
															</li>',
											progressBar: '<div class="bar"></div>',
											itemAppendToEnd: false,
											removeConfirmation: false,
											_selectors: {
													list: '.jFiler-item-list',
													item: '.jFiler-item',
													progressBar: '.bar',
													remove: '.jFiler-item-trash-action',
											}
									},
									uploadFile: {
											url: "upload.php",
											data: {},
											type: 'POST',
											enctype: 'multipart/form-data',
											beforeSend: function(){},
											success: function(data, el){
													var parent = el.find(".jFiler-jProgressBar").parent();
													el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
															$("<div class=\"jFiler-item-others text-success\"><i class=\"icon-jfi-check-circle\"></i> Success</div>").hide().appendTo(parent).fadeIn("slow");
													});
											},
											error: function(el){
													var parent = el.find(".jFiler-jProgressBar").parent();
													el.find(".jFiler-jProgressBar").fadeOut("slow", function(){
															$("<div class=\"jFiler-item-others text-error\"><i class=\"icon-jfi-minus-circle\"></i> Error</div>").hide().appendTo(parent).fadeIn("slow");
													});
											},
											statusCode: {},
											onProgress: function(){},
									},
									dragDrop: {
											dragEnter: function(){},
											dragLeave: function(){},
											drop: function(){},
									},
									addMore: true,
									clipBoardPaste: true,
									excludeName: null,
									beforeShow: function(){return true},
									onSelect: function(){},
									afterShow: function(){},
									onRemove: function(){},
									onEmpty: function(){},
									captions: {
											button: "Choose Files",
											feedback: "Choose files To Upload",
											feedback2: "files were chosen",
											drop: "Drop file here to Upload",
											removeConfirmation: "Are you sure you want to remove this file?",
											errors: {
													filesLimit: "Only {{fi-limit}} files are allowed to be uploaded.",
													filesType: "Only Images are allowed to be uploaded.",
													filesSize: "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
													filesSizeAll: "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
											}
									}
							});
				});

				$("#input-ke-1").fileinput({
					minFileCount: 0,
					showUpload: false,
					showCancel: false,
					overwriteInitial: true
				});
				//
				// $("#buktisusulan").fileinput({
				// 	theme: "explorer",
			  //   uploadUrl: "/public/assets/evidence/",
			  //   minFileCount: 2,
			  //   maxFileCount: 5,
			  //   overwriteInitial: false,
			  //   previewFileIcon: '<i class="fa fa-file"></i>',
			  //   initialPreview: [
			  //   ],
			  //   initialPreviewAsData: true, // defaults markup
			  //   initialPreviewConfig: [
				//
			  //   ],
			  //   uploadExtraData: {
			  //       img_key: "1000",
			  //       img_keywords: "happy, nature"
			  //   },
			  //   preferIconicPreview: true, // this will force thumbnails to display icons for following file extensions
			  //   previewFileIconSettings: {
			  //   },
			  //   previewFileExtSettings: { // configure the logic for determining icon file extensions
			  //       'doc': function(ext) {
			  //           return ext.match(/(doc|docx)$/i);
			  //       },
			  //       'xls': function(ext) {
			  //           return ext.match(/(xls|xlsx)$/i);
			  //       },
			  //       'ppt': function(ext) {
			  //           return ext.match(/(ppt|pptx)$/i);
			  //       },
			  //       'zip': function(ext) {
			  //           return ext.match(/(zip|rar|tar|gzip|gz|7z)$/i);
			  //       },
			  //       'htm': function(ext) {
			  //           return ext.match(/(htm|html)$/i);
			  //       },
			  //       'txt': function(ext) {
			  //           return ext.match(/(txt|ini|csv|java|php|js|css)$/i);
			  //       },
			  //       'mov': function(ext) {
			  //           return ext.match(/(avi|mpg|mkv|mov|mp4|3gp|webm|wmv)$/i);
			  //       },
			  //       'mp3': function(ext) {
			  //           return ext.match(/(mp3|wav)$/i);
			  //       }
			  //   }
				// });
				//
				// $("#input-ke-3").fileinput({
				// 	theme: "explorer",
				// 	minFileCount: 0,
				// 	showUpload: false,
				// 	showCancel: false,
				// 	overwriteInitial: true
				// });

				$('#tanggal_pengajuan_last_filter').click(function() {
					// console.log(document.getElementById('tanggal_pengajuan_first_filter').value);
					$('#tanggal_pengajuan_last_filter').datepicker({
						minDate: new Date(document.getElementById('tanggal_pengajuan_first_filter').value)
					});
				});

				$('#realisasi_pengajuan_last_filter').click(function() {
					// console.log(document.getElementById('tanggal_pengajuan_first_filter').value);
					$('#realisasi_pengajuan_last_filter').datepicker({
						minDate: new Date(document.getElementById('realisasi_pengajuan_first_filter').value)
					});
				});

				// function bs_input_file() {
				// 	$(".input-file").before(
				// 		function() {
				// 			if ( ! $(this).prev().hasClass('input-ghost') ) {
				// 				var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
				// 				element.attr("name",$(this).attr("name"));
				// 				element.change(function(){
				// 					element.next(element).find('input').val((element.val()).split('\\').pop());
				// 				});
				// 				$(this).find("button.btn-choose").click(function(){
				// 					element.click();
				// 				});
				// 				$(this).find("button.btn-reset").click(function(){
				// 					element.val(null);
				// 					$(this).parents(".input-file").find('input').val('');
				// 				});
				// 				$(this).find('input').css("cursor","pointer");
				// 				$(this).find('input').mousedown(function() {
				// 					$(this).parents('.input-file').prev().click();
				// 					return false;
				// 				});
				// 				return element;
				// 			}
				// 		}
				// 	);
				// }
				// $(function() {
				// bs_input_file();
				// });

				$(document).ready(function(){
					var id = 1;
					$("#add_more").click(function(){
						var showId = ++id;
						if(showId <=10)
						{
							$(".input-files").append('<input type="file" name="file_upload-'+showId+'">');
						}
					});
				});

				document.getElementsByClassName('stat').visibility = 'hidden';
				document.getElementsByClassName('stat').display = 'none';
				$('#invoiced_stat').hide();
				$('#bayar_stat').hide();
				$('#client_stat').hide();
				$('#tanggal_pengajuan_satuan').hide();
				$('#tanggal_pengajuan_range').hide();
				$('#realisasi_pengajuan_satuan').hide();
				$('#realisasi_pengajuan_range').hide();
				$('#print').show();
				$('#print_c').hide();
				$('#acc').hide();
				$('#check_all').hide();
				$('#uncheck_all').hide();
				$('#h_check_all').hide();
				$('#h_uncheck_all').hide();

				$(document).ready(function() {
						submission = $('#submission').DataTable({
								"processing": true,
								"serverSide": true,
			          dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
			               "<'row'<'col-sm-12'tr>>" +
			               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
			          "pageLength": 15,
								// rowReorder: {
				        // 	selector: 'td:nth-child(2)'
				        // },
								// "responsive": true,
								// "language"	: {
								// 	"info": "Menampilkan halaman _PAGE_ of _PAGES_"
								// },
								"order": [],
								"ajax": {
										"url": "<?php echo site_url('submission/data')?>",
										"type": "POST",
										"data": function(data) {
											data.on_progress = $('#on_progress_val').val();
											data.belum_diprint = $('#belum_diprint_val').val();
											data.history = $('#history_val').val();
											data.progress_project = $('#progress_project_val').val();
											data.semua_pengajuan = $('#semua_pengajuan_val').val();
											data.belum_diapprove = $('#belum_diapprove_val').val();
											data.reject = $('#reject_val').val();
											data.sudah_diapprove = $('#sudah_diapprove_val').val();
											data.belum_diproses = $('#belum_diproses_val').val();
											data.sudah_diproses = $('#sudah_diproses_val').val();

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
										<?php if(isApproval()) { ?>
											"targets"		: [0, 2, 3, 5, 6]
										<?php } else if (isAdminJakarta()) { ?>
											"targets"		: [0, 2, 3, 4, 5]
										<?php } else { ?>
											"targets"		: [1, 2, 3, 4, 5, 6]
										<?php } ?>
									}
								],
						});

						$(document).ready(function() {
							<?php if(isAdminJakarta()) { ?>
								document.getElementById("belum_diprint_val").value = "Y";
							<?php } ?>
							submission.ajax.reload();  //just reload table
						});

						$('#on_progress').click(function() {
							$('#menampilkan').text("Pengajuan yang Terhold");
							$("input[type=hidden]").val("N");
							document.getElementById("on_progress_val").value = "Y";
							<?php if(!isAdminTasik()) { ?>
								document.getElementById("print").href = "<?=site_url('submission/re-print')?>";
							<?php } ?>
							$('#print').show();
							$('#print_c').show();
							$('#print_evi').hide();
							$('#acc').show();
							$('#check_all').show();
							$('#uncheck_all').show();
							$('#h_check_all').hide();
							$('#h_uncheck_all').hide();
							submission.ajax.reload();  //just reload table
						});

						$('#semua_pengajuan').click(function() {
							$('#print').hide();
							$('#menampilkan').text("Semua Pengajuan <?php if(isApproval()) { echo "Anda"; } ?>");
							document.getElementById("belum_diprint_val").value = "N";
							document.getElementById("history_val").value = "N";
							document.getElementById("on_progress_val").value = "N";
							document.getElementById("progress_project_val").value = "N";
							document.getElementById("belum_diapprove_val").value = "N";
							document.getElementById("reject_val").value = "N";
							document.getElementById("sudah_diapprove_val").value = "N";
							document.getElementById("belum_diproses_val").value = "N";
							document.getElementById("sudah_diproses_val").value = "N";
							document.getElementById("semua_pengajuan_val").value = "N";
							submission.ajax.reload();  //just reload table
							$('#print_c').hide();
							$('#acc').hide();
							$('#check_all').hide();
							$('#uncheck_all').hide();
							$('#h_check_all').hide();
							$('#h_uncheck_all').hide();
							$('#print_evi').hide();
						});

						$('#belum_diprint').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum Diprint");
							$("input[type=hidden]").val("N");
							document.getElementById("belum_diprint_val").value = "Y";
							<?php if (!isAdminTasik()) { ?>
								document.getElementById("print").href = "<?=site_url('submission/print')?>";
							<?php } ?>
							$('#print').show();
							$('#print_c').hide();
							$('#acc').hide();
							$('#print_evi').show();
							$('#check_all').hide();
							$('#uncheck_all').hide();
							$('#h_check_all').hide();
							$('#h_uncheck_all').hide();
							submission.ajax.reload();  //just reload table
						});

						$('#rejected').click(function() {
							$('#menampilkan').text("Pengajuan yang diReject");
							$("input[type=hidden]").val("N");
							document.getElementById("reject_val").value = "Y";
							$('#approve_terpilih').hide();
							submission.ajax.reload();  //just reload table
						});

						$('#belum_diapprove').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum diApprove");
							$("input[type=hidden]").val("N");
							document.getElementById("belum_diapprove_val").value = "Y";
							$('#approve_terpilih').show();
							submission.ajax.reload();  //just reload table
						});

						$('#sudah_diapprove').click(function() {
							$('#menampilkan').text("Pengajuan yang Sudah diApprove");
							$("input[type=hidden]").val("N");
							document.getElementById("sudah_diapprove_val").value = "Y";
							$('#approve_terpilih').hide();
							submission.ajax.reload();  //just reload table
						});

						$('#belum_diproses').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum diProses");
							$("input[type=hidden]").val("N");
							document.getElementById("belum_diproses_val").value = "Y";
							$('#approve_terpilih').hide();
							submission.ajax.reload();  //just reload table
						});

						$('#sudah_diproses').click(function() {
							$('#menampilkan').text("Pengajuan yang Sudah diProses");
							$("input[type=hidden]").val("N");
							document.getElementById("sudah_diproses_val").value = "Y";
							$('#approve_terpilih').hide();
							submission.ajax.reload();  //just reload table
						});

						$('#history_btn').click(function() {
							$('#menampilkan').text("History Pengajuan");
							$("input[type=hidden]").val("N");
							document.getElementById("history_val").value = "Y";
							<?php if(!isAdminTasik()) { ?>
								document.getElementById("print").href = "<?=site_url('submission/re-print-h')?>";
							<?php } ?>
							$('#print').show();
							$('#print_c').hide();
							$('#acc').hide();
							$('#print_evi').hide();
							$('#check_all').hide();
							$('#uncheck_all').hide();
							$('#h_check_all').show();
							$('#h_uncheck_all').show();
							submission.ajax.reload();  //just reload table
						});

						$('#progress_project_btn').click(function() {
							$('.stat').hide();
							$('#invoiced_stat').show();
							$('#bayar_stat').show();
							$('#client_stat').show();
							$('#print_c').hide();
							$('#print_evi').hide();
							$('#acc').hide();

							$("input[type=hidden]").val("N");
							document.getElementById("progress_project_val").value = "Y";
							$('#print').hide();
							submission.ajax.reload();  //just reload table
						})

						$('#check_all').click(function() {
							$.ajax({
								url: "<?=site_url('submission/checkAll/')?>",
								type: "POST",
								success: function(data) {
									reload_table();
								}, error: function(XMLHttpRequest, textStatus, errorThrown) {
									console.log(errorThrown);
								}
							});
						});

						$('#uncheck_all').click(function() {
							$.ajax({
								url: "<?=site_url('submission/unCheckAll/')?>",
								type: "POST",
								success: function(data) {
									reload_table();
								}, error: function(XMLHttpRequest, textStatus, errorThrown) {
									console.log(errorThrown);
								}
							});
						});

						$('#h_check_all').click(function() {
							$.ajax({
								url: "<?=site_url('submission/hCheckAll/')?>",
								type: "POST",
								success: function(data) {
									reload_table();
								}, error: function(XMLHttpRequest, textStatus, errorThrown) {
									console.log(errorThrown);
								}
							});
						});

						$('#h_uncheck_all').click(function() {
							$.ajax({
								url: "<?=site_url('submission/hunCheckAll/')?>",
								type: "POST",
								success: function(data) {
									reload_table();
								}, error: function(XMLHttpRequest, textStatus, errorThrown) {
									console.log(errorThrown);
								}
							});
						});

						$('#btn-filter').click(function() { //button filter event click
				    	submission.ajax.reload();  //just reload table
				    });

				    $('#btn-reset').click(function() { //button reset event click
				    	$('#form-filter')[0].reset();
							$("#nama_pengaju_filter").val('default');
							$("#nama_pengaju_filter").selectpicker("refresh");
							$("#kategori_pengajuan_filter").val('default');
							$("#kategori_pengajuan_filter").selectpicker("refresh");
							$("#jenis_pengajuan_filter").val('default');
							$("#jenis_pengajuan_filter").selectpicker("refresh");
							$("#tanggal_pengajuan_jns_op").val('default');
							$("#tanggal_pengajuan_jns_op").selectpicker("refresh");
							$("#realisasi_pengajuan_jns_op").val('default');
							$("#realisasi_pengajuan_jns_op").selectpicker("refresh");
							$('#tanggal_pengajuan_satuan').hide();
							$('#tanggal_pengajuan_range').hide();
							$('#realisasi_pengajuan_satuan').hide();
							$('#realisasi_pengajuan_range').hide();
				    	submission.ajax.reload();  //just reload table
				    });
				});

				function reload_table() {
					submission.ajax.reload(null, false);
				}

				$('#jenis_nilai_div').hide();
				$('#start_penawaran_dmt_div').hide();
				$('#no_spk_div').hide();
				$('#nilai_sph_div').hide();
				$('#nilai_po_div').hide();
				$('#nilai_corr_div').hide();
				$('#no_sph_div').hide();
				$('#no_po_div').hide();
				$('#no_corr_div').hide();
				$('#nama_project').hide();
				$('#new_site_div').hide();
				$('#new_project_div').hide();
				$('#project_id_div').hide();
				$('#custom_filter').hide();
				$('#site_id_div').hide();
				$('#pid_div_det').hide();
				$('#start_penawaran_dmt_div_det').hide();

				// CURRENCY SEPARATOR
				webshims.setOptions('forms-ext', {
				  replaceUI: 'auto',
					types: 'number'
				});
				webshims.polyfill('forms forms-ext');

				$(document).ready(function() {
					$('#custom_filter_btn').click(function() {
						if ($('#custom_filter_btn').html() === '<i class="fas fa-filter"></i>&nbsp; HIDE CUSTOM FILTER') {
							$('#custom_filter').hide();
						} else {
							$('#custom_filter').show();
						}

						$('#custom_filter_btn').html(function(i, v) {
							return v === '<i class="fas fa-filter"></i>&nbsp; HIDE CUSTOM FILTER' ? '<i class="fas fa-filter"></i>&nbsp; SHOW CUSTOM FILTER' : '<i class="fas fa-filter"></i>&nbsp; HIDE CUSTOM FILTER'
						});
					});
				});

				$(document).ready(function() {
					$('#site_id').change(function() {
						if ($(this).val() === 'new_site') {
							$('#new_site_div').show();
						} else {
							$('#new_site_div').hide();
						}
					});
				});

				$(document).ready(function() {
					$('#project_id').change(function() {
						if ($(this).val() === 'new_project') {
							$('#new_project_div').show();
						} else {
							$('#new_project_div').hide();
							$('#nilai_sph_div').hide();
							$('#nilai_po_div').hide();
							$('#nilai_corr_div').hide();
							$('#no_sph_div').hide();
							$('#no_po_div').hide();
							$('#no_corr_div').hide();

							$('[name=nilai_sph]').val("");
							$('[name=nilai_po]').val("");
							$('[name=nilai_corr]').val("");
						}
					});
				});

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

				// HIDE AND SHOW
				$(document).ready(function() {
					$('#jenis_pengajuan').change(function() {
						if ($(this).val() === 'Non Project' || $(this).val() === 'Operasional') {
							$('#nilai_sph_div').hide();
							$('#nilai_po_div').hide();
							$('#nilai_corr_div').hide();
						} else {
						}
					});
				});

				$(document).ready(function() {
					$('#kategori_pengajuan').change(function() {
						if ($(this).val() === 'project') {
							$('#nama_project').show();
							$('#project_id_div').show();
							$('#jenis_nilai_div').show();
							$('#start_penawaran_dmt_div').show();
							$('#site_id_div').show();

							$('#jenis_pengajuan option[value="Project"]').show();
							$('#jenis_pengajuan option[value="Corrective"]').show();
							$('#jenis_pengajuan option[value="Commcase"]').show();
							$('#jenis_pengajuan option[value="Gaji PJS"]').show();
							$('#jenis_pengajuan option[value="Imbas Petir"]').show();
							$('#jenis_pengajuan option[value="Non Project"]').hide();
							$('#jenis_pengajuan option[value="Operasional"]').hide();
							$('#jenis_pengajuan').selectpicker('refresh')
						} else if ($(this).val() === 'non_project') {
							$('#start_penawaran_dmt_div').hide();
							$('#no_spk_div').hide();
							$('#jenis_nilai_div').show();
							$('#nama_project').hide();
							$('#project_id_div').hide();
							$('#jenis_nilai_div').hide();
							$('#new_project_div').hide();
							$('#nilai_sph_div').hide();
							$('#nilai_po_div').hide();
							$('#nilai_corr_div').hide();
							$('#site_id_div').hide();

							$('#project_id').val("");
							$('[name=project_id]').val("");
							$('[name=nama_project]').val("");
							$('[name=nilai_sph]').val("");
							$('[name=nilai_po]').val("");
							$('[name=nilai_corr]').val("");

							$('#jenis_pengajuan option[value="Project"]').hide();
							$('#jenis_pengajuan option[value="Corrective"]').hide();
							$('#jenis_pengajuan option[value="Commcase"]').hide();
							$('#jenis_pengajuan option[value="Gaji PJS"]').hide();
							$('#jenis_pengajuan option[value="Imbas Petir"]').hide();
							$('#jenis_pengajuan option[value="Non Project"]').show();
							$('#jenis_pengajuan option[value="Operasional"]').show();
							$('#jenis_pengajuan').selectpicker('refresh')
						}
					});
				});

				$(document).ready(function() {
					$('#jenis_nilai').change(function() {
						if ($(this).val() === 'jenis_sph') {
							$('#nilai_sph_div').show();
							$('#nilai_po_div').hide();
							$('#nilai_corr_div').hide();
							$('#no_sph_div').show();
							$('#no_po_div').hide();
							$('#no_corr_div').hide();
							$('#no_spk_div').hide();

							$('[name=nilai_sph]').val("");
							$('[name=nilai_po]').val("");
							$('[name=nilai_corr]').val("");
							$('[name=no_sph]').val("");
							$('[name=no_po]').val("");
							$('[name=no_corr]').val("");
						} else if ($(this).val() === 'jenis_po') {
							$('#nilai_sph_div').hide();
							$('#nilai_po_div').show();
							$('#nilai_corr_div').show();
							$('#no_sph_div').hide();
							$('#no_po_div').show();
							$('#no_corr_div').show();
							$('#no_spk_div').show();

							$('[name=nilai_sph]').val("");
							$('[name=nilai_po]').val("");
							$('[name=nilai_corr]').val("");
							$('[name=no_sph]').val("");
							$('[name=no_po]').val("");
							$('[name=no_corr]').val("");
						} else if ($(this).val() === 'jenis_corr') {
							$('#nilai_sph_div').hide();
							$('#nilai_po_div').hide();
							$('#nilai_corr_div').show();
							$('#no_sph_div').hide();
							$('#no_po_div').hide();
							$('#no_corr_div').show();
							$('#no_spk_div').hide();

							$('[name=nilai_sph]').val("");
							$('[name=nilai_po]').val("");
							$('[name=nilai_corr]').val("");
							$('[name=no_sph]').val("");
							$('[name=no_po]').val("");
							$('[name=no_corr]').val("");
						}
					});
				});

				$(document).ready(function() {
					$('#upload-image').click(function() {
						$('[name=bukti]').val("");
						$('#thumbnail > img').remove();
					});
					$('#reset').click(function() {
						$('[name=bukti]').val("");
						$('#thumbnail > img').remove();
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
						var reject = document.getElementById('reject_val').value;
						var sudah_diapprove = document.getElementById('sudah_diapprove_val').value;
						var pengajuan = document.getElementById('pengajuan_filter').value;
						// var kategori_pengajuan = document.getElementById('kategori_pengajuan_filter').value;
						var jenis_pengajuan = document.getElementById('jenis_pengajuan_filter').value;
						var tanggal_pengajuan = document.getElementById('tanggal_pengajuan_filter').value;
						var tanggal_pengajuan_first = document.getElementById('tanggal_pengajuan_first_filter').value;
						var tanggal_pengajuan_last = document.getElementById('tanggal_pengajuan_last_filter').value;
						var realisasi_pengajuan = document.getElementById('realisasi_pengajuan_filter').value;
						var realisasi_pengajuan_first = document.getElementById('realisasi_pengajuan_first_filter').value;
						var realisasi_pengajuan_last = document.getElementById('realisasi_pengajuan_last_filter').value;
						var nama_pengaju = document.getElementById('nama_pengaju_filter').value;

						$.ajax({
							url: "<?=site_url('submission/exportExcel')?>",
							type: "POST",
							dataType: "json",
							beforeSend: function() {
								window.open("<?=site_url('submission/exportExcel')?>
										?on_progress="+on_progress+
										"&belum_diprint="+belum_diprint+
										"&history="+history+
										"&progress_project="+progress_project+
										"&semua_pengajuan="+semua_pengajuan+
										"&belum_diapprove="+belum_diapprove+
										"&sudah_diapprove="+sudah_diapprove+
										"&pengajuan="+pengajuan+
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

				// $(document).ready(function() {
				// 	if ($('[name=bukti]').val().length != 0) {
				// 		$('#upload').text('Change');
				// 	}
				// });

				function approveTerpilih() {
					url = "<?=site_url('submission/approveTerpilih')?>";
					$.ajax({
						url: url,
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Semua pengajuan yang terpilih berhasil diapprove!", "success");
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function accTerpilih() {
					url = "<?=site_url('submission/accTerpilih')?>";
					$.ajax({
						url: url,
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Semua pengajuan yang terpilih berhasil diacc!", "success");
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function checkall() {
					if (document.getElementById("checkall").checked = true) {
						url = "<?=site_url('submission/checkall')?>";
						$.ajax({
							url: url,
							type: "POST",
							success: function(data) {
								if (data.status = 'true') {
									reload_table();
								} else {
									swal("Error!", "Something went wrong!", "error");
									reload_table();
								}
							}
						});
					} else if (document.getElementById("checkall").checked = false) {
						url = "<?=site_url('submission/rmvcheckall')?>";
						$.ajax({
							url: url,
							type: "POST",
							success: function(data) {
								if (data.status = 'true') {
									reload_table();
								} else {
									swal("Error!", "Something went wrong!", "error");
									reload_table();
								}
							}
						});
					}
				}

				function saveCBox(id) {
					url = "<?=site_url('submission/savecbox')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function rmvCBox(id) {
					url = "<?=site_url('submission/rmvcbox')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function h_saveCBox(id) {
					url = "<?=site_url('submission/h_savecbox')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function h_rmvCBox(id) {
					url = "<?=site_url('submission/h_rmvcbox')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function pad(num, places) {
					var zero = places - num.toString().length + 1;
					return Array(+(zero > 0 && zero)).join("0") + num;
				}

				function currency_format(num) {
					return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
				}

				function approveSemuaPengajuan() {
					url = "<?=site_url('submission/approveAll')?>";
					$.ajax({
						url: url,
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Semua pengajuan berhasil diapprove", "success");
								reload_table();
							} else {
								swal("Error!", "Something went wrong!", "error");
								reload_table();
							}
						}
					});
				}

				function accPengajuan(id) {
					url = "<?=site_url('submission/approve')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Pengajuan berhasil diapprove!", "success");
								reload_table();
							} else {
								swal("Error!", "Pengajuan gagal diapprove!", "success");
								reload_table();
							}
						}
					});
				}

				function rejectPengajuan(id) {
					swal({
			      title: "Are you sure?",
			      text: "You will not be able to recover this data!",
			      type: "warning",
			      showCancelButton: true,
			      confirmButtonClass: "btn-danger",
			      confirmButtonText: "Yes, reject it!",
			      cancelButtonText: "No, cancel pls!",
			      closeOnConfirm: false,
			      closeOnCancel: false
			    },
			    function(isConfirm) {
			      if (isConfirm) {
			        $.ajax({
			          url: "<?=site_url('submission/rejectPengajuan/')?>" + id,
			          type: "POST",
			          data: {id: id},
			          success: function(data) {
			            swal("Rejected!", "Pengajuan berhasil direject.", "success");
			            reload_table();
			          }
			        });
			      } else {
			        swal("Cancelled", "Pengajuan batal direject", "error");
			      }
			    });
				}

				function accPengajuanAkhir(id) {
					url = "<?=site_url('submission/approveAkhir')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Pengajuan berhasil diapprove!", "success");
								reload_table();
							} else {
								swal("Error!", "Pengajuan gagal diapprove!", "success");
								reload_table();
							}
						}
					});
				}

				function accBos(id) {
					url = "<?=site_url('submission/acc_edwin')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Status berhasil diapprove!", "success");
								reload_table();
							} else {
								swal("Error!", "Status gagal diapprove!", "success");
								reload_table();
							}
						}
					});
				}

				function accLangsung(id) {
					url = "<?=site_url('submission/acc_langsung')?>";
					$.ajax({
						url: url,
						data: {id: id},
						type: "POST",
						success: function(data) {
							if (data.status = 'true') {
								swal("Success!", "Status berhasil diapprove!", "success");
								reload_table();
							} else {
								swal("Error!", "Status gagal diapprove!", "success");
								reload_table();
							}
						}
					});
				}

				function updateProgress(id) {
					$.ajax({
						url: "<?=site_url('submission/getPengajuanDetail/')?>" + id,
						type: "GET",
						dataType: "json",
						success: function(data) {
							$('[name=id]').val(data.pengajuan.pengajuan_id);
							if (data.tanggal_approval_keuangan != null) {
								document.getElementById("done").checked = true;
								document.getElementById("done").value = data.tanggal_approval_keuangan;
							}
							if (data.is_invoiced == 'Y') {
								document.getElementById("invoiced").checked = true;
							}
							if (data.is_bayar == 'Y') {
								document.getElementById("bayar").checked = true;
							}
							if (data.is_bayarclient == 'Y') {
								document.getElementById("bayarclient").checked = true;
							}
							$('#updateProgress').modal('show');
							$('.modal-title').text('Upload Evidence Pengajuan #ADP' + pad(data.pengajuan.pengajuan_id, 4));
							reload_table();
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				function update() {
					$('#btnUpdate').text('Updating...');
					$('#btnUpdate').attr('disabled', true);
					var url;

					url = "<?=site_url('submission/update')?>";

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
								$('#updateProgress').modal('hide');
								$('#alert').modal('show');
								swal("Success!", "Progress berhasil diupdate!", "success");
								reload_table();
							}
							$('#btnUpdate').text('Update');
							$('#btnUpdate').attr('disabled', false);
						}
					});
				}

				function monthDiff(d1, d2) {
					var months;
					months = (d2.getFullYear() - d1.getFullYear()) * 12;
					months -= d1.getMonth() + 1;
					months += d2.getMonth();
					return months <= 0 ? 0 : months;
				}

				$('#nilai_pengajuan_val_edit').hide();
				$('#editNilaiPengajuan').show();
				$('#doneNilaiPengajuan').hide();

				$(document).ready(function() {
					$('#editNilaiPengajuan').click(function() {
						$('#nilai_pengajuan_val_edit').show();
						$('#nilai_pengajuan_val').hide();
						$('#editNilaiPengajuan').hide();
						$('#doneNilaiPengajuan').show();

						$.ajax({
							url: "<?=site_url('submission/getPengajuanDetail/')?>/" + $('#id_val').val(),
							type: "GET",
							dataType: "json",
							success: function(data) {
								$('[name=nilai_pengajuan_edit]').val(data.pengajuan.nilai_pengajuan);
							}
						});
					});
				});

				$(document).ready(function() {
					$('#detailClose').click(function() {
						$('#nilai_pengajuan_val_edit').hide();
						$('#nilai_pengajuan_val').show();
						$('#doneNilaiPengajuan').hide();
						$('#editNilaiPengajuan').show();
					});
				});

				$(document).ready(function() {
					$('#doneNilaiPengajuan').click(function() {
						$('#nilai_pengajuan_val_edit').hide();
						$('#nilai_pengajuan_val').show();
						$('#doneNilaiPengajuan').hide();
						$('#editNilaiPengajuan').show();

						$.ajax({
							url: "<?=site_url('submission/updateNilaiPengajuan/')?>" + $('#id_val').val(),
							type: "POST",
							data: {np: $('[name=nilai_pengajuan_edit]').val()},
							success: function(data) {
								if (data.status = 'true') {
									$.ajax({
										url: "<?=site_url('submission/getPengajuanDetail/')?>/" + $('#id_val').val(),
										type: "GET",
										dataType: "json",
										success: function(data) {
											$('[id=nilai_pengajuan_val]').html("Rp. " + currency_format(data.pengajuan.nilai_pengajuan));
										}
									});
									swal("Success!", "Nilai pengajuan berhasil dirubah!", "success");
									reload_table();
								}
							}, error: function(XMLHttpRequest, textStatus, errorThrown) {
								 console.log(errorThrown);
							}
						});
					});
				});

				function uploadBukti(id) {
			    $.ajax({
			      url: "<?=site_url('submission/getPengajuanDetail/')?>/" + id,
			      type: "GET",
			      dataType: "json",
			      success: function(data) {
			        $('[name=idp]').val(data.pengajuan.pengajuan_id);
							$('.modal-title').text('Upload Bukti Susulan untuk Pengajuan ' + "#ADP" + pad(data.pengajuan.pengajuan_id, 4));
			      }
			    });
			  }

				function uploadBuktiTransaksi(id) {
			    $.ajax({
			      url: "<?=site_url('submission/getPengajuanDetail/')?>/" + id,
			      type: "GET",
			      dataType: "json",
			      success: function(data) {
			        $('[name=idp]').val(data.pengajuan.pengajuan_id);
							$('.modal-title').text('Upload Bukti Transaksi untuk Pengajuan ' + "#ADP" + pad(data.pengajuan.pengajuan_id, 4));
			      }
			    });
			  }

				function remarkPengajuan(id) {
					$.ajax({
			      url: "<?=site_url('submission/historyRemark/')?>" + id,
			      type: "GET",
			      dataType: "json",
			      success: function(data) {
			        document.getElementById("idp_r").value = id;
			        var row1 = '';
			        var row = '';
							console.log(data.length);
							if (data.length != 0) {
			        	for (var i = 0; i < data.length; i++) {
			            row1+='<div style="border:solid 1px green;border-radius:4px;padding:10px;margin-bottom:5px;">'+
										'<span style="font-size:11px !important;margin:auto !important;">'+ data[i].name +' pada ' + moment(data[i].remark_at).format('dddd, D MMMM Y') +'</span>'+
			              '<br><span>'+ data[i].remark +'</span>'+
			            '</div>';
			          }
			        } else {
								row1+='Tidak ada remark';
							}
			        $('#history').html(row1);
			      }
			    });
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
			      url: "<?=site_url('submission/historyRemark/')?>" + id,
			      type: "GET",
			      dataType: "json",
			      success: function(data) {
			        var row_h = '';
							console.log(data.length);
							if (data.length != 0) {
			        	for (var i = 0; i < data.length; i++) {
			            row_h+='<div style="border:solid 1px green;border-radius:4px;padding:10px;margin-bottom:5px;">'+
										'<span style="font-size:11px !important;margin:auto !important;">'+ data[i].name +' pada ' + moment(data[i].remark_at).format('dddd, D MMMM Y') +'</span>'+
			              '<br><span>'+ data[i].remark +'</span>'+
			            '</div>';
			          }
			        } else {
								row_h+='Tidak ada remark';
							}
			        $('#history_k').html(row_h);
			      }
			    });
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
					        $('#nilai_corr_div_det').show();
					      } else {
					        $('#nilai_corr_div_det').hide();
					      }
								if (data.pengajuan.no_corr != null) {
									$('[id=no_corr_val]').html(data.pengajuan.no_corr);
									$('#no_corr_div_det').show();
								} else {
									$('#no_corr_div_det').hide();
								}
					      if (data.pengajuan.nilai_po != "0") {
					        $('[id=nilai_po_val]').html("Rp. " + currency_format(data.pengajuan.nilai_po));
					        $('#nilai_po_div_det').show();
					      } else {
					        $('#nilai_po_div_det').hide();
					      }
								if (data.pengajuan.no_po != "") {
					        $('[id=no_po_val]').html(data.pengajuan.no_po);
					        $('#no_po_div_det').show();
					      } else {
					        $('#no_po_div_det').hide();
					      }
					      $('[id=nama_project_val]').html(data.pengajuan.nama_project);
					      $('#jenis_pengajuan_div').show();
					      $('#nama_project_div').show();
					    }
					    $('[id=pengajuan]').html(data.pengajuan.pengajuan);
					    if (data.pengajuan.tanggal_approval_keuangan != null) {
					      $('#editNilaiPengajuan').hide();
					    } else {
					      $('#editNilaiPengajuan').show();
					    }
							$('[id=nilai_pengajuan_val]').html("Rp. " + currency_format(data.pengajuan.nilai_pengajuan));
							if (data.pengajuan.biaya_penyelesaian != null) {
								$('[id=biaya_penyelesaian_val]').html("Rp. " + currency_format(data.pengajuan.biaya_penyelesaian));
								$('#biaya_penyelesaian_div_det').show();
							} else {
								$('#biaya_penyelesaian_div_det').hide();
							}
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
							if (data.pengajuan.tanggal_approval != null || data.pengajuan.is_rejected != 'N') {
								$('#approval_detail').show();
								$.ajax({
									url: "<?=site_url('submission/getApprovalName/')?>" + (data.pengajuan.tanggal_approval != null ? data.pengajuan.approved_by : data.pengajuan.rejected_by),
									type: "GET",
									dataType: "json",
									success: function(app) {
										$('[id=approved_by]').
										html(
										(data.pengajuan.tanggal_approval != null ? '#1 '+ moment(data.pengajuan.tanggal_approval).format('dddd, D MMMM Y HH:mm:ss') +' by ' + app.name : (data.pengajuan.tanggal_approval == null && data.pengajuan.is_rejected != 'N' ? '#1 Rejected by ' + app.name : '')) +
										(data.pengajuan.tanggal_approval == null && data.pengajuan.is_rejected != 'N' ? '' : (data.pengajuan.tanggal_approval_akhir != null ? '<br>#2 '+ moment(data.pengajuan.tanggal_approval_akhir).format('dddd, D MMMM Y HH:mm:ss') + ' by Simon Tambunan' : (data.pengajuan.tanggal_approval_akhir == null && data.pengajuan.is_rejected != 'N' ? '<br>#2 Rejected by Simon Tambunan' : ''))));
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
															row2+= '<hr><div id="print_bukti_btn"><button class="btn btn-outline-default" type="button" name="button"><a id="print_bukti" target="_blank" href="<?=site_url('submission/print-bukti-susulan/')?>'+data.pengajuan.pengajuan_id+'"><i class="fas fa-print"></i></a></button>&nbsp;&nbsp;<button class="btn btn-outline-default" type="button" name="button"><a id="print_bukti" target="_blank" href="<?=site_url('submission/print-all-evidence/')?>'+data.pengajuan.pengajuan_id+'"><i class="fas fa-print"></i> PRINT BOTH</a></button></div><div id="my_gallery'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'" data-nanogallery2=\'{"thumbnailWidth": 100,"thumbnailHeight": 100}\'>';
														}

														for (var i = 0; i < evi[0][0].length; i++) {
															if (evi[0][0][i] != null) {
																row2+= '<a href="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" data-ngthumb="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" >'+evi[0][0][i].url.substring(14)+'</a>';
															}
														}

														if (evi[0][0] != null) {
															row2+= '</div>';
														}
													// row1+= (i == 0 ? '<br>' : '') + '<a href="public/assets/evidence/'+ escape(evi[0][i].url) +'" data-ngthumb="public/assets/evidence/'+ escape(evi[0][i].url) +'" >Title Image1</a>';

													// row2+='<div class="mySlides">'+
													// 		'<img src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%">'+
													// 	'</div>';
													//
													// row3+='<div class="column">'+
													// 		'<img class="demo cursor" src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][i].keterangan +'">'+
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
				                row5+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" target="_blank">'+ evi[0][0][i].url.slice(14) +'</a></div>';
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
																row1+= '<a href="public/assets/evidence/'+ escape(evi[0][i].url) +'" data-ngthumb="public/assets/evidence/'+ escape(evi[0][i].url) +'" >'+evi[0][i].url.substring(14)+'</a>';
															}
														}

														if (evi[0][0] != null) {
															row1+= '</div>';
														}
													// row1+= (i == 0 ? '<br>' : '') + '<a href="public/assets/evidence/'+ escape(evi[0][i].url) +'" data-ngthumb="public/assets/evidence/'+ escape(evi[0][i].url) +'" >Title Image1</a>';

													// row2+='<div class="mySlides">'+
													// 		'<img src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%">'+
													// 	'</div>';
													//
													// row3+='<div class="column">'+
													// 		'<img class="demo cursor" src="public/assets/evidence/'+ escape(evi[0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][i].keterangan +'">'+
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
												row4+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="public/assets/evidence/'+ escape(evi[0][i].url) +'" target="_blank">'+ evi[0][i].url.slice(14) +'</a></div>';
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
									var rowt = '';

									if (evi[0][0].length > 0) {
										$('#buktit_src_div').show();
										rowt+= '<div id="print_bukti_transaksi_btn"><button class="btn btn-outline-default" type="button" name="button"><a id="print_bukti" target="_blank" href="<?=site_url('submission/print-bukti-transaksi/')?>'+data.pengajuan.pengajuan_id+'"><i class="fas fa-print"></i></a></button></div><div id="my_galleryt'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'" data-nanogallery2=\'{"thumbnailWidth": 100,"thumbnailHeight": 100}\'>';
										for (var i = 0; i < evi[0][0].length; i++) {
												rowt+= '<a href="public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" data-ngthumb="public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" >'+evi[0][0][i].url.substring(14)+'</a>';
										}
										rowt+= '</div>';

										$('#mult_img_row_t').html(rowt);
										$('#my_galleryt'+data.pengajuan.pengajuan_id+data.pengaju_id+moment().toDate().getTime()+'').nanogallery2('refresh');
									} else {
										$('#buktit_src_div').hide();
									}
								}, error: function(jqXHR, textStatus, errorThrown) {
									var err = eval("(" + jqXHR.responseText + ")");
									alert(err.Message);
								}
								// success: function(evi) {
								// 	var img = '';
								// 	var trow1 = '';
								// 	var trow2 = '';
								// 	var trow3 = '';
								// 	var tangka = 1;
								// 	if (evi[0][0].length > 0) {
								// 		$('#buktit_src_div').show();
								// 		for (var i = 0; i < evi[0][0].length; i++) {
								// 			// console.log(evi[0][i].url)
								// 				trow1+= (i == 0 ? '<br>' : '') + '<div class="column">'+
								// 					'<img src="public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" style="width:50%" onclick="openModal2();tcurrentSlide(\''+ tangka +'\')" class="hover-shadow cursor">'+
								// 				'</div>';
								//
								// 				trow2+='<div class="mySlides">'+
								// 						'<img src="public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" style="width:50%">'+
								// 					'</div>';
								//
								// 				trow3+='<div class="column">'+
								// 						'<img class="demo cursor" src="public/assets/evidence/transaksi/'+ escape(evi[0][0][i].url) +'" style="width:50%" onclick="tcurrentSlide(\''+ tangka +'\')" alt="'+ evi[0][0][i].keterangan +'">'+
								// 					'</div>';
								// 			tangka++;
								// 		}
								// 	} else {
								// 		$('#buktit_src_div').hide();
								// 	}
								//
								// 	$('#tmult_img_row1').html(trow1);
								// 	$('#tmult_img_row2').html(trow2);
								// 	$('#tmult_img_row3').html(trow3);
								// }, error: function(jqXHR, textStatus, errorThrown) {
								// 	var err = eval("(" + jqXHR.responseText + ")");
								// 	alert(err.Message);
								// }
							});
							$('.modal-title').text('Pengajuan ' + "#ADP" + pad(data.pengajuan.pengajuan_id, 4));
						}, error: function(jqXHR, textStatus, errorThrown) {
							alert('Error get data from ajax');
						}
					});
				}

				$(document).on('change', '.btn-file :file', function() {
				  var input = $(this),
				      numFiles = input.get(0).files ? input.get(0).files.length : 1,
				      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				  input.trigger('fileselect', [numFiles, label]);
				});

				$(document).on('click', '#close-preview', function(){
				    $('.image-preview').popover('hide');
				    // Hover befor close the preview
				    $('.image-preview').hover(
				        function () {
				           $('.image-preview').popover('show');
				        },
				         function () {
				           $('.image-preview').popover('hide');
				        }
				    );
				});

				$(function() {
				    // Create the close button
				    var closebtn = $('<button/>', {
				        type:"button",
				        text: 'x',
				        id: 'close-preview',
				        style: 'font-size: initial;',
				    });
				    closebtn.attr("class","close pull-right");
				    // Set the popover default content
				    $('.image-preview').popover({
				        trigger:'manual',
				        html:true,
				        title: "<strong>Preview</strong>"+$(closebtn)[0].outerHTML,
				        content: "There's no image",
				        placement:'bottom'
				    });
				    // Clear event
				    $('.image-preview-clear').click(function(){
				        $('.image-preview').attr("data-content","").popover('hide');
				        $('.image-preview-filename').val("");
				        $('.image-preview-clear').hide();
				        $('.image-preview-input input:file').val("");
				        $(".image-preview-input-title").text("Browse");
				    });
				    // Create the preview image
				    $(".image-preview-input input:file").change(function (){
				        var img = $('<img/>', {
				            id: 'dynamic',
				            width:250,
				            height:200
				        });
				        var file = this.files[0];
				        var reader = new FileReader();
				        // Set preview image into the popover data-content
				        reader.onload = function (e) {
				            $(".image-preview-input-title").text("Change");
				            $(".image-preview-clear").show();
				            $(".image-preview-filename").val(file.name);
				            img.attr('src', e.target.result);
				            $(".image-preview").attr("data-content",$(img)[0].outerHTML).popover("show");
				        }
				        reader.readAsDataURL(file);
				    });
				});

				// jQuery(function($){
				// 	var fileDiv = document.getElementById("upload");
				// 	var fileInput = document.getElementById("upload-image");
				// 	fileInput.addEventListener("change",function(e){
				// 	  var files = this.files
				// 	  showThumbnail(files)
				// 	},false)
        //
				// 	fileDiv.addEventListener("click",function(e){
				// 	  $(fileInput).show().focus().click().hide();
				// 	  e.preventDefault();
				// 	},false)
        //
				// 	fileDiv.addEventListener("dragenter",function(e){
				// 	  e.stopPropagation();
				// 	  e.preventDefault();
				// 	},false);
        //
				// 	fileDiv.addEventListener("dragover",function(e){
				// 	  e.stopPropagation();
				// 	  e.preventDefault();
				// 	},false);
        //
				// 	fileDiv.addEventListener("drop",function(e){
				// 	  e.stopPropagation();
				// 	  e.preventDefault();
        //
				// 	  var dt = e.dataTransfer;
				// 	  var files = dt.files;
        //
				// 	  showThumbnail(files)
				// 	},false);
        //
				// 	function showThumbnail(files){
				// 	  for(var i=0;i<files.length;i++){
				// 	    var file = files[i]
				// 	    var imageType = /image.*/
				// 	    if(!file.type.match(imageType)){
				// 	      console.log("Not an Image");
				// 	      continue;
				// 	    }
        //
				// 	    var image = document.createElement("img");
				// 	    // image.classList.add("")
				// 	    var thumbnail = document.getElementById("thumbnail");
				// 	    image.file = file;
				// 	    thumbnail.appendChild(image)
        //
				// 	    var reader = new FileReader()
				// 	    reader.onload = (function(aImg){
				// 	      return function(e){
				// 	        aImg.src = e.target.result;
				// 	      };
				// 	    }(image))
				// 	    var ret = reader.readAsDataURL(file);
				// 	    var canvas = document.createElement("canvas");
				// 	    ctx = canvas.getContext("2d");
				// 	    image.onload= function(){
				// 	      ctx.drawImage(image,100,100)
				// 	    }
				// 	  }
				// 	}
				// });
			</script>

			<script>
				function openModal() {
				  document.getElementById('myModal').style.display = "block";
				}

				function closeModal() {
				  document.getElementById('myModal').style.display = "none";
				}

				function openModal2() {
				  document.getElementById('myModal2').style.display = "block";
				}

				function closeModal2() {
				  document.getElementById('myModal2').style.display = "none";
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
