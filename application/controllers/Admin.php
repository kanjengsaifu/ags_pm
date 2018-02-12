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
      $row[]  = $stfd->pengajuan;
      $row[]  = strtoupper($stfd->jenis_pengajuan);
      $row[]  = date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan));
      $row[]  = ($stfd->nilai_sph == "0" ? "-" : number_format($stfd->nilai_sph, '0','.','.'));
      $row[]  = ($stfd->nilai_corr == "0" ? "-" : number_format($stfd->nilai_corr, '0','.','.'));
      $row[]  = ($stfd->nilai_po == "0" ? "-" : number_format($stfd->nilai_po, '0','.','.'));
      $row[]  = ($stfd->nilai_pengajuan == "0" ? "-" : number_format($stfd->nilai_pengajuan, '0','.','.'));
      // if (!(isAdminJakarta() || isApproval())) {
      //   $row[]  = ($stfd->tanggal_approval != "" ? date('l, d-m-Y', strtotime($stfd->tanggal_approval)) : "<span class=\"btn btn-outline-danger\">BELUM DIAPPROVE</span>");
      //   $row[]  = ($stfd->status_admin_dmt != "" ?
      //               ($stfd->tanggal_approval_keuangan != "" ? date('l, d-m-Y', strtotime($stfd->tanggal_approval_keuangan)) : "<span class=\"btn btn-outline-danger\">ON PROGRESS</span>")
      //               :
      //               "<span class=\"btn btn-outline-danger\">". (!isAdminJakarta() ? 'PENDING' : 'BELUM DI PRINT') ."</span>"
      //             );
      // }
      // $row[]  = ($stfd->realisasi_pengajuan <= date('Y-m-d') ?
      //             '<span class="btn btn-outline-danger">'.date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan)).'</span>'
      //             :
      //             date('l, d-m-Y', strtotime($stfd->realisasi_pengajuan))
      //           );
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

  public function cron() {
    $this->load->view('cron');
  }

  public function exportExcel() {
    $data = array(
      'on_progress'               => $this->input->get('on_progress'),
      'belum_diprint'             => $this->input->get('belum_diprint'),
      'history'                   => $this->input->get('history'),
      'progress_project'          => $this->input->get('progress_project'),
      'semua_pengajuan'           => $this->input->get('semua_pengajuan'),
      'belum_diapprove'           => $this->input->get('belum_diapprove'),
      'sudah_diapprove'           => $this->input->get('sudah_diapprove'),
      'pengajuan'                 => $this->input->get('pengajuan'),
      'kategori_pengajuan'        => $this->input->get('kategori_pengajuan'),
      'jenis_pengajuan'           => $this->input->get('jenis_pengajuan'),
      'tanggal_pengajuan'         => $this->input->get('tanggal_pengajuan'),
      'tanggal_pengajuan_first'   => $this->input->get('tanggal_pengajuan_first'),
      'tanggal_pengajuan_last'    => $this->input->get('tanggal_pengajuan_last'),
      'realisasi_pengajuan'       => $this->input->get('realisasi_pengajuan'),
      'realisasi_pengajuan_first' => $this->input->get('realisasi_pengajuan_first'),
      'realisasi_pengajuan_last'  => $this->input->get('realisasi_pengajuan_last'),
      'nama_pengaju'              => $this->input->get('nama_pengaju')
    );
    $this->adminModel->exportExcel($data);
    // echo json_encode(array("status" => TRUE));
  }

  public function tesExcel() {
    //load our new PHPExcel library
    $this->load->library('excel');
    //activate worksheet number 1
    $this->excel->setActiveSheetIndex(0);
    //name the worksheet
    $this->excel->getActiveSheet()->setTitle('test worksheet');
    //set cell A1 content with some text
    $this->excel->getActiveSheet()->setCellValue('A1', 'This is just some text value');
    //change the font size
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(20);
    //make the font become bold
    $this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
    //merge cell A1 until D1
    $this->excel->getActiveSheet()->mergeCells('A1:D1');
    //set aligment to center for that merged cell (A1 to D1)
    $this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

    $filename='just_some_random_name.xls'; //save our workbook as this file name
    header('Content-Type: application/vnd.ms-excel'); //mime type
    header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
    header('Cache-Control: max-age=0'); //no cache

    //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
    //if you want to save it as .XLSX Excel 2007 format
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    //force user to download the Excel file without writing it to server's HD
    $objWriter->save('php://output');
  }

}
