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

  public function getClusterEditData($id) {
    $data = $this->appModel->getClusterEditbyID($id);
    echo json_encode($data);
  }
}
