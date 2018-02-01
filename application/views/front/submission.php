<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
                <div class="peer">
                  <?php if (isAdminTasik() || isAdministrator() || isApproval()): ?>
										<button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#exampleModal">
	                    Buat Pengajuan Baru
	                  </button>
                  <?php endif; ?>
									<button type="button" name="button" class="btn btn-outline-primary" id="custom_filter_btn">SHOW CUSTOM FILTER</button>
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
																<option id="jenis_sph" value="jenis_sph">SPH</option>
																<option id="jenis_corr" value="jenis_corr">Corr</option>
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


														<div class="form-group" id="start_penawaran_dmt_div">
															<label for="">Start Penawaran DMT</label>
															<input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="start_penawaran_dmt" placeholder="Start Penawaran DMT" />
														</div>

														<div class="form-group" id="no_spk_div">
															<label for="">Nomor SPK</label>
															<input type="text" class="form-control" name="no_spk" placeholder="Nomor SPK" >
														</div>



														<!-- SITE -->
														<hr>
														<div class="form-group" id="site_id_div">
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
														<div class="form-group">
															<label for="">Realisasi Pengajuan</label>
															<input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-language='en' name="realisasi_pengajuan" placeholder="Realisasi Pengajuan" />
														</div>
														<div class="form-group">
															<label for="">Keterangan Pengajuan</label>
															<textarea name="keterangan" class="form-control" rows="8" cols="80" placeholder="Keterangan Pengajuan"></textarea>
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
															 <label for="">Bukti (allowed file types: .jpg, .jpeg, .png, .pdf, .doc/x, .xls/x, .txt) *optional</label>
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
								<?php if (isApproval()): ?>
									<div class="alert alert-success alert-dismissable">
										Pastikan membaca detail pengajuan dengan teliti sebelum memproses.
									</div>
								<?php endif; ?>
								<div class="bgc-white bd bdrs-3 p-20 mB-20">
									<?php if (!isAdminTasik()): ?>
										<button type="button" class="btn cur-p btn-primary" id="semua_pengajuan">
	                    SEMUA PENGAJUAN
	                  </button>
									<?php endif; ?>
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
										<!-- <button type="button" class="btn cur-p btn-success" onclick="approveSemuaPengajuan()">
	                    APPROVE SEMUA PENGAJUAN
	                  </button> -->
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
									<table cellspacing="0" class="table table-striped table-bordered" id="submission" width="100%">
										<thead>
											<tr>
												<?php if (isAdminJakarta() || isApproval()): ?>
													<th class="text-center" style="width:20px">
														<!-- <input type="checkbox" name="checkall" id="checkall" value="" onclick="checkall()"> -->
													</th>
												<?php endif; ?>
												<th class="text-center" style="width:30px">NO</th>
												<th class="text-center" style="width:80px">KODE<br>PENGAJUAN</th>
												<th class="text-center">Pengajuan</th>
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
                        <th class="text-center" style="width:200px;">ACTION</th>
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
				$("#input-ke-1").fileinput({
					theme: "explorer",
					minFileCount: 0,
					showUpload: false,
					showCancel: false,
					overwriteInitial: true
				});
			</script>

			<script type="text/javascript">

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
				$('#print').hide();
				$('#print_c').hide();
				$('#acc').hide();

				$(document).ready(function() {
						submission = $('#submission').DataTable({
								"processing": true,
								"serverSide": true,
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
											"targets"		: [0, 3, 5, 6]
										<?php } else if (isAdminJakarta()) { ?>
											"targets"		: [0, 2, 3, 4, 5]
										<?php } else { ?>
											"targets"		: [1, 3, 4, 5, 6]
										<?php } ?>
									}
								],
						});

						// $(document).ready(function() {
						// 	if (!isAdminTasik()) {
						// 		document.getElementById("belum_diprint_val").value = "Y";
						// 	}
						// 	submission.ajax.reload();  //just reload table
						// });

						$('#on_progress').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum Di ACC");
							$("input[type=hidden]").val("N");
							document.getElementById("on_progress_val").value = "Y";
							<?php //if (!isAdminTasik()) { ?>
								// document.getElementById("print").href = "<?=site_url('submission/re-print')?>";
							<?php //} ?>
							$('#print').show();
							$('#print_c').show();
							$('#acc').show();
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
							document.getElementById("semua_pengajuan_val").value = "N";
							submission.ajax.reload();  //just reload table
							$('#print_c').hide();
							$('#acc').hide();
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
							submission.ajax.reload();  //just reload table
						});

						$('#belum_diapprove').click(function() {
							$('#menampilkan').text("Pengajuan yang Belum Diapprove");
							$("input[type=hidden]").val("N");
							document.getElementById("belum_diapprove_val").value = "Y";
							submission.ajax.reload();  //just reload table
						});

						$('#history_btn').click(function() {
							$('#menampilkan').text("History Pengajuan");
							$("input[type=hidden]").val("N");
							document.getElementById("history_val").value = "Y";
							$('#print').hide();
							$('#print_c').hide();
							$('#acc').hide();
							submission.ajax.reload();  //just reload table
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
							submission.ajax.reload();  //just reload table
						})

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

				// CURRENCY SEPARATOR
				webshims.setOptions('forms-ext', {
				  replaceUI: 'auto',
					types: 'number'
				});
				webshims.polyfill('forms forms-ext');

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
							$('#no_spk_div').show();
							$('#site_id_div').show();
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

							$('[name=nilai_sph]').val("");
							$('[name=nilai_po]').val("");
							$('[name=nilai_corr]').val("");
							$('[name=no_sph]').val("");
							$('[name=no_po]').val("");
							$('[name=no_corr]').val("");
						} else if ($(this).val() === 'jenis_po') {
							$('#nilai_sph_div').hide();
							$('#nilai_po_div').show();
							$('#nilai_corr_div').hide();
							$('#no_sph_div').hide();
							$('#no_po_div').show();
							$('#no_corr_div').hide();

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
							$('[name=id]').val(data.pengajuan_id);
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
							$('.modal-title').text('Update Progress Pengajuan #ADP' + pad(data.pengajuan_id, 4));
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
