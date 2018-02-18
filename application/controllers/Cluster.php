<?php

/**
 *
 */
class Cluster extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page = 'cluster') {
    isLoggedIn();
    $config['title']  = "Cluster Management" . $this->title;
    $config['site_list']          = $this->appModel->getSiteData();
    $this->loadPage($page, $config);
  }

  public function data() {
    $staff_data = $this->appModel->getClusterJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($staff_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = $stfd->homebase;
      $row[]  = $stfd->wilayah;
      $row[]  = $stfd->id_site . " - " . $stfd->nama_site;
      $row[]  = '
                  <button type="button" href="" onclick="edit_cluster('."'".$stfd->cluster_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#editCluster">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button type="button" href="" onclick="removeCluster('."'".$stfd->cluster_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countClusterData(),
      "recordsFiltered" => $this->appModel->countClusterDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
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

    $data = array(
      'homebase'        => $this->input->post('homebase'),
      'wilayah'         => $this->input->post('wilayah'),
      'site_id'         => (
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
    $this->appModel->saveCluster($data);
  }

  public function getClusterEditData($id) {
    $data = $this->appModel->getClusterEditbyID($id);
    echo json_encode($data);
  }

  public function removeCluster() {
    $delete_staff = $this->appModel->removeCluster($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }

  public function update() {
    $data = array(
      'homebase'        => $this->input->post('homebase_e'),
      'wilayah'         => $this->input->post('wilayah_e'),
      'site_id'         => $this->input->post('site_id_e')
    );
    $insert = $this->appModel->updateCluster(array('cluster_id' => $this->input->post('id_e')), $data);
    echo json_encode(array("status" => TRUE));
  }
}
