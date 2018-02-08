<main class="main-content bgc-grey-100">
  <div id="mainContent">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="peer">
            <button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createProgress">
              Progress Baru
            </button>
            <button type="button" name="button" class="btn btn-outline-primary" id="custom_filter_btn">SHOW CUSTOM FILTER</button>
            <br><br>
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
                            <label for="FirstName" class="col-sm-2 control-label">Nama Project</label>
                            <div class="col-sm-6">
                                <input type="text" name="pengajuan" class="form-control" id="pengajuan_filter">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Kategori Pengajuan</label>
                          <div class="col-sm-6">
                            <select id="kategori_pengajuan_filter" style="width:100%;" class="form-control" name="kategori_pengajuan_filter">
                              <option value="" selected disabled readonly>KATEGORI PENGAJUAN</option>
                              <option value="Project">Project</option>
                              <option value="Non Project">Non Project</option>
                            </select>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Jenis Pengajuan</label>
                          <div class="col-sm-6">
                            <select id="jenis_pengajuan_filter" style="width:100%;" class="form-control" name="jenis_pengajuan_filter">
                              <option value="" selected disabled readonly>JENIS PENGAJUAN</option>
                              <?php foreach ($kategori_pengajuan as $data_k): ?>
                                <option value="<?=$data_k?>"><?=strtoupper($data_k)?></option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <?php if (!isAdminTasik()): ?>
                          <div class="form-group">
                              <label for="LastName" class="col-sm-2 control-label">Nama Pengaju</label>
                              <div class="col-sm-6">
                                  <select class="form-control" name="">
                                    <option value="" selected disabled readonly>SELECT PENGAJU</option>
                                    <option value="">Ahmad Fauzi</option>
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
                </div>
            <!-- END OF CUSTOM FILTER -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="createProgress" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Progress Baru</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="" method="post" action="<?=site_url('progress/save')?>">
                      <div class="">
                        <div class="form-group">
                          <label for="">Keterangan Progress</label>
                          <input type="text" class="form-control" name="keterangan" value="" placeholder="Keterangan Progress">
                        </div>
                      </div>
                      <div class="form-group" id="project_id_div">
                        <label for="">Pilih Project</label>
                        <select class="selectpicker form-control" name="project_id" id="project_id" data-live-search="true">
                          <option selected disabled readonly>SELECT PROJECT</option>
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
                      <!-- SITE -->
                      <hr>
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
                      <hr>
                      <div class="form-group">
                        <label for="">Nomor COR</label>
                        <input type="text" class="form-control" name="no_corr" value="" placeholder="Nomor COR">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Corr</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_corr" placeholder="Tanggal Corr">
                      </div>
                      <div class="form-group">
                        <label for="">Nomor PO</label>
                        <input type="text" class="form-control" name="no_po" value="" placeholder="Nomor PO">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal PO</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_po" placeholder="Tanggal PO">
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
            <!-- END OF CREATE PROGRESS -->
            <!-- PROGRESS DETAIL -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="detailProgress" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document" id="modalDetail">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <table class="table">
                      <tbody>
                        <tr>
                          <th width="250">Tanggal Mulai Progress</th>
                          <td><span id="tanggal_mulai_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Project</th>
                          <td><span id="project_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">PID</th>
                          <td><span id="pid_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Nama Site</th>
                          <td><span id="nama_site_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Lokasi Site</th>
                          <td><span id="lokasi_site_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal COR</th>
                          <td><span id="tanggal_corr_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Nomor Corr</th>
                          <td><span id="no_corr_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal PO</th>
                          <td><span id="tanggal_po_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Nomor PO</th>
                          <td><span id="no_po_val"></span></td>
                        </tr>

                        <tr>
                          <th width="250">Sudah Dibayarkan</th>
                          <td><span id="sudah_dibayarkan_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Sudah Dibayar Client</th>
                          <td><span id="sudah_dibayar_client_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Sudah Invoice</th>
                          <td><span id="sudah_invoice_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Keterangan</th>
                          <td><span id="keterangan_val"></span></td>
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
            <!-- END OF PROGRESS DETAIL -->
            <!-- UPDATE PROGRESS -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="updateProgress" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="" id="form_update" action="#">
                      <input type="hidden" name="id" value="">
                      <div class="form-group">
                        <label for="inputAddress2"></label>
                        <input type="text" class="form-control" name="no_po" placeholder="Nomor PO" required>
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
            <table cellspacing="0" class="table table-striped table-bordered" id="progress" width="100%">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Project</th>
                  <th class="text-center">PID</th>
                  <th class="text-center">Tanggal COR</th>
                  <th class="text-center">Nomor Corr</th>
                  <th class="text-center">Tanggal PO</th>
                  <th class="text-center">Nomor PO</th>
                  <th class="text-center">Sudah<br>Dibayarkan<br>AG</th>
                  <th class="text-center">Sudah<br>Dibayarkan<br>Client</th>
                  <th class="text-center">Sudah<br>Invoice</th>
                  <th style="white-space:nowrap;" class="text-center" width="150">Action</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<script type="text/javascript">
  $(document).ready(function() {
      progress = $('#progress').DataTable({
          "processing": true,
          "serverSide": true,
          // "language"	: {
          // 	"info": "Menampilkan halaman _PAGE_ of _PAGES_"
          // },
          "order": [],
          "ajax": {
              "url": "<?php echo site_url('progress/data')?>",
              "type": "POST",
              "data": function(data) {
                // data.kategori_pengajuan = $('#kategori_pengajuan_filter').val();
              }
          }, "columnDefs": [
            {
              "targets": 0,
              "orderable": false
            },
            {
              "targets": [ -1 ],
              "orderable": false
            },
            // {
            //   "className": "dt-body-right",
            //   "targets": [3, 5]
            // },
            {
              "className": "dt-center",
              "targets": [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
            }
          ],
      });
  });

  function reload_table() {
    progress.ajax.reload(null, false);
  }

  $('#new_project_div').hide();
  $('#custom_filter').hide();
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
    $('#project_id').change(function() {
      if ($(this).val() === 'new_project') {
        $('#new_project_div').show();
        $('#jenis_nilai_div').show();
      } else {
        $('#new_project_div').hide();
        $('#jenis_nilai_div').hide();
        $('#nilai_sph_div').hide();
        $('#nilai_po_div').hide();
        $('#nilai_corr_div').hide();

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

        $('[name=nilai_sph]').val("");
        $('[name=nilai_po]').val("");
        $('[name=nilai_corr]').val("");
      } else if ($(this).val() === 'jenis_po') {
        $('#nilai_sph_div').hide();
        $('#nilai_po_div').show();
        $('#nilai_corr_div').hide();

        $('[name=nilai_sph]').val("");
        $('[name=nilai_po]').val("");
        $('[name=nilai_corr]').val("");
      } else if ($(this).val() === 'jenis_corr') {
        $('#nilai_sph_div').hide();
        $('#nilai_po_div').hide();
        $('#nilai_corr_div').show();

        $('[name=nilai_sph]').val("");
        $('[name=nilai_po]').val("");
        $('[name=nilai_corr]').val("");
      }
    });
  });

  function detailProgress(id) {
    $.ajax({
      url: "<?=site_url('progress/getProgressDetail/')?>/" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('id').html(data.progress_id);
        if (data.tanggal_mulai != null) {
          $('[id=tanggal_mulai_val]').html(moment(data.tanggal_mulai).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_mulai_val]').html("-");
        }
        $('[id=project_val]').html(data.nama_project);
        $('[id=pid_val]').html(data.id_site);
        $('[id=nama_site_val]').html(data.nama_site);
        $('[id=lokasi_site_val]').html(data.lokasi);
        if (data.no_corr != null) {
          $('[id=no_corr_val]').html(data.no_corr);
        } else {
          $('[id=no_corr_val]').html("-");
        }
        if (data.tanggal_corr != null) {
          $('[id=tanggal_corr_val]').html(moment(data.tanggal_corr).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_corr_val]').html("-");
        }
        if (data.no_po != null) {
          $('[id=no_po_val]').html(data.no_po);
        } else {
          $('[id=no_po_val]').html("-");
        }
        if (data.tanggal_po != null) {
          $('[id=tanggal_po_val]').html(moment(data.tanggal_po).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_po_val]').html("-");
        }
        if (data.is_bayar != null) {
          $('[id=sudah_dibayarkan_val]').html(moment(data.is_bayar).format('dddd, D MMMM Y'));
        } else {
          $('[id=sudah_dibayarkan_val]').html("BELUM");
        }
        if (data.is_bayarclient != null) {
          $('[id=sudah_dibayar_client_val]').html(moment(data.is_bayarclient).format('dddd, D MMMM Y'));
        } else {
          $('[id=sudah_dibayar_client_val]').html("BELUM");
        }
        if (data.is_invoiced != null) {
          $('[id=sudah_invoice_val]').html(moment(data.is_invoiced).format('dddd, D MMMM Y'));
        } else {
          $('[id=sudah_invoice_val]').html("BELUM");
        }

        // $('[id=tanggal_pengajuan]').html(moment(data.tanggal_pengajuan).format('dddd, D MMMM Y HH:m:s'));
        // $('[id=realisasi_pengajuan]').html(moment(data.realisasi_pengajuan).format('dddd, D MMMM Y'));
        // $('[id=pid_val]').html(data.id_site + ' / ' + data.nama_site);
        if (data.keterangan != null) {
          $('[id=keterangan_val]').html(data.keterangan);
        } else {
          $('[id=keterangan_val]').html("-");
        }
        $('.modal-title').text('Progress ' + "#ADPR" + pad(data.progress_id, 4));
      }, error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function updateProgress(id) {
    $.ajax({
      url: "<?=site_url('progress/getProgressDetail/')?>/" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('[name=id]').val(data.progress_id);
        $('[name=no_po]').val(data.no_po);
        if (data.tanggal_po != null) {
          $('[name=tanggal_po]').val(data.tanggal_po);
        }
        $('[name=nilai_po]').val(data.nilai_po);
        $('[name=keterangan]').val(data.keterangan);
        $('#updateProgress').modal('show');
        $('.modal-title').text('Update Progress ' + "#ADPR" + pad(data.progress_id, 4));
      }, error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
</script>
