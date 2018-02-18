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
    $order = array('realisasi_pengajuan' => 'asc');
    // if (isAdminJakarta()) {
    // } else {
    //   $order = array('tanggal_pengajuan' => 'desc');
    // }
    //
    $this->db->from($table);
    // if (isAdminJakarta()) {
    //   $this->db->where('tanggal_approval !=', NULL);
    // }
    //
    //
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
      $this->db->where('tanggal_approval !=', NULL);
    }

    if ($this->input->post('progress_project') != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('kategori_pengajuan', 'Project');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($this->input->post('semua_pengajuan') != 'N') {

    }

    if ($this->input->post('belum_diapprove') != 'N') {
      $this->db->where('tanggal_approval', NULL);
    }

    if ($this->input->post('sudah_diapprove') != 'N') {
      $this->db->where('tanggal_approval !=', NULL);
      $this->db->where('is_printed', 'N');
    }

    if (isAdminTasik()) {
      $this->db->where('pengaju_id', $this->session->userdata('useractive_id'));
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
      $this->db->where('pengajuan.is_printed', 'Y');
      $this->db->where('pengajuan.success_print', 'Y');
      $this->db->where('pengajuan.status_admin_dmt !=', NULL);
      $this->db->where('pengajuan.tanggal_approval_keuangan', NULL);
    }

    if ($data['history'] != 'N') {
      $this->db->where('pengajuan.is_printed', 'Y');
      $this->db->where('pengajuan.success_print', 'Y');
      $this->db->where('pengajuan.status_admin_dmt !=', NULL);
      $this->db->where('pengajuan.tanggal_approval_keuangan !=', NULL);
    }

    if ($data['belum_diprint'] != 'N') {
      $this->db->where('pengajuan.is_printed', 'N');
      $this->db->where('pengajuan.success_print', 'N');
      $this->db->where('pengajuan.success_print', 'N');
      $this->db->where('pengajuan.status_admin_dmt', NULL);
      $this->db->where('pengajuan.tanggal_approval_keuangan', NULL);
      $this->db->where('pengajuan.tanggal_approval !=', NULL);
    }

    if ($data['progress_project'] != 'N') {
      $this->db->where('pengajuan.is_printed', 'Y');
      $this->db->where('pengajuan.success_print', 'Y');
      $this->db->where('pengajuan.kategori_pengajuan', 'Project');
      $this->db->where('pengajuan.status_admin_dmt !=', NULL);
      $this->db->where('pengajuan.tanggal_approval_keuangan !=', NULL);
    }

    if ($data['semua_pengajuan'] != 'N') {
    }

    if ($data['belum_diapprove'] != 'N') {
      $this->db->where('pengajuan.tanggal_approval', NULL);
      $this->db->where('pengajuan.is_printed', 'N');
    }

    if ($data['sudah_diapprove'] != 'N') {
      $this->db->where('pengajuan.tanggal_approval !=', NULL);
      $this->db->where('pengajuan.is_printed', 'N');
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
    $this->excel->getActiveSheet()->setCellValue("E1", "NILAI SPH");
    $this->excel->getActiveSheet()->setCellValue("F1", "NOMOR COR");
    $this->excel->getActiveSheet()->setCellValue("G1", "NILAI CORR");
    $this->excel->getActiveSheet()->setCellValue("H1", "NOMOR PO");
    $this->excel->getActiveSheet()->setCellValue("I1", "NILAI PO");
    $this->excel->getActiveSheet()->setCellValue("J1", "NOMOR SPK");
    $this->excel->getActiveSheet()->setCellValue("K1", "NILAI PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("L1", "TANGGAL PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("M1", "REALISASI PENGAJUAN");
    $this->excel->getActiveSheet()->setCellValue("M1", "KETERANGAN");

    $no = 2;
    foreach ($row as $key => $value)
    {
      $this->excel->getActiveSheet()->setCellValue("A$no", "ADP".sprintf('%04d', $value->pengajuan_id)."")
      ->setCellValue("B$no", ($value->pengajuan != NULL ? $value->pengajuan : "-"))
      ->setCellValue("C$no", ($value->jenis_pengajuan != NULL ? $value->jenis_pengajuan : "-"))
      ->setCellValue("D$no", ($value->nama_project != NULL ? $value->nama_project : "-"))
      ->setCellValue("E$no", ($value->nilai_sph != NULL ? $value->nilai_sph : "-"))
      ->setCellValue("F$no", ($value->no_corr != NULL ? $value->no_corr : "-"))
      ->setCellValue("G$no", ($value->nilai_corr != NULL ? $value->nilai_corr : "-"))
      ->setCellValue("H$no", ($value->no_po != NULL ? $value->no_po : "-"))
      ->setCellValue("I$no", ($value->nilai_po != NULL ? $value->nilai_po : "-"))
      ->setCellValue("J$no", ($value->no_spk != NULL ? $value->no_spk : "-"))
      ->setCellValue("K$no", ($value->nilai_pengajuan != NULL ? $value->nilai_pengajuan : "-"))
      ->setCellValue("L$no", ($value->tanggal_pengajuan != NULL ? $value->tanggal_pengajuan : "-"))
      ->setCellValue("M$no", ($value->realisasi_pengajuan != NULL ? $value->realisasi_pengajuan : "-"))
      ->setCellValue("N$no", ($value->keterangan != NULL ? $value->keterangan : "-"));
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
}
