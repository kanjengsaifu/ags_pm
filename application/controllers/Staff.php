<?php

/**
 *
 */
class Staff extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page='staff') {
    isLoggedIn();
    $config['title']  = "Staff Management" . $this->title;
    $config['staffData']   = $this->appModel->staffData();
    $config['team_list']   = $this->appModel->teamData();
    $this->loadPage($page, $config);
  }

  public function awdawd() {
    $this->appModel->teamData();
  }

  public function save() {
    $name                         = $this->input->post('nama');
    $telp                         = $this->input->post('telp');
    $posisi                       = $this->input->post('posisi');
    $dob                          = ($this->input->post('dob') != "" ? $this->input->post('dob') : NULL);
    $alamat                       = $this->input->post('alamat');
    $keterangan                   = $this->input->post('keterangan');
    $keluarga_yg_bisa_dihub       = $this->input->post('keluarga_yg_bisa_dihub');
    $telp_keluarga_yg_bisa_dihub  = $this->input->post('telp_keluarga_yg_bisa_dihub');

    $this->appModel->addStaff($name, $telp, $posisi, $dob, $alamat, $keterangan, $keluarga_yg_bisa_dihub, $telp_keluarga_yg_bisa_dihub);
  }

  // public function save() {
  //   $data = array(
  //     'nama'                         => $this->input->post('nama'),
  //     'telp'                         => $this->input->post('telp'),
  //     'posisi'                       => $this->input->post('posisi'),
  //     'dob'                          => $this->input->post('dob'),
  //     'alamat'                       => $this->input->post('alamat'),
  //     'keterangan'                   => $this->input->post('keterangan'),
  //     'keluarga_yg_bisa_dihub'       => $this->input->post('keluarga_yg_bisa_dihub'),
  //     'telp_keluarga_yg_bisa_dihub'  => $this->input->post('telp_keluarga_yg_bisa_dihub')
  //   );
  //   $insert = $this->appModel->addStaff($data);
  //   echo json_encode(array("status" => TRUE));
  // }

  public function data() {
    $staff_data = $this->appModel->getStaffJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($staff_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = $stfd->nama;
      $row[]  = $stfd->posisi;
      $row[]  = ' <button type="button" href="" onclick="viewStaffDetail('."'".$stfd->staff_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailStaff">
                    <i class="fas fa-search"></i>
                  </button>
                  '.
                    ($stfd->team_id != "" ?
                      '<button type="button" href="" onclick="change_toteam('."'".$stfd->staff_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#changeTeam">
                        CHANGE TEAM
                      </button>'
                      :
                      '<button type="button" href="" onclick="add_toteam('."'".$stfd->staff_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#addToTeam">
                        ADD TO  TEAM
                      </button>'
                    )
                  .'
                  <button type="button" href="" onclick="edit_staff('."'".$stfd->staff_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#editStaff">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button type="button" href="" onclick="removeStaff('."'".$stfd->staff_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                  <!--<a href="'.site_url('staff/removeStaff/'.$stfd->staff_id).'" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </a>-->
                  ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countStaffData(),
      "recordsFiltered" => $this->appModel->countStaffDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function getStaffDetail($id) {
    $data = $this->appModel->getStaffbyID($id);
    echo json_encode($data);
  }

  public function update() {
    $data = array(
      'telp'                         => $this->input->post('telp_e'),
      'nama'                         => $this->input->post('nama_e'),
      'posisi'                       => $this->input->post('posisi_e'),
      'dob'                          => ($this->input->post('dob_e') != "" ? $this->input->post('dob_e') : NULL),
      'alamat'                       => $this->input->post('alamat_e'),
      'keterangan'                   => $this->input->post('keterangan_e'),
      'keluarga_yg_bisa_dihub'       => $this->input->post('keluarga_yg_bisa_dihub_e'),
      'telp_keluarga_yg_bisa_dihub'  => $this->input->post('telp_keluarga_yg_bisa_dihub_e')
    );
    $insert = $this->appModel->updateStaff(array('staff_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function getStaffEditData($id) {
    $data = $this->appModel->getStaffEditbyID($id);
    echo json_encode($data);
  }

  public function add_toteam() {
    $data = array(
      'team_id' => $this->input->post('team_id')
    );
    $update_team = $this->appModel->addToTeam(array('staff_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }

  public function removefromteam() {
    $remove_team = $this->appModel->removeFromTeam($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }

  public function removeStaff() {
    // $id = $this->uri->segment(3);
    // $remove_staff = $this->appModel->removeStaff($id);
    $delete_staff = $this->appModel->removeStaff($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }
}
