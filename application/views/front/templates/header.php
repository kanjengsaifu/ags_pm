<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
    <style>
      #loader{transition:all .3s ease-in-out;opacity:1;visibility:visible;position:fixed;height:100vh;width:100%;background:#fff;z-index:90000}#loader.fadeOut{opacity:0;visibility:hidden}.spinner{width:40px;height:40px;position:absolute;top:calc(50% - 20px);left:calc(50% - 20px);background-color:#333;border-radius:100%;-webkit-animation:sk-scaleout 1s infinite ease-in-out;animation:sk-scaleout 1s infinite ease-in-out}@-webkit-keyframes sk-scaleout{0%{-webkit-transform:scale(0)}100%{-webkit-transform:scale(1);opacity:0}}@keyframes sk-scaleout{0%{-webkit-transform:scale(0);transform:scale(0)}100%{-webkit-transform:scale(1);transform:scale(1);opacity:0}}
      .btn-primary {background-color:red !important;border-color:red !important; }
      .btn-primary:hover {background-color:black !important; border-color: black !important; cursor: pointer; transition: all 0.5s ease-out}
    </style>
    <title><?=$title?></title>
    <?=css('theme/adminator/colorlib.com/polygon/adminator/style.css')?>
    <?=css('css/fontawesome/web-fonts-with-css/css/fontawesome-all.css')?>
    <?=css('theme/air-datepicker/datepicker.min.css')?>
    <?=css('css/jquery.dataTables.min.css')?>
    <?=css('css/bootstrap.css')?>
    <?=css('css/fileinput.min.css')?>
    <?=css('css/bootstrap-tagsinput.css')?>
    <?=css('css/bootstrap-select.min.css')?>
    <?=css('css/select2.min.css')?>
    <?=css('css/sweetalert.css')?>
    <?=css('css/ekko-lightbox.css')?>
    <?=css('css/font-awesome.min.css')?>
    <?=css('css/theme.min.css?ver=201801102302')?>
    <?=css('css/jquery.filer.css')?>
    <link href="https://unpkg.com/nanogallery2@2.0.0/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="https://code.jquery.com/jquery-latest.min.js"></script>
    <?=js('js/jquery.validate.min.js')?>
    <?=js('js/jquery.nanogallery2.min.js')?>
    <?=js('js/piexif.min.js')?>
    <?=js('js/sortable.min.js')?>
    <?=js('js/purify.min.js')?>
    <?=js('js/bootstrap.min.js')?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/fileinput.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.5/js/locales/LANG.js"></script> -->
    <?=js('assets/js/fileinput.js'); ?>
    <?=js('js/id.min.js')?>
    <?=js('js/sweetalert.js')?>
    <?=js('theme/air-datepicker/datepicker.min.js')?>
    <script type="text/javascript" src="https://afarkas.github.io/webshim/js-webshim/minified/polyfiller.js"></script>
    <?=js('js/ekko-lightbox.min.js')?>
    <?=js('js/jquery.dataTables.min.js')?>
    <?=js('js/Chart.min.js')?>
    <?=js('js/jquery.filer.js')?>
    <script src="https://cdn.ckeditor.com/4.8.0/standard/ckeditor.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.3/js/dataTables.rowReorder.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.1/js/dataTables.responsive.min.js"></script> -->
    <style media="screen">

      input[type=number]::-webkit-inner-spin-button,
      input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none !important;
        margin: 0 !important;
      }

      .file_input{
          display: inline-block;
          padding: 10px 16px;
          outline: none;
          cursor: pointer;
          text-decoration: none;
          text-align: center;
          white-space: nowrap;
          font-family: sans-serif;
          font-weight: bold !important;
          border-radius: 3px;
          color: #008BFF;
          border: 1px solid #008BFF;
          vertical-align: middle;
          background-color: #fff;
          margin-bottom: 10px;
          box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
          -webkit-transition: all 0.2s;
          -moz-transition: all 0.2s;
          transition: all 0.2s;
      }
      .file_input:hover,
      .file_input:active {
          background: #008BFF;
          color: #fff !important;
      }

      table, tr, td {
        padding: 5px !important;
      }
      .caret {
        visibility: hidden;
      }

      .input-group-btn {
        width: auto;
        display: inline-flex;
      }

      input:focus {
        outline: 0 !important;
        border: solid 1px #333 !important;
        -webkit-box-shadow: none !important;
      }

      .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        border: none !important;
      }

      label {
        font-weight: bold;
      }

      canvas {
        border: none !important;
      }

      .bootstrap-select > .dropdown-toggle {
        width: 100% !important;
      }

      .open > .dropdown-menu { display: block; }


      .selectpicker { overflow: auto !important; }
      .modal { overflow: auto !important; }
      .modal > .open > .dropdown-menu { display: block; }

      .dropdown-toggle.btn-default {
        color: #292b2c;
        background-color: #fff;
        border-color: #ccc;
      }

      .bootstrap-select.show>.dropdown-menu>.dropdown-menu {
        display: block;
      }

      .bootstrap-select > .dropdown-menu > .dropdown-menu li.hidden{
        display:none;
      }

      .bootstrap-select > .dropdown-menu > .dropdown-menu li a{
        display: block;
        width: 100%;
        padding: 3px 1.5rem;
        clear: both;
        font-weight: 400;
        color: #292b2c;
        text-align: inherit;
        white-space: nowrap;
        background: 0 0;
        border: 0;
      }

      .dropdown-menu > li.active > a {
        color: #fff !important;
        background-color: #337ab7 !important;
      }

      .bootstrap-select .check-mark::after {
        content: "✓";
      }

      .bootstrap-select button {
        overflow: hidden;
        text-overflow: ellipsis;
      }


      .dropdown-toggle.btn-default {
        color: #292b2c;
        background-color: #fff;
        border-color: #ccc;
      }
      .bootstrap-select.show > .dropdown-menu > .dropdown-menu,
      .bootstrap-select > .dropdown-menu > .dropdown-menu li.hidden {
        display: block;
      }
      .bootstrap-select > .dropdown-menu > .dropdown-menu li a {
        display: block;
        width: 100%;
        padding: 3px 1.5rem;
        clear: both;
        font-weight: 400;
        color: #292b2c;
        text-align: inherit;
        white-space: nowrap;
        background: 0 0;
        border: 0;
        text-decoration: none;
      }
      .bootstrap-select > .dropdown-menu > .dropdown-menu li a:hover {
        background-color: #f4f4f4;
      }
      .bootstrap-select > .dropdown-toggle {
        width: auto;
      }
      .dropdown-menu > li.active > a {
        color: #fff !important;
        background-color: #337ab7 !important;
      }
      .bootstrap-select .check-mark {
        line-height: 14px;
      }
      .bootstrap-select .check-mark::after {
        font-family: "FontAwesome";
        content: "\f00c";
      }
      .bootstrap-select button {
        overflow: hidden;
        text-overflow: ellipsis;
      }

      /* Make filled out selects be the same size as empty selects */
      .bootstrap-select.btn-group .dropdown-toggle .filter-option {
        display: inline !important;
      }
      /* Make filled out selects be the same size as empty selects */
      .bootstrap-select.btn-group .dropdown-toggle .filter-option {
      display: inline !important;
      }

      * {
        font-size: 14px !important;
      }

      .open > .dropdown-menu { display: block; }

      #bukti .modal-content {
        box-shadow: none !important;
        border: none;
      }

      #bukti .caption-container {
        background-color: #fff;
        color: #000;
      }

      #bukti .column {
        padding:3px 1px;
      }

      #bukti .row > .column {
        padding: 3px;
      }

      #bukti .row:after {
        content: "";
        display: table;
        clear: both;
      }

      #bukti .column {
        float: left;
        width: 25%;
      }

      /* The Modal (background) */
      #bukti .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: #fff;
      }

      /* Modal Content */
      #bukti .modal-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
      }

      /* The Close Button */
      #bukti .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
      }

      #bukti .close:hover,
      #bukti .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
      }

      #bukti .mySlides {
        display: none;
      }

      #bukti .cursor {
        cursor: pointer
      }

      /* Next & previous buttons */
      #bukti .prev,
      #bukti .next {
        cursor: pointer;
        position: absolute;
        top: 220px;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
        background-color: #fff;
        color: #000;
      }

      /* Position the "next button" to the right */
      #bukti .next {
        right: 0;
        border-radius: 3px 0 0 3px;
      }

      /* On hover, add a black background color with a little bit see-through */
      #bukti .prev:hover,
      #bukti .next:hover {
        background-color: rgba(0, 0, 0, #fff);
      }

      /* Number text (1/3 etc) */
      #bukti .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
      }

      .bukti, .bukti:hover, .bukti:focus {
        padding:none !important;
        transition: all 0s ease !important;
        border: solid 0px #000 !important;
        box-shadow: none !important;
        width: 50%;
      }

      .bukti::-webkit-file-upload-button {
        background: #fff;
        color: #000;
      }

      img {
        margin-bottom: -4px;
      }

      .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
      }

      .demo {
        opacity: 0.6;
      }

      .active,
      .demo:hover {
        opacity: 1;
      }

      img.hover-shadow {
        transition: 0.3s
      }

      .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)
      }
      .form-control:focus, input:focus, input:hover {

      }
      table, tr, td, th {
        border: solid 1px #eaeaea !important;
        box-shadow: none !important;
        border-collapse:collapse !important;
      }
      tbody tr:hover {
        background: #f0f0f0 !important;
      }
      .btn-group {
        border: solid 1px #ccc;
      }
      input.select2-search__field {
        border: none !important;
      }
      .datepicker {
        z-index: 99999 !important;
      }
      th.dt-center, td.dt-center { text-align: center; }
      .table>tbody>tr>td, .table>thead>tr>th {vertical-align: middle !important}
      #thumbnail img{
        width:100px;
        height:100px;
        margin:5px;
      }
      canvas{
        border:1px solid red;
      }
      /* .input-group input {

      }
      .file-preview-frame {

      }
      .input-group-btn {
        width: 90%;
        float: right;
      }
      #kvFileinputModal {
        margin-top: 30%;
      } */

    </style>
  </head>
  <?php if (isLogin()): ?>
    <body class="app">
    <div id="loader">
      <div class="spinner"></div>
    </div>
    <script type="text/javascript">window.addEventListener('load', () => {
      const loader = document.getElementById('loader');
      setTimeout(() => {
        loader.classList.add('fadeOut');
        }, 300);
      });
    </script>
      <div>
        <div class="sidebar">
          <div class="sidebar-inner">
            <div class="sidebar-logo">
              <div class="peers ai-c fxw-nw">
                <div class="peer peer-greed">
                  <a class="td-n" href="<?=site_url();?>">
                  <div class="peers ai-c fxw-nw">
                    <div class="peer">
                      <div class="logo"><img alt="" src="<?=base_url('public/theme/adminator/colorlib.com/polygon/adminator/assets/static/images/logo-tiny.png')?>"></div>
                    </div>
                    <div class="peer peer-greed">
                      <h5 class="lh-1 mB-0 logo-text">
                        <b>AG</b> APS
                      </h5>
                    </div>
                  </div></a>
                </div>
                <div class="peer">
                  <div class="mobile-toggle sidebar-toggle">
                    <a class="td-n" href="#"><i class="ti-arrow-circle-left"></i></a>
                  </div>
                </div>
              </div>
            </div>

            <ul class="sidebar-menu scrollable pos-r">
              <li class="nav-item mT-30 active">
                <a class="sidebar-link" href="<?=site_url('')?>"><span class="icon-holder"><i class="fas fa-home"></i></span> <span class="title">Dashboard</span></a>
              </li>
              <?php if (isAdministrator() || isApproval() || isAdminJakarta() || isAdminTasik()): ?>
                <li class="nav-item">
                  <a class="sidebar-link" href="<?=site_url('submission')?>"><span class="icon-holder"><i class="fas fa-file"></i></span> <span class="title">
                    <?php if (isApproval()) { echo "Approvement"; } else { echo "Pengajuan"; } ?>
                  </span></a>
                </li>
              <?php endif; ?>
              <?php if (isAdm() || $this->session->userdata('username') == "zahra"): ?>
                <li class="nav-item">
                  <a class="sidebar-link" href="<?=site_url('progress')?>"><span class="icon-holder"><i class="fas fa-tasks"></i></span> <span class="title">Progress</span></a>
                </li>
              <?php endif; ?>
              <?php if (isViewer() || isAdministrator() || isAdm()): ?>
                <?php if (isViewer()): ?>
                  <li class="nav-item">
                    <a class="sidebar-link" href="<?=site_url('progress/report')?>"><span class="icon-holder"><i class="fas fa-tasks"></i></span> <span class="title">Progress</span></a>
                  </li>
                <?php endif; ?>
                <li class="nav-item">
                  <a class="sidebar-link" href="<?=site_url('progress/chart')?>"><span class="icon-holder"><i class="far fa-chart-bar"></i></span> <span class="title">Progress Chart</span></a>
                </li>
              <?php endif; ?>
              <?php if (!isAdminTasik()): ?>
                <li class="nav-item dropdown">
                  <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                      <i class="fas fa-book"></i>
                    </span>
                    <span class="title">Evidences</span>
                    <span class="arrow">
                      <i class="ti-angle-right"></i>
                    </span>
                  </a>
                  <ul class="dropdown-menu" style="display: none;">

                    <?php if (!isAdm()): ?>
                      <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                          <span>Pengajuan</span>
                          <span class="arrow">
                            <i class="ti-angle-right"></i>
                          </span>
                        </a>
                        <ul class="dropdown-menu" style="display: block;">
                          <li>
                            <a href="<?=site_url('evidences/submission/document')?>">Dokumen</a>
                          </li>
                          <li>
                            <a href="<?=site_url('evidences/submission/picture')?>">Picture</a>
                          </li>
                        </ul>
                      </li>
                    <?php endif; ?>

                    <?php if (!isAdm()): ?>
                      <li class="nav-item dropdown">
                        <a href="<?=site_url('evidences/transaksi/document')?>">
                          <span>Transaksi</span>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if (isAdm() || isViewer() || $this->session->userdata('username') == "stadmaresi"): ?>
                      <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                          <span>Progress</span>
                          <span class="arrow">
                            <i class="ti-angle-right"></i>
                          </span>
                        </a>
                        <ul class="dropdown-menu" style="display: block;">
                          <li>
                            <a href="<?=site_url('evidences/progress/document')?>">Dokumen</a>
                          </li>
                          <li>
                            <a href="<?=site_url('evidences/progress/picture')?>">Picture</a>
                          </li>
                        </ul>
                      </li>
                    <?php endif; ?>
                  </ul>
                </li>
              <?php endif; ?>
              <?php if ($this->session->userdata('username') == "stadmaresi" || isApproval() || isAdminJakarta()): ?>
                <li class="nav-item dropdown">
                  <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                      <i class="fas fa-eye"></i>
                    </span>
                    <span class="title">Monitoring</span>
                    <span class="arrow">
                      <i class="ti-angle-right"></i>
                    </span>
                  </a>
                  <ul class="dropdown-menu" style="display: none;">

                    <?php if (!isAdminJakarta()): ?>
                      <li class="nav-item dropdown">
                        <a href="<?=site_url('monitoring/submission')?>">
                          <span>Pengajuan</span>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if ($this->session->userdata('username') == "stadmaresi" || isAdminJakarta()): ?>
                      <li class="nav-item dropdown">
                        <a href="<?=site_url('monitoring/progress')?>">
                          <span>Progress</span>
                        </a>
                      </li>
                    <?php endif; ?>

                  </ul>
                </li>
              <?php endif; ?>
              <?php if (isAdministrator() || isApproval() || isAdminTasik()) { ?>
                <hr>
                <li class="nav-item">
                  <a class="sidebar-link" href="<?=site_url('staff')?>"><span class="icon-holder"><i class="fas fa-user"></i></span> <span class="title">Staff</span></a>
                </li>
                <li class="nav-item">
                  <a class="sidebar-link" href="<?=site_url('site')?>"><span class="icon-holder"><i class="fas fa-map-marker"></i></span> <span class="title">Site</span></a>
                </li>
                <li class="nav-item">
                  <a class="sidebar-link" href="<?=site_url('kendaraan')?>"><span class="icon-holder"><i class="fas fa-car"></i></span> <span class="title">Kendaraan</span></a>
                </li>
                <li class="nav-item dropdown">
                  <a class="dropdown-toggle" href="javascript:void(0);">
                    <span class="icon-holder">
                      <i class="fas fa-sitemap"></i>
                    </span>
                    <span class="title">Cluster</span>
                    <span class="arrow">
                      <i class="ti-angle-right"></i>
                    </span>
                  </a>
                  <ul class="dropdown-menu" style="display: none;">

                    <li class="nav-item">
                      <a class="sidebar-link" href="<?=site_url('cluster')?>"><span class="icon-holder"></span> <span class="title">Data Wilayah</span></a>
                    </li>

                    <li class="nav-item">
                      <a class="sidebar-link" href="<?=site_url('team')?>"><span class="icon-holder"></span> <span class="title">Cluster</span></a>
                    </li>

                  </ul>
                </li>
              <?php } ?>
              <hr>
              <li class="nav-item">
                <a class="sidebar-link" href="" data-toggle="modal" data-target="#feedback" onclick="feedback()"><span class="icon-holder"><i class="fas fa-comment"></i></span> <span class="title">Pesan untuk Developer</span></a>
              </li>
            </ul>
          </div>
        </div>
        <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="feedback" role="dialog" tabindex="-1">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Message for Developer</h5><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">×</span></button>
              </div>
              <div class="modal-body">
                <form id="form_addfeed" class="" action="<?=site_url('feedback/save')?>" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="">Jenis Umpan</label>
                    <select id="jenis_feedback" style="width:100%;" class="form-control selectpicker" name="jenis_feedback" >
                      <option value="" selected disabled readonly>PILIH JENIS FEEDBACK</option>
                      <option id="report_bug" value="report_bug">REPORT BUG</option>
                      <option id="req_feature" value="req_feature">REQUEST FEATURE</option>
                      <option id="lainnya" value="lainnya">LAINNYA</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="name" value="" placeholder="Nama Lengkap" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="">Pesan</label>
                    <textarea name="content" class="form-control" rows="8" cols="80"></textarea>
                  </div>

              </div>
              <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal" type="button">Close</button>
                <button class="btn btn-primary" data-dismiss="modal" type="button" id="btnAddFeed" onclick="savefeed()">Kirim</button>
              </div>
              </form>
            </div>
          </div>
        </div>
  <?php endif; ?>
  <?php if (isLogin()): ?>
    <div class="page-container">
      <?php navbar() ?>
  <?php endif; ?>
  <script>
    function feedback() {
      $('.modal-title').text('Message for Developer');
    }
  </script>
