<?php

/**
 *
 */
class Transaksi extends MY_Controller
{

  public function main_document($page = 'transaksi/document') {
    isLoggedIn();
    $config['title']  = "Transaksi Evidence | Pengajuan" . $this->title;
    $this->loadPage($page, $config);
  }

  public function data_doc() {
    $TDoc_data  = $this->appModel->getTDocJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($TDoc_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = '<img src='.base_url('public/assets/evidence/transaksi/'.$stfd->url).' width="200">';
      $row[]  = $stfd->pengajuan;
      $row[]  = "#ADP".sprintf('%04d', $stfd->pengajuan_id);
      $row[]  = '
                  <a type="button" href="'.base_url('public/assets/evidence/transaksi/'.$stfd->url).'" download="'.$stfd->url.'" onclick="downloadEvidence('."'".$stfd->id_evidence."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                    <i class="fas fa-download"></i>
                  </button>
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->appModel->countTDocData(),
      "recordsFiltered" => $this->appModel->countTDocDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }
}
