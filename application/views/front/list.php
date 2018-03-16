<main class="main-content bgc-grey-100">
				<div id="mainContent">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<?php if (isNotification()): ?>
									<div class="alert alert-success alert-dismissable">
									  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
									  <strong>Success!</strong> <?=notificationMessage()?>
									</div>
								<?php endif; ?>
								<div class="bgc-white bd bdrs-3 p-20 mB-20">
                  <h5>LIST PEKERJAAN DARI PROGRESS "<b><?=$subject?></b>"</h5>
                  <br>
									<button type="button" class="btn cur-p btn-outline-primary" style="" onclick="reload_table()">
										<i class="fas fa-sync-alt"></i>
                  </button>
                  <?php if (isAdm()): ?>
                    <button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createPekerjaan">
                      <i class="fas fa-plus"></i> &nbsp;Tambah Pekerjaan
                    </button>
                  <?php endif; ?>
                  <!-- TAMBHA PEKERJAAN -->
                  <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="createPekerjaan" role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Progress Baru</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                        </div>
                        <div class="modal-body">
                          <form class="" method="post" action="<?=site_url('progress/save_pekerjaan')?>">
                            <input type="hidden" name="progress_id" value="<?=$this->uri->segment(3)?>">
                            <div class="form-group">
                              <label for="">Nama Pekerjaan</label>
                              <input type="text" class="form-control" name="pekerjaan" value="" placeholder="Nama Pekerjaan">
                            </div>
                            <div class="form-group">
                              <label for="">Tanggal Selesai Pekerjaan</label> <i>*optional</i>
                              <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_selesai" placeholder="Tanggal Selesai Pekerjaan">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                          <input type="submit" value="Tambah" class="btn btn-primary">
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  <!-- END OF TAMBAH PEKERJAAN -->
									<hr>
									<table cellspacing="0" class="table table-bordered" id="list" width="100%">
										<thead>
											<tr>
												<th width="30">No</th>
												<th>Pekerjaan</th>
												<th>Tanggal Selesai Pekerjaan</th>
												<!-- <th>Is Done?</th> -->
												<th style="white-space:nowrap;" width="150">Action</th>
											</tr>
										</thead>
									</table>
								</div>
                <!-- UPDATE PROGRESS -->
                <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="updatePekerjaan" role="dialog" tabindex="-1" style="padding-bottom: 180px;">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                      </div>
                      <div class="modal-body">
                        <form class="" id="form_update" action="#">
                          <input type="hidden" name="id" value="">
                          <div class="form-group">
                            <label for="">Nama Pekerjaan</label>
                            <input id="pekerjaan_vale" type="text" class="form-control" name="pekerjaan_vale" placeholder="Nama Pekerjaan" required>
                          </div>
                          <div class="form-group">
                            <label for="">Tanggal Selesai Pekerjaan</label>
                            <input id="tanggal_selesai_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_selesai_vale" placeholder="Tanggal Selesai Pekerjaan">
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
                <!-- END OF UPDATE PROGRESS -->
							</div>
						</div>
					</div>
				</div>
			</main>
			<script type="text/javascript">

				var list;

				$(document).ready(function() {
				    list = $('#list').DataTable({
				        "processing": true,
				        "serverSide": true,
				        "order": [],
								"ajax": {
				            "url": "<?php echo site_url('progress/list_data/'.$this->uri->segment(3))?>",
				            "type": "POST"
				        }, "columnDefs": [
					        {
					            "targets": [ -1 ],
					            "orderable": false
					        },
									{
										"class": "dt-center",
										"targets": [2, 3]
									}
				        ],
				    });
				});

				function reload_table() {
					list.ajax.reload(null, false);
				}

        function updatePekerjaan(id) {
          $.ajax({
            url: "<?=site_url('progress/getPekerjaanDetail/')?>/" + id,
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('[name=id]').val(data.pekerjaan_id);
              if (data.pekerjaan != null) {
                $('[name=pekerjaan_vale]').val(data.pekerjaan);
              } else {
                $('[name=pekerjaan_vale]').val("");
              }
              if (data.tanggal_selesai != null) {
                $('[name=tanggal_selesai_vale]').val(data.tanggal_selesai);
              } else {
                $('[name=tanggal_selesai_vale]').val("");
              }
              $('#updatePekerjaan').modal('show');
              $('.modal-title').text('Update Pekerjaan ' + "#PKR" + pad(data.pekerjaan_id, 4));
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

          url = "<?=site_url('progress/update_list')?>";

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
                swal("Success!", "Data progress berhasil diupdate!", "success");
                reload_table();
              }
              $('#btnUpdate').text('Update');
              $('#btnUpdate').attr('disabled', false);
            }
          });
        }

        function deletePekerjaan(id) {
          swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
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
                url: "<?=site_url('progress/deletePekerjaan/')?>" + id,
                type: "POST",
                data: {id: id},
                success: function(data) {
                  swal("Deleted!", "Pekerjaan berhasil dihapus.", "success");
                  reload_table();
                }
              });
            } else {
              swal("Cancelled", "Progress batal dihapus", "error");
            }
          });
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
			</script>
