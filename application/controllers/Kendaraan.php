<?php

/**
 *
 */
class Kendaraan extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page = 'kendaraan') {
    isLoggedIn();
    $config['title']      = "Vehicles Management" . $this->title;
    // $config['site_list']  = $this->appModel->getSiteData();
    $this->loadPage($page, $config);
  }

  public function data() {
    $staff_data = $this->appModel->getVehiclesJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($staff_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      // $row[]  = $stfd->nama_kendaraan;
      $row[]  = $stfd->plat_kendaraan;
      $row[]  = $stfd->jenis_kendaraan;
      $row[]  = ($stfd->team_id != NULL ? $stfd->team_id : '-');
      $row[]  = '
                  <button type="button" href="" onclick="edit_vehicle('."'".$stfd->kendaraan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#editVehicle">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button type="button" href="" onclick="removeVehicle('."'".$stfd->kendaraan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countVehiclesData(),
      "recordsFiltered" => $this->appModel->countVehiclesDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function save() {
    $data = array(
      'plat_kendaraan'     => $this->input->post('plat_kendaraan'),
      'jenis_kendaraan'    => $this->input->post('jenis_kendaraan')
    );

    $this->appModel->addVehicle($data);
  }

  public function getClusterEditData($id) {
    $data = $this->appModel->getClusterEditbyID($id);
    echo json_encode($data);
  }

}
