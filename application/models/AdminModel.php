<?php

/**
 *
 */
class AdminModel extends CI_Model
{

  // PENGAJUAN
  public function getSubAdminJSON() {
    $this->SubAdminJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function SubAdminJSON_query() {
    $table = 'pengajuan';
    $column_order = array(null, 'pengajuan_id', 'pengajuan', 'tanggal_pengajuan', 'tanggal_approval', 'tanggal_approval_keuangan');
    $column_search = array('pengajuan_id', 'pengajuan_id', 'pengajuan');
    $order = array('tanggal_pengajuan' => 'desc');

    $this->db->from($table);

    if ($this->input->post('on_progress') != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan', NULL);
    }

    if ($this->input->post('history') != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($this->input->post('belum_diprint') != 'N') {
      $this->db->where('is_printed', 'N');
      $this->db->where('success_print', 'N');
      $this->db->where('status_admin_dmt', NULL);
      $this->db->where('tanggal_approval_keuangan', NULL);
      $this->db->where('tanggal_approval_akhir !=', NULL);
    }

    if ($this->input->post('progress_project') != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('kategori_pengajuan', 'Project');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($this->input->post('semua_pengajuan') != 'N') {

    } else {
      if ($this->input->post('reject') != 'N') {
        $this->db->where('is_rejected', 'Y');
      } else {
        $this->db->where('is_rejected', 'N');
      }
    }



    if ($this->input->post('belum_diapprove') != 'N') {
      $this->db->where('tanggal_approval_akhir', NULL);
    }

    if ($this->input->post('sudah_diapprove') != 'N') {
      $this->db->where('tanggal_approval_akhir !=', NULL);
    }

    if ($this->input->post('pengajuan')) {
      $this->db->like('pengajuan', $this->input->post('pengajuan'));
    }

    if ($this->input->post('tanggal_pengajuan')) {
      $this->db->like('tanggal_pengajuan', $this->input->post('tanggal_pengajuan'));
    }

    if ($this->input->post('tanggal_pengajuan_first')) {
      $this->db->where('DATE_FORMAT(tanggal_pengajuan, "%Y-%m-%D") >=', $this->input->post('tanggal_pengajuan_first'));
    }

    if ($this->input->post('tanggal_pengajuan_last')) {
      $this->db->where('DATE_FORMAT(tanggal_pengajuan, "%Y-%m-%D") <=', $this->input->post('tanggal_pengajuan_last'));
    }

    if ($this->input->post('realisasi_pengajuan')) {
      $this->db->like('realisasi_pengajuan', $this->input->post('realisasi_pengajuan'));
    }

    if ($this->input->post('realisasi_pengajuan_first')) {
      $this->db->where('DATE_FORMAT(realisasi_pengajuan, "%Y-%m-%D") >=', $this->input->post('realisasi_pengajuan_first'));
    }

    if ($this->input->post('realisasi_pengajuan_last')) {
      $this->db->where('DATE_FORMAT(realisasi_pengajuan, "%Y-%m-%D") <=', $this->input->post('realisasi_pengajuan_last'));
    }

    if ($this->input->post('nama_pengaju')) {
      $this->db->where('pengaju_id', $this->input->post('nama_pengaju'));
    }

    if ($this->input->post('jenis_pengajuan')) {
      $this->db->where('jenis_pengajuan', $this->input->post('jenis_pengajuan'));
    }

    if ($this->input->post('kategori_pengajuan')) {
      $this->db->where('kategori_pengajuan', $this->input->post('kategori_pengajuan'));
    }

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($order)) {
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countSubAdminDataFiltered() {
    $this->SubAdminJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countSubAdminData() {
    $this->db->from('pengajuan');
    return $this->db->count_all_results();
  }

  public function exportExcel($data) {
    $this->load->library('Excel');
    $this->excel->setActiveSheetIndex(0);

    // $this->excel->getActiveSheet()->setTitle('test worksheet');

    $this->db->from('pengajuan');
    $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left');

    if ($data['on_progress'] != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan', NULL);
    }

    if ($data['history'] != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($data['belum_diprint'] != 'N') {
      $this->db->where('is_printed', 'N');
      $this->db->where('success_print', 'N');
      $this->db->where('success_print', 'N');
      $this->db->where('status_admin_dmt', NULL);
      $this->db->where('tanggal_approval_keuangan', NULL);
      $this->db->where('tanggal_approval_akhir !=', NULL);
    }

    if ($data['progress_project'] != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('kategori_pengajuan', 'Project');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($data['semua_pengajuan'] != 'N') {
    } else {
      if ($data['reject'] != 'N') {
        $this->db->where('is_rejected', 'Y');
      } else {
        $this->db->where('is_rejected', 'N');
      }
    }

    if ($data['belum_diapprove'] != 'N') {
      $this->db->where('tanggal_approval_akhir', NULL);
      $this->db->where('is_printed', 'N');
    }

    if ($data['sudah_diapprove'] != 'N') {
      $this->db->where('tanggal_approval_akhir !=', NULL);
      $this->db->where('is_printed', 'N');
    }

    if ($data['pengajuan'] != "") {
      $this->db->like('pengajuan', $data['pengajuan']);
    }
    if ($data['kategori_pengajuan'] != "") {
      $this->db->where('kategori_pengajuan', $data['kategori_pengajuan']);
    }
    if ($data['jenis_pengajuan'] != "") {
      $this->db->where('jenis_pengajuan', $data['jenis_pengajuan']);
    }
    if ($data['tanggal_pengajuan'] != "") {
      $this->db->where('tanggal_pengajuan', $data['tanggal_pengajuan']);
    }
    if ($data['tanggal_pengajuan_first'] != "") {
      $this->db->where('tanggal_pengajuan_first >=', $data['tanggal_pengajuan_first']);
        $this->db->where('tanggal_pengajuan_last <=', $data['tanggal_pengajuan_last']);
    }
    if ($data['realisasi_pengajuan'] != "") {
      $this->db->where('realisasi_pengajuan', $data['realisasi_pengajuan']);
    }
    if ($data['realisasi_pengajuan_first'] != "") {
      $this->db->where('realisasi_pengajuan_first >=', $data['realisasi_pengajuan_first']);
      $this->db->where('realisasi_pengajuan_last <=', $data['realisasi_pengajuan_last']);
    }
    if ($data['nama_pengaju'] != "") {
      $this->db->where('pengaju_id', $data['nama_pengaju']);
    }

    $row = $this->db->get()->result();

    $this->excel->getActiveSheet()->setCellValue("A1", "ID PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("B1", "PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("C1", "JENIS PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("D1", "NAMA PROJECT");
    $this->excel->getActiveSheet()->setCellValue("E1", "NOMOR CORR");
    $this->excel->getActiveSheet()->setCellValue("F1", "NILAI SPH/CORR");
    $this->excel->getActiveSheet()->setCellValue("G1", "NOMOR PO");
    $this->excel->getActiveSheet()->setCellValue("H1", "NILAI PO");
    $this->excel->getActiveSheet()->setCellValue("I1", "NOMOR SPK");
    $this->excel->getActiveSheet()->setCellValue("J1", "NILAI PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("K1", "TANGGAL PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("L1", "REALISASI PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("M1", "KETERANGAN");

    $no = 2;
    foreach ($row as $key => $value)
    {
      $this->excel->getActiveSheet()->setCellValue("A$no", "ADP".sprintf('%04d', $value->pengajuan_id)."")
      ->setCellValue("B$no", ($value->pengajuan != NULL ? $value->pengajuan : "-"))
      ->setCellValue("C$no", ($value->jenis_pengajuan != NULL ? $value->jenis_pengajuan : "-"))
      ->setCellValue("D$no", ($value->nama_project != NULL ? $value->nama_project : "-"))
      ->setCellValue("E$no", ($value->no_corr != NULL ? $value->no_corr : "-"))
      ->setCellValue("F$no", ($value->nilai_corr != NULL ? $value->nilai_corr : "-"))
      ->setCellValue("G$no", ($value->no_po != NULL ? $value->no_po : "-"))
      ->setCellValue("H$no", ($value->nilai_po != NULL ? $value->nilai_po : "-"))
      ->setCellValue("I$no", ($value->no_spk != NULL ? $value->no_spk : "-"))
      ->setCellValue("J$no", ($value->nilai_pengajuan != NULL ? $value->nilai_pengajuan : "-"))
      ->setCellValue("K$no", ($value->tanggal_pengajuan != NULL ? $value->tanggal_pengajuan : "-"))
      ->setCellValue("L$no", ($value->realisasi_pengajuan != NULL ? $value->realisasi_pengajuan : "-"))
      ->setCellValue("M$no", ($value->keterangan != NULL ? $value->keterangan : "-"));
      $no++;
    }

    $filename = 'data_report.xls';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
    echo "<script>window.close();</script>";
  }

  public function countBlmSelesai() {
    $this->db->from('progress');
    $this->db->where('is_bayarclient', NULL);
    return $this->db->count_all_results();
  }

  public function countSdhSelesai() {
    $this->db->from('progress');
    $this->db->where('is_bayarclient !=', NULL);
    return $this->db->count_all_results();
  }

  public function countisbayar() {
    $this->db->from('progress');
    $this->db->where('is_invoiced !=', NULL);
    $this->db->where('is_bayar !=', NULL);
    $this->db->where('is_bayarclient', NULL);
    return $this->db->count_all_results();
  }

  public function countisbayarclient() {
    $this->db->from('progress');
    $this->db->where('is_invoiced !=', NULL);
    $this->db->where('is_bayar !=', NULL);
    $this->db->where('is_bayarclient !=', NULL);
    return $this->db->count_all_results();
  }

  public function countinvoiced() {
    $this->db->from('progress');
    $this->db->where('is_invoiced !=', NULL);
    $this->db->where('is_bayar', NULL);
    $this->db->where('is_bayarclient', NULL);
    return $this->db->count_all_results();
  }

  public function countbelumsemua() {
    $this->db->from('progress');
    $this->db->where('is_invoiced=', NULL);
    $this->db->where('is_bayar', NULL);
    $this->db->where('is_bayarclient', NULL);
    return $this->db->count_all_results();
  }

  public function countrejected() {
    $this->db->from('pengajuan');
    $this->db->where('is_rejected', 'Y');
    return $this->db->count_all_results();
  }

  public function countsudahdiapprove() {
    $this->db->from('pengajuan');
    $this->db->where('tanggal_approval_akhir !=', NULL);
    return $this->db->count_all_results();
  }

  public function countbelumdiapprove() {
    $this->db->from('pengajuan');
    $this->db->where('tanggal_approval_akhir', NULL);
    return $this->db->count_all_results();
  }

  public function checkAll($data) {
    $this->db->where('is_bayarclient', NULL);
    $this->db->update('progress', $data);
    return $this->db->affected_rows();
  }

  public function hCheckAll($data) {
    $this->db->where('is_bayarclient !=', NULL);
    $this->db->update('progress', $data);
    return $this->db->affected_rows();
  }

  public function saveCBox($where, $data) {
    $this->db->update('progress', $data, $where);
    return $this->db->affected_rows();
  }

  public function getProgressPrinting() {
    $this->db->from('progress');
    $this->db->join('project', 'project.project_id = progress.project_id', 'left outer');
    $this->db->join('site', 'site.site_id = progress.site_id', 'left outer');
    $this->db->where('progress.is_bayarclient', NULL);
    $this->db->order_by('site.nama_site', 'asc');
    $row = $this->db->get();

    echo '
    <link rel="stylesheet" type="text/css" href="'.base_url('public/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css').'" media="all">
    <style>
    @media print{@page {size: landscape}}
    @media print{
      div.row:nth-child(odd) {
        background-color: #eee !important;
      }
    }
    * {
      font-size:12px;
      font-family: calibri, sans-serif;
      -webkit-print-color-adjust: exact;
    }
    tr{ page-break-before: avoid; display: "inline-block"; //or display: "inline-table" }
    table {
        font-family: calibri, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: #585858;
    }
    td, th {
        border: 1px solid #333333;
        text-align: left;
        padding:0px 3px;
    }
    @media print {
      div.row:nth-child(odd) div.cell {
        background-color: #000000;
      }
    }
    tbody:nth-child(odd) tr {
        background-color: #eee;
    }
    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid;
    }
    </style>

    <body onload="window.print()">
    <span>Progress Berjalan</span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">No</td>
          <td style="width:120px;text-align:center"><b>Keterangan</b></td>
          <td style="width:120px;text-align:center"><b>No BAPP</b></td>
          <td style="width:120px;text-align:center"><b>No BAST</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAPP</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAST</b></td>
          <td style="width:120px;text-align:center"><b>No CORMO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal CORMO</b></td>
          <td style="width:120px;text-align:center"><b>No PO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal PO</b></td>
          <td style="width:120px;text-align:center"><b>Invoiced</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar Client</b></td>
        </tr>
      </thead>
      <tbody>
    ';

    $no = 1;
    foreach ($row->result() as $key => $value) {
      echo '
          <tr style="background-color:#fff;">
            <td>'.$no.'</td>
            <td>'.$value->keterangan.'</td>
            <td style="text-align:center;">'.($value->no_bapp != NULL ? $value->no_bapp : '-').'</td>
            <td style="text-align:center;">'.($value->no_bast != NULL ? $value->no_bast : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bapp != NULL ? date('d M Y', strtotime($value->tanggal_bapp)) : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bast != NULL ? date('d M Y', strtotime($value->tanggal_bast)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_corr != NULL ? $value->no_corr : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_corr != NULL ? date('d M Y', strtotime($value->tanggal_corr)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_po != NULL ? $value->no_po : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_po != NULL ? date('d M Y', strtotime($value->tanggal_po)) : '-').'</td>
            <td style="text-align:center;">'.($value->is_invoiced != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_invoiced : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayar != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayar : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayarclient != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayarclient : "<i class='fas fa-times text-danger'></i>").'</td>
          </tr>
      ';
      $no++;
    }
    echo '</tbody>
        </table>';
  }

  public function getProgressPrintingTerpilih() {
    $this->db->from('progress');
    $this->db->join('project', 'project.project_id = progress.project_id', 'left outer');
    $this->db->join('site', 'site.site_id = progress.site_id', 'left outer');
    $this->db->where('progress.is_bayarclient', NULL);
    $this->db->where('progress.is_checked', 'Y');
    $this->db->order_by('site.nama_site', 'asc');
    $row = $this->db->get();

    echo '
    <link rel="stylesheet" type="text/css" href="'.base_url('public/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css').'" media="all">
    <style>
    @media print{@page {size: landscape}}
    @media print{
      div.row:nth-child(odd) {
        background-color: #eee !important;
      }
    }
    * {
      font-size:12px;
      font-family: calibri, sans-serif;
      -webkit-print-color-adjust: exact;
    }
    tr{ page-break-before: avoid; display: "inline-block"; //or display: "inline-table" }
    table {
        font-family: calibri, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: #585858;
    }
    td, th {
        border: 1px solid #333333;
        text-align: left;
        padding:0px 3px;
    }
    @media print {
      div.row:nth-child(odd) div.cell {
        background-color: #000000;
      }
    }
    tbody:nth-child(odd) tr {
        background-color: #eee;
    }
    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid;
    }
    </style>

    <body onload="window.print()">
    <span>Progress Berjalan</span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">No</td>
          <td style="width:120px;text-align:center"><b>Keterangan</b></td>
          <td style="width:120px;text-align:center"><b>No BAPP</b></td>
          <td style="width:120px;text-align:center"><b>No BAST</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAPP</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAST</b></td>
          <td style="width:120px;text-align:center"><b>No CORMO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal CORMO</b></td>
          <td style="width:120px;text-align:center"><b>No PO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal PO</b></td>
          <td style="width:120px;text-align:center"><b>Invoiced</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar Client</b></td>
        </tr>
      </thead>
      <tbody>
    ';

    $no = 1;
    foreach ($row->result() as $key => $value) {
      echo '
          <tr style="background-color:#fff;">
            <td>'.$no.'</td>
            <td>'.$value->keterangan.'</td>
            <td style="text-align:center;">'.($value->no_bapp != NULL ? $value->no_bapp : '-').'</td>
            <td style="text-align:center;">'.($value->no_bast != NULL ? $value->no_bast : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bapp != NULL ? date('d M Y', strtotime($value->tanggal_bapp)) : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bast != NULL ? date('d M Y', strtotime($value->tanggal_bast)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_corr != NULL ? $value->no_corr : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_corr != NULL ? date('d M Y', strtotime($value->tanggal_corr)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_po != NULL ? $value->no_po : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_po != NULL ? date('d M Y', strtotime($value->tanggal_po)) : '-').'</td>
            <td style="text-align:center;">'.($value->is_invoiced != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_invoiced : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayar != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayar : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayarclient != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayarclient : "<i class='fas fa-times text-danger'></i>").'</td>
          </tr>
      ';
      $no++;
    }
    echo '</tbody>
        </table>';
  }

  public function h_getProgressPrinting() {
    $this->db->from('progress');
    $this->db->join('project', 'project.project_id = progress.project_id', 'left outer');
    $this->db->join('site', 'site.site_id = progress.site_id', 'left outer');
    $this->db->where('progress.is_bayarclient !=', NULL);
    $this->db->order_by('site.nama_site', 'asc');
    $row = $this->db->get();

    echo '
    <link rel="stylesheet" type="text/css" href="'.base_url('public/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css').'" media="all">
    <style>
    @media print{@page {size: landscape}}
    @media print{
      div.row:nth-child(odd) {
        background-color: #eee !important;
      }
    }
    * {
      font-size:12px;
      font-family: calibri, sans-serif;
      -webkit-print-color-adjust: exact;
    }
    tr{ page-break-before: avoid; display: "inline-block"; //or display: "inline-table" }
    table {
        font-family: calibri, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: #585858;
    }
    td, th {
        border: 1px solid #333333;
        text-align: left;
        padding:0px 3px;
    }
    @media print {
      div.row:nth-child(odd) div.cell {
        background-color: #000000;
      }
    }
    tbody:nth-child(odd) tr {
        background-color: #eee;
    }
    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid;
    }
    </style>

    <body onload="window.print()">
    <span>Progress yang Telah Selesai</span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">No</td>
          <td style="width:120px;text-align:center"><b>Keterangan</b></td>
          <td style="width:120px;text-align:center"><b>No BAPP</b></td>
          <td style="width:120px;text-align:center"><b>No BAST</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAPP</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAST</b></td>
          <td style="width:120px;text-align:center"><b>No CORMO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal CORMO</b></td>
          <td style="width:120px;text-align:center"><b>No PO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal PO</b></td>
          <td style="width:120px;text-align:center"><b>Invoiced</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar Client</b></td>
        </tr>
      </thead>
      <tbody>
    ';

    $no = 1;
    foreach ($row->result() as $key => $value) {
      echo '
          <tr style="background-color:#fff;">
            <td>'.$no.'</td>
            <td>'.$value->keterangan.'</td>
            <td style="text-align:center;">'.($value->no_bapp != NULL ? $value->no_bapp : '-').'</td>
            <td style="text-align:center;">'.($value->no_bast != NULL ? $value->no_bast : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bapp != NULL ? date('d M Y', strtotime($value->tanggal_bapp)) : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bast != NULL ? date('d M Y', strtotime($value->tanggal_bast)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_corr != NULL ? $value->no_corr : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_corr != NULL ? date('d M Y', strtotime($value->tanggal_corr)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_po != NULL ? $value->no_po : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_po != NULL ? date('d M Y', strtotime($value->tanggal_po)) : '-').'</td>
            <td style="text-align:center;">'.($value->is_invoiced != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_invoiced : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayar != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayar : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayarclient != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayarclient : "<i class='fas fa-times text-danger'></i>").'</td>
          </tr>
      ';
      $no++;
    }
    echo '</tbody>
        </table>';
  }

  public function h_getProgressPrintingTerpilih() {
    $this->db->from('progress');
    $this->db->join('project', 'project.project_id = progress.project_id', 'left outer');
    $this->db->join('site', 'site.site_id = progress.site_id', 'left outer');
    $this->db->where('progress.is_bayarclient !=', NULL);
    $this->db->where('progress.is_checked', 'Y');
    $this->db->order_by('site.nama_site', 'asc');
    $row = $this->db->get();

    echo '
    <link rel="stylesheet" type="text/css" href="'.base_url('public/css/fontawesome/web-fonts-with-css/css/fontawesome-all.css').'" media="all">
    <style>
    @media print{@page {size: landscape}}
    @media print{
      div.row:nth-child(odd) {
        background-color: #eee !important;
      }
    }
    * {
      font-size:12px;
      font-family: calibri, sans-serif;
      -webkit-print-color-adjust: exact;
    }
    tr{ page-break-before: avoid; display: "inline-block"; //or display: "inline-table" }
    table {
        font-family: calibri, sans-serif;
        border-collapse: collapse;
        width: 100%;
        color: #585858;
    }
    td, th {
        border: 1px solid #333333;
        text-align: left;
        padding:0px 3px;
    }
    @media print {
      div.row:nth-child(odd) div.cell {
        background-color: #000000;
      }
    }
    tbody:nth-child(odd) tr {
        background-color: #eee;
    }
    table.print-friendly tr td, table.print-friendly tr th {
        page-break-inside: avoid;
    }
    </style>

    <body onload="window.print()">
    <span>Progress yang Telah Selesai</span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">No</td>
          <td style="width:120px;text-align:center"><b>Keterangan</b></td>
          <td style="width:120px;text-align:center"><b>No BAPP</b></td>
          <td style="width:120px;text-align:center"><b>No BAST</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAPP</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal BAST</b></td>
          <td style="width:120px;text-align:center"><b>No CORMO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal CORMO</b></td>
          <td style="width:120px;text-align:center"><b>No PO</b></td>
          <td style="width:120px;text-align:center"><b>Tanggal PO</b></td>
          <td style="width:120px;text-align:center"><b>Invoiced</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar</b></td>
          <td style="width:120px;text-align:center"><b>Sudah Dibayar Client</b></td>
        </tr>
      </thead>
      <tbody>
    ';

    $no = 1;
    foreach ($row->result() as $key => $value) {
      echo '
          <tr style="background-color:#fff;">
            <td>'.$no.'</td>
            <td>'.$value->keterangan.'</td>
            <td style="text-align:center;">'.($value->no_bapp != NULL ? $value->no_bapp : '-').'</td>
            <td style="text-align:center;">'.($value->no_bast != NULL ? $value->no_bast : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bapp != NULL ? date('d M Y', strtotime($value->tanggal_bapp)) : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_bast != NULL ? date('d M Y', strtotime($value->tanggal_bast)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_corr != NULL ? $value->no_corr : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_corr != NULL ? date('d M Y', strtotime($value->tanggal_corr)) : '-').'</td>
            <td style="text-align:center;">'.($value->no_po != NULL ? $value->no_po : '-').'</td>
            <td style="text-align:right;">'.($value->tanggal_po != NULL ? date('d M Y', strtotime($value->tanggal_po)) : '-').'</td>
            <td style="text-align:center;">'.($value->is_invoiced != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_invoiced : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayar != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayar : "<i class='fas fa-times text-danger'></i>").'</td>
            <td style="text-align:center;">'.($value->is_bayarclient != NULL ? "<i class='fas fa-check text-success'></i>&nbsp; ".$value->is_bayarclient : "<i class='fas fa-times text-danger'></i>").'</td>
          </tr>
      ';
      $no++;
    }
    echo '</tbody>
        </table>';
  }

  // evidence
  public function getPrpicJSON() {
    $this->PrpicJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function PrpicJSON_query() {
    $table = 'evidence_progress';
    $column_order = array(null, 'evidence_progress.url', 'evidence_progress.url', 'evidence_progress.id_evidence', null);
    $column_search = array('evidence_progress.url', 'evidence_progress.url', 'evidence_progress.id_evidence');

    $this->db->from($table);
    // $this->db->join('evidence', 'find_in_set(evidence_progress.id_evidence, progress.evidence_id)', 'left outer', false);
    $this->db->join('progress', 'evidence_progress.progress_id = progress.progress_id', 'left outer', false);
    $this->db->where_in('evidence_progress.extension', array('jpg', 'png', 'gif', 'jpeg'));
    $this->db->group_by('evidence_progress.id_evidence');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($order)) {
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countPrpicDataFiltered() {
    $this->PrpicJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countPrpicData() {
    $this->db->from('evidence_progress');
    return $this->db->count_all_results();
  }

  // evidence
  public function getPrDocJSON() {
    $this->PrDocJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function PrDocJSON_query() {
    $table = 'evidence_progress';
    $column_order = array(null, 'evidence_progress.url', 'evidence_progress.url', 'evidence_progress.id_evidence', null);
    $column_search = array('evidence_progress.url', 'evidence_progress.url', 'evidence_progress.id_evidence');

    $this->db->from($table);
    // $this->db->join('evidence', 'find_in_set(evidence_progress.id_evidence, progress.evidence_id)', 'left outer', false);
    $this->db->join('progress', 'evidence_progress.progress_id = progress.progress_id', 'left outer', false);
    $this->db->where_not_in('evidence_progress.extension', array('jpg', 'png', 'gif', 'jpeg'));
    $this->db->group_by('evidence_progress.id_evidence');

    $i = 0;
    foreach ($column_search as $item) {
      if ($_POST['search']['value']) {
        if ($i === 0) {
          $this->db->group_start();
          $this->db->like($item, $_POST['search']['value']);
        } else {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        if (count($column_search) - 1 == $i) {
          $this->db->group_end();
        }
      }
      $i++;
    }

    if (isset($_POST['order'])) {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } else if (isset($order)) {
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  public function countPrDocDataFiltered() {
    $this->PrDocJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countPrDocData() {
    $this->db->from('evidence_progress');
    return $this->db->count_all_results();
  }
}
