<?php

/**
 *
 */
class Feedback extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function save() {
    $data = array(
      'name'           => $this->input->post('name'),
      'type'           => $this->input->post('jenis_feedback'),
      'content'        => $this->input->post('content'),
      'tanggal_umpan'  => date('Y-m-d', time())
    );

    $insert = $this->appModel->feedSave($data);
  }
}
