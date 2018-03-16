<?php

/**
 *
 */
class Progress extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page = 'progress') {
    isLoggedIn();
    $config['title']  = "Progress Project" . $this->title;
    $config['kategori_pengajuan'] = $this->appModel->getEnumKategoriPengajuan();
    $config['site_list']          = $this->appModel->getSiteData();
    $config['project_list']       = $this->appModel->getProjectDataforProgress();
    $this->loadPage($page, $config);
  }

  public function list($page = 'list') {
    isLoggedIn();
    $config['title']  = "List Pekerjaan" . $this->title;
    $config['subject']= $this->appModel->subjectP($this->uri->segment(3));
    $this->loadPage($page, $config);
  }

  public function main_report($page = 'progress_report') {
    isLoggedIn();
    $config['title']  = "Monitor Progress" . $this->title;
    $config['kategori_pengajuan'] = $this->appModel->getEnumKategoriPengajuan();
    $config['site_list']          = $this->appModel->getSiteData();
    $config['project_list']       = $this->appModel->getProjectDataforProgress();
    $config['totalprogress']      = $this->appModel->totalprogress();
    $config['progressbelumselesai'] = $this->appModel->progressBelumSelesai();
    $config['progresssudahselesai'] = $this->appModel->progressSudahSelesai();
    $this->loadPage($page, $config);
  }

  public function save() {
    if ($this->input->post('site_id')=="new_site") {
      $data_site = array(
        'id_site'           => $this->input->post('id_site'),
        'id_site_telkom'    => $this->input->post('id_site_telkom'),
        'nama_site'         => $this->input->post('nama_site'),
        'lokasi'            => $this->input->post('lokasi_site'),
        'keterangan_site'   => $this->input->post('keterangan_site')
      );
      $this->appModel->siteSave($data_site);
    }

    $data_progress = array(
      'subject'               => ($this->input->post('subject') != "" ? $this->input->post('subject') : NULL),
      'tanggal_mulai'         => ($this->input->post('tanggal_mulai') != "" ? $this->input->post('tanggal_mulai') : NULL),
      'no_corr'               => ($this->input->post('no_corr') != "" ? $this->input->post('no_corr') : NULL),
      'no_po'                 => ($this->input->post('no_po') != "" ? $this->input->post('no_po') : NULL),
      'tanggal_corr'          => ($this->input->post('tanggal_corr') != "" ? $this->input->post('tanggal_corr') : NULL),
      'tanggal_po'            => ($this->input->post('tanggal_po') != "" ? $this->input->post('tanggal_po') : NULL),
      'nilai_corr'            => ($this->input->post('nilai_corr') != "" ? $this->input->post('nilai_corr') : NULL),
      'nilai_progress'        => ($this->input->post('nilai_progress') != "" ? $this->input->post('nilai_progress') : NULL),
      'tanggal_kontrak'       => ($this->input->post('tanggal_kontrak') != "" ? $this->input->post('tanggal_kontrak') : NULL),
      'tanggal_akhir_kontrak' => ($this->input->post('tanggal_akhir_kontrak') != "" ? $this->input->post('tanggal_akhir_kontrak') : NULL),
      'deskripsi'             => ($this->input->post('deskripsi') != "" ? $this->input->post('deskripsi') : NULL),
      'tipe_pekerjaan'        => $this->input->post('tipe_pekerjaan'),
      'site_id'               => (
                                   $this->input->post('site_id') == "" ?
                                     ""
                                     :
                                     (
                                       $this->input->post('site_id') == "new_site" ?
                                       $this->appModel->getNewSiteID($this->input->post('id_site'), $this->input->post('id_site_telkom'), $this->input->post('nama_site')) :
                                       $this->input->post('site_id')
                                     )
                                  ),
      'created_by'            => $this->session->userdata('useractive_id'),
      'created_at'            => date('Y-m-d', time())
    );
    $this->appModel->addProgress($data_progress, $this->input->post('keterangan'));

    // $ket_count = count($this->input->post('keterangan'));
    // for ($i=0; $i < $ket_count; $i++) {
    //   'keterangan'            => $this->input->post('keterangan')[$i]
    // }
  }

  public function save_pekerjaan() {
    $data_pekerjaan = array(
      'progress_id'           => $this->input->post('progress_id'),
      'pekerjaan'             => ($this->input->post('pekerjaan') != "" ? $this->input->post('pekerjaan') : NULL),
      'tanggal_selesai'       => ($this->input->post('tanggal_selesai') != "" ? $this->input->post('tanggal_selesai') : NULL),
    );
    $this->appModel->addPekerjaan($data_pekerjaan, $this->input->post('progress_id'));
  }

  public function data() {
    $staff_data = $this->appModel->getProgressJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($staff_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = ($stfd->is_bayarclient != NULL ?
                  ($stfd->is_checked != "N" ?
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="h_rmvCBox('.$stfd->progress_id.')" checked>'
                    :
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="h_saveCBox('.$stfd->progress_id.')">'
                  )
                  :
                  ($stfd->is_checked != "N" ?
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="rmvCBox('.$stfd->progress_id.')" checked>'
                    :
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="saveCBox('.$stfd->progress_id.')">'
                  )
                );
      // $row[]  = $no;
      $row[]  = $stfd->id_site . ' ' . $stfd->id_site_telkom;
      $row[]  = ($stfd->tipe_pekerjaan != null ? $stfd->tipe_pekerjaan : '-');
      $row[]  = ($stfd->no_corr != null ? $stfd->no_corr : '-');
      $row[]  = ($stfd->no_po != null ? $stfd->no_po : '-');
      $row[]  = ($stfd->no_bast != null ? $stfd->no_bast : '-');
      $row[]  = ($stfd->no_bapp != null ? $stfd->no_bapp : '-');
      $row[]  = ($stfd->nilai_progress != null ? number_format($stfd->nilai_progress, '0','.','.') : '-');
      $row[]  = '
                <button type="button" href="" onclick="detailProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailProgress">
                  <i class="fas fa-search"></i>
                </button>
                <button type="button" href="" onclick="historyProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#historyProgress">
                  <i class="fas fa-history"></i>
                </button>
                '.
                  ($stfd->is_bayarclient != NULL ?
                  ''
                  :
                  '
                  '.
                  (isAdm() ?
                  '<a href="'.site_url('progress/list/'.$stfd->progress_id).'" target="_blank" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                    <i class="fas fa-external-link-square-alt"></i>
                  </a>' : '')
                  .'
                  <button type="button" href="" onclick="updateProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#updateProgress">
                    UPD
                  </button>
                  '.
                  (isAdm() ?
                  '<button type="button" href="" onclick="uploadBuktiProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#uploadBuktiProgress">
                    <i class="fas fa-upload"></i>
                  </button>
                  <button type="button" href="" onclick="deleteProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger" data-toggle="modal" data-target="#deleteProgress">
                    <i class="fas fa-trash"></i>
                  </button>' : ''
                  )
                  .'


                  '
                  )
                .'
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countProgressData(),
      "recordsFiltered" => $this->appModel->countProgressDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function list_data() {
    $staff_data = $this->appModel->getListJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($staff_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = ($stfd->pekerjaan != null ? $stfd->pekerjaan : '-');
      $row[]  = ($stfd->tanggal_selesai != null ? $stfd->tanggal_selesai : '-');
      // $row[]  = ($stfd->is_done != "N" ? "DONE" : "NOT DONE YET");
      $row[]  = '
                <button type="button" href="" onclick="updatePekerjaan('."'".$stfd->pekerjaan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#updatePekerjaan">
                  UPDATE
                </button>
                <button type="button" href="" onclick="deletePekerjaan('."'".$stfd->pekerjaan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger" data-toggle="modal" data-target="#deletePekerjaan">
                  <i class="fas fa-trash"></i>
                </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countListData(),
      "recordsFiltered" => $this->appModel->countListDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function data_report() {
    $staff_data = $this->appModel->getProgressJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($staff_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = ($stfd->is_bayarclient != NULL ?
                  ($stfd->is_checked != "N" ?
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="h_rmvCBox('.$stfd->progress_id.')" checked>'
                    :
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="h_saveCBox('.$stfd->progress_id.')">'
                  )
                  :
                  ($stfd->is_checked != "N" ?
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="rmvCBox('.$stfd->progress_id.')" checked>'
                    :
                    '<input type="checkbox" name="checked[]" value="'.$stfd->progress_id.'" onclick="saveCBox('.$stfd->progress_id.')">'
                  )
                );
      // $row[]  = $no;
      $row[]  = $stfd->id_site . ' ' . $stfd->id_site_telkom;
      $row[]  = ($stfd->tipe_pekerjaan != null ? $stfd->tipe_pekerjaan : '-');
      $row[]  = ($stfd->no_corr != null ? $stfd->no_corr : '-');
      $row[]  = ($stfd->no_po != null ? $stfd->no_po : '-');
      $row[]  = ($stfd->no_bast != null ? $stfd->no_bast : '-');
      $row[]  = ($stfd->no_bapp != null ? $stfd->no_bapp : '-');
      $row[]  = ($stfd->nilai_progress != null ? number_format($stfd->nilai_progress, '0','.','.') : '-');
      $row[]  = '
                <button type="button" href="" onclick="detailProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailProgress">
                  <i class="fas fa-search"></i>
                </button>
                <button type="button" href="" onclick="historyProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#historyProgress">
                  <i class="fas fa-history"></i>
                </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countProgressData(),
      "recordsFiltered" => $this->appModel->countProgressDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function getPekerjaanDetail($id) {
    $data = $this->appModel->getPekerjaanDetail($id);
    echo json_encode($data);
  }

  public function getProgressDetail($id) {
    $data = $this->appModel->getProgressByID($id);
    echo json_encode($data);
  }

  public function getProgressByID($id) {
    $data = $this->appModel->getProgressByID($id);
    echo json_encode($data);
  }

  public function update() {
    $data = array(
      'nilai_corr'              => ($this->input->post('nilai_corr_vale') != "" ? $this->input->post('nilai_corr_vale') : NULL),
      'nilai_progress'          => ($this->input->post('nilai_progress_vale') != "" ? $this->input->post('nilai_progress_vale') : NULL),
      'tanggal_corr'            => ($this->input->post('tanggal_corr_vale') != null ? $this->input->post('tanggal_corr_vale') : NULL),
      'no_corr'                 => ($this->input->post('no_corr_vale') != null ? $this->input->post('no_corr_vale') : NULL),
      'tanggal_po'              => ($this->input->post('tanggal_po_vale') != null ? $this->input->post('tanggal_po_vale') : NULL),
      'no_po'                   => ($this->input->post('no_po_vale') != null ? $this->input->post('no_po_vale') : NULL),
      'tanggal_bmhd'            => ($this->input->post('tanggal_bmhd_vale') != null ? $this->input->post('tanggal_bmhd_vale') : NULL),
      'is_bymhd'                => ($this->input->post('no_po_vale') != "bymhd" ? 'N' : 'Y'),
      'tanggal_kontrak'         => ($this->input->post('tanggal_kontrak_vale') != null ? $this->input->post('tanggal_kontrak_vale') : NULL),
      'tanggal_akhir_kontrak'   => ($this->input->post('tanggal_akhir_kontrak_vale') != null ? $this->input->post('tanggal_akhir_kontrak_vale') : NULL),
      'tanggal_bapp'            => ($this->input->post('tanggal_bapp_vale') != null ? $this->input->post('tanggal_bapp_vale') : NULL),
      'no_bapp'                 => ($this->input->post('no_bapp_vale') != null ? $this->input->post('no_bapp_vale') : NULL),
      'tanggal_bast'            => ($this->input->post('tanggal_bast_vale') != null ? $this->input->post('tanggal_bast_vale') : NULL),
      'no_bast'                 => ($this->input->post('no_bast_vale') != null ? $this->input->post('no_bast_vale') : NULL),
      'deskripsi'               => ($this->input->post('deskripsi_vale') != null ? $this->input->post('deskripsi_vale') : NULL),
      'is_invoiced'             => ($this->input->post('invoiced_vale') != null ? $this->input->post('invoiced_vale') : NULL),
      'is_bayar'                => ($this->input->post('bayar_vale') != null ? $this->input->post('bayar_vale') : NULL),
      'is_bayarclient'          => ($this->input->post('bayarclient_vale') != null ? $this->input->post('bayarclient_vale') : NULL),
      'remark'                  => ($this->input->post('remark') != null ? $this->input->post('remark') : NULL)
    );
    $insert = $this->appModel->updateProgress(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function update_list() {
    $data = array(
      'pekerjaan'              => ($this->input->post('pekerjaan_vale') != "" ? $this->input->post('pekerjaan_vale') : NULL),
      'tanggal_selesai'        => ($this->input->post('tanggal_selesai_vale') != null ? $this->input->post('tanggal_selesai_vale') : NULL)
    );
    $insert = $this->appModel->updatePekerjaan(array('pekerjaan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function update_detail() {
    $data = array(
      'keterangan'              => ($this->input->post('pekerjaan_vale') != null ? $this->input->post('pekerjaan_vale') : NULL),
      'tanggal_mulai'           => ($this->input->post('tanggal_mulai_pekerjaan_vale') != null ? $this->input->post('tanggal_mulai_pekerjaan_vale') : NULL)
      // 'site_id'                 => ($this->input->post('site_vale') != null ? $this->input->post('site_vale') : NULL),
      // 'project_id'              => ($this->input->post('project_vale') != null ? $this->input->post('project_vale') : NULL)
    );
    $insert = $this->appModel->editProgress(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function deleteProgress() {
    $delete_staff = $this->appModel->deleteProgress($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }

  public function deletePekerjaan() {
    $delete_staff = $this->appModel->deletePekerjaan($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }

  public function saveEvidence() {
    if ($_FILES['buktiprog']['name']['0'] != "") {
      $filesCount = count($_FILES['buktiprog']['name']);

      for ($i=0; $i < $filesCount; $i++) {
        unset($config);
        $config = array();
        $config['upload_path']    = './public/assets/evidence/progress/';
        $config['allowed_types']  = 'jpg|jpeg|png|pdf|xlsx|xls|doc|docx';
        $config['overwrite']      = FALSE;
        $config['file_name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['buktiprog']['name'][$i]));

        $_FILES['f']['name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['buktiprog']['name'][$i]));
        $_FILES['f']['type']      = $_FILES['buktiprog']['type'][$i];
        $_FILES['f']['tmp_name']  = $_FILES['buktiprog']['tmp_name'][$i];
        $_FILES['f']['error']     = $_FILES['buktiprog']['error'][$i];
        $_FILES['f']['size']      = $_FILES['buktiprog']['size'][$i];
        // $ext = pathinfo($path, PATHINFO_EXTENSION);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('f')) {
          echo $this->upload->display_errors();
        } else {
          $data = $this->upload->data();
          $digit = strlen(pathinfo($config['file_name'], PATHINFO_EXTENSION))+1;
          $data_evidence = array(
            'progress_id'     => $this->input->post('idp'),
            'url'             => $config['file_name'],
            'keterangan'      => '',
            'extension'       => pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'uploaded_at'     => date('Y-m-d', time()),
            'uploaded_by'     => $this->session->userdata('useractive_id')
          );
          $this->appModel->evidenceProgressSave($data_evidence);
        }
      }
    }
    $this->session->set_flashdata('notification', "Evidence berhasil diupload!");
    redirect('/progress');
  }

  public function getEvidenceProgressbyID($id) {
    $data = $this->appModel->getEvidenceProgressbyID($id);
    echo json_encode(array($data));
  }

  public function getEvidenceProgressbyIDDokumen($id) {
    $data = $this->appModel->getEvidenceProgressbyIDDokumen($id);
    echo json_encode(array($data));
  }

  public function chart($page = "progress_chart") {
    isLoggedIn();
    $config['title']  = "Progress Graph" . $this->title;
    $config['belumSelesai'] = $this->adminModel->countBlmSelesai();
    $config['sudahSelesai'] = $this->adminModel->countSdhSelesai();
    $config['isbayar'] = $this->adminModel->countisbayar();
    $config['isbayarclient'] = $this->adminModel->countisbayarclient();
    $config['invoiced'] = $this->adminModel->countinvoiced();
    $config['belumsemua'] = $this->adminModel->countbelumsemua();
    $this->loadPage($page, $config);
  }

  public function savecbox() {
    $data = array(
      'is_checked'  => "Y"
    );
    $this->adminModel->saveCBox(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function rmvcbox() {
    $data = array(
      'is_checked'  => "N"
    );
    $this->adminModel->saveCBox(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function h_savecbox() {
    $data = array(
      'is_checked'  => "Y"
    );
    $this->adminModel->saveCBox(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function h_rmvcbox() {
    $data = array(
      'is_checked'  => "N"
    );
    $this->adminModel->saveCBox(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function checkAll() {
    // check all on progress
    $data = array(
      'is_checked'  => "Y"
    );
    $this->adminModel->checkAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function unCheckAll() {
    // check all on progress
    $data = array(
      'is_checked'  => "N"
    );
    $this->adminModel->checkAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function hCheckAll() {
    // check all on progress
    $data = array(
      'is_checked'  => "Y"
    );
    $this->adminModel->hCheckAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function hunCheckAll() {
    // check all on progress
    $data = array(
      'is_checked'  => "N"
    );
    $this->adminModel->hCheckAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function print() {
    $this->adminModel->getProgressPrinting();
  }

  public function printTerpilih() {
    $this->adminModel->getProgressPrintingTerpilih();
  }

  public function h_print() {
    $this->adminModel->h_getProgressPrinting();
  }

  public function h_printTerpilih() {
    $this->adminModel->h_getProgressPrintingTerpilih();
  }

  public function main_document($page = 'progress/document') {
    isLoggedIn();
    $config['title']  = "Progress Evidences | Pengajuan" . $this->title;
    $this->loadPage($page, $config);
  }

  public function main_picture($page = 'progress/picture') {
    isLoggedIn();
    $config['title']  = "Progress Evidences | Pengajuan" . $this->title;
    $this->loadPage($page, $config);
  }

  public function data_doc() {
    $PrDoc_data  = $this->adminModel->getPrDocJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($PrDoc_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = substr($stfd->url, 14);
      $row[]  = $stfd->extension;
      $row[]  = "#ADP".sprintf('%04d', $stfd->progress_id);
      $row[]  = '
                  <a type="button" href="'.base_url('public/assets/evidence/progress/'.$stfd->url).'" download="'.$stfd->url.'" onclick="downloadEvidence('."'".$stfd->id_evidence."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                    <i class="fas fa-download"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->adminModel->countPrDocData(),
      "recordsFiltered" => $this->adminModel->countPrDocDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function data_pic() {
    $TDoc_data  = $this->adminModel->getPrpicJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($TDoc_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = '<img src='.base_url('public/assets/evidence/progress/'.$stfd->url).' width="200">';
      $row[]  = $stfd->keterangan;
      $row[]  = "#ADP".sprintf('%04d', $stfd->progress_id);
      $row[]  = '
                  <a type="button" href="'.base_url('public/assets/evidence/progress/'.$stfd->url).'" download="'.$stfd->url.'" onclick="downloadEvidence('."'".$stfd->id_evidence."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                    <i class="fas fa-download"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->adminModel->countPrpicData(),
      "recordsFiltered" => $this->adminModel->countPrpicDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function historyProgress($id) {
    $this->appModel->historyProgress($id);
  }

  public function getListPekerjaan($id) {
    $this->appModel->getListPekerjaan($id);
  }
}
