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
    $config['belumSelesai'] = $this->adminModel->countBlmSelesai();
    $config['sudahSelesai'] = $this->adminModel->countSdhSelesai();
    $config['isbayar'] = $this->adminModel->countisbayar();
    $config['isbayarclient'] = $this->adminModel->countisbayarclient();
    $config['invoiced'] = $this->adminModel->countinvoiced();
    $config['belumsemua'] = $this->adminModel->countbelumsemua();
    $config['sudahdiapprove'] = $this->adminModel->countsudahdiapprove();
    $config['belumdiapprove'] = $this->adminModel->countbelumdiapprove();
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

  public function backupdb() {
    $this->load->dbutil();
    $backup = $this->dbutil->backup();

    $this->load->helper('file');
    write_file('/public/database.zip', $backup);

    $this->load->helper('download');
    force_download('database.zip', $backup);
  }

  public function checkCurrPassword() {
    $currpass = md5($this->input->post('currpass'));
    $this->appModel->checkOldPassMatch($currpass);
  }

  public function saveChanges() {
    $newpassword = md5($this->input->post('ep_password'));
    $this->appModel->changePassword($newpassword);
  }
}
