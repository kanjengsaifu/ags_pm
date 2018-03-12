<?php

/**
 *
 */
class Team extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function main($page = 'team') {
    isLoggedIn();
    $config['title']  = "Team Management" . $this->title;
    $config['teamData']   = $this->appModel->getTeamData();
    $config['staff_list'] = $this->appModel->getAllStaff();
    $config['cluster_list'] = $this->appModel->getClusterData();
    $config['kendaraan_list'] = $this->appModel->getKendaraanData();
    $this->loadPage($page, $config);
  }

  public function data() {
    $team_data  = $this->appModel->getTeamJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($team_data as $stfd) {
      $genset_total = $stfd->genset_mobile_75+$stfd->genset_mobile_10+$stfd->genset_mobile_12;
      $no++;
      $row = array();
      $row[]  = $no;
      // $row[]  = '#ADT'.sprintf('%03d', $stfd->team_id);
      $row[]  = $stfd->homebase . ' - ' . $stfd->wilayah;
      $row[]  = $stfd->mac_address;
      $row[]  = $genset_total;
      $row[]  = $stfd->genset_mobile_75;
      $row[]  = $stfd->genset_mobile_10;
      $row[]  = $stfd->genset_mobile_12;
      $row[]  = '
                  <!--<a href="'.site_url("delete_team&pid?='.$stfd->team_id").'">
                    <i class="far fa-edit"></i>
                  </a>
                   /
                  <a href="'.site_url("delete_team&pid?='.$stfd->team_id").'">
                     <i class="fas fa-trash"></i>
                  </a>-->
                  <button type="button" href="" onclick="detailTeam('."'".$stfd->team_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailTeam">
                    <i class="fas fa-search"></i>
                  </button>
                  <button type="button" href="" onclick="edit_team('."'".$stfd->team_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#editTeam">
                    <i class="fas fa-edit"></i>
                  </button>
                  <button type="button" href="" onclick="removeTeam('."'".$stfd->team_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countTeamData(),
      "recordsFiltered" => $this->appModel->countTeamDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

  public function save() {
    // echo count($this->input->post('kendaraan'));
    $data = array(
      'cluster_id'        => $this->input->post('cluster'),
      'genset_mobile_75'  => $this->input->post('genset_mobile_75'),
      'genset_mobile_10'  => $this->input->post('genset_mobile_10'),
      'genset_mobile_12'  => $this->input->post('genset_mobile_12'),
      'kendaraan_id'      => (count($this->input->post('kendaraan')) > 1 ? implode(',',$this->input->post('kendaraan')) : implode(',',$this->input->post('kendaraan')))
    );
    $this->appModel->saveTeam($data);
  }

  public function getTeamData($id) {
    $data = $this->appModel->getTeamEditbyID($id);
    echo json_encode($data);
  }

  public function getAnggota($id) {
    $data = $this->appModel->getAnggota($id);
    echo json_encode($data);
  }

  public function getAnggotaTelp($id) {
    $data = $this->appModel->getAnggotaTelp($id);
    echo json_encode($data);
  }

  public function getCurrentCluster($id) {
    $data = $this->appModel->getCurrentCluster($id);
    echo json_encode($data);
  }

  public function removeTeam() {
    // $id = $this->uri->segment(3);
    // $remove_staff = $this->appModel->removeStaff($id);
    $delete_staff = $this->appModel->removeTeam($this->input->post('id'));
    echo json_encode(array("status" => TRUE));
  }

  public function getTeamDetail($id) {
    $data = $this->appModel->getTeambyID($id);
    echo json_encode($data);
  }

  public function update() {
    // echo implode(',', $this->input->post('kendaraan_e'));
    $data = array(
      'cluster_id'         => $this->input->post('cluster_id_e'),
      'mac_address'        => $this->input->post('mac_address_e'),
      'genset_mobile_75'   => $this->input->post('genset_mobile_75_e'),
      'genset_mobile_10'   => $this->input->post('genset_mobile_10_e'),
      'genset_mobile_12'   => $this->input->post('genset_mobile_12_e'),
      'kendaraan_id'       => implode(',', $this->input->post('kendaraan_e'))
    );
    $insert = $this->appModel->updateTeam(array('team_id' => $this->input->post('id')), $data);
    echo json_encode(array("status" => TRUE));
  }
}
