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
      $genset_total = $stfd->genset_mobile_75+$stfd->genset_mobile_10+$stfd->genset_mobile_12+$stfd->genset_fix_75+$stfd->genset_fix_10+$stfd->genset_fix_12;
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = '
                  <button type="button" href="'.site_url('team/detail/'.$stfd->team_id).'" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#teamD'.$stfd->team_id.'">
                    #ADT'.sprintf('%03d', $stfd->team_id)
                  .'</button>
                ';
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
    $data = array(
      'cluster_id'        => $this->input->post('cluster'),
      'genset_mobile_75'  => $this->input->post('genset_mobile_75'),
      'genset_mobile_10'  => $this->input->post('genset_mobile_10'),
      'genset_mobile_12'  => $this->input->post('genset_mobile_12'),
      'kendaraan_id'      => implode(',',$this->input->post('kendaraan'))
    );
    $this->appModel->saveTeam($data);
  }

  public function getTeamData($id) {
    $data = $this->appModel->getTeamEditbyID($id);
    echo json_encode($data);
  }

  public function getCurrentCluster($id) {
    $data = $this->appModel->getCurrentCluster($id);
    echo json_encode($data);
  }
}
