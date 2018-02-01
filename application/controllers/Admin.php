<?php

/**
 *
 */
class Admin extends MY_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function data() {
    $team_data  = $this->adminModel->getSubAdminJSON();
    $data       = array();
    $no         = $_POST['start'];
    foreach ($team_data as $stfd) {
      $no++;
      $row = array();
      $row[]  = $no;
      $row[]  = "#ADP".sprintf('%04d', $stfd->pengajuan_id);
      $row[]  = $stfd->pengajuan;
      $row[]  = date('l, d-m-Y H:m:s', strtotime($stfd->tanggal_pengajuan));
      if (!(isAdminJakarta() || isApproval())) {
        $row[]  = ($stfd->tanggal_approval != "" ? date('l, d-m-Y', strtotime($stfd->tanggal_approval)) : "<span class=\"btn btn-outline-danger\">BELUM DIAPPROVE</span>");
        $row[]  = ($stfd->status_admin_dmt != "" ?
                    ($stfd->tanggal_approval_keuangan != "" ? date('l, d-m-Y', strtotime($stfd->tanggal_approval_keuangan)) : "<span class=\"btn btn-outline-danger\">ON PROGRESS</span>")
                    :
                    "<span class=\"btn btn-outline-danger\">". (!isAdminJakarta() ? 'PENDING' : 'BELUM DI PRINT') ."</span>"
                  );
      }
      $row[]  = ($stfd->realisasi_pengajuan <= date('Y-m-d') ?
                  '<span class="btn btn-outline-danger">'.date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan)).'</span>'
                  :
                  date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan))
                );
      // $row[]  = ($stfd->is_invoiced == "N" ? "&#x2714" : '');
      // $row[]  = ($stfd->is_bayar == "N" ? "&#x2714" : '');
      // $row[]  = ($stfd->is_bayarclient == "N" ? "&#x2714" : '');
      $row[]  = '
                  <button type="button" href="" onclick="detailPengajuan('."'".$stfd->pengajuan_id."'".')" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary" data-toggle="modal" data-target="#detailPengajuan">
                    DETAIL
                  </button>
                  '.
                    (isApproval() || isAdministrator() ?
                      ($stfd->tanggal_approval != null ?
                        '

                        '
                        :
                        '
                          <a href="#" onclick="accPengajuan('."'".$stfd->pengajuan_id."'".')" class="text-center btn cur-p btn-outline-success">APPROVE</a>
                        '
                      ) : ''
                    )
                  .'
                  '.
                    (isAdminJakarta() || isAdministrator() ?
                      ($stfd->is_printed == "Y" ?
                        ($stfd->tanggal_approval_keuangan != NULL ?
                          '' :
                          ($stfd->is_printed == "Y" ?
                            '<button type="button" href="" onclick="'. ($stfd->nama_project != "" ? 'accBos('."'".$stfd->pengajuan_id."'".')' : 'accLangsung('."'".$stfd->pengajuan_id."'".')') .'" style="margin:0 auto;" class="text-center btn cur-p btn-outline-primary">
                              ACC
                            </button>' : ''
                          )
                        ) : ''
                      ) : ''
                    )
                  .'
                ';
      $data[]  = $row;
    }

    $output = array(
      "draw"            => $_POST['draw'],
      "recordsTotal"    => $this->adminModel->countSubAdminData(),
      "recordsFiltered" => $this->adminModel->countSubAdminDataFiltered(),
      "data"            => $data
    );

    echo json_encode($output);
  }

}
