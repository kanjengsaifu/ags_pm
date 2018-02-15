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
            'url'             => $config['file_name'],
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
                                      $this->appModel->getNewSiteID($this->input->post('id_site')) :
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
                                      $this->appModel->getNewSiteID($this->input->post('id_site')) :
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
        $row[]  = (
                    $stfd->is_printed == "N" ?
                    '<input type="checkbox" disabled readonly>' :
                    ($stfd->tanggal_approval_keuangan != NULL ?
                      '<input type="checkbox" disabled readonly>' :
                      ($stfd->is_checked == "Y" ?
                        '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="rmvCBox('.$stfd->pengajuan_id.')" checked>'
                        :
                        '<input type="checkbox" name="checked[]" value="'.$stfd->pengajuan_id.'" onclick="saveCBox('.$stfd->pengajuan_id.')">'
                      )
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
      $row[]  = "#ADP".sprintf('%04d', $stfd->pengajuan_id);
      $row[]  = $stfd->pengajuan;
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
                  <button type="button" href="" onclick="detailPengajuan('."'".$stfd->pengajuan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailPengajuan">
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

  public function checkall() {
    $data = array(
      'is_checked' => "Y"
    );
    $this->appModel->checkAll(array('is_printed' => "N"), $data);
    echo json_encode(array("status" => TRUE));
  }

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
}
