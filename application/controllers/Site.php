<?php

/**
 *
 */
class Site extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page = 'site') {
    isLoggedIn();
    $config['title']  = "Site Management" . $this->title;
    $this->loadPage($page, $config);
  }

  public function data() {
    $site_data  = $this->appModel->getSiteJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($site_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = $stfd->id_site;
      $row[]  = $stfd->nama_site;
      $row[]  = $stfd->lokasi;
      $row[]  = ($stfd->keterangan_site != "" ? $stfd->keterangan_site : "-");
      $row[]  = '
                  <button type="button" href="" onclick="edit_site('."'".$stfd->site_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#editSite">
                    <i class="fas fa-edit"></i>
                  </button>
                  <!--<button type="button" href="" onclick="removeSite('."'".$stfd->site_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>-->
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countSiteData(),
      "recordsFiltered" => $this->appModel->countSiteDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function save() {
    $data = array(
      'id_site'         => $this->input->post('id_site'),
      'id_site_telkom'  => $this->input->post('id_site_telkom'),
      'nama_site'       => $this->input->post('nama_site'),
      'lokasi'          => $this->input->post('lokasi'),
      'keterangan_site' => $this->input->post('keterangan')
    );
    $this->appModel->saveSite($data);
  }

  public function getSiteEditData($id) {
    $data = $this->appModel->getSiteEditbyID($id);
    echo json_encode($data);
  }

  public function update() {
    $data = array(
      'id_site'         => $this->input->post('id_site_e'),
      'id_site_telkom'  => $this->input->post('id_site_telkom_e'),
      'nama_site'       => $this->input->post('nama_site_e'),
      'lokasi'          => $this->input->post('lokasi_e'),
      'keterangan_site' => $this->input->post('keterangan_site_e')
    );
    $insert = $this->appModel->updateSite(array('site_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function removeSite() {
    $delete_staff = $this->appModel->removeSite($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }
}
