<?php

/**
 *
 */
class Submission extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page = 'submission') {
    isLoggedIn();
    $config['title']  = "Pengajuan" . $this->title;
    $config['kategori_pengajuan'] = $this->appModel->getEnumKategoriPengajuan();
    $config['site_list']          = $this->appModel->getSiteData();
    $config['project_list']       = $this->appModel->getProjectData();
    $config['getPengajuUser']     = $this->appModel->getPengajuUser();
    $this->loadPage($page, $config);
  }

  public function save() {
    if ($_FILES['bukti']['name']['0'] != "") {
      $filesCount = count($_FILES['bukti']['name']);

      for ($i=0; $i < $filesCount; $i++) {
        unset($config);
        $config = array();
        $config['upload_path']    = './public/assets/evidence/';
        $config['allowed_types']  = 'jpg|jpeg|png|pdf|xlsx|xls|doc|docx';
        $config['overwrite']      = FALSE;
        $config['file_name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['bukti']['name'][$i]));

        $_FILES['f']['name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['bukti']['name'][$i]));
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
          $digit = strlen(pathinfo($config['file_name'], PATHINFO_EXTENSION))+1;
          $data_evidence = array(
            'url'             => str_replace('.', '_', substr($config['file_name'], 0, -$digit)).'.'.pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'keterangan'      => '',
            'extension'       => pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'uploaded_at'     => date('Y-m-d', time()),
            'uploaded_by'     => $this->session->userdata('useractive_id')
          );
          $this->appModel->evidenceSave($data_evidence);
        }
      }

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

      if ($this->input->post('project_id')=="new_project") {
        $data_site = array(
          'nama_project'      => $this->input->post('nama_project')
        );
        $this->appModel->projectSave($data_site);
      }

      $data_pengajuan = array(
        'pengajuan'           => $this->input->post('pengajuan'),
        'realisasi_pengajuan' => date('Y-m-d', strtotime($this->input->post('realisasi_pengajuan'))),
        'jenis_pengajuan'     => $this->input->post('jenis_pengajuan'),
        'nama_project'        => (
                                  $this->input->post('project_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('project_id') == "new_project" ?
                                      $this->input->post('nama_project') :
                                      $this->appModel->getNamaProject($this->input->post('project_id'))
                                    )
                                 ),
        'nilai_sph'           => $this->input->post('nilai_sph'),
        'nilai_corr'          => $this->input->post('nilai_corr'),
        'nilai_po'            => $this->input->post('nilai_po'),
        'nilai_pengajuan'     => $this->input->post('nilai_pengajuan'),
        'no_sph'              => $this->input->post('no_sph'),
        'no_corr'             => $this->input->post('no_corr'),
        'no_po'               => $this->input->post('no_po'),
        'no_spk'              => $this->input->post('no_spk'),
        'start_penawaran_dmt' => ($this->input->post('start_penawaran_dmt') == "" ? NULL : date('Y-m-d', strtotime($this->input->post('start_penawaran_dmt')))),
        'keterangan'          => $this->input->post('keterangan'),
        'pengaju_id'          => $this->session->userdata('useractive_id'),
        'evidence_id'         => $this->appModel->getEvidence($filesCount),
        'project_id'          => (
                                  $this->input->post('project_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('project_id') == "new_project" ?
                                      $this->appModel->getNewProjectID($this->input->post('nama_project')) :
                                      $this->input->post('project_id')
                                    )
                                 ),
        'site_id'             => (
                                  $this->input->post('site_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('site_id') == "new_site" ?
                                      $this->appModel->getNewSiteID($this->input->post('id_site'), $this->input->post('id_site_telkom'), $this->input->post('nama_site')) :
                                      $this->input->post('site_id')
                                    )
                                 ),
        'tanggal_approval'    => (isApproval() ? date('Y-m-d', time()) : NULL),
        'approved_by'         => (isApproval() ? $this->session->userdata('useractive_id') : NULL)
      );
      $this->appModel->subSave($data_pengajuan);
      echo "sukses";
    } else {

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

      if ($this->input->post('project_id')=="new_project") {
        $data_site = array(
          'nama_project'      => $this->input->post('nama_project')
        );
        $this->appModel->projectSave($data_site);
      }

      $data = array(
        'pengajuan'           => $this->input->post('pengajuan'),
        'realisasi_pengajuan' => date('Y-m-d', strtotime($this->input->post('realisasi_pengajuan'))),
        'jenis_pengajuan'     => $this->input->post('jenis_pengajuan'),
        'nama_project'        => (
                                  $this->input->post('project_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('project_id') == "new_project" ?
                                      $this->input->post('nama_project') :
                                      $this->appModel->getNamaProject($this->input->post('project_id'))
                                    )
                                 ),
        'nilai_sph'           => $this->input->post('nilai_sph'),
        'nilai_corr'          => $this->input->post('nilai_corr'),
        'nilai_po'            => $this->input->post('nilai_po'),
        'nilai_pengajuan'     => $this->input->post('nilai_pengajuan'),
        'no_sph'              => $this->input->post('no_sph'),
        'no_corr'             => $this->input->post('no_corr'),
        'no_po'               => $this->input->post('no_po'),
        'no_spk'              => $this->input->post('no_spk'),
        'start_penawaran_dmt' => ($this->input->post('start_penawaran_dmt') == "" ? NULL : date('Y-m-d', strtotime($this->input->post('start_penawaran_dmt')))),
        'keterangan'          => $this->input->post('keterangan'),
        'pengaju_id'          => $this->session->userdata('useractive_id'),
        'project_id'          => (
                                  $this->input->post('project_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('project_id') == "new_project" ?
                                      $this->appModel->getNewProjectID($this->input->post('nama_project')) :
                                      $this->input->post('project_id')
                                    )
                                 ),
        'site_id'             => (
                                  $this->input->post('site_id') == "" ?
                                    ""
                                    :
                                    (
                                      $this->input->post('site_id') == "new_site" ?
                                      $this->appModel->getNewSiteID($this->input->post('id_site'), $this->input->post('id_site_telkom'), $this->input->post('nama_site')) :
                                      $this->input->post('site_id')
                                    )
                                 ),
        'tanggal_approval'    => (isApproval() ? date('Y-m-d', time()) : NULL),
        'approved_by'         => (isApproval() ? $this->session->userdata('useractive_id') : NULL)
      );

      $insert = $this->appModel->subSave($data);
    }
  }

  public function subSave() {
    $this->appModel->getNewSiteID('TSK003');
  }

  public function data() {
    $team_data  = $this->appModel->getSubJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($team_data as $stfd) {
      $no++;
      $row = array();
      if (isAdminJakarta()) {
        $row[]  = ($stfd->tanggal_approval_keuangan != NULL ?
                    ($stfd->is_printed != "N" ?
                      ($stfd->is_checked_h == "Y" ?
                        '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="h_rmvCBox('.$stfd->pengajuan_id.')" checked>'
                        :
                        '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="h_saveCBox('.$stfd->pengajuan_id.')">'
                      ) : ''
                    )
                    :
                    ($stfd->is_printed != "N" ?
                      ($stfd->is_checked == "Y" ?
                        '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="rmvCBox('.$stfd->pengajuan_id.')" checked>'
                        :
                        '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="saveCBox('.$stfd->pengajuan_id.')">'
                      ) : ''
                    )
                  );
      } else if (isApproval()) {
        $row[]  = ($stfd->tanggal_approval != NULL ?
                    '<input type="checkbox" disabled readonly>' :
                    ($stfd->is_checked == "Y" ?
                      '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="rmvCBox('.$stfd->pengajuan_id.')" checked>'
                      :
                      '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="saveCBox('.$stfd->pengajuan_id.')">'
                    )
                  );
      }
      $row[]  = $no;
      $row[]  = $stfd->pengajuan;
      $row[]  = date('l, d-m-Y', strtotime($stfd->tanggal_pengajuan));
      if (isApproval()) {
        $row[]  = ($stfd->nama_project != "" ? $stfd->nama_project : "-");
      }
      // $row[]  = date('l, d-m-Y H:m:s', strtotime($stfd->tanggal_pengajuan));
      if (!(isAdminJakarta() || isApproval())) {
        $row[]  = ($stfd->tanggal_approval != "" ? date('l, d-m-Y', strtotime($stfd->tanggal_approval)) : "<span class=\"btn btn-outline-danger\">BELUM DIAPPROVE</span>");
        $row[]  = ($stfd->status_admin_dmt != "" ?
                    ($stfd->tanggal_approval_keuangan != "" ? date('l, d-m-Y', strtotime($stfd->tanggal_approval_keuangan)) : "<span class=\"btn btn-outline-danger\">ON PROGRESS</span>")
                    :
                    "<span class=\"btn btn-outline-danger\">". (!isAdminJakarta() ? 'PENDING' : 'BELUM DI PRINT') ."</span>"
                  );
      }
      $row[]  = ($stfd->realisasi_pengajuan <= date('Y-m-d') ?
                  '<span class="btn btn-outline-danger">'.date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan)).'</span>'
                  :
                  date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan))
                );
      // $row[]  = ($stfd->is_invoiced == "N" ? "&#x2714" : '');
      // $row[]  = ($stfd->is_bayar == "N" ? "&#x2714" : '');
      // $row[]  = ($stfd->is_bayarclient == "N" ? "&#x2714" : '');
      $row[]  = '
                  <button type="button" href="" id="detailPengajuan" onclick="detailPengajuan('."'".$stfd->pengajuan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailPengajuan">
                    <i class="fas fa-search"></i>
                  </button>
                  '.
                    (isApproval() || isAdministrator() ?
                      ($stfd->tanggal_approval != null ?
                        '

                        '
                        :
                        '
                          <a href="#" onclick="accPengajuan('."'".$stfd->pengajuan_id."'".')" class="text-center btn cur-p btn-outline-success">APPROVE</a>
                        '
                      ) : ''
                    )
                  .'
                  '.
                    (isAdminJakarta() || isAdministrator() ?
                      ($stfd->is_printed == "Y" ?
                        ($stfd->tanggal_approval_keuangan != NULL ?
                          '<button onclick="reset_cam('."'".$stfd->pengajuan_id."'".')" type="button" href="" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#captureEvidence">
                            <i class="fa fa-camera"></i>
                          </button>' :
                          ($stfd->is_printed == "Y" ?
                            '<button type="button" href="" onclick="'. ($stfd->nama_project != "" ? 'accBos('."'".$stfd->pengajuan_id."'".')' : 'accLangsung('."'".$stfd->pengajuan_id."'".')') .'" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                              ACC
                            </button>' : ''
                          )
                        ) : ''
                      ) : ''
                    )
                  .'
                  '.
                    (isAdminTasik() ?
                      '
                      <button type="button" href="" onclick="uploadBukti('."'".$stfd->pengajuan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#uploadBukti">
                        <i class="fas fa-upload"></i>
                      </button> '.
                      ($stfd->tanggal_approval_keuangan != NULL ?
                        '<button onclick="reset_cam('."'".$stfd->pengajuan_id."'".')" type="button" href="" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#captureEvidence">
                          <i class="fa fa-camera"></i>
                        </button>
                        <button type="button" href="" onclick="uploadBuktiTransaksi('."'".$stfd->pengajuan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#uploadBuktiTransaksi">
                          <i class="fas fa-paperclip"></i>
                        </button>' : ''
                      ) : ''
                    )
                  .'
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countSubData(),
      "recordsFiltered" => $this->appModel->countSubDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function getPengajuanDetail($id) {
    $data = $this->appModel->getPengajuanByID($id);
    echo json_encode($data);
  }

  public function getEvidencebyID($id) {
    $data = $this->appModel->getEvidencebyID($id);
    echo json_encode(array($data));
  }

  public function getEvidenceSusulanbyID($id) {
    $data = $this->appModel->getEvidenceSusulanbyID($id);
    echo json_encode(array($data));
  }

  public function getEvidenceSusulanbyIDDokumen($id) {
    $data = $this->appModel->getEvidenceSusulanbyIDDokumen($id);
    echo json_encode(array($data));
  }

  public function getEvidencebyIDDokumen($id) {
    $data = $this->appModel->getEvidencebyIDDokumen($id);
    echo json_encode(array($data));
  }

  public function approve() {
    $data = array(
      'tanggal_approval'  => date('Y-m-d', time()),
      'approved_by'      => $this->session->userdata('useractive_id')
    );
    $insert = $this->appModel->accPengajuan(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function acc_edwin() {
    $data = array(
      'tanggal_approval_keuangan'  => date('Y-m-d', time())
    );
    $insert = $this->appModel->accPengajuan(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function acc_langsung() {
    $data = array(
      'tanggal_approval_keuangan'  => date('Y-m-d', time()),
      'is_invoiced'                => 'Y',
      'is_bayar'                   => 'Y',
      'is_bayarclient'             => 'Y'
    );
    $insert = $this->appModel->accPengajuan(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function printed() {
    $this->appModel->getSubPrinting();
  }

  public function reprinted() {
    $this->appModel->getReSubPrinting();
  }

  public function printTerpilih() {
    $this->appModel->getSubPrintingTerpilih();
  }

  public function update() {
    $data = array(
      'tanggal_approval_keuangan'     => $this->input->post('done'),
      'is_invoiced'                   => ($this->input->post('invoiced') == 'Y' ? $this->input->post('invoiced') : 'N'),
      'is_bayar'                      => ($this->input->post('bayar') == 'Y' ? $this->input->post('bayar') : 'N'),
      'is_bayarclient'                => ($this->input->post('bayarclient') == 'Y' ? $this->input->post('bayarclient') : 'N')
    );
    $insert = $this->appModel->updateProgress(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function savecbox() {
    $data = array(
      'is_checked'  => "Y"
    );
    $this->appModel->saveCBox(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function rmvcbox() {
    $data = array(
      'is_checked'  => "N"
    );
    $this->appModel->saveCBox(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function h_savecbox() {
    $data = array(
      'is_checked_h'  => "Y"
    );
    $this->appModel->saveCBox(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function h_rmvcbox() {
    $data = array(
      'is_checked_h'  => "N"
    );
    $this->appModel->saveCBox(array('pengajuan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  // public function checkall() {
  //   $data = array(
  //     'is_checked' => "Y"
  //   );
  //   $this->appModel->checkAll(array('is_printed' => "N"), $data);
  //   echo json_encode(array("status" => TRUE));
  // }

  public function rmvcheckall() {
    $data = array(
      'is_checked' => "N"
    );
    $this->appModel->checkAll(array('is_printed' => "N"), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function accTerpilih() {
    $data = array(
      'tanggal_approval_keuangan' => date('Y-m-d', time())
    );
    $this->appModel->accTerpilih(array('is_checked' => "Y"), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function approveAll() {
    $data = array(
      'tanggal_approval'  => date('Y-m-d', time())
    );
    $this->appModel->approveAll(array('tanggal_approval' => NULL), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function approveTerpilih() {
    $data = array(
      'tanggal_approval' => date('Y-m-d', time()),
      'is_checked'       => 'N',
      'approved_by'      => $this->session->userdata('useractive_id')
    );
    $this->appModel->approveTerpilih(array('is_checked' => 'Y', 'tanggal_approval' => NULL), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function updateNilaiPengajuan($id) {
    // echo $this->input->post('np');
    $data = array(
      'nilai_pengajuan' => $this->input->post('np')
    );
    $this->appModel->updateNilaiPengajuan(array('pengajuan_id' => $id), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function capture($id) {
    $filename = 'pic_'.date('YmdHis') . '.jpeg';

    $url = '';
    if( move_uploaded_file($_FILES['webcam']['tmp_name'], './public/assets/evidence/transaksi/'.$filename) ){
     $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['REQUEST_URI']) . '/upload/' . $filename;
    }

    $data = array(
      'pengajuan_id'    => $id,
      'url'             => $filename,
      'keterangan'      => '',
      'extension'       => pathinfo($filename, PATHINFO_EXTENSION),
      'uploaded_at'     => date('Y-m-d', time()),
      'uploaded_by'     => $this->session->userdata('useractive_id')
    );
    $this->appModel->uploadEvidenceTransaksi($data);
  }

  public function getEvidenceTransaksi($id) {
    $data = $this->appModel->getEvidenceTransaksi($id);
    echo json_encode(array($data));
  }

  public function main_document($page = 'submission/document') {
    isLoggedIn();
    $config['title']  = "Document Evidence | Pengajuan" . $this->title;
    $this->loadPage($page, $config);
  }

  public function main_picture($page = 'submission/picture') {
    isLoggedIn();
    $config['title']  = "Picture Evidence | Pengajuan" . $this->title;
    $this->loadPage($page, $config);
  }

  public function data_doc() {
    $pdoc_data  = $this->appModel->getPDocJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($pdoc_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = substr($stfd->url, 14);
      $row[]  = $stfd->extension;
      $row[]  = "#ADP".sprintf('%04d', $stfd->pengajuan_id);
      $row[]  = '
                  <a type="button" href="'.base_url('public/assets/evidence/'.$stfd->url).'" download="'.$stfd->url.'" onclick="downloadEvidence('."'".$stfd->id_evidence."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                    <i class="fas fa-download"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countPDocData(),
      "recordsFiltered" => $this->appModel->countPDocDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function data_pic() {
    $TDoc_data  = $this->appModel->getSPicJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($TDoc_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = '<img src='.base_url('public/assets/evidence/'.$stfd->url).' width="200">';
      $row[]  = $stfd->pengajuan;
      $row[]  = "#ADP".sprintf('%04d', $stfd->pengajuan_id);
      $row[]  = '
                  <a type="button" href="'.base_url('public/assets/evidence/'.$stfd->url).'" download="'.$stfd->url.'" onclick="downloadEvidence('."'".$stfd->id_evidence."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                    <i class="fas fa-download"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countSPicData(),
      "recordsFiltered" => $this->appModel->countSPicDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function printBukti($id) {
    $this->appModel->printEvidences($id);
  }

  public function printBuktiSusulan($id) {
    $this->appModel->printEvidencesSusulan($id);
  }

  public function printEvidencesBoth($id) {
    $this->appModel->printEvidencesBoth($id);
  }

  public function checkAll() {
    // check all on progress
    $data = array(
      'is_checked'  => "Y"
    );
    $this->appModel->checkAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function unCheckAll() {
    // check all on progress
    $data = array(
      'is_checked'  => "N"
    );
    $this->appModel->checkAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function hCheckAll() {
    // check all on progress
    $data = array(
      'is_checked_h'  => "Y"
    );
    $this->appModel->checkAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function hunCheckAll() {
    // check all on progress
    $data = array(
      'is_checked_h'  => "N"
    );
    $this->appModel->checkAll($data);
    echo json_encode(array("status" => TRUE));
  }

  public function getImages($id) {
    $this->appModel->getImages($id);
  }

  public function printEvidences() {
    $this->appModel->printEvidencesSekaligus();
  }

  public function saveEvidence() {
    // echo count($_FILES['buktisusulan']['name']);
    if ($_FILES['buktisusulan']['name']['0'] != "") {
      $filesCount = count($_FILES['buktisusulan']['name']);

      for ($i=0; $i < $filesCount; $i++) {
        unset($config);
        $config = array();
        $config['upload_path']    = './public/assets/evidence/';
        $config['allowed_types']  = 'jpg|jpeg|png|pdf|xlsx|xls|doc|docx';
        $config['overwrite']      = FALSE;
        $config['file_name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['buktisusulan']['name'][$i]));

        $_FILES['f']['name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['buktisusulan']['name'][$i]));
        $_FILES['f']['type']      = $_FILES['buktisusulan']['type'][$i];
        $_FILES['f']['tmp_name']  = $_FILES['buktisusulan']['tmp_name'][$i];
        $_FILES['f']['error']     = $_FILES['buktisusulan']['error'][$i];
        $_FILES['f']['size']      = $_FILES['buktisusulan']['size'][$i];
        // $ext = pathinfo($path, PATHINFO_EXTENSION);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('f')) {
          echo $this->upload->display_errors();
        } else {
          $data = $this->upload->data();
          $digit = strlen(pathinfo($config['file_name'], PATHINFO_EXTENSION))+1;
          $data_evidence = array(
            'pengajuan_id'    => $this->input->post('idp'),
            'url'             => str_replace('.', '_', substr($config['file_name'], 0, -$digit)).'.'.pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'keterangan'      => '',
            'extension'       => pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'uploaded_at'     => date('Y-m-d', time()),
            'uploaded_by'     => $this->session->userdata('useractive_id')
          );
          $this->appModel->evidencePengajuanSave($data_evidence);
        }
      }
      $this->session->set_flashdata('notification', "Evidence berhasil diupload!");
      redirect('/submission');
    }
  }

  public function saveTransaksi() {
    if ($_FILES['buktitransaksi']['name']['0'] != "") {
      $filesCount = count($_FILES['buktitransaksi']['name']);

      for ($i=0; $i < $filesCount; $i++) {
        unset($config);
        $config = array();
        $config['upload_path']    = './public/assets/evidence/transaksi/';
        $config['allowed_types']  = 'jpg|jpeg|png';
        $config['overwrite']      = FALSE;
        $config['file_name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['buktitransaksi']['name'][$i]));

        $_FILES['f']['name']      = str_replace(" ", "_", date('YmdHis', time()) . trim($_FILES['buktitransaksi']['name'][$i]));
        $_FILES['f']['type']      = $_FILES['buktitransaksi']['type'][$i];
        $_FILES['f']['tmp_name']  = $_FILES['buktitransaksi']['tmp_name'][$i];
        $_FILES['f']['error']     = $_FILES['buktitransaksi']['error'][$i];
        $_FILES['f']['size']      = $_FILES['buktitransaksi']['size'][$i];
        // $ext = pathinfo($path, PATHINFO_EXTENSION);

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('f')) {
          echo $this->upload->display_errors();
        } else {
          $data = $this->upload->data();
          $digit = strlen(pathinfo($config['file_name'], PATHINFO_EXTENSION))+1;
          $data_evidence = array(
            'pengajuan_id'    => $this->input->post('idp'),
            'url'             => str_replace('.', '_', substr($config['file_name'], 0, -$digit)).'.'.pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'keterangan'      => '',
            'extension'       => pathinfo($config['file_name'], PATHINFO_EXTENSION),
            'uploaded_at'     => date('Y-m-d', time()),
            'uploaded_by'     => $this->session->userdata('useractive_id')
          );
          $this->appModel->transaksiPengajuanSave($data_evidence);
        }
      }
      $this->session->set_flashdata('notification', "Bukti transaksi berhasil diupload!");
      redirect('/submission');

      // echo "sukses";
    }
  }

  public function getApprovalName($id) {
    $data = $this->appModel->getApprovalName($id);
    echo json_encode($data);
  }

  public function main_report($page = 'submission_report') {
    isLoggedIn();
    $config['title']  = "Monitor Pengajuan" . $this->title;
    if (isViewer() || $this->session->userdata('username') == "stadmaresi") {
      $config['kategori_pengajuan'] = $this->appModel->getEnumKategoriPengajuan();
      $config['getPengajuUser']     = $this->appModel->getPengajuUser();
    }
    $config['totalpengajuan'] = $this->appModel->totalPengajuan();
    $config['pengajuanterhold'] = $this->appModel->pengajuanTerhold();
    $config['belumSelesai'] = $this->adminModel->countBlmSelesai();
    $config['sudahSelesai'] = $this->adminModel->countSdhSelesai();
    $config['isbayar'] = $this->adminModel->countisbayar();
    $config['isbayarclient'] = $this->adminModel->countisbayarclient();
    $config['invoiced'] = $this->adminModel->countinvoiced();
    $config['belumsemua'] = $this->adminModel->countbelumsemua();
    $config['sudahdiapprove'] = $this->adminModel->countsudahdiapprove();
    $config['belumdiapprove'] = $this->adminModel->countbelumdiapprove();
    $config['kategori_pengajuan'] = $this->appModel->getEnumKategoriPengajuan();
    $config['site_list']          = $this->appModel->getSiteData();
    $config['project_list']       = $this->appModel->getProjectDataforProgress();
    $config['totalprogress']      = $this->appModel->totalprogress();
    $config['progressbelumselesai'] = $this->appModel->progressBelumSelesai();
    $config['progresssudahselesai'] = $this->appModel->progressSudahSelesai();
    $this->loadPage($page, $config);
  }
}
