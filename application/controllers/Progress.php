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

  public function save() {
    if ($this->input->post('project_id')=="new_project") {
      $data_site = array(
        'nama_project'      => $this->input->post('nama_project')
      );
      $this->appModel->projectSave($data_site);
    }

    if ($this->input->post('site_id')=="new_site") {
      $data_site = array(
        'id_site'           => $this->input->post('id_site'),
        'nama_site'         => $this->input->post('nama_site'),
        'lokasi'            => $this->input->post('lokasi_site'),
        'keterangan_site'   => $this->input->post('keterangan_site')
      );
      $this->appModel->siteSave($data_site);
    }

    $data_progress = array(
      'tanggal_mulai'         => ($this->input->post('tanggal_mulai') != "" ? $this->input->post('tanggal_mulai') : NULL),
      'keterangan'            => ($this->input->post('keterangan') != "" ? $this->input->post('keterangan') : NULL),
      'no_corr'               => ($this->input->post('no_corr') != "" ? $this->input->post('no_corr') : NULL),
      'no_po'                 => ($this->input->post('no_po') != "" ? $this->input->post('no_po') : NULL),
      'tanggal_corr'          => ($this->input->post('tanggal_corr') != "" ? $this->input->post('tanggal_corr') : NULL),
      'tanggal_po'            => ($this->input->post('tanggal_po') != "" ? $this->input->post('tanggal_po') : NULL),
      'tanggal_kontrak'       => ($this->input->post('tanggal_kontrak') != "" ? $this->input->post('tanggal_kontrak') : NULL),
      'tanggal_akhir_kontrak' => ($this->input->post('tanggal_akhir_kontrak') != "" ? $this->input->post('tanggal_akhir_kontrak') : NULL),
      'deskripsi'             => ($this->input->post('deskripsi') != "" ? $this->input->post('deskripsi') : NULL),
      'project_id'            => (
                                  $this->input->post('project_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('project_id') == "new_project" ?
                                      $this->appModel->getNewProjectID($this->input->post('nama_project')) :
                                      $this->input->post('project_id')
                                    )
                                  ),
      'site_id'               => (
                                   $this->input->post('site_id') == "" ?
                                     ""
                                     :
                                     (
                                       $this->input->post('site_id') == "new_site" ?
                                       $this->appModel->getNewSiteID($this->input->post('id_site')) :
                                       $this->input->post('site_id')
                                     )
                                  )
    );
    $this->appModel->addProgress($data_progress);
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
      $row[]  = $no;
      $row[]  = $stfd->keterangan;
      $row[]  = $stfd->nama_project;
      $row[]  = $stfd->id_site;
      $row[]  = ($stfd->tanggal_corr != null ? $stfd->tanggal_corr : '-');
      $row[]  = ($stfd->tanggal_po != null ? $stfd->tanggal_po : '-');
      $row[]  = ($stfd->is_invoiced != NULL ? date('Y-m-d', strtotime($stfd->is_invoiced)) : 'PROGRESS');
      $row[]  = ($stfd->is_bayar != NULL ? date('Y-m-d', strtotime($stfd->is_bayar)) : 'PROGRESS');
      $row[]  = ($stfd->is_bayarclient != NULL ? date('Y-m-d', strtotime($stfd->is_bayarclient)) : 'PROGRESS');
      $row[]  = '
                <button type="button" href="" onclick="detailProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailProgress">
                  <i class="fas fa-search"></i>
                </button>
                '.
                  ($stfd->is_bayarclient != NULL ?
                  ''
                  :
                  '<button type="button" href="" onclick="updateProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#updateProgress">
                    UPDATE
                  </button>
                  <button type="button" href="" onclick="uploadBuktiProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#uploadBuktiProgress">
                    <i class="fas fa-upload"></i>
                  </button>
                  <button type="button" href="" onclick="deleteProgress('."'".$stfd->progress_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger" data-toggle="modal" data-target="#deleteProgress">
                    <i class="fas fa-trash"></i>
                  </button>'
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
      'tanggal_corr'            => ($this->input->post('tanggal_corr_vale') != null ? $this->input->post('tanggal_corr_vale') : NULL),
      'no_corr'                 => ($this->input->post('no_corr_vale') != null ? $this->input->post('no_corr_vale') : NULL),
      'tanggal_po'              => ($this->input->post('tanggal_po_vale') != null ? $this->input->post('tanggal_po_vale') : NULL),
      'no_po'                   => ($this->input->post('no_po_vale') != null ? $this->input->post('no_po_vale') : NULL),
      'tanggal_kontrak'         => ($this->input->post('tanggal_kontrak_vale') != null ? $this->input->post('tanggal_kontrak_vale') : NULL),
      'tanggal_akhir_kontrak'   => ($this->input->post('tanggal_akhir_kontrak_vale') != null ? $this->input->post('tanggal_akhir_kontrak_vale') : NULL),
      'tanggal_bapp'            => ($this->input->post('tanggal_bapp_vale') != null ? $this->input->post('tanggal_bapp_vale') : NULL),
      'no_bapp'                 => ($this->input->post('no_bapp_vale') != null ? $this->input->post('no_bapp_vale') : NULL),
      'tanggal_bast'            => ($this->input->post('tanggal_bast_vale') != null ? $this->input->post('tanggal_bast_vale') : NULL),
      'no_bast'                 => ($this->input->post('no_bast_vale') != null ? $this->input->post('no_bast_vale') : NULL),
      'deskripsi'               => ($this->input->post('deskripsi_vale') != null ? $this->input->post('deskripsi_vale') : NULL),
      'is_invoiced'             => ($this->input->post('invoiced_vale') != null ? $this->input->post('invoiced_vale') : NULL),
      'is_bayar'                => ($this->input->post('bayar_vale') != null ? $this->input->post('bayar_vale') : NULL),
      'is_bayarclient'          => ($this->input->post('bayarclient_vale') != null ? $this->input->post('bayarclient_vale') : NULL)
    );
    $insert = $this->appModel->updateProgress(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function deleteProgress() {
    $delete_staff = $this->appModel->deleteProgress($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }

  public function saveEvidence() {
    if ($_FILES['bukti']['name']['0'] != "") {
      $filesCount = count($_FILES['bukti']['name']);

      for ($i=0; $i < $filesCount; $i++) {
        unset($config);
        $config = array();
        $config['upload_path']    = './public/assets/evidence/progress/';
        $config['allowed_types']  = 'jpg|jpeg|png|pdf|xlsx|xls|doc|docx';
        $config['overwrite']      = FALSE;
        $config['file_name']      = str_replace(' ', '_', date('YmdHis', time()) . $_FILES['bukti']['name'][$i]);

        $_FILES['f']['name']      = str_replace(' ', '_', date('YmdHis', time()) . $_FILES['bukti']['name'][$i]);
        $_FILES['f']['type']      = $_FILES['bukti']['type'][$i];
        $_FILES['f']['tmp_name']  = $_FILES['bukti']['tmp_name'][$i];
        $_FILES['f']['error']     = $_FILES['bukti']['error'][$i];
        $_FILES['f']['size']      = $_FILES['bukti']['size'][$i];
        // $ext = pathinfo($path, PATHINFO_EXTENSION);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('f')) {
          echo $this->upload->display_errors();
        } else {
          $data = $this->upload->data();
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

      // echo "sukses";
    }
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
}
