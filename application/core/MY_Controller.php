<?php

/**
 *
 */
class my_controller extends CI_Controller
{

  public $title = " | Admaresi Globalindo";

  function __construct()
  {
    parent::__construct();
  }

  public function loadPage($contentView = false, $data = array()) {
    if ($this->session->userdata('logged_in') == FALSE) {
      if (!$contentView) {
        $contentView = 'login_page';
      }
    } else {
      if (!$contentView) {
        $contentView = 'index';
      }
    }
    $this->load->view('front/templates/header', $data);
    $this->load->view('front/'.$contentView, $data);
    $this->load->view('front/templates/footer', $data);
  }
}
