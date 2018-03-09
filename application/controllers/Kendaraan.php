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
      $row[]  = $stfd->jenis_kendaraan;
      $row[]  = $stfd->tipe_kendaraan;
      $row[]  = $stfd->plat_kendaraan;
      $row[]  = ($stfd->tgl_pajak != NULL ? date('Y-m-d', strtotime($stfd->tgl_pajak)) : '-');
      $row[]  = ($stfd->tgl_stnk != NULL ? date('Y-m-d', strtotime($stfd->tgl_stnk)) : '-');
      $row[]  = ($stfd->tgl_service != NULL ? date('Y-m-d', strtotime($stfd->tgl_service)) : '-');
      // $row[]  = ($stfd->team_id != NULL ? $stfd->team_id : '-');
      $row[]  = '
                  <button type="button" href="" onclick="edit_vehicle('."'".$stfd->kendaraan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#editVehicle">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button type="button" href="" onclick="service('."'".$stfd->kendaraan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#service">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <!--<button type="button" href="" onclick="removeVehicle('."'".$stfd->kendaraan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>-->
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
      'plat_kendaraan'      => ($this->input->post('plat_kendaraan') != "" ? $this->input->post('plat_kendaraan') : NULL),
      'jenis_kendaraan'     => ($this->input->post('jenis_kendaraan') != "" ? $this->input->post('jenis_kendaraan') : NULL),
      'tipe_kendaraan'      => ($this->input->post('tipe_kendaraan') != "" ? $this->input->post('tipe_kendaraan') : NULL),
      'tgl_pajak'           => ($this->input->post('tgl_pajak') != "" ? $this->input->post('tgl_pajak') : NULL),
      'tgl_stnk'            => ($this->input->post('tgl_stnk') != "" ? $this->input->post('tgl_stnk') : NULL),
      'masa_kir'            => ($this->input->post('masa_kir') != "" ? $this->input->post('masa_kir') : NULL),
      'km_akhir'            => ($this->input->post('km_akhir') != "" ? $this->input->post('km_akhir') : NULL),
      'tgl_pajak'           => ($this->input->post('tgl_pajak') != "" ? $this->input->post('tgl_pajak') : NULL),
      'tgl_stnk'            => ($this->input->post('tgl_stnk') != "" ? $this->input->post('tgl_stnk') : NULL),
      'tgl_service'         => ($this->input->post('tgl_service') != "" ? $this->input->post('tgl_service') : NULL),
      'plat_kendaraan'      => ($this->input->post('plat_kendaraan') != "" ? $this->input->post('plat_kendaraan') : NULL),
      'keterangan'          => $this->input->post('keterangan')
    );

    $this->appModel->addVehicle($data);
  }

  public function getClusterEditData($id) {
    $data = $this->appModel->getClusterEditbyID($id);
    echo json_encode($data);
  }

  public function getVehiclesData($id) {
    $data = $this->appModel->getVehicleEditbyID($id);
    echo json_encode($data);
  }

  public function update() {
    $data = array(
      'plat_kendaraan'    => ($this->input->post('plat_kendaraan_e') != "" ? $this->input->post('plat_kendaraan_e') : NULL),
      'jenis_kendaraan'   => ($this->input->post('jenis_kendaraan_e') != "" ? $this->input->post('jenis_kendaraan_e') : NULL),
      'tipe_kendaraan'    => ($this->input->post('tipe_kendaraan_e') != "" ? $this->input->post('tipe_kendaraan_e') : NULL),
      'tgl_pajak'         => ($this->input->post('tgl_pajak_e') != "" ? $this->input->post('tgl_pajak_e') : NULL),
      'tgl_stnk'          => ($this->input->post('tgl_stnk_e') != "" ? $this->input->post('tgl_stnk_e') : NULL),
      'masa_kir'          => ($this->input->post('masa_kir_e') != "" ? $this->input->post('masa_kir_e') : NULL),
      'km_akhir'          => ($this->input->post('km_akhir_e') != "" ? $this->input->post('km_akhir_e') : NULL),
      'tgl_pajak'         => ($this->input->post('tgl_pajak_e') != "" ? $this->input->post('tgl_pajak_e') : NULL),
      'tgl_stnk'          => ($this->input->post('tgl_stnk_e') != "" ? $this->input->post('tgl_stnk_e') : NULL),
      'tgl_service'       => ($this->input->post('tgl_service_e') != "" ? $this->input->post('tgl_service_e') : NULL),
      'plat_kendaraan'    => ($this->input->post('plat_kendaraan_e') != "" ? $this->input->post('plat_kendaraan_e') : NULL),
      'keterangan'        => ($this->input->post('keterangan_e') != "" ? $this->input->post('keterangan_e') : NULL)
    );
    $insert = $this->appModel->updateKendaraan(array('kendaraan_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

}
