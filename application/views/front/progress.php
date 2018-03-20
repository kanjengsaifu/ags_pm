<main class="main-content bgc-grey-100">
  <div id="mainContent">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="peer">
            <?php if (isAdm()): ?>
              <button type="button" class="btn cur-p btn-outline-primary" data-toggle="modal" data-target="#createProgress">
                <i class="fas fa-plus"></i> &nbsp;Progress Baru
              </button>
            <?php endif; ?>
            <button type="button" name="button" class="btn btn-outline-primary" id="custom_filter_btn"><i class="fas fa-filter"></i> &nbsp;SHOW CUSTOM FILTER</button>
            <br><br>
            <!-- CUSTOM FILTER -->
            <div id="custom_filter" class="bgc-white bd bdrs-3 p-20 mB-20">
              <h4 class="c-grey-900 mB-20">Custom Filter : </h4>
                    <form id="form-filter" class="form-horizontal">

                        <input type="hidden" name="show_all_val" id="show_all_val" value="N">
                        <input type="hidden" name="belum_selesai_val" id="belum_selesai_val" value="N">
                        <input type="hidden" name="sudah_selesai_val" id="sudah_selesai_val" value="N">


                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Nama Pekerjaan</label>
                            <div class="col-sm-6">
                                <input type="text" name="keterangan_filter" class="form-control" id="keterangan_filter">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Tipe Pekerjaan</label>
                            <div class="col-sm-6">
                              <select class="selectpicker form-control" name="tipe_pekerjaan_filter" id="tipe_pekerjaan_filter" data-live-search="true">
                                <option selected disabled readonly>PILIH TIPE PEKERJAAN</option>
                                <option value="CSR">CSR</option>
                                <option value="Iuran Warga">IURAN WARGA</option>
                                <option value="Imbas Petir">IMBAS PETIR</option>
                                <option value="Corrective">CORRECTIVE</option>
                                <option value="Kontribusi Sewa Lahan">KONTRIBUSI SEWA LAHAN</option>
                                <option value="Penjaga Site">PENJAGA SITE</option>
                                <option value="Jasa">JASA</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Site ID</label>
                            <div class="col-sm-6">
                              <select class="selectpicker form-control" name="site_id_filter" id="site_id_filter" data-live-search="true">
                                <option selected disabled readonly>PILIH SITE</option>
                                <?php foreach ($site_list->result() as $site_data): ?>
                                  <option value="<?=$site_data->site_id?>"><?=$site_data->id_site?> <?=$site_data->id_site_telkom?> / <?=$site_data->lokasi?></option>
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
                          <label for="" class="col-sm-2 control-label">Nilai/nominal COR</label>
                          <div class="col-sm-6">
                            <input name="nilai_corr_filter" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai/nominal COR">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="" class="col-sm-2 control-label">Total nilai/nominal Pekerjaan</label>
                          <div class="col-sm-6">
                            <input name="nilai_progress_filter" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Total nilai/nominal Pekerjaan">
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
                                <input type="text" name="no_po_filter" class="form-control" id="no_po_filter">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Tanggal BAST</label>
                          <div class="col-sm-6">
                            <select class="form-control selectpicker" name="" id="tanggal_bast_jns_op">
                              <option value="" selected disabled readonly>JENIS SELECTOR</option>
                              <option value="satuan_val">Per Tanggal</option>
                              <option value="range_val">Range</option>
                            </select>
                            <div style="padding:5px 0px;" id="tanggal_bast_satuan">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_bast_filter" id="tanggal_bast_filter">
                            </div>
                            <div style="padding:5px 0px;" id="tanggal_bast_range">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_bast_first_filter" id="tanggal_bast_first_filter" placeholder="Dari Tanggal">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;margin-top:5px;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_bast_last_filter" id="tanggal_bast_last_filter" placeholder="ke Tanggal">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Nomor BAST</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_bast_filter" class="form-control" id="no_bast_filter">
                            </div>
                        </div>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Tanggal BAPP</label>
                          <div class="col-sm-6">
                            <select class="form-control selectpicker" name="" id="tanggal_bapp_jns_op">
                              <option value="" selected disabled readonly>JENIS SELECTOR</option>
                              <option value="satuan_val">Per Tanggal</option>
                              <option value="range_val">Range</option>
                            </select>
                            <div style="padding:5px 0px;" id="tanggal_bapp_satuan">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_bapp_filter" id="tanggal_bapp_filter">
                            </div>
                            <div style="padding:5px 0px;" id="tanggal_bapp_range">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_bapp_first_filter" id="tanggal_bapp_first_filter" placeholder="Dari Tanggal">
                              <input type="text" class="form-control datepicker-here" style="z-index: 99999 !important;margin-top:5px;" data-date-format="yyyy-mm-dd" data-language='en' name="tanggal_bapp_last_filter" id="tanggal_bapp_last_filter" placeholder="ke Tanggal">
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                            <label for="FirstName" class="col-sm-2 control-label">Nomor BAPP</label>
                            <div class="col-sm-6">
                                <input type="text" name="no_bapp_filter" class="form-control" id="no_bapp_filter">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                          <label for="LastName" class="col-sm-2 control-label">Progress Pengajuan</label>
                          <div class="col-sm-6">
                            <label class="form-check-label"> <input type="checkbox" id="check_bayar" name="check_bayar" value="N"> Sudah Dibayar AG </label> &nbsp;&nbsp;&nbsp;
                            <label class="form-check-label"> <input type="checkbox" id="check_invoiced" name="check_invoiced" value="N"> Invoiced </label> &nbsp;&nbsp;&nbsp;
                            <label class="form-check-label"> <input type="checkbox" id="check_bayarclient" name="check_bayarclient" value="N"> Sudah Dibayar Client </label> &nbsp;&nbsp;&nbsp;
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
                      <div class="form-group input_wrap">
                        <button class="btn btn-outline-primary add_field_button">Tambah List Pekerjaan</button>
                        <br><label style="margin-top:10px;" for="">Daftar Pekerjaan</label>
                        <input type="text" class="form-control" name="keterangan[]" value="" placeholder="eg: GEMBOK ABUS 30MM TITALIUM KWH DAN ACPDB, JASA PEMASANGAN">
                      </div>
                      <div class="form-group">
                        <label for="">Subject Pekerjaan</label>
                        <input type="text" class="form-control" name="subject" value="" placeholder="eg: Honor PJS Juni, Pekerjaan non rutin periode Desember 2017">
                      </div>
                      <div class="form-group">
                        <label for="">Total nilai/nominal Pekerjaan</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <div class="input-group-addon" style="width: 40px;">Rp.</div>
                          <input name="nilai_progress" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Total nilai/nominal Pekerjaan">
                        </div>
                      </div>
                      <hr>
                      <div class="form-group">
                        <label for="">Tanggal Mulai Pekerjaan</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_mulai" placeholder="Tanggal Mulai Pekerjaan">
                      </div>
                      <hr>
                      <div class="form-group">
                        <label for="FirstName">Tipe Pekerjaan</label>
                        <select class="selectpicker form-control" name="tipe_pekerjaan" id="tipe_pekerjaan" data-live-search="true">
                          <option selected disabled readonly>PILIH TIPE PEKERJAAN</option>
                          <option value="CSR">CSR</option>
                          <option value="Iuran Warga">IURAN WARGA</option>
                          <option value="Imbas Petir">IMBAS PETIR</option>
                          <option value="Corrective">CORRECTIVE</option>
                          <option value="Kontribusi Sewa Lahan">KONTRIBUSI SEWA LAHAN</option>
                          <option value="Penjaga Site">PENJAGA SITE</option>
                          <option value="Jasa">JASA</option>
                        </select>
                      </div>
                      <div class="" id="new_project_div">
                        <div class="form-group">
                          <label for="">Nama Project</label>
                          <input type="text" class="form-control" name="nama_project" value="" placeholder="Nama Project">
                        </div>
                      </div>
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
                          <label for="">PID</label>
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
                      <hr>
                      <div class="form-group">
                        <label for="">Tanggal Awal Kontrak</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_kontrak" placeholder="Tanggal Awal Kontrak">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Akhir Kontrak</label> <i>*optional</i>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_akhir_kontrak" placeholder="Tanggal Akhir Kontrak">
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
                        <label for="">Nilai/nominal COR</label>
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                          <div class="input-group-addon" style="width: 40px;">Rp.</div>
                          <input name="nilai_corr" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai/nominal COR">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label for="">Nomor PO</label>
                        <input type="text" class="form-control" name="no_po" value="" placeholder="Nomor PO">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal PO</label>
                        <input type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_po" placeholder="Tanggal PO">
                      </div> -->
                      <hr>
                      <div class="form-group">
                        <label for="">Deskripsi Progress</label>
                        <textarea name="deskripsi" rows="8" cols="80" class="form-control" placeholder="eg: BYMHD 2017, Rembes"></textarea>
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
                    <span style="float:right" id="created_by"></span>
                    <i class="fas fa-info-circle"></i> <b> LIST PEKERJAAN</b>
                    <br><br>
                    <a id="modify_pekerjaan" <?php echo (isAdm() ? '' : 'style="display:none"') ?> target="_blank" href="#" class="btn btn-outline-primary" style="margin-bottom:5px;">Modify</a>
                    <div id="list_val"></div>
                    <br>

                    <i class="fas fa-info-circle"></i> <b> DETAIL PROGRESS</b>
                    <br><br>
                    <table class="table">
                      <tbody>
                        <tr>
                          <th width="250">Subject Pekerjaan</th>
                          <td><span id="subject_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Mulai Pekerjaan</th>
                          <td><span id="tanggal_mulai_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Kontrak</th>
                          <td><span id="tanggal_kontrak_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tipe Pekerjaan</th>
                          <td><span id="tipe_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Site</th>
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
                          <th width="250">Nilai Cormo</th>
                          <td><span id="nilai_corr_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Nilai PO/Akhir</th>
                          <td><span id="nilai_progress_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Deskripsi</th>
                          <td><span id="deskripsi_val"></span></td>
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
                    <br>
                    <i class="fas fa-tasks"></i> <b> PROGRESS</b>
                    <br><br>
                    <table class="table">
                      <tbody>
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
                          <th width="250">Tanggal BAST</th>
                          <td><span id="tanggal_bast_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Nomor BAST</th>
                          <td><span id="no_bast_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal BAPP</th>
                          <td><span id="tanggal_bapp_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Nomor BAPP</th>
                          <td><span id="no_bapp_val"></span></td>
                        </tr>
                      </tbody>
                    </table>
                    <br>
                    <i class="fas fa-money-bill-alt"></i> <b> STATUS PEMBAYARAN</b>
                    <br><br>
                    <table class="table">
                      <tbody>
                        <tr>
                          <th width="250">Tanggal Pembayaran AG</th>
                          <td><span id="sudah_dibayarkan_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Invoice</th>
                          <td><span id="sudah_invoice_val"></span></td>
                        </tr>
                        <tr>
                          <th width="250">Tanggal Pembayaran Client</th>
                          <td><span id="sudah_dibayar_client_val"></span></td>
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
            <!-- UPDATE HISTORY PROGRESS -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="historyProgress" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document" id="modalDetail">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">History Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <i class="fas fa-info-circle"></i> <b> HISTORY PROGRESS</b>
                    <br><br>
                    <div id="history"></div>
                    <div id="history_cr"></div>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- END OF PROGRESS DETAIL -->
            <!-- UPDATE PROGRESS -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="updateProgress" role="dialog" tabindex="-1" style="padding-bottom: 180px;">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="" id="form_update" action="#">
                      <input type="hidden" name="id" value="">
                      <div class="form-group">
                        <label for="">Remark/Keterangan Update Ini</label>
                        <textarea name="remark" class="form-control" rows="8" cols="80" <?php echo (isAdm() ? 'placeholder="eg: Nomor Corr baru dikeluarkan satu hari yang lalu"' : 'placeholder="eg: Sudah dibayarkan AG, etc."') ?>></textarea>
                      </div>
                      <?php if (isAdm()): ?>
                        <div class="form-group">
                          <label for="">Total nilai/nominal Pekerjaan</label>
                          <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 40px;">Rp.</div>
                            <input name="nilai_progress_vale" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Total nilai/nominal Pekerjaan">
                          </div>
                        </div>

                        <div class="form-group">
                          <label for="inputAddress2">Nomor CORMO</label>
                          <input id="no_corr_vale" type="text" class="form-control" name="no_corr_vale" placeholder="Nomor CORMO" required>
                        </div>
                        <div class="form-group">
                          <label for="">Tanggal Corr</label>
                          <input id="tanggal_corr_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_corr_vale" placeholder="Tanggal Corr">
                        </div>
                        <div class="form-group">
                          <label for="">Nilai/nominal COR</label>
                          <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <div class="input-group-addon" style="width: 40px;">Rp.</div>
                            <input name="nilai_corr_vale" type="number" class="form-control currency" min="0" step="0.01" data-number-stepfactor="100" id="inlineFormInputGroup" placeholder="Nilai/nominal COR">
                          </div>
                        </div>

                        <div>
                          <div class="form-group">
                            <label for="LastName">PO</label>
                            <select class="form-control selectpicker" name="" id="po_select">
                              <option value="" selected disabled readonly>SELECT PO</option>
                              <option value="po_s">Nomor PO</option>
                              <option value="bymhd">BYMHD</option>
                            </select>
                          </div>
                          <div id="isian_po">
                            <div class="form-group">
                              <label for="inputAddress2">Nomor PO</label>
                              <input id="no_po_vale" type="text" class="form-control" name="no_po_vale" placeholder="Nomor PO" required>
                            </div>
                            <div class="form-group">
                              <label for="">Tanggal PO</label>
                              <input id="tanggal_po_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_po_vale" placeholder="Tanggal PO">
                            </div>
                          </div>
                          <div id="tanggal_bmhd_div">
                            <div class="form-group">
                              <label for="">Tanggal MHD</label>
                              <input id="tanggal_bmhd_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_bmhd_vale" placeholder="Tanggal MHD">
                            </div>
                          </div>
                        </div>
                        <hr>
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
                          <textarea id="deskripsi_vale" name="deskripsi_vale" rows="8" cols="80" class="form-control" placeholder="eg: BYMHD 2017, Rembes"></textarea>
                        </div>
                        <hr>
                      <?php endif; ?>
                      <table class="table">
                        <tbody>
                          <tr>
                            <td style="width:100px;text-align:center;">TANGGAL INVOICE</td>
                            <td style="width:100px;text-align:center;">TANGGAL PEMBAYARAN AG</td>
                            <td style="width:100px;text-align:center;">TANGGAL PEMBAYARAN CLIENT</td>
                          </tr>
                          <tr>
                            <form class="" action="index.html" method="post">
                              <input type="hidden" name="id" value="">
                              <td style="text-align:center;"> <label><input id="is_bayar_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="bayar_vale"></span> </td>
                              <td style="text-align:center;"> <label><input id="is_invoiced_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="invoiced_vale"></span> </td>
                              <td style="text-align:center;"> <label><input id="is_bayarclient_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="bayarclient_vale"></span> </td>
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
            <!-- UPDATE PROGRESS -->
            <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="editProgress" role="dialog" tabindex="-1">
              <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Progress</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="" id="form_update_e" action="#">
                      <input type="hidden" name="id" value="">
                      <div class="form-group">
                        <label for="inputAddress2">Nama Pekerjaan</label>
                        <input id="pekerjaan_vale" type="text" class="form-control" name="pekerjaan_vale" placeholder="Nama Pekerjaan" required>
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Mulai Pekerjaan</label>
                        <input id="tanggal_mulai_pekerjaan_vale" type="text" class="form-control datepicker-here user-success" style="z-index: 99999 !important;" data-language="en" name="tanggal_mulai_pekerjaan_vale" placeholder="Tanggal Mulai Pekerjaan">
                      </div>
                      <hr>
                      <!-- <div class="form-group">
                        <label for="FirstName">Project</label>
                        <select class="selectpicker form-control" id="project_vale" name="project_vale" data-live-search="true">
                          <option value="default">PILIH PROJECT</option>
                          <?php foreach ($project_list->result() as $project_data): ?>
                            <option value="<?=$project_data->project_id?>"><?=$project_data->nama_project?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Site ID</label>
                        <select class="form-control selectpicker" id="site_vale" name="site_vale" data-live-search="true">
                          <option value="default">PILIH SITE</option>
                          <?php foreach ($site_list->result() as $site_data): ?>
                            <option value="<?=$site_data->site_id?>"><?=$site_data->id_site?> / <?=$site_data->lokasi?></option>
                          <?php endforeach; ?>
                        </select>
                      </div> -->
                    </div>
                    </form>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                      <button class="btn btn-primary" data-dismiss="modal" type="button" id="btnEdit" onclick="edit()">Update</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pekerjaan</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
                  </div>
                  <div class="modal-body">
                    <form class="" id="form_updatep" action="<?=site_url('progress/saveEvidence')?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="idp" value="">
                      <div class="form-group">
                         <label for="">Bukti Pekerjaan (allowed file types: .jpg, .jpeg, .png, .pdf, .doc/x, .xls/x, .txt)</label>
                         <!-- <div class="input-files">
                          <input type="file" name="file_upload-1">
                         </div>
                         <a id="add_more"><i class="fas fa-plus"></i> Add More</a> -->
                         <!-- <div class="file-loading">
                           <input id="buktisusulan" name="buktisusulan[]" type="file" accept=".jpg,.jpeg,.png,.pdf,.doc,.docx,.xls,.xlsx,.txt" multiple="multiple">
                         </div> -->
                         <br>
                         <a class="file_input btn btn-outline-primary" data-jfiler-name="buktiprog" data-jfiler-extensions="jpg, jpeg, png, pdf, doc, docx, xls, xlsx, txt">
                         <i class="icon-jfi-paperclip"></i> Attach a file</a>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                        <!-- <input type="reset" name="" value="Reset" class="btn btn-primary"> -->
                        <input type="submit" name="" value="Upload Bukti Pekerjaan" class="btn btn-outline-primary">
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
            <button type="button" class="btn cur-p btn-outline-primary" style="" id="show_all">
							SHOW ALL
            </button>
            <button type="button" class="btn cur-p btn-outline-danger" style="" id="belum_selesai">
							BELUM SELESAI
            </button>
            <button type="button" class="btn cur-p btn-outline-success" style="" id="sudah_selesai">
							SUDAH SELESAI
            </button>
            <!-- <div class="" style="float:right ">
              <button type="button" class="btn cur-p btn-outline-default" name="button">
                <a class="" href="#" target="_blank" id="exportExcel" style="text-decoration:none;color:inherit;">
                  <i class="fas fa-file-excel"></i>
                </a>
              </button>
            </div> -->
            <div class="" style="display:none;">
              <br><br>
              <a id="print" class="btn btn-outline-primary" target="_blank" href="<?=site_url('progress/print')?>"><i class="fas fa-print"></i>&nbsp; PRINT</a>
              <a id="print_c" class="btn btn-outline-primary" target="_blank" href="<?=site_url('progress/printTerpilih')?>"><i class="fas fa-print"></i>&nbsp; PRINT YANG TERPILIH</a>
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
            </div>
            <hr>
            <table cellspacing="0" class="table table-striped table-bordered" id="progress" width="100%">
              <thead>
                <tr>
                  <th class="text-center"></th>
                  <th class="text-center" width="50">Site</th>
                  <th class="text-center">Tipe</th>
                  <th class="text-center">No CORMO</th>
                  <th class="text-center">Nomor PO</th>
                  <th class="text-center">BAST</th>
                  <th class="text-center">BAPP</th>
                  <th class="text-center">Nominal</th>
                  <th style="white-space:nowrap;" class="text-center" width="280">Action</th>
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

  // CURRENCY SEPARATOR
  webshims.setOptions('forms-ext', {
    replaceUI: 'auto',
    types: 'number'
  });
  webshims.polyfill('forms forms-ext');

  $(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div style="margin-top:3px;"><input type="text" class="form-control" name="keterangan[]" value="" placeholder="Pekerjaan" style="width:95% !important;float:left"><a href="#" class="btn btn-danger" style="margin-left:5px;" id="remove_field">X</a></div>'); //add input box
        }
    });

    $(wrapper).on("click","#remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
  });

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

        $('#buktiprog').filer({
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
          dom: "<'row'<'col-sm-3'l><'col-sm-3'f><'col-sm-6'p>>" +
               "<'row'<'col-sm-12'tr>>" +
               "<'row'<'col-sm-5'i><'col-sm-7'p>>",
          "pageLength": 5,
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

                data.keterangan = $('#keterangan_filter').val();
                data.tipe_pekerjaan = $('#tipe_pekerjaan_filter').val();
                data.site = $('#site_id_filter').val();
                data.no_corr = $('#no_corr_filter').val();
                data.no_po = $('#no_po_filter').val();
                data.nilai_corr = $('#nilai_corr_filter').val();
                data.nilai_progress = $('#nilai_progress_filter').val();
                data.tanggal_corr = $('#tanggal_corr_filter').val();
                data.tanggal_corr_first = $('#tanggal_corr_first_filter').val();
                data.tanggal_corr_last = $('#tanggal_corr_last_filter').val();
                data.tanggal_po = $('#tanggal_po_filter').val();
                data.tanggal_po_first = $('#tanggal_po_first_filter').val();
                data.tanggal_po_last = $('#tanggal_po_last_filter').val();

                data.no_bast = $('#no_bast_filter').val();
                data.no_bapp = $('#no_bapp_filter').val();
                data.tanggal_bast = $('#tanggal_bast_filter').val();
                data.tanggal_bast_first = $('#tanggal_bast_first_filter').val();
                data.tanggal_bast_last = $('#tanggal_bast_last_filter').val();
                data.tanggal_bapp = $('#tanggal_bapp_filter').val();
                data.tanggal_bapp_first = $('#tanggal_bapp_first_filter').val();
                data.tanggal_bapp_last = $('#tanggal_bapp_last_filter').val();

                if (document.getElementById('check_invoiced').checked) {
                  data.check_invoiced = $('#check_invoiced').val();
                }

                if (document.getElementById('check_bayar').checked) {
                  data.check_bayar = $('#check_bayar').val();
                }

                if (document.getElementById('check_bayarclient').checked) {
                  data.check_bayarclient = $('#check_bayarclient').val();
                }
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
              "targets": [1, 2, 3, 4, 5, 6, 7, 8]
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
  $('#tanggal_bast_satuan').hide();
  $('#tanggal_bast_range').hide();
  $('#tanggal_bapp_satuan').hide();
  $('#tanggal_bapp_range').hide();
  $('#h_check_all').hide();
  $('#h_uncheck_all').hide();
  $('#isian_po').hide();
  $('#tanggal_bmhd_div').hide();

  $('#check_all').click(function() {
    $.ajax({
      url: "<?=site_url('progress/checkAll/')?>",
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
      url: "<?=site_url('progress/unCheckAll/')?>",
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
      url: "<?=site_url('progress/hCheckAll/')?>",
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
      url: "<?=site_url('progress/hunCheckAll/')?>",
      type: "POST",
      success: function(data) {
        reload_table();
      }, error: function(XMLHttpRequest, textStatus, errorThrown) {
        console.log(errorThrown);
      }
    });
  });

  $('#show_all').click(function() {
    $('#menampilkan').text("Semua Progress Pekerjaan");
    $('#h_check_all').hide();
    $('#h_uncheck_all').hide();
    $('#check_all').show();
    $('#uncheck_all').show();
    $("input[type=hidden]").val("N");
    document.getElementById("show_all_val").value = "Y";
    document.getElementById("print").href = "<?=site_url('progress/print')?>";
    document.getElementById("print_c").href = "<?=site_url('progress/printTerpilih')?>";
    progress.ajax.reload();
  });

  $('#belum_selesai').click(function() {
    $('#modify_pekerjaan').show();
    $('#menampilkan').text("Progress yang Belum Selesai");
    $('#h_check_all').hide();
    $('#h_uncheck_all').hide();
    $('#check_all').show();
    $('#uncheck_all').show();
    $("input[type=hidden]").val("N");
    document.getElementById("belum_selesai_val").value = "Y";
    document.getElementById("print").href = "<?=site_url('progress/print')?>";
    document.getElementById("print_c").href = "<?=site_url('progress/printTerpilih')?>";
    progress.ajax.reload();
  });

  $('#sudah_selesai').click(function() {
    $('#modify_pekerjaan').hide();
    $('#menampilkan').text("Progress yang Sudah Selesai");
    $('#h_check_all').show();
    $('#h_uncheck_all').show();
    $('#check_all').hide();
    $('#uncheck_all').hide();
    $("input[type=hidden]").val("N");
    document.getElementById("sudah_selesai_val").value = "Y";
    document.getElementById("print").href = "<?=site_url('progress/h_print')?>";
    document.getElementById("print_c").href = "<?=site_url('progress/h_printTerpilih')?>";
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
    $('#po_select').change(function() {
      if ($(this).val() === 'po_s') {
        $('#isian_po').show();
        $('#tanggal_bmhd_div').hide();
        document.getElementById('no_po_vale').value = "";
        document.getElementById('tanggal_po_vale').value = "";
        document.getElementById('tanggal_bmhd_vale').value = "";
      } else {
        $('#isian_po').hide();
        $('#tanggal_bmhd_div').show();
        document.getElementById('no_po_vale').value = "BYMHD";
        document.getElementById('tanggal_po_vale').value = "";
        document.getElementById('tanggal_bmhd_vale').value = "";
      }
    })
  });

  $(document).ready(function() {
    $('#tanggal_bast_jns_op').change(function() {
      if ($(this).val() === 'satuan_val') {
        $('#tanggal_bast_satuan').show();
        $('#tanggal_bast_range').hide();
        document.getElementById('tanggal_bast_filter').value = "";
        document.getElementById('tanggal_bast_first_filter').value = "";
        document.getElementById('tanggal_bast_last_filter').value = "";
      } else {
        $('#tanggal_bast_satuan').hide();
        $('#tanggal_bast_range').show();
        document.getElementById('tanggal_bast_filter').value = "";
        document.getElementById('tanggal_bast_first_filter').value = "";
        document.getElementById('tanggal_bast_last_filter').value = "";
      }
    });
  });

  $(document).ready(function() {
    $('#tanggal_bapp_jns_op').change(function() {
      if ($(this).val() === 'satuan_val') {
        $('#tanggal_bapp_satuan').show();
        $('#tanggal_bapp_range').hide();
        document.getElementById('tanggal_bapp_filter').value = "";
        document.getElementById('tanggal_bapp_first_filter').value = "";
        document.getElementById('tanggal_bapp_last_filter').value = "";
      } else {
        $('#tanggal_bapp_satuan').hide();
        $('#tanggal_bapp_range').show();
        document.getElementById('tanggal_bapp_filter').value = "";
        document.getElementById('tanggal_bapp_first_filter').value = "";
        document.getElementById('tanggal_bapp_last_filter').value = "";
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

  $('#btn-filter').click(function() { //button filter event click
    progress.ajax.reload();  //just reload table
  });

  $('#btn-reset').click(function() { //button reset event click
    $('#form-filter')[0].reset();
    $("#tipe_pekerjaan_filter").val('default');
    $("#tipe_pekerjaan_filter").selectpicker("refresh");
    $("#site_id_filter").val('default');
    $("#site_id_filter").selectpicker("refresh");
    $("#tanggal_corr_jns_op").val('default');
    $("#tanggal_corr_jns_op").selectpicker("refresh");
    $("#tanggal_po_jns_op").val('default');
    $("#tanggal_po_jns_op").selectpicker("refresh");
    $("#tanggal_bast_jns_op").val('default');
    $("#tanggal_bast_jns_op").selectpicker("refresh");
    $("#tanggal_bapp_jns_op").val('default');
    $("#tanggal_bapp_jns_op").selectpicker("refresh");
    $("#tanggal_corr_satuan").hide();
    $("#tanggal_corr_range").hide();
    $("#tanggal_po_satuan").hide();
    $("#tanggal_po_range").hide();
    $("#tanggal_bast_satuan").hide();
    $("#tanggal_bast_range").hide();
    $("#tanggal_bapp_satuan").hide();
    $("#tanggal_bapp_range").hide();
    progress.ajax.reload();  //just reload table
  });

  function currency_format(num) {
    return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
  }

  function saveCBox(id) {
    url = "<?=site_url('progress/savecbox')?>";
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
    url = "<?=site_url('progress/rmvcbox')?>";
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
    url = "<?=site_url('progress/h_savecbox')?>";
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
    url = "<?=site_url('progress/h_rmvcbox')?>";
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

  function historyProgress(id) {
    $.ajax({
      url: "<?=site_url('progress/getProgressDetail/')?>" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        var row = '';
        row+='<div class="text-center" style="border:solid 1px green;border-radius:4px;padding:10px;margin-bottom:5px;"><b>Dibuat pada '+moment(data.created_at).format('dddd, D MMMM Y') +' oleh '+ data.name +'</b></div>';
        $('#history_cr').html(row);
      }
    });

    $.ajax({
      url: "<?=site_url('progress/historyProgress/')?>" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('id').html(data.progress_id);
        var row1 = '';
        var row = '';
        for (var i = 0; i < data.length; i++) {
          if (data[i] != null) {
            row1+='<div style="border:solid 1px green;border-radius:4px;padding:10px;margin-bottom:5px;"><b>'+moment(data[i].updated_at).format('dddd, D MMMM Y HH:mm:ss') +' oleh '+ data[i].name +'</b><hr>'+
              '<table class="table">'+
              '<tr><td width="150">Corr</td><td colspan="2">'+ (data[i].tanggal_corr != null ? moment(data[i].tanggal_corr).format('dddd, D MMMM Y') : '-') + (data[i].no_corr != null ? ' - ' + data[i].no_corr : '') +'</td></tr>'+
              '<tr><td width="150">PO</td><td colspan="2">'+(data[i].no_po != "BYMHD" ? (data[i].tanggal_po != null ? moment(data[i].tanggal_po).format('dddd, D MMMM Y') : '-') : moment(data[i].tanggal_bmhd).format('dddd, D MMMM Y')) + (data[i].no_po != null ? ' - ' + data[i].no_po : '') +'</td></tr>'+
              '<tr><td width="150">BAST</td><td colspan="2">'+ (data[i].tanggal_bast != null ? moment(data[i].tanggal_bast).format('dddd, D MMMM Y') : '-') + (data[i].no_bast != null ? ' - ' + data[i].no_bast : '') +'</td></tr>'+
              '<tr><td width="150">BAPP</td><td colspan="2">'+ (data[i].tanggal_bapp != null ? moment(data[i].tanggal_bapp).format('dddd, D MMMM Y') : '-') + (data[i].no_bapp != null ? ' - ' + data[i].no_bapp : '') +'</td></tr>'+
              '<tr><td width="150">Remark</td><td colspan="2">'+ (data[i].remark != null ? data[i].remark : '') +'</td></tr>'+
              '<tr>'+
              '<td colspan="3" class="text-center">'+
              (data[i].is_bayar != null ? '<i class=\'fas fa-check text-success\'></i> Sudah Dibayar AG' : '<i class=\'fas fa-times text-danger\'></i> Sudah Dibayar AG') + '&nbsp;&nbsp;&nbsp;&nbsp;'+
              (data[i].is_invoiced != null ? '<i class=\'fas fa-check text-success\'></i> Invoiced' : '<i class=\'fas fa-times text-danger\'></i> Invoiced') + '&nbsp;&nbsp;&nbsp;&nbsp;'+
              (data[i].is_bayarclient != null ? '<i class=\'fas fa-check text-success\'></i> Sudah Dibayar Client' : '<i class=\'fas fa-times text-danger\'></i> Sudah Dibayar Client') +'</td>'+
              '</tr>'+
              '</table>'+
            '</div>';
          } else {
            $('#history').html("Belum ada update.");
          }
        }
        $('#history').html(row1);
      }
    });
  }

  function detailProgress(id) {
    $.ajax({
      url: "<?=site_url('progress/getProgressDetail/')?>/" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('id').html(data.progress_id);

        $.ajax({
          url: "<?=site_url('progress/getListPekerjaan')?>/" + data.progress_id,
          type: "GET",
          dataType: "json",
          success: function(list) {
            var img = '';
            var rowl = '';
            var angka = 1;
            rowl+='<table class="table"><tr><td style="text-align:center;font-weight:bold">DAFTAR PEKERJAAN</td><td style="text-align:center;font-weight:bold">STATUS</td></tr>';
            for (var i = 0; i < list.length; i++) {
              // console.log(evi[0][i].url)
              rowl+='<tr><td>'+ list[i].pekerjaan +'</td><td width="150" style="text-align:center">'+ (list[i].tanggal_selesai != null ? "<i class='fas fa-check text-success'></i> DONE" : "<i class='fas fa-times text-danger'></i> NOT DONE YET") +'</td></tr>';
              angka++;
            }
            rowl+='</table>';

            $('#list_val').html(rowl);
          }, error: function(jqXHR, textStatus, errorThrown) {
            var err = eval("(" + jqXHR.responseText + ")");
            alert(err.Message);
          }
        });
        document.getElementById('modify_pekerjaan').href = "<?=site_url('progress/list/')?>"+data.progress_id;
        $('#created_by').html("Created by <b>" + data.name + "</b>");
        if (data.subject != null) {
          $('[id=subject_val]').html(data.subject);
        } else {
          $('[id=subject_val]').html("-");
        }
        if (data.tanggal_mulai != null) {
          $('[id=tanggal_mulai_val]').html(moment(data.tanggal_mulai).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_mulai_val]').html("-");
        }
        $('[id=tipe_val]').html(data.tipe_pekerjaan);
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
        if (data.nilai_corr != null) {
          $('[id=nilai_corr_val]').html("Rp. " + currency_format(data.nilai_corr));
        } else {
          $('[id=nilai_corr_val]').html("-");
        }
        if (data.nilai_progress != null) {
          $('[id=nilai_progress_val]').html("Rp. " + currency_format(data.nilai_progress));
        } else {
          $('[id=nilai_progress_val]').html("-");
        }
        if (data.site_id != "") {
          $('[id=pid_val]').html(data.id_site + ' ' + data.id_site_telkom + ' / ' + data.nama_site);
          $("#pid_div_det").show();
        } else {
          $("#pid_div_det").hide();
        }
        $('[id=nama_site_val]').html(data.nama_site);
        $('[id=lokasi_site_val]').html(data.lokasi);
        if (data.no_corr != null) {
          $('[id=no_corr_val]').html("<i class='fas fa-check text-success'></i> " + data.no_corr);
        } else {
          $('[id=no_corr_val]').html("<i class='fas fa-times text-danger'></i>");
        }
        if (data.tanggal_corr != null) {
          $('[id=tanggal_corr_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.tanggal_corr).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_corr_val]').html("<i class='fas fa-times text-danger'></i> ");
        }
        if (data.no_po != null) {
          if (data.no_po != "BYMHD") {
            $('[id=no_po_val]').html("<i class='fas fa-check text-success'></i> " + data.no_po);
          } else {
            $('[id=no_po_val]').html("<i class='fas fa-check text-success'></i> " + data.no_po + ' ' + data.tanggal_bmhd);
          }
        } else {
          $('[id=no_po_val]').html("<i class='fas fa-times text-danger'></i>");
        }
        if (data.tanggal_po != null) {
          $('[id=tanggal_po_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.tanggal_po).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_po_val]').html("<i class='fas fa-times text-danger'></i> ");
        }

        if (data.tanggal_bmhd != null) {
          $('[id=tanggal_bmhd_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.tanggal_bmhd).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_bmhd_val]').html("<i class='fas fa-times text-danger'></i> ");
        }

        if (data.no_bast != null) {
          $('[id=no_bast_val]').html("<i class='fas fa-check text-success'></i> " + data.no_bast);
        } else {
          $('[id=no_bast_val]').html("<i class='fas fa-times text-danger'></i>");
        }
        if (data.tanggal_bast != null) {
          $('[id=tanggal_bast_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.tanggal_bast).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_bast_val]').html("<i class='fas fa-times text-danger'></i> ");
        }
        if (data.no_bapp != null) {
          $('[id=no_bapp_val]').html("<i class='fas fa-check text-success'></i> " + data.no_bapp);
        } else {
          $('[id=no_bapp_val]').html("<i class='fas fa-times text-danger'></i>");
        }
        if (data.tanggal_bapp != null) {
          $('[id=tanggal_bapp_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.tanggal_bapp).format('dddd, D MMMM Y'));
        } else {
          $('[id=tanggal_bapp_val]').html("<i class='fas fa-times text-danger'></i>");
        }

        if (data.is_bayar != null) {
          $('[id=sudah_dibayarkan_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.is_bayar).format('dddd, D MMMM Y'));
        } else {
          $('[id=sudah_dibayarkan_val]').html("<i class='fas fa-times text-danger'></i> BELUM");
        }
        if (data.is_invoiced != null) {
          $('[id=sudah_invoice_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.is_invoiced).format('dddd, D MMMM Y'));
        } else {
          $('[id=sudah_invoice_val]').html("<i class='fas fa-times text-danger'></i> BELUM");
        }
        if (data.is_bayarclient != null) {
          $('#modify_pekerjaan').hide();
          $('[id=sudah_dibayar_client_val]').html("<i class='fas fa-check text-success'></i> " + moment(data.is_bayarclient).format('dddd, D MMMM Y'));
        } else {
          $('#modify_pekerjaan').show();
          $('[id=sudah_dibayar_client_val]').html("<i class='fas fa-times text-danger'></i> BELUM");
        }

        // $('[id=tanggal_pengajuan]').html(moment(data.tanggal_pengajuan).format('dddd, D MMMM Y HH:m:s'));
        // $('[id=realisasi_pengajuan]').html(moment(data.realisasi_pengajuan).format('dddd, D MMMM Y'));
        // $('[id=pid_val]').html(data.id_site + ' / ' + data.nama_site);

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
                row4+='<div class="" style="'+ (i == 0 ? '' : '+ "line-height:25px" +') +'"><i class="fas fa-file"></i> <a href="public/assets/evidence/progress/'+ escape(evi[0][0][i].url) +'" target="_blank">'+ evi[0][0][i].url.slice(14) +'</a></div>';
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
                for (var i = 0; i < evi[0][0].length; i++) {
                  // console.log(evi[0][i].url)
                    row1+= (i == 0 ? '<br>' : '') + '<div class="column">'+
                      '<img src="public/assets/evidence/progress/'+ escape(evi[0][0][i].url) +'" style="width:100%" onclick="openModal();currentSlide(\''+ angka +'\')" class="hover-shadow cursor">'+
                    '</div>';

                    row2+='<div class="mySlides">'+
                        '<img src="public/assets/evidence/progress/'+ escape(evi[0][0][i].url) +'" style="width:100%">'+
                      '</div>';

                    row3+='<div class="column">'+
                        '<img class="demo cursor" src="public/assets/evidence/progress/'+ escape(evi[0][0][i].url) +'" style="width:100%" onclick="currentSlide(\''+ angka +'\')" alt="'+ evi[0][0][i].keterangan +'">'+
                      '</div>';
                  angka++;
                }
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
          swal("Success!", "Data progress berhasil diupdate!", "success");
          reload_table();
        }
        $('#btnUpdate').text('Update');
        $('#btnUpdate').attr('disabled', false);
      }
    });
  }

  function edit() {
    $('#btnEdit').text('Updating...');
    $('#btnEdit').attr('disabled', true);
    var url;

    url = "<?=site_url('progress/update_detail')?>";

    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_update_e').serialize(),
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
        $('#btnEdit').text('Update');
        $('#btnEdit').attr('disabled', false);
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

  function editProgress(id) {

    $.ajax({
      url: "<?=site_url('progress/getProgressDetail/')?>" + id,
      type: "GET",
      dataType: "json",
      success: function(data) {
        $('#project_vale option').attr('selected', false);
        $('#project_vale').selectpicker('render');
        $('#site_vale option').attr('selected', false);
        $('#site_vale').selectpicker('refresh');
        $('#site_vale').selectpicker('render');
        $('[name=id]').val(data.progress_id);
        if (data.keterangan != null) {
          $('[name=pekerjaan_vale]').val(data.keterangan);
        } else {
          $('[name=pekerjaan_vale]').val("");
        }
        if (data.tanggal_mulai != null) {
          $('[name=tanggal_mulai_pekerjaan_vale]').val(data.tanggal_mulai);
        } else {
          $('[name=tanggal_mulai_pekerjaan_vale]').val("");
        }
        // if (data.site_id != null) {
        //   $('#site_vale option[value='+data.site_id+']').attr('selected', true);
        // } else {
        //   $('#site_vale option[value=default]').attr('selected', true);
        // }
        // if (data.project_id != null) {
        //   $('#project_vale option[value='+data.project_id+']').attr('selected', true);
        // } else {
        //   $('#project_vale option[value=default]').attr('selected', true);
        // }
        // $('.selectpicker').selectpicker('refresh');
        // $('.selectpicker').selectpicker('render');
        // $('#project_vale').find('.bs-title-option').text($('#project_vale option:selected').text());
        // $('#project_vale').selectpicker({title: $('#project_vale option:selected').text()}).selectpicker('render');
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
          // $('#po_select option[value='+data.no_po+']').attr('selected', true);
          // $('.selectpicker').selectpicker('refresh');
          // $('.selectpicker').selectpicker('render');
        } else {
          $('[name=no_po_vale]').val("");
          // $('#po_select option[value=po_s').attr('selected', true);
          // $('.selectpicker').selectpicker('refresh');
          // $('.selectpicker').selectpicker('render');
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
          $('#tanggal_bmhd_div').hide();
          $('#isian_po').show();
          $('[name=tanggal_po_vale]').val(data.tanggal_po);
        } else {
          $('[name=tanggal_po_vale]').val("");
        }
        if (data.tanggal_bmhd != null) {
          $('#tanggal_bmhd_div').show();
          $('#isian_po').hide();
          $('[name=tanggal_bmhd_vale]').val(data.tanggal_bmhd);
        } else {
          $('[name=tanggal_bmhd_vale]').val("");
        }
        if (data.tanggal_corr != null) {
          $('[name=tanggal_corr_vale]').val(data.tanggal_corr);
        } else {
          $('[name=tanggal_corr_vale]').val("");
        }
        if (data.nilai_progress != null) {
          $('[name=nilai_progress_vale]').val(data.nilai_progress);
        } else {
          $('[name=nilai_progress_vale]').val("");
        }
        if (data.nilai_corr != null) {
          $('[name=nilai_corr_vale]').val(data.nilai_corr);
        } else {
          $('[name=nilai_corr_vale]').val("");
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
        if (data.deskripsi != null) {
          $('[name=deskripsi_vale]').val(data.deskripsi);
        } else {
          $('[name=deskripsi_vale]').val("");
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
          $('[name=invoiced_vale]').val(data.is_invoiced);
        } else {
          $('[name=invoiced_vale]').val("");
        }
        if (data.is_bayar != null) {
          $('[name=bayar_vale]').val(data.is_bayar);
        } else {
          $('[name=bayar_vale]').val("");
        }
        if (data.is_bayar_client != null) {
          $('[name=bayarclient_vale]').val(data.is_bayar_client);
        } else {
          $('[name=bayarclient_vale]').val("");
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
