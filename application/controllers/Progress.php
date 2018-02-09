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
      'tanggal_mulai'   => $this->input->post('tanggal_mulai'),
      'keterangan'      => $this->input->post('keterangan'),
      'no_corr'         => $this->input->post('no_corr'),
      'no_po'           => $this->input->post('no_po'),
      'tanggal_corr'    => $this->input->post('tanggal_corr'),
      'tanggal_po'      => $this->input->post('tanggal_po'),
      'tanggal_kontrak' => $this->input->post('tanggal_kontrak'),
      'deskripsi'       => $this->input->post('deskripsi'),
      'project_id'      => (
                            $this->input->post('project_id') == "" ?
                              ""
                              :
                              (
                                $this->input->post('project_id') == "new_project" ?
                                $this->appModel->getNewProjectID($this->input->post('nama_project')) :
                                $this->input->post('project_id')
                              )
                            ),
      'site_id'       => (
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
      $row[]  = $no;
      $row[]  = $stfd->nama_project;
      $row[]  = $stfd->id_site;
      $row[]  = ($stfd->tanggal_corr != null ? $stfd->tanggal_corr : '-');
      $row[]  = ($stfd->no_corr != null ? $stfd->no_corr : '-');
      $row[]  = ($stfd->tanggal_po != null ? $stfd->tanggal_po : '-');
      $row[]  = ($stfd->no_po != null ? $stfd->no_po : '-');
      $row[]  = ($stfd->is_bayar != NULL ? date('Y-m-d', strtotime($stfd->is_bayar)) : 'PROGRESS');
      $row[]  = ($stfd->is_bayarclient != NULL ? date('Y-m-d', strtotime($stfd->is_bayarclient)) : 'PROGRESS');
      $row[]  = ($stfd->is_invoiced != NULL ? date('Y-m-d', strtotime($stfd->is_invoiced)) : 'PROGRESS');
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
      'tanggal_corr'      => $this->input->post('tanggal_corr_vale'),
      'no_corr'           => $this->input->post('no_corr_vale'),
      'tanggal_po'        => $this->input->post('tanggal_po_vale'),
      'no_po'             => $this->input->post('no_po_vale'),
      'tanggal_kontrak'   => $this->input->post('tanggal_kontrak_vale'),
      'tanggal_bapp'      => $this->input->post('tanggal_bapp_vale'),
      'no_bapp'           => $this->input->post('no_bapp_vale'),
      'tanggal_bast'      => $this->input->post('tanggal_bast_vale'),
      'no_bast'           => $this->input->post('no_bast_vale'),
      'deskripsi'         => $this->input->post('deskripsi_vale'),
      'is_invoiced'       => ($this->input->post('invoiced_vale') != null ? $this->input->post('invoiced_vale') : NULL),
      'is_bayar'          => ($this->input->post('bayar_vale') != null ? $this->input->post('bayar_vale') : NULL),
      'is_bayarclient'    => ($this->input->post('bayarclient_vale') != null ? $this->input->post('bayarclient_vale') : NULL)
    );
    $insert = $this->appModel->updateProgress(array('progress_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function deleteProgress() {
    $delete_staff = $this->appModel->deleteProgress($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }
}
