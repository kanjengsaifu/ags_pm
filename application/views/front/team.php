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
									<h4 class="c-grey-900 mB-20">Team</h4>
									<table cellspacing="0" class="table table-striped table-bordered" id="team_table" width="100%">
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
												<th class="text-center">NO</th>
                        <th class="text-center">TEAM ID</th>
												<th class="text-center">Total<br>Genset</th>
                        <th class="text-center">Genset<br>7,5 KVA</th>
                        <th class="text-center">Genset<br>10 KVA</th>
                        <th class="text-center">Genset<br>12 KVA</th>
                        <!-- <th class="text-center">Genset<br>7,5 KVA</th>
                        <th class="text-center">Genset<br>10 KVA</th>
												<th class="text-center">Genset<br>12 KVA</th> -->
												<?php if (isAdministrator()): ?>
                          <th class="text-center">MODIFY</th>
                        <?php endif; ?>
											</tr>
										</thead>
									</table>
                  <?php foreach ($teamData->result() as $data) {
                    echo '
                    <div class="modal fade" id="teamD'.$data->team_id.'">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-body">
                              <div class="te"></div>
                            </div>
                          </div>
                      </div>
                    </div>';
                  } ?>
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
				});
			</script>
