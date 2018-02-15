<main class="main-content bgc-grey-100">
  <div id="mainContent">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="peer">
            <button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createProgress">
              <i class="fas fa-plus"></i> &nbsp;Progress Baru
            </button>
            <button type="button" name="button" class="btn btn-outline-primary" id="custom_filter_btn"><i class="fas fa-filter"></i> &nbsp;SHOW CUSTOM FILTER</button>
            <br><br>
            <!-- CUSTOM FILTER -->
            <div id="custom_filter" class="bgc-white bd bdrs-3 p-20 mB-20">
              <h4 class="c-grey-900 mB-20">Custom Filter : </h4>
                    <form id="form-filter" class="form-horizontal">

                        <input type="hidden" name="belum_selesai_val" id="belum_selesai_val" value="N">
                        <input type="hidden" name="sudah_selesai_val" id="sudah_selesai_val" value="N">


                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Keterangan Progress</label>
                            <div class="col-sm-6">
                                <input type="text" name="keterangan_filter" class="form-control" id="keterangan_filter">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Project</label>
                            <div class="col-sm-6">
                              <select class="selectpicker form-control" name="project_filter" id="project_filter" data-live-search="true">
                                <option selected disabled readonly>PILIH PROJECT</option>
                                <?php foreach ($project_list->result() as $project_data): ?>
                                  <option value="<?=$project_data->project_id?>"><?=$project_data->nama_project?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Site ID</label>
                            <div class="col-sm-6">
                              <select class="selectpicker form-control" name="site_id_filter" id="site_id_filter" data-live-search="true">
                                <option selected disabled readonly>PILIH SITE</option>
                                <?php foreach ($site_list->result() as $site_data): ?>
                                  <option value="<?=$site_data->site_id?>"><?=$site_data->id_site?> / <?=$site_data->lokasi?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Tanggal COR</label>
                          <div class="col-sm-6">
                            <select class="form-control selectpicker" name="" id="tanggal_corr_jns_op">
                              <option value="" selected disabled readonly>JENIS SELECTOR</option>
                              <option value="satuan_val">Per Tanggal</option>
                              <option value="range_val">Range</option>
                            </select>
                            <div style="padding:5px 0px;" id="tanggal_corr_satuan">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_corr_filter" id="tanggal_corr_filter">
                            </div>
                            <div style="padding:5px 0px;" id="tanggal_corr_range">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_corr_first_filter" id="tanggal_corr_first_filter" placeholder="Dari Tanggal">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;margin-top:5px;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_corr_last_filter" id="tanggal_corr_last_filter" placeholder="ke Tanggal">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Nomor COR</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_corr_filter" class="form-control" id="no_corr_filter">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Tanggal PO</label>
                          <div class="col-sm-6">
                            <select class="form-control selectpicker" name="" id="tanggal_po_jns_op">
                              <option value="" selected disabled readonly>JENIS SELECTOR</option>
                              <option value="satuan_val">Per Tanggal</option>
                              <option value="range_val">Range</option>
                            </select>
                            <div style="padding:5px 0px;" id="tanggal_po_satuan">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_po_filter" id="tanggal_po_filter">
                            </div>
                            <div style="padding:5px 0px;" id="tanggal_po_range">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_po_first_filter" id="tanggal_po_first_filter" placeholder="Dari Tanggal">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;margin-top:5px;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_po_last_filter" id="tanggal_po_last_filter" placeholder="ke Tanggal">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Nomor PO</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_po" class="form-control" id="no_po_filter">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Progress Pengajuan</label>
                          <div class="col-sm-6">
                            <label for=""> <input type="checkbox" id="check_invoiced" name="check_invoiced" value="Y"> Invoiced </label> &nbsp;&nbsp;&nbsp;
                            <label for=""> <input type="checkbox" id="check_bayar" name="check_bayar" value="Y"> Sudah Dibayar AG </label> &nbsp;&nbsp;&nbsp;
                            <label for=""> <input type="checkbox" id="check_bayarclient" name="check_bayarclient" value="Y"> Sudah Dibayar Client </label> &nbsp;&nbsp;&nbsp;
                          </div>
                        </div>
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
                      <div class="form-group">
                        <label for="">Tanggal Mulai Progress</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_mulai" placeholder="Tanggal Mulai Progress">
                      </div>
                      <hr>
                      <div class="form-group">
                        <label for="">Keterangan Progress</label>
                        <input type="text" class="form-control" name="keterangan" value="" placeholder="Keterangan Progress">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Awal Kontrak</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_kontrak" placeholder="Tanggal Awal Kontrak">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Akhir Kontrak</label> <i>*optional</i>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_akhir_kontrak" placeholder="Tanggal Akhir Kontrak">
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
                      <hr>
                      <div class="form-group">
                        <label for="">Deskripsi Progress</label>
                        <textarea name="deskripsi" rows="8" cols="80" class="form-control" placeholder="Deskripsi Progress"></textarea>
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
                          <th width="250">Keterangan Progress</th>
                          <td><span id="keterangan_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Kontrak</th>
                          <td><span id="tanggal_kontrak_val"></span></td>
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
                          <th width="250">Deskripsi</th>
                          <td><span id="deskripsi_val"></span></td>
                        </tr>

                        <tr>
                          <th width="250">Tanggal Pembayaran</th>
                          <td><span id="sudah_dibayarkan_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Pembayaran Client</th>
                          <td><span id="sudah_dibayar_client_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Invoice</th>
                          <td><span id="sudah_invoice_val"></span></td>
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
                        <label for="">Tanggal Corr</label>
                        <input id="tanggal_corr_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_corr_vale" placeholder="Tanggal Corr">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Nomor CORMO</label>
                        <input id="no_corr_vale" type="text" class="form-control" name="no_corr_vale" placeholder="Nomor CORMO" required>
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal PO</label>
                        <input id="tanggal_po_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_po_vale" placeholder="Tanggal PO">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Nomor PO</label>
                        <input id="no_po_vale" type="text" class="form-control" name="no_po_vale" placeholder="Nomor PO" required>
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Kontrak</label>
                        <input id="tanggal_kontrak_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_kontrak_vale" placeholder="Tanggal Kontrak">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Akhir Kontrak</label>
                        <input id="tanggal_akhir_kontrak_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_akhir_kontrak_vale" placeholder="Tanggal Akhir Kontrak">
                      </div>
                      <hr>
                      <div class="form-group">
                        <label for="">Tanggal BAPP</label>
                        <input id="tanggal_bapp_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_bapp_vale" placeholder="Tanggal BAPP">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Nomor BAPP</label>
                        <input id="no_bapp_vale" type="text" class="form-control" name="no_bapp_vale" placeholder="Nomor BAPP" required>
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal BAST</label>
                        <input id="tanggal_bast_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_bast_vale" placeholder="Tanggal BAST">
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Nomor BAST</label>
                        <input id="no_bast_vale" type="text" class="form-control" name="no_bast_vale" placeholder="Nomor BAST" required>
                      </div>
                      <div class="form-group">
                        <label for="inputAddress2">Deskripsi</label>
                        <textarea id="deskripsi_vale" name="deskripsi_vale" rows="8" cols="80" class="form-control" placeholder="Deskripsi Progress"></textarea>
                      </div>
                      <hr>
                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="width:100px;text-align:center;">INVOICED</td>
                            <td style="width:100px;text-align:center;">SUDAH DIBAYAR</td>
                            <td style="width:100px;text-align:center;">SUDAH DIBAYAR CLIENT</td>
                          </tr>
                          <tr>
                            <form class="" action="index.html" method="post">
                              <input type="hidden" name="id" value="">
                              <td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="invoiced_vale" name="invoiced_vale" value="<?=date('Y-m-d', time())?>"></label> <br> <span id="tanggal_invoiced"></span> </td>
                              <td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="bayar_vale" name="bayar_vale" value="<?=date('Y-m-d', time())?>"></label> <br> <span id="tanggal_bayar"></span> </td>
                              <td style="text-align:center;"> <label><input type="checkbox" style="text-align:center" class="" id="bayarclient_vale" name="bayarclient_vale" value="<?=date('Y-m-d', time())?>"></label> <br> <span id="tanggal_bayarclient"></span> </td>
                            </form>
                          </tr>
                        </tbody>
                      </table>
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
            <!-- EVIDENCE PROGRESS -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="uploadBuktiProgress" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="" id="form_updatep" action="<?=site_url('progress/saveEvidence')?>" method="post"  enctype="multipart/form-data">
                      <input type="hidden" name="idp" value="">
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
                      <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                        <input type="submit" name="" value="Upload Evidence" class="btn btn-outline-primary">
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- END OF EVIDENCE PROGRESS -->
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
            <button type="button" class="btn cur-p btn-outline-danger" style="" id="belum_selesai">
							BELUM SELESAI
            </button>
            <button type="button" class="btn cur-p btn-outline-success" style="" id="sudah_selesai">
							SUDAH SELESAI
            </button>
            <div class="" style="float:right ">
              <button type="button" class="btn cur-p btn-outline-default" name="button">
                <a class="" href="#" target="_blank" id="exportExcel" style="text-decoration:none;color:inherit;">
                  <i class="fas fa-file-excel"></i>
                </a>
              </button>
            </div>
            <hr>
            <table cellspacing="0" class="table table-striped table-bordered" id="progress" width="100%">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama Project</th>
                  <th class="text-center">PID</th>
                  <th class="text-center">Tanggal<br>COR</th>
                  <th class="text-center">Nomor<br>Corr</th>
                  <th class="text-center">Tanggal<br>PO</th>
                  <th class="text-center">Nomor<br>PO</th>
                  <th class="text-center">Tanggal<br>Pembayaran<br>AG</th>
                  <th class="text-center">Tanggal<br>Pembayaran<br>Client</th>
                  <th class="text-center">Tanggal<br>Invoice</th>
                  <th style="white-space:nowrap;" class="text-center" width="250">Action</th>
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
                data.belum_selesai = $('#belum_selesai_val').val();
                data.sudah_selesai = $('#sudah_selesai_val').val();
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
  $('#tanggal_corr_satuan').hide();
  $('#tanggal_corr_range').hide();
  $('#tanggal_po_satuan').hide();
  $('#tanggal_po_range').hide();

  $('#belum_selesai').click(function() {
    $('#menampilkan').text("Progress yang Belum Selesai");
    $("input[type=hidden]").val("N");
    document.getElementById("belum_selesai_val").value = "Y";
    progress.ajax.reload();
  });

  $('#sudah_selesai').click(function() {
    $('#menampilkan').text("Progress yang Sudah Selesai");
    $("input[type=hidden]").val("N");
    document.getElementById("sudah_selesai_val").value = "Y";
    progress.ajax.reload();
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
    $('#tanggal_corr_jns_op').change(function() {
      if ($(this).val() === 'satuan_val') {
        $('#tanggal_corr_satuan').show();
        $('#tanggal_corr_range').hide();
        document.getElementById('tanggal_corr_filter').value = "";
        document.getElementById('tanggal_corr_first_filter').value = "";
        document.getElementById('tanggal_corr_last_filter').value = "";
      } else {
        $('#tanggal_corr_satuan').hide();
        $('#tanggal_corr_range').show();
        document.getElementById('tanggal_corr_filter').value = "";
        document.getElementById('tanggal_corr_first_filter').value = "";
        document.getElementById('tanggal_corr_last_filter').value = "";
      }
    });
  });

  $(document).ready(function() {
    $('#tanggal_po_jns_op').change(function() {
      if ($(this).val() === 'satuan_val') {
        $('#tanggal_po_satuan').show();
        $('#tanggal_po_range').hide();
        document.getElementById('tanggal_po_filter').value = "";
        document.getElementById('tanggal_po_first_filter').value = "";
        document.getElementById('tanggal_po_last_filter').value = "";
      } else {
        $('#tanggal_po_satuan').hide();
        $('#tanggal_po_range').show();
        document.getElementById('tanggal_po_filter').value = "";
        document.getElementById('tanggal_po_first_filter').value = "";
        document.getElementById('tanggal_po_last_filter').value = "";
      }
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

  $('#btn-reset').click(function() { //button reset event click
    $('#form-filter')[0].reset();
    $("#project_filter").val('default');
    $("#project_filter").selectpicker("refresh");
    $("#site_id_filter").val('default');
    $("#site_id_filter").selectpicker("refresh");
    $("#tanggal_corr_jns_op").val('default');
    $("#tanggal_corr_jns_op").selectpicker("refresh");
    $("#tanggal_po_jns_op").val('default');
    $("#tanggal_po_jns_op").selectpicker("refresh");
    $("#tanggal_corr_satuan").hide();
    $("#tanggal_corr_range").hide();
    $("#tanggal_po_satuan").hide();
    $("#tanggal_po_range").hide();
    progress.ajax.reload();  //just reload table
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
        if (data.tanggal_kontrak != null) {
          $('[id=tanggal_kontrak_val]').html(moment(data.tanggal_kontrak).format('dddd, D MMMM Y') + (data.tanggal_akhir_kontrak != null ? " - " + moment(data.tanggal_akhir_kontrak).format('dddd, D MMMM Y') : ""));
        } else {
          $('[id=tanggal_kontrak_val]').html("-");
        }
        if (data.deskripsi != null) {
          $('[id=deskripsi_val]').html(data.deskripsi);
        } else {
          $('[id=deskripsi_val]').html("-");
        }
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

        $.ajax({
          url: "<?=site_url('progress/getEvidenceProgressbyIDDokumen')?>/" + data.progress_id,
          type: "GET",
          dataType: "json",
          success: function(evi) {
            var img = '';
            var row4 = '';
            var angka = 1;
            for (var i = 0; i < evi[0][0].length; i++) {
              // console.log(evi[0][i].url)
              if (evi[0][0][i] != null) {
                row4+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" target="_blank">'+ evi[0][0][i].url.slice(14) +'</a></div>';
              }
              angka++;
            }

            $('#bukti_dokumen').html(row4);
          }, error: function(jqXHR, textStatus, errorThrown) {
            var err = eval("(" + jqXHR.responseText + ")");
            alert(err.Message);
          }
        });

        $.ajax({
          url: "<?=site_url('progress/getEvidenceProgressbyID')?>/" + data.progress_id,
          type: "GET",
          dataType: "json",
          success: function(evi) {
            var img = '';
            var row1 = '';
            var row2 = '';
            var row3 = '';
            var angka = 1;
              if (evi[0][0].length > 0) {
                $('#bukti_src_div').show();
                for (var i = 0; i < evi[0][0].length; i++) {
                  // console.log(evi[0][i].url)
                    row1+= (i == 0 ? '<br>' : '') + '<div class="column">'+
                      '<img src="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" style="width:100%" onclick="openModal();currentSlide(\''+ angka +'\')" class="hover-shadow cursor">'+
                    '</div>';

                    row2+='<div class="mySlides">'+
                        '<img src="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" style="width:100%">'+
                      '</div>';

                    row3+='<div class="column">'+
                        '<img class="demo cursor" src="public/assets/evidence/'+ escape(evi[0][0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][0][i].keterangan +'">'+
                      '</div>';
                  angka++;
                }
              } else {
                $('#bukti_src_div').hide();
              }

            console.log(evi[0][0].length);

            $('#mult_img_row1').html(row1);
            $('#mult_img_row2').html(row2);
            $('#mult_img_row3').html(row3);
          }, error: function(jqXHR, textStatus, errorThrown) {
            var err = eval("(" + jqXHR.responseText + ")");
            alert(err.Message);
          }
        });

        $('.modal-title').text('Progress ' + "#ADPR" + pad(data.progress_id, 4));
      }, error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }

  function deleteProgress(id) {
    swal({
      title: "Are you sure?",
      text: "You will not be able to recover this progress data!",
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
          url: "<?=site_url('progress/deleteProgress/')?>" + id,
          type: "POST",
          data: {id: id},
          success: function(data) {
            swal("Deleted!", "Progress berhasil dihapus.", "success");
            reload_table();
          }
        });
      } else {
        swal("Cancelled", "Progress batal dihapus", "error");
      }
    });
  }

  function saveEvidence() {
    $('#btnUpdate').text('Uploading...');
    $('#btnUpdate').attr('disabled', true);
    var url;

    url = "<?=site_url('progress/saveEvidence')?>";

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_updatep').serialize(),
      success: function(data) {
        if (data.status = 'tru') {
          $('.modal').removeClass('show');
          $('.modal').removeClass('in');
          $('.modal').attr("aria-hidden","true");
          $('.modal-backdrop').remove();
          $('body').removeClass('modal-open');
          $('#alert').modal('show');
          swal("Success!", "Evidence berhasil diupload!", "success");
          reload_table();
        }
        $('#btnUpdate').text('Upload Evidence');
        $('#btnUpdate').attr('disabled', false);
      }
    });
  }

  function update() {
    $('#btnUpdate').text('Updating...');
    $('#btnUpdate').attr('disabled', true);
    var url;

    url = "<?=site_url('progress/update')?>";

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

  function pad(num, places) {
    var zero = places - num.toString().length + 1;
    return Array(+(zero > 0 && zero)).join("0") + num;
  }

  function uploadBuktiProgress(id) {
    $.ajax({
      url: "<?=site_url('progress/getProgressDetail/')?>/" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('[name=idp]').val(data.progress_id);
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
        if (data.no_po != null) {
          $('[name=no_po_vale]').val(data.no_po);
        } else {
          $('[name=no_po_vale]').val("");
        }
        if (data.no_corr != null) {
          $('[name=no_corr_vale]').val(data.no_corr);
        } else {
          $('[name=no_corr_vale]').val("");
        }
        if (data.no_bapp != null) {
          $('[name=no_bapp_vale]').val(data.no_bapp);
        } else {
          $('[name=no_bapp_vale]').val("");
        }
        if (data.no_bast != null) {
          $('[name=no_bast_vale]').val(data.no_bast);
        } else {
          $('[name=no_bast_vale]').val("");
        }
        if (data.tanggal_po != null) {
          $('[name=tanggal_po_vale]').val(data.tanggal_po);
        } else {
          $('[name=tanggal_po_vale]').val("");
        }
        if (data.tanggal_corr != null) {
          $('[name=tanggal_corr_vale]').val(data.tanggal_corr);
        } else {
          $('[name=tanggal_corr_vale]').val("");
        }
        if (data.tanggal_bapp != null) {
          $('[name=tanggal_bapp_vale]').val(data.tanggal_bapp);
        } else {
          $('[name=tanggal_bapp_vale]').val("");
        }
        if (data.tanggal_bast != null) {
          $('[name=tanggal_bast_vale]').val(data.tanggal_bast);
        } else {
          $('[name=tanggal_bast_vale]').val("");
        }
        if (data.no_bapp != null) {
          $('[name=no_bapp_vale]').val(data.no_bapp);
        } else {
          $('[name=no_bapp_vale]').val("");
        }
        if (data.no_bast != null) {
          $('[name=no_bast_vale]').val(data.no_bast);
        } else {
          $('[name=no_bast_vale]').val("");
        }
        if (data.tanggal_kontrak != null) {
          $('[name=tanggal_kontrak_vale]').val(data.tanggal_kontrak);
        } else {
          $('[name=tanggal_kontrak_vale]').val("");
        }
        if (data.tanggal_akhir_kontrak != null) {
          $('[name=tanggal_akhir_kontrak_vale]').val(data.tanggal_akhir_kontrak);
        } else {
          $('[name=tanggal_akhir_kontrak_vale]').val("");
        }
        if (data.tanggal_bapp != null) {
          $('[name=tanggal_bapp_vale]').val(data.tanggal_bapp);
        } else {
          $('[name=tanggal_bapp_vale]').val("");
        }
        if (data.tanggal_bast != null) {
          $('[name=tanggal_bast_vale]').val(data.tanggal_bast);
        } else {
          $('[name=tanggal_bast_vale]').val("");
        }
        if (data.is_invoiced != null) {
          document.getElementById("invoiced_vale").checked = true;
          $('#tanggal_invoiced').html(data.is_invoiced);
        } else {
          document.getElementById("invoiced_vale").checked = false;
          $('#tanggal_invoiced').html("");
        }
        if (data.is_bayar != null) {
          document.getElementById("bayar_vale").checked = true;
          $('#tanggal_bayar').html(data.is_bayar);
        } else {
          document.getElementById("bayar_vale").checked = false;
          $('#tanggal_bayar').html("");
        }
        if (data.is_bayarclient != null) {
          document.getElementById("bayarclient_vale").checked = true;
          $('#tanggal_bayarclient').html(data.is_bayarclient);
        } else {
          document.getElementById("bayarclient_vale").checked = false;
          $('#tanggal_bayarclient').html("");
        }
        $('#updateProgress').modal('show');
        $('.modal-title').text('Update Progress ' + "#ADPR" + pad(data.progress_id, 4));
        reload_table();
      }, error: function(jqXHR, textStatus, errorThrown) {
        alert('Error get data from ajax');
      }
    });
  }
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
