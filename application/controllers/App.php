<?php

/**
 *
 */
class App extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index($page = '') {
    $config['title']  = "Welcome" . $this->title;
    $config['totalpengajuan'] = $this->appModel->totalPengajuan();
    $config['pengajuanterhold'] = $this->appModel->pengajuanTerhold();
    if (isViewer()) {
      $config['kategori_pengajuan'] = $this->appModel->getEnumKategoriPengajuan();
      $config['getPengajuUser']     = $this->appModel->getPengajuUser();
    }
    $this->loadPage($page, $config);
  }

  public function auth_in() {
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $auth_check = $this->appModel->auth_check($username, $password);
  }

  public function destroy_session() {
    $this->session->sess_destroy();
    redirect('');
  }
}
