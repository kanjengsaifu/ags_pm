<?php


/**
 *
 */
class AppModel extends CI_Model
{

  public function totalPengajuan() {
    $this->db->from('pengajuan');
    return $this->db->count_all_results();
  }

  public function pengajuanTerhold() {
    $this->db->where('tanggal_approval !=', NULL);
    $this->db->where('tanggal_approval_keuangan', NULL);
    $this->db->where('is_printed', 'Y');
    $this->db->from('pengajuan');
    return $this->db->count_all_results();
  }

  public function auth_check($username, $password) {
    $this->db->where('username', $username);
    $this->db->where('password', $password);
    $user = $this->db->get('users');
    $user_c = $user->num_rows();
    $row = $user->row();

    if ($user_c === 1) {
      if ($row->status == "ACTIVE") {
        $this->sessionData($row);
      } else {
        $this->session->set_flashdata('notification', "Akun tidak aktif, hubungi Admin");
        redirect('');
      }
    } else {
      $this->session->set_flashdata('notification', "Username atau Password Salah");
      redirect('');
    }
  }

  public function sessionData($row='') {
    $data['useractive_id']  = $row->user_id;
    $data['username']       = $row->username;
    $data['name']           = $row->name;
    $data['permission']     = $row->permission;
    $data['logged_in']      = TRUE;

    $this->session->set_userdata($data);
    redirect('');
  }

  public function addStaff($name, $telp, $posisi, $dob, $alamat, $keterangan, $keluarga_yg_bisa_dihub, $telp_keluarga_yg_bisa_dihub) {
    $data = array(
      "nama" => $name,
      "telp"  => $telp,
      "posisi" => $posisi,
      "dob" => date("Y-m-d", strtotime($dob)),
      "alamat" => $alamat,
      "keterangan" => $keterangan,
      "keluarga_yg_bisa_dihub" => $keluarga_yg_bisa_dihub,
      "telp_keluarga_yg_bisa_dihub" => $telp_keluarga_yg_bisa_dihub
    );
    $insert = $this->db->insert('staff', $data);
    if ($insert) {
      $this->session->set_flashdata('notification', "Staff berhasil ditambahkan!");
      redirect('/staff');
    } else {
      $this->session->set_flashdata('error', "Something went wrong!");
      redirect('/staff');
    }
  }

  // public function addStaff($data) {
  //   $this->db->insert('staff', $data);
  //   return $this->db->insert_id();
  // }

  public function staffData() {
    return $this->db->get('staff');
  }

  public function getStaffJSON() {
    $this->staffJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function staffJSON_query() {
    $table = 'staff';
    $column_order = array(null, 'nama', 'posisi', 'alamat', 'keterangan', null);
    $column_search = array('nama', 'posisi', 'alamat', 'keterangan');
    $order = array('staff_id' => 'asc');

    $this->db->from($table);

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

  public function countStaffDataFiltered() {
    $this->staffJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countStaffData() {
    $this->db->from('staff');
    return $this->db->count_all_results();
  }

  // TEAM
  public function getTeamData() {
    return $this->db->get('team');
  }

  public function getTeamJSON() {
    $this->teamJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function teamJSON_query() {
    $table = 'team';
    $column_order = array(null, 'team_id', 'genset_total', 'genset_mobile_75', 'genset_mobile_10', 'genset_mobile_12', 'genset_fix_75', 'genset_fix_10', 'genset_fix_12', null);
    $column_search = array('team_id', 'genset_total', 'genset_mobile_75', 'genset_mobile_10', 'genset_mobile_12', 'genset_fix_75', 'genset_fix_10', 'genset_fix_12');
    $order = array('team_id' => 'asc');

    $this->db->from($table);

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

  public function countTeamDataFiltered() {
    $this->teamJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countTeamData() {
    $this->db->from('team');
    return $this->db->count_all_results();
  }

  // STAFF JSON DATA
  public function getStaffbyID($id) {
    $this->db->from('staff');
    $query = $this->db->get();
    $data = $query->row();
    if ($data->team_id != "") {
      $this->db->select('*');
      $this->db->from('staff');
      $this->db->join('team', 'staff.team_id = team.team_id');
      $this->db->where('staff.staff_id', $id);
      $d = $this->db->get();
      return $d->row();
    } else {
      return $data;
    }

    // return $query->row();
  }

  public function getAllStaff() {
    $this->db->from('staff');
    return $this->db->get();
  }

  public function getClusterData() {
    $this->db->from('cluster');
    $this->db->where('is_used', 'N');
    return $this->db->get();
  }

  public function getKendaraanData() {
    $this->db->from('kendaraan');
    $this->db->where('is_used', 'N');
    return $this->db->get();
  }

  public function saveTeam($data) {
    $insert = $this->db->insert('team', $data);
    if ($insert) {
      $kendaraan_list = $this->input->post('kendaraan');
      foreach ($kendaraan_list as $kendaraan) {
        $data = array(
          'kendaraan_id' => $kendaraan
        );
        $this->db->set('is_used', 'Y');
        $this->db->where('kendaraan_id', $kendaraan);
        $this->db->update('kendaraan');
      }
      $this->session->set_flashdata('notification', "Team berhasil dibuat!");
      redirect('/team');
    } else {
      $this->session->set_flashdata('error', "Team gagal dibuat!");
      redirect('/team');
    }
  }

  public function updateStaff($where, $data) {
    $this->db->update('staff', $data, $where);
    return $this->db->affected_rows();
  }

  public function getStaffEditbyID($id) {
    $this->db->from('staff');
    $this->db->where('stafF_id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function teamData() {
    return $this->db->get('team');
  }

  public function addToTeam($where, $data) {
    $this->db->update('staff', $data, $where);
    return $this->db->affected_rows();
  }

  public function removeStaff($where) {
    $this->db->where('staff_id', $where);
    $this->db->delete('staff');
    return $this->db->affected_rows();
  }

  public function removeTeam($where) {
    $this->db->where('team_id', $where);
    $this->db->delete('team');
    return $this->db->affected_rows();
  }

  public function deleteProgress($where) {
    $this->db->where('progress_id', $where);
    $this->db->delete('progress');
    return $this->db->affected_rows();
  }

  public function removeFromTeam($where) {
    $this->db->set('team_id', "");
    $this->db->where('staff_id', $where);
    $this->db->update('staff');
    return $this->db->affected_rows();
  }

  // public function removeStaff($where) {
  //   $this->db->where('staff_id', $where);
  //   $delete = $this->db->delete('staff');
  //
  //   if ($delete) {
  //     $this->session->set_flashdata('notification', "Staff berhasil dihapus!");
  //     redirect('/staff');
  //   } else {
  //     $this->session->set_flashdata('notification', "Staff gagal dihapus!");
  //     redirect('/staff');
  //   }
  // }

  public function getPengajuUser() {
    $this->db->from('users');
    $this->db->where_in('permission', array('APPROVAL', 'ADMIN TASIK'));
    return $this->db->get();
  }

  public function subSave($data) {
    $this->db->insert('pengajuan', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Pengajuan berhasil disubmit!");
      redirect('/submission');
    } else {
      $this->session->set_flashdata('notification', "Pengajuan gagal disubmit!");
      redirect('/submission');
    }
  }

  public function feedSave($data) {
    $this->db->insert('feedback', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Feedback berhasil disubmit!");
    } else {
      $this->session->set_flashdata('notification', "Feedback gagal disubmit!");
    }
  }

  public function evidenceSave($data) {
    $this->db->insert('evidence', $data);
    $insert = $this->db->insert_id();
  }

  public function evidenceProgressSave($data) {
    $this->db->insert('evidence_progress', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Evidence berhasil diupload!");
      redirect('/progress');
    } else {
      $this->session->set_flashdata('notification', "Evidence gagal diupload!");
      redirect('/progress');
    }
  }

  public function siteSave($data) {
    $this->db->insert('site', $data);
    $insert = $this->db->insert_id();
  }

  public function projectSave($data) {
    $this->db->insert('project', $data);
    $insert = $this->db->insert_id();
  }

  public function getEnumKategoriPengajuan() {
    $type = $this->db->query( "SHOW COLUMNS FROM pengajuan WHERE Field = 'jenis_pengajuan'" )->row( 0 )->Type;
    preg_match("/^enum\(\'(.*)\'\)$/", $type, $matches);
    $enum = explode("','", $matches[1]);
    return $enum;
  }

  // PENGAJUAN
  public function getSubJSON() {
    $this->subJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function subJSON_query() {
    $table = 'pengajuan';
    $column_order = array(null, 'pengajuan_id', 'pengajuan', 'tanggal_pengajuan', 'tanggal_approval', 'tanggal_approval_keuangan');
    $column_search = array('pengajuan_id', 'pengajuan_id', 'pengajuan');
    if (isAdminJakarta()) {
      $order = array('realisasi_pengajuan' => 'asc');
    } else {
      $order = array('tanggal_pengajuan' => 'desc');
    }

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
    }

    if ($this->input->post('belum_diapprove') != 'N') {
      $this->db->where('tanggal_approval', NULL);
    }

    if ($this->input->post('sudah_diapprove') != 'N') {
      $this->db->where('tanggal_approval !=', NULL);
    } else {
      if (isAdminJakarta()) {
        $this->db->where('tanggal_approval !=', NULL);
      }
      if (isApproval()) {
        $this->db->where('tanggal_approval', NULL);
      }
    }

    if ($this->input->post('progress_project') != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('kategori_pengajuan', 'Project');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($this->input->post('semua_pengajuan') != 'N') {
      if (!isAdminJakarta()) {
        $this->db->where('pengaju_id', $this->session->userdata('useractive_id'));
      }
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

  public function countSubDataFiltered() {
    $this->subJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countSubData() {
    $this->db->from('pengajuan');
    return $this->db->count_all_results();
  }

  public function getPengajuanByID($id) {
    $this->db->select('site_id');
    $this->db->from('pengajuan');
    $this->db->where('pengajuan_id', $id);
    $query_get_siteid = $this->db->get();
    $row = $query_get_siteid->row();

    $this->db->select('*');
    $this->db->from('pengajuan');
    $this->db->join('users', 'pengajuan.pengaju_id = users.user_id');
    if ($row->site_id != "") {
      $this->db->join('site', 'pengajuan.site_id = site.site_id');
    }
    $this->db->where('pengajuan.pengajuan_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getProgressByID($id) {
    $this->db->select('project.project_id, project.nama_project, progress.*, site.*');
    $this->db->from('progress');
    $this->db->join('project', 'progress.project_id = project.project_id');
    $this->db->join('site', 'progress.site_id = site.site_id');
    $this->db->where('progress.progress_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getEvidencebyID($id) {
    $this->db->from('pengajuan');
    $this->db->where('pengajuan_id', $id);
    $query = $this->db->get();
    $data = $query->row();
    $evidence_list = explode(',', $data->evidence_id);
    $arr = array();
    foreach ($evidence_list as $evi) {
      $this->db->from('evidence');
      $this->db->where('id_evidence', $evi);
      $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row();
    }
    return $arr;
  }

  public function getEvidenceProgressbyID($id) {
    $this->db->from('evidence_progress');
    $this->db->where('progress_id', $id);
    $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
    $evidence_q[] = $this->db->get()->result();
    return $evidence_q;
  }

  public function getEvidenceProgressbyIDDokumen($id) {
    $this->db->from('evidence_progress');
    $this->db->where('progress_id', $id);
    $this->db->where_not_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
    $evidence_q[] = $this->db->get()->result();
    return $evidence_q;
  }

  public function getEvidencebyIDDokumen($id) {
    $this->db->from('pengajuan');
    $this->db->where('pengajuan_id', $id);
    $query = $this->db->get();
    $data = $query->row();
    $evidence_list = explode(',', $data->evidence_id);
    $arr = array();
    foreach ($evidence_list as $evi) {
      $this->db->from('evidence');
      $this->db->where('id_evidence', $evi);
      $this->db->where_not_in('extension', array('png','jpg','gif','jpeg'));
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row();
    }
    return $arr;
  }

  public function accPengajuan($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function saveCBox($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function checkAll($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function accTerpilih($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function getSubPrinting() {
    $this->db->set('is_printed', 'Y');
    $this->db->set('status_admin_dmt', date('Y-m-d', time()));
    $this->db->where('is_printed', 'N');
    $this->db->where('tanggal_approval !=', NULL);
    $update = $this->db->update('pengajuan');
    if ($update) {
      $this->db->distinct();
      $this->db->select('jenis_pengajuan');
      $this->db->where('success_print', 'N');
      $data = $this->db->get('pengajuan');

      echo '
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
      <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
      <br><br>
      <table class="print-friendly">
        <thead>
          <tr>
            <td style="width:20px">#</td>
            <td style="width:70px;text-align:center"><b>ID</b></td>
            <td><b>PEKERJAAN</b></td>
            <td style="width:70px;text-align:center"><b>ID SITE</b></td>
            <td style="width:90px;text-align:center"><b>NAMA SITE</b></td>
            <td style="width:90px;text-align:center"><b>REALISASI</b></td>
            <!--<td style="width:90px;text-align:center"><b>NILAI SPH</b></td>-->
            <td style="width:90px;text-align:center"><b>NILAI CORR / SPH</b></td>
            <td style="width:90px;text-align:center"><b>NILAI PO</b></td>
            <td style="width:90px;text-align:center"><b>PENGAJUAN</b></td>
            <td style="width:120px;text-align:center"><b>KET</b></td>
          </tr>
        </thead>
      ';

      $no = 1;
      foreach ($data->result() as $row) {
        $this->db->from('pengajuan');
        $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left outer');
        $this->db->where('pengajuan.jenis_pengajuan', $row->jenis_pengajuan);
        $this->db->where('pengajuan.tanggal_approval !=', NULL);
        $this->db->where('pengajuan.success_print', 'N');
        $this->db->order_by('pengajuan.jenis_pengajuan');
        $data2 = $this->db->get();

        echo '<tbody>
          <tr style="background-color: #ccc;">
            <td valign="middle" colspan="11"><b>'.strtoupper($row->jenis_pengajuan).'</b></td>
          </tr>
        </tbody>';
        $current_cat = null;
        $nilai_sph = 0;
        $nilai_corr = 0;
        $nilai_po = 0;
        $pengajuan_total = 0;
        foreach ($data2->result() as $row2) {
          $nilai_sph+= $row2->nilai_sph;
          $nilai_corr+= $row2->nilai_corr;
          $nilai_po+= $row2->nilai_po;
          $pengajuan_total+= $row2->nilai_pengajuan;
          if ($row2->jenis_pengajuan != $current_cat) {
            $current_cat = $row2->jenis_pengajuan;
          }
          echo '
          <tbody>
            <tr>
              <td style="width:20px;">'.$no.'</td>
              <td style="width:70px;text-align:center">#ADP'.sprintf('%04d', $row2->pengajuan_id).'</td>
              <td>'.$row2->pengajuan.'</td>
              <td style="width:70px;text-align:center">'.($row2->id_site == "" ? "-" : $row2->id_site).'</td>
              <td style="width:90px;text-align:center">'.($row2->nama_site == "" ? "-" : $row2->nama_site).'</td>
              <td style="width:90px;text-align:center">'.date('d M Y', strtotime($row2->realisasi_pengajuan)).'</td>
              <!--<td style="width:90px;text-align:right">'.($row2->nilai_sph == '0' ? '' : number_format($row2->nilai_sph, '0','.','.')).'</td>-->
              <td style="width:90px;text-align:right">'.($row2->nilai_corr == '0' ? '' : number_format($row2->nilai_corr, '0','.','.')).'</td>
              <td style="width:90px;text-align:right">'.($row2->nilai_po == '0' ? '' : number_format($row2->nilai_po, '0','.','.')).'</td>
              <td style="width:90px;text-align:right">'.($row2->nilai_pengajuan == '0' ? '' : number_format($row2->nilai_pengajuan, '0','.','.')).'</td>
              <td style="width:120px;text-align:center">'.($row2->keterangan == "" ? "-" : $row2->keterangan).'</td>
            <tr>
          </tbody>';
          $no++;
          $no = $no++;
        }
        echo '<tbody>
          <tr style="background-color:#fff;">
            <td colspan="6"></td>
            <!--<td style="width:90px;text-align:right"><b>'.($nilai_sph == '0' ? '' : number_format($nilai_sph, '0','.','.')).'</b></td>-->
            <td style="width:90px;text-align:right"><b>'.($nilai_corr == '0' ? '' : number_format($nilai_corr, '0','.','.')).'</b></td>
            <td style="width:90px;text-align:right"><b>'.($nilai_po == '0' ? '' : number_format($nilai_po, '0','.','.')).'</b></td>
            <td style="width:90px;text-align:right"><b>'.($pengajuan_total == '0' ? '' : number_format($pengajuan_total, '0','.','.')).'</b></td>
            <td style="width:120px;text-align:center"></td>
          </tr>
        </tbody>';
      }
      echo '
      </table>';
      $this->db->set('success_print', 'Y');
      $this->db->where('success_print', 'N');
      $this->db->update('pengajuan');
    } else {
      echo "Something wrong";
    }

  }

  public function getSubPrintingTerpilih() {
    echo $this->uri->segment(2);
    $this->db->distinct();
    $this->db->select('jenis_pengajuan');
    if ($this->uri->segment(2) == "re-print-h") {
      $this->db->where('is_checked_h', 'Y');
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    } else {
      $this->db->where('is_checked', 'Y');
      $this->db->where('tanggal_approval_keuangan', NULL);
    }
    $data = $this->db->get('pengajuan');

    echo '
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
    <span style="float:left;font-weight: 100"> <i>Lembar Print Ulang Pengajuan Terhold</i>  </span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">#</td>
          <td style="width:50px;text-align:center"><b>ID</b></td>
          <td><b>PEKERJAAN</b></td>
          <td style="width:30px;text-align:center"><b>ID SITE</b></td>
          <td style="width:90px;text-align:center"><b>NAMA SITE</b></td>
          <td style="width:60px;text-align:center"><b>REALISASI</b></td>
          <!--<td style="width:90px;text-align:center"><b>NILAI SPH</b></td>-->
          <td style="width:90px;text-align:center"><b>NILAI CORR / SPH</b></td>
          <td style="width:90px;text-align:center"><b>NILAI PO</b></td>
          <td style="width:90px;text-align:center"><b>PENGAJUAN</b></td>
          <td style="width:120px;text-align:center"><b>KET</b></td>
        </tr>
      </thead>
    ';

    $no = 1;
    foreach ($data->result() as $row) {
      $this->db->from('pengajuan');
      $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left');
      $this->db->where('pengajuan.jenis_pengajuan', $row->jenis_pengajuan);
      $this->db->where('pengajuan.tanggal_approval !=', NULL);
      $this->db->where('pengajuan.is_printed', 'Y');
      $this->db->where('pengajuan.success_print', 'Y');
      if ($this->uri->segment(2) == "re-print-h") {
        $this->db->where('pengajuan.is_checked_h', 'Y');
        $this->db->where('pengajuan.tanggal_approval_keuangan !=', NULL);
      } else {
        $this->db->where('pengajuan.is_checked', 'Y');
        $this->db->where('pengajuan.tanggal_approval_keuangan', NULL);
      }
      $this->db->order_by('pengajuan.jenis_pengajuan');
      $data2 = $this->db->get();

      echo '<tbody>
        <tr style="background-color: #ccc;">
          <td valign="middle" colspan="14"><b>'.strtoupper($row->jenis_pengajuan).'</b></td>
        </tr>
      </tbody>';
      $current_cat = null;
      $nilai_sph = 0;
      $nilai_corr = 0;
      $nilai_po = 0;
      $pengajuan_total = 0;
      foreach ($data2->result() as $row2) {
        $nilai_sph+= $row2->nilai_sph;
        $nilai_corr+= $row2->nilai_corr;
        $nilai_po+= $row2->nilai_po;
        $pengajuan_total+= $row2->nilai_pengajuan;
        if ($row2->jenis_pengajuan != $current_cat) {
          $current_cat = $row2->jenis_pengajuan;
        }
        echo '
        <tbody>
          <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:50px;text-align:center">#ADP'.sprintf('%04d', $row2->pengajuan_id).'</td>
            <td>'.$row2->pengajuan.'</td>
            <td style="width:30px;text-align:center">'.($row2->id_site == "" ? "-" : $row2->id_site).'</td>
            <td style="width:90px;text-align:center">'.($row2->nama_site == "" ? "-" : $row2->nama_site).'</td>
            <td style="width:60px;text-align:center">'.date('d M Y', strtotime($row2->realisasi_pengajuan)).'</td>
            <!--<td style="width:90px;text-align:right">'.($row2->nilai_sph == '0' ? '' : number_format($row2->nilai_sph, '0','.','.')).'</td>-->
            <td style="width:90px;text-align:right">'.($row2->nilai_corr == '0' ? '' : number_format($row2->nilai_corr, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_po == '0' ? '' : number_format($row2->nilai_po, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_pengajuan == '0' ? '' : number_format($row2->nilai_pengajuan, '0','.','.')).'</td>
            <td style="width:120px;text-align:center">'.($row2->keterangan == "" ? "-" : $row2->keterangan).'</td>
          <tr>
        </tbody>';
        $no++;
        $no = $no++;
      }
      echo '<tbody>
        <tr style="background-color:#fff;">
          <td colspan="6"></td>
          <!--<td style="width:90px;text-align:right"><b>'.($nilai_sph == '0' ? '' : number_format($nilai_sph, '0','.','.')).'</b></td>-->
          <td style="width:90px;text-align:right"><b>'.($nilai_corr == '0' ? '' : number_format($nilai_corr, '0','.','.')).'</b></td>
          <td style="width:90px;text-align:right"><b>'.($nilai_po == '0' ? '' : number_format($nilai_po, '0','.','.')).'</b></td>
          <td style="width:90px;text-align:right"><b>'.($pengajuan_total == '0' ? '' : number_format($pengajuan_total, '0','.','.')).'</b></td>
          <td colspan="1" style="width:120px;text-align:center;"></td>
        </tr>
      </tbody>';
    }
    echo '
    </table>';
  }

  public function getReSubPrinting() {
    $this->db->distinct();
    $this->db->select('jenis_pengajuan');
    $this->db->where('tanggal_approval_keuangan', NULL);
    $data = $this->db->get('pengajuan');

    echo '
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
    <span style="float:left;font-weight: 100"> <i>Lembar Print Ulang Pengajuan Terhold</i>  </span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">#</td>
          <td style="width:50px;text-align:center"><b>ID</b></td>
          <td><b>PEKERJAAN</b></td>
          <td style="width:30px;text-align:center"><b>ID SITE</b></td>
          <td style="width:90px;text-align:center"><b>NAMA SITE</b></td>
          <td style="width:60px;text-align:center"><b>REALISASI</b></td>
          <!--<td style="width:90px;text-align:center"><b>NILAI SPH</b></td>-->
          <td style="width:90px;text-align:center"><b>NILAI CORR / SPH</b></td>
          <td style="width:90px;text-align:center"><b>NILAI PO</b></td>
          <td style="width:90px;text-align:center"><b>PENGAJUAN</b></td>
          <td style="width:120px;text-align:center"><b>KET</b></td>
        </tr>
      </thead>
    ';

    $no = 1;
    foreach ($data->result() as $row) {
      $this->db->from('pengajuan');
      $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left outer');
      $this->db->where('pengajuan.jenis_pengajuan', $row->jenis_pengajuan);
      $this->db->where('pengajuan.tanggal_approval !=', NULL);
      $this->db->where('pengajuan.is_printed', 'Y');
      $this->db->where('pengajuan.success_print', 'Y');
      $this->db->where('pengajuan.tanggal_approval_keuangan', NULL);
      $this->db->order_by('pengajuan.jenis_pengajuan');
      $data2 = $this->db->get();

      echo '<tbody>
        <tr style="background-color: #ccc;">
          <td valign="middle" colspan="14"><b>'.strtoupper($row->jenis_pengajuan).'</b></td>
        </tr>
      </tbody>';
      $current_cat = null;
      $nilai_sph = 0;
      $nilai_corr = 0;
      $nilai_po = 0;
      $pengajuan_total = 0;
      foreach ($data2->result() as $row2) {
        $nilai_sph+= $row2->nilai_sph;
        $nilai_corr+= $row2->nilai_corr;
        $nilai_po+= $row2->nilai_po;
        $pengajuan_total+= $row2->nilai_pengajuan;
        if ($row2->jenis_pengajuan != $current_cat) {
          $current_cat = $row2->jenis_pengajuan;
        }
        echo '
        <tbody>
          <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:50px;text-align:center">#ADP'.sprintf('%04d', $row2->pengajuan_id).'</td>
            <td>'.$row2->pengajuan.'</td>
            <td style="width:30px;text-align:center">'.($row2->id_site == "" ? "-" : $row2->id_site ).'</td>
            <td style="width:90px;text-align:center">'.($row2->nama_site == "" ? "-" : $row2->nama_site ).'</td>
            <td style="width:60px;text-align:center">'.date('d M Y', strtotime($row2->realisasi_pengajuan)).'</td>
            <!--<td style="width:90px;text-align:right">'.($row2->nilai_sph == '0' ? '' : number_format($row2->nilai_sph, '0','.','.')).'</td>-->
            <td style="width:90px;text-align:right">'.($row2->nilai_corr == '0' ? '' : number_format($row2->nilai_corr, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_po == '0' ? '' : number_format($row2->nilai_po, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_pengajuan == '0' ? '' : number_format($row2->nilai_pengajuan, '0','.','.')).'</td>
            <td style="width:120px;text-align:center">'.($row2->keterangan == "" ? "-" : $row2->keterangan).'</td>
          <tr>
        </tbody>';
        $no++;
        $no = $no++;
      }
      echo '<tbody>
        <tr style="background-color:#fff;">
          <td colspan="6"></td>
          <!--<td style="width:90px;text-align:right"><b>'.($nilai_sph == '0' ? '' : number_format($nilai_sph, '0','.','.')).'</b></td>-->
          <td style="width:90px;text-align:right"><b>'.($nilai_corr == '0' ? '' : number_format($nilai_corr, '0','.','.')).'</b></td>
          <td style="width:90px;text-align:right"><b>'.($nilai_po == '0' ? '' : number_format($nilai_po, '0','.','.')).'</b></td>
          <td style="width:90px;text-align:right"><b>'.($pengajuan_total == '0' ? '' : number_format($pengajuan_total, '0','.','.')).'</b></td>
          <td colspan="1" style="width:120px;text-align:center;"></td>
        </tr>
      </tbody>';
    }
    echo '
    </table>';
  }

  public function getProjectData() {
    $this->db->from('project');
    return $this->db->get();
  }

  public function getProjectDataforProgress() {
    $this->db->select('project.project_id, project.nama_project');
    $this->db->from('project');
    $this->db->join('progress', 'project.project_id = progress.project_id', 'left');
    $this->db->where('progress.project_id', NULL);
    return $this->db->get();
  }

  public function getEvidence($count) {
    $this->db->select('id_evidence');
    $this->db->from('evidence');
    $this->db->order_by('id_evidence', 'desc');
    $this->db->limit($count);
    $data = $this->db->get();
    foreach ($data->result() as $key => $value) {
      $result[] = $value->id_evidence;
    }
    return implode(",", $result);
  }

  public function getNewSiteID($id_site) {
    $this->db->select('site_id');
    $this->db->from('site');
    $this->db->where('id_site', $id_site);
    $data = $this->db->get();
    $value = $data->row();
    return $value->site_id;
  }

  public function getNewProjectID($nama_project) {
    $this->db->select('project_id');
    $this->db->from('project');
    $this->db->where('nama_project', $nama_project);
    $data = $this->db->get();
    $value = $data->row();
    return $value->project_id;
  }

  public function getNamaProject($project_id) {
    $this->db->select('nama_project');
    $this->db->from('project');
    $this->db->where('project_id', $project_id);
    $data = $this->db->get();
    $value = $data->row();
    return $value->nama_project;
  }

  public function getNilaiSPH($project_id) {
    $this->db->select('nilai_sph');
    $this->db->from('project');
    $this->db->where('project_id', $project_id);
    $data = $this->db->get();
    $value = $data->row();
    return $value->nilai_sph;
  }

  public function getNilaiCorr($project_id) {
    $this->db->select('nilai_corr');
    $this->db->from('project');
    $this->db->where('project_id', $project_id);
    $data = $this->db->get();
    $value = $data->row();
    return $value->nilai_corr;
  }

  public function getNilaiPO($project_id) {
    $this->db->select('nilai_po');
    $this->db->from('project');
    $this->db->where('project_id', $project_id);
    $data = $this->db->get();
    $value = $data->row();
    return $value->nilai_po;
  }

  public function updateProgress($where, $data) {
    $this->db->update('progress', $data, $where);
    return $this->db->affected_rows();
  }

  public function approveAll($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function approveTerpilih($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function addProgress($data) {
    $this->db->insert('progress', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Progress berhasil dibuat!");
      redirect('/progress');
    } else {
      $this->session->set_flashdata('notification', "Progress gagal dibuat!");
      redirect('/progress');
    }
  }

  public function progressData() {
    return $this->db->get('progress');
  }

  public function getProgressJSON() {
    $this->progressJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function progressJSON_query() {
    $table = 'progress';
    $column_order = array(null, 'nama_project', null);
    $column_search = array('nama_project');
    $order = array('progress_id' => 'asc');

    $this->db->from($table);
    $this->db->select('project.project_id, project.nama_project, progress.*, site.*');
    $this->db->join('project', 'progress.project_id = project.project_id');
    $this->db->join('site', 'progress.site_id = site.site_id');


    if ($this->input->post('sudah_selesai') != "N") {
      $this->db->where('progress.is_bayarclient !=', NULL);
    } else {
      $this->db->where('progress.is_bayarclient', NULL);
    }

    if ($this->input->post('belum_selesai') != "N") {
      $this->db->where('progress.is_bayarclient', NULL);
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

  public function countProgressDataFiltered() {
    $this->progressJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countProgressData() {
    $this->db->from('staff');
    return $this->db->count_all_results();
  }

  public function updateNilaiPengajuan($id, $data) {
    $this->db->update('pengajuan', $data, $id);
    return $this->db->affected_rows();
  }

  // SITE

  public function getSiteData() {
    $this->db->from('site');
    return $this->db->get();
  }

  public function getSiteJSON() {
    $this->siteJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function siteJSON_query() {
    $table = 'site';
    $column_order = array(null, 'site_id', 'id_site', 'nama_site', 'lokasi', 'keterangan_site', null);
    $column_search = array('site_id', 'id_site', 'nama_site', 'lokasi', 'keterangan_site');
    $order = array('site_id' => 'asc');

    $this->db->from($table);

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

  public function countSiteDataFiltered() {
    $this->siteJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countSiteData() {
    $this->db->from('team');
    return $this->db->count_all_results();
  }

  public function saveSite($data) {
    $insert = $this->db->insert('site', $data);
    if ($insert) {
      $this->session->set_flashdata('notification', "Site berhasil disimpan!");
      redirect('/site');
    } else {
      $this->session->set_flashdata('error', "Site gagal disimpan!");
      redirect('/site');
    }
  }

  public function getSiteEditbyID($id) {
    $this->db->from('site');
    $this->db->where('site_id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function updateSite($where, $data) {
    $this->db->update('site', $data, $where);
    return $this->db->affected_rows();
  }

  // CLUSTER
  // SITE

  public function getClusterDataJ() {
    $this->db->from('cluster');
    return $this->db->get();
  }

  public function getClusterJSON() {
    $this->clusterJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function clusterJSON_query() {
    $table = 'cluster';
    $column_order = array(null, 'cluster.homebase', 'cluster.wilayah', 'site.id_site', null);
    $column_search = array('cluster.homebase', 'cluster.wilayah', 'site.id_site');
    $order = array('cluster.cluster_id' => 'asc');

    $this->db->from($table);
    $this->db->join('site', 'cluster.site_id = site.site_id');

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

  public function countClusterDataFiltered() {
    $this->clusterJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countClusterData() {
    $this->db->from('cluster');
    return $this->db->count_all_results();
  }

  public function getClusterEditbyID($id) {
    $this->db->from('cluster');
    $this->db->where('cluster_id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  public function uploadEvidenceTransaksi($data) {
    $this->db->insert('evidence_transaksi', $data);
    $insert = $this->db->insert_id();
  }

  public function getEvidenceTransaksi($id) {
    $this->db->from('evidence_transaksi');
    $this->db->where('pengajuan_id', $id);
    $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
    $evidence_q[] = $this->db->get()->result();
    return $evidence_q;
  }

  // kendaraan
  public function getVehiclesJSON() {
    $this->vehiclesJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function vehiclesJSON_query() {
    $table = 'kendaraan';
    $column_order = array(null, 'kendaraan.nama_kendaraan', 'kendaraan.jenis_kendaraan', 'kendaraan.plat_kendaraan', null);
    $column_search = array('kendaraan.nama_kendaraan', 'kendaraan.jenis_kendaraan', 'kendaraan.plat_kendaraan');

    $this->db->from($table);
    $this->db->join('team', 'find_in_set(kendaraan.kendaraan_id, team.kendaraan_id)', 'left outer', false);
    // $this->db->query("select a.*, b.team_id from kendaraan a left outer join team b on find_in_set(a.kendaraan_id, b.kendaraan_id) order by a.kendaraan_id asc");

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

  public function countVehiclesDataFiltered() {
    $this->vehiclesJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countVehiclesData() {
    $this->db->from('cluster');
    return $this->db->count_all_results();
  }

  public function addVehicle($data) {
    $this->db->insert('kendaraan', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Data kendaraan berhasil disimpan!");
      redirect('/kendaraan');
    } else {
      $this->session->set_flashdata('notification', "Data kendaraan gagal disimpan!");
      redirect('/kendaraan');
    }
  }

  public function getTeamEditbyID($id) {
    $this->db->from('team');
    $this->db->join('cluster', 'cluster.cluster_id=team.cluster_id', 'left outer');
    $this->db->where('team.team_id', $id);
    $query = $this->db->get();

    return $query->row();
  }

  // public function getCurrentCluster($id) {
  //   $this->db->from('cluster');
  //   $this->db->where('cluster_id', $id);
  //   $query = $this->db->get();
  //
  //   return $query->row();
  // }

  public function removeSite($where) {
    $this->db->where('site_id', $where);
    $this->db->delete('site');
    return $this->db->affected_rows();
  }

  public function saveCluster($data) {
    $this->db->insert('cluster', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Cluster berhasil ditambahkan!");
      redirect('/cluster');
    } else {
      $this->session->set_flashdata('notification', "Cluster gagal ditambahkan!");
      redirect('/cluster');
    }
  }

  public function removeCluster($where) {
    $this->db->where('cluster_id', $where);
    $this->db->delete('cluster');
    return $this->db->affected_rows();
  }

  public function updateCluster($where, $data) {
    $this->db->update('cluster', $data, $where);
    return $this->db->affected_rows();
  }

  // evidence
  public function getPDocJSON() {
    $this->pdocJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function pdocJSON_query() {
    $table = 'evidence';
    $column_order = array(null, 'evidence.url', 'evidence.url', 'evidence.id_evidence', null);
    $column_search = array('evidence.url', 'evidence.url', 'evidence.id_evidence');

    $this->db->from($table);
    $this->db->join('pengajuan', 'find_in_set(evidence.id_evidence, pengajuan.evidence_id)', 'left outer', false);
    $this->db->where_not_in('evidence.extension', array('jpg', 'png', 'gif', 'jpeg'));
    $this->db->group_by('evidence.id_evidence');

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

  public function countPDocDataFiltered() {
    $this->pdocJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countPDocData() {
    $this->db->from('cluster');
    return $this->db->count_all_results();
  }

  // evidence
  public function getTDocJSON() {
    $this->tdocJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function tdocJSON_query() {
    $table = 'evidence_transaksi';
    $column_order = array(null, 'evidence_transaksi.url', 'evidence_transaksi.url', 'evidence_transaksi.id_evidence', null);
    $column_search = array('evidence_transaksi.url', 'evidence_transaksi.url', 'evidence_transaksi.id_evidence');

    $this->db->from($table);
    $this->db->join('pengajuan', 'evidence_transaksi.pengajuan_id = pengajuan.pengajuan_id', 'left outer', false);
    $this->db->where_in('evidence_transaksi.extension', array('jpg', 'png', 'gif', 'jpeg'));
    $this->db->group_by('evidence_transaksi.id_evidence');

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

  public function countTDocDataFiltered() {
    $this->tdocJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countTDocData() {
    $this->db->from('cluster');
    return $this->db->count_all_results();
  }

  public function getTeambyID($id) {
    $this->db->from('team');
    $this->db->select('team.*, cluster.homebase, cluster.wilayah, GROUP_CONCAT(kendaraan.plat_kendaraan SEPARATOR ",") as plat');
    $this->db->join('cluster', 'cluster.cluster_id = team.cluster_id');
    $this->db->join('kendaraan', 'find_in_set(kendaraan.kendaraan_id, team.kendaraan_id)', 'left outer', false);
    $this->db->where('team.team_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function printEvidences($id) {
    // $this->db->select('evidence_id','pengajuan');
    $this->db->from('pengajuan');
    $this->db->where('pengajuan_id', $id);
    $query = $this->db->get();
    $data = $query->row();
    $evidence_list = explode(',', $data->evidence_id);
    $arr = array();
    foreach ($evidence_list as $evi) {
      $this->db->select('url');
      $this->db->from('evidence');
      $this->db->where('id_evidence', $evi);
      $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row();
    }
    echo "<style>
            @media print{@page {size: landscape}}
            .image {
              display: inline-block;
              margin: 4px;
              border: 1px solid #CCCCCC;
              background-position: center center;
              background-repeat: no-repeat;
            }
            .image.size-fixed {
              width: 500px;
              height: 500px;
            }
            .image.size-fluid {
              width: 32%;
              height: 45%;
            }
            .image.scale-fit {
              background-size: contain;
            }
            .image.scale-fill {
              background-size: cover;
            }
            .image img {
              display: none;
            }
        </style>
        Evidence untuk pengajuan $data->pengajuan<br>";
    foreach ($arr as $key => $value) {
      echo "
            <div class=\"image size-fluid scale-fit\" style=\"background-image: url(".base_url('public/assets/evidence/'.$value->url).");\"><img src=\"image-1.jpg\" alt=\"Orientation: Square\"></div>
           ";
    }
  }

}
