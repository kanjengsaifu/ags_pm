<?php


/**
 *
 */
class AppModel extends CI_Model
{

  public function __construct() {
    parent::__construct();
    $this->load->library('email');
  }

  public function totalPengajuan() {
    $this->db->from('pengajuan');
    return $this->db->count_all_results();
  }

  public function pengajuanTerhold() {
    $this->db->where('tanggal_approval !=', NULL);
    $this->db->where('tanggal_approval_akhir !=', NULL);
    $this->db->where('tanggal_approval_keuangan', NULL);
    $this->db->where('is_printed', 'Y');
    $this->db->from('pengajuan');
    return $this->db->count_all_results();
  }

  public function totalProgress() {
    $this->db->from('progress');
    return $this->db->count_all_results();
  }

  public function subjectP($id) {
    $this->db->select('subject');
    $this->db->from('progress');
    $this->db->where('progress_id', $id);
    $data = $this->db->get()->row();
    return $data->subject;
  }

  public function progressBelumSelesai() {
    $this->db->where('is_bayarclient', NULL);
    $this->db->from('progress');
    return $this->db->count_all_results();
  }

  public function progressSudahSelesai() {
    $this->db->where('is_bayarclient !=', NULL);
    $this->db->from('progress');
    return $this->db->count_all_results();
  }

  public function checkOldPassMatch($currpass) {
    $this->db->where('user_id', $this->session->useractive_id);
    $user = $this->db->get('users');
    $row = $user->row();
    if ($row->password != $currpass) {
      echo "false";
    } else {
      echo "true";
    }
  }

  public function changePassword($newpassword) {
    $update = $this->db->set('password', $newpassword);
    $this->db->where('user_id', $this->session->useractive_id);
    $update = $this->db->update('users');
    if ($update) {
      $this->session->set_flashdata('notification', "Password berhasil dirubah");
      redirect('');
    } else {
      $this->session->set_flashdata('notification', "Something went wrong");
      redirect('');
    }
  }

  public function auth_check($username, $password) {
    $this->db->where('username', $username);
    $this->db->where('password', md5($password));
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
      "dob" => ($dob != "" ? date("Y-m-d", strtotime($dob)) : NULL),
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
    $order = array('staff_id' => 'desc');

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
    $this->db->select('team.*, cluster.homebase, cluster.wilayah');
    $this->db->from('team');
    $this->db->join('cluster', 'cluster.cluster_id = team.cluster_id', 'left outer');
    return $this->db->get();
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
    $column_order = array(null, 'team.team_id', '', 'team.genset_total', 'team.genset_mobile_75', 'team.genset_mobile_10', 'team.genset_mobile_12', 'team.genset_fix_75', 'team.genset_fix_10', 'team.genset_fix_12', null);
    $column_search = array('team.team_id', '', 'team.genset_total', 'team.genset_mobile_75', 'team.genset_mobile_10', 'team.genset_mobile_12', 'team.genset_fix_75', 'team.genset_fix_10', 'team.genset_fix_12');
    $order = array('team.team_id' => 'desc');

    $this->db->from($table);
    $this->db->join('cluster', 'cluster.cluster_id = team.cluster_id', 'left outer');

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
    $this->db->join('team', 'staff.team_id = team.team_id', 'left outer');
    $this->db->where('staff.staff_id', $id);
    $query = $this->db->get();
    $data = $query->row();
    if ($data->team_id != NULL) {
      $this->db->select('*');
      $this->db->from('staff');
      $this->db->join('team', 'staff.team_id = team.team_id', 'left outer');
      $this->db->where('staff.staff_id', $id);
      return $d = $this->db->get()->row();
      // $this->db->select('team.*, cluster.homebase, cluster.wilayah');
      // $this->db->from('staff');
      // $this->db->join('team', 'staff.team_id = team.team_id', 'left outer');
      // $this->db->join('cluster', 'cluster.cluster_id = team.cluster_id', 'left outer');
      // $this->db->where('staff.staff_id', $id);
      // $this->db->where('cluster.cluster_id', $d->cluster_id);
      // return $this->db->get();
      // return $d->row();
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
    // $this->db->where('is_used', 'N');
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
    $this->db->select('team.*, cluster.homebase, cluster.wilayah');
    $this->db->from('team');
    $this->db->join('cluster', 'cluster.cluster_id = team.cluster_id', 'left outer');
    return $this->db->get();
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

  public function deletePekerjaan($where) {
    $this->db->where('pekerjaan_id', $where);
    $this->db->delete('list_pekerjaan');
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

  public function saveRemark($data) {
    $this->db->insert('remark_history', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Remark berhasil disubmit!");
      redirect('/submission');
    } else {
      $this->session->set_flashdata('notification', "Remark gagal disubmit!");
      redirect('/submission');
    }
  }

  public function subSave($data) {
    $this->db->insert('pengajuan', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      // $from_email = 'info@admaresi.com';
      // $email = array('ahmad.uji1902@gmail.com', 'alven.gultom@gmail.com');
      // $subject = 'Pengajuan Baru';
      // $message = '<style>
      //             table {
      //                 font-family: arial, sans-serif;
      //                 border-collapse: collapse;
      //                 width: 100%;
      //             }
      //
      //             td, th {
      //                 border: 1px solid #dddddd;
      //                 text-align: left;
      //                 padding: 8px;
      //             }
      //
      //             tr:nth-child(even) {
      //                 background-color: #dddddd;
      //             }
      //             </style>
      //             Dear Approval,<br /><br />
      //             Notifikasi Pengajuan Baru :<br>
      //             <table>
      //               <tr>
      //                 <td>Diajukan oleh</td>
      //                 <td>'.$this->session->userdata('name').'</td>
      //               </tr>
      //               <tr>
      //                 <td>Deskripsi Pengajuan</td>
      //                 <td>'.$data['pengajuan'].'</td>
      //               </tr>
      //               <tr>
      //                 <td>Tanggal Realisasi</td>
      //                 <td>'.$data['realisasi_pengajuan'].'</td>
      //               </tr>
      //               <tr>
      //                 <td>Nilai Pengajuan</td>
      //                 <td>'.$data['nilai_pengajuan'].'</td>
      //               </tr>
      //             </table>
      //             <br>Thanks<br />
      //             Admaresi Globalindo PT';
      // $config['protocol'] = 'smtp';
      // $config['smtp_host'] = 'ssl://mail.admaresi.com';
      // $config['smtp_timeout'] = '10';
      // $config['smtp_port'] = '465';
      // $config['smtp_user'] = $from_email;
      // $config['smtp_pass'] = 'info@Admaresi';
      // $config['mailtype'] = 'html';
      // $config['charset'] = 'iso-8859-1';
      // $config['wordwrap'] = TRUE;
      // $config['mailtype'] = 'html';
      // $config['newline'] = "\r\n";
      // $config['crlf'] = "\r\n";
      // $this->email->initialize($config);
      // $this->email->from($from_email, 'Admaresi Globalindo PT');
      // $this->email->to($email);
      // $this->email->subject($subject);
      // $this->email->message($message);
      // echo $this->email->print_debugger();
      // $this->email->send();

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
  }

  public function evidencePengajuanSave($data) {
    $this->db->insert('evidence_susulan', $data);
    $insert = $this->db->insert_id();
  }

  public function transaksiPengajuanSave($data) {
    $this->db->insert('evidence_transaksi', $data);
    $insert = $this->db->insert_id();
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
      $order = array('realisasi_pengajuan' => 'desc');
    } else {
      $order = array('tanggal_pengajuan' => 'desc');
    }

    $this->db->from($table);

    if (isApproval() && $this->session->userdata('username') != "stadmaresi") {
      $this->db->where('target_approval', $this->session->userdata('useractive_id'));
    }

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

    if (!isAdminTasik()) {
      if ($this->input->post('reject') != 'N') {
        $this->db->where('is_rejected', 'Y');
      } else {
        $this->db->where('is_rejected', 'N');
      }
    }

    if ($this->session->userdata('username') != "stadmaresi") {
      if ($this->input->post('belum_diapprove') != 'N') {
        $this->db->where('tanggal_approval', NULL);
      }

      if ($this->input->post('sudah_diapprove') != 'N') {
        $this->db->where('tanggal_approval !=', NULL);
        $this->db->where('target_approval', $this->session->userdata('useractive_id'));
      } else {
        if (isAdminJakarta()) {
          $this->db->where('tanggal_approval !=', NULL);
          $this->db->where('tanggal_approval_akhir !=', NULL);
        }
        if (isApproval()) {
          // $this->db->where('tanggal_approval', NULL);
        }
      }
    } else if ($this->session->userdata('username') == "stadmaresi") {
      if ($this->input->post('semua_pengajuan') != 'N') {

      } else if ($this->input->post('belum_diproses') != 'N') {
        $this->db->where('tanggal_approval !=', NULL);
        $this->db->where('tanggal_approval_akhir', NULL);
      } else if ($this->input->post('sudah_diproses') != 'N') {
        $this->db->where('tanggal_approval !=', NULL);
        $this->db->where('tanggal_approval_akhir !=', NULL);
      } else if ($this->input->post('belum_diapprove') != 'N') {
        $this->db->where('tanggal_approval', NULL);
        $this->db->where('target_approval', $this->session->userdata('useractive_id'));
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

  public function getApprovalName($id) {
    $this->db->from('pengajuan');
    $this->db->join('users', 'users.user_id = "'.$id.'"');
    $this->db->where('users.user_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getTargetApproval($id) {
    $this->db->from('pengajuan');
    $this->db->join('users', 'users.user_id = pengajuan.target_approval');
    $this->db->where('users.user_id', $id);
    $query = $this->db->get();
    return $query->row();
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
    $q1 = $query->row();

    $this->db->select('*');
    $this->db->from('evidence_susulan');
    $this->db->where('pengajuan_id', $id);
    $es = $this->db->get()->result_array();
    $arr = array();
    foreach ($es as $key => $value) {
      $arr[] = $value['url'];
    }
    return array('pengajuan' => $q1, 'es' => $arr);
  }

  public function getPekerjaanDetail($id) {
    $this->db->from('list_pekerjaan');
    $this->db->where('pekerjaan_id', $id);
    $query = $this->db->get();
    return $query->row();
  }

  public function getProgressByID($id) {
    $this->db->select('users.name, project.project_id, project.nama_project, progress.*, site.*');
    $this->db->from('progress');
    $this->db->join('project', 'progress.project_id = project.project_id', 'left outer');
    $this->db->join('site', 'progress.site_id = site.site_id', 'left outer');
    $this->db->join('users', 'progress.created_by = users.user_id', 'left outer');
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

  public function getEvidenceSusulanbyID($id) {
    $this->db->from('evidence_susulan');
    $this->db->where('pengajuan_id', $id);
    $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
    $evidence_q[] = $this->db->get()->result();
    return $evidence_q;
  }

  public function getEvidenceSusulanbyIDDokumen($id) {
    $this->db->from('evidence_susulan');
    $this->db->where('pengajuan_id', $id);
    $this->db->where_not_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
    $evidence_q[] = $this->db->get()->result();
    return $evidence_q;
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

  public function historyProgress($id) {
    $this->db->from('progress_history');
    $this->db->join('users', 'progress_history.updated_by = users.user_id', 'left');
    $this->db->where('progress_history.progress_id', $id);
    $this->db->order_by('progress_history.history_id', 'desc');
    $query = $this->db->get();
    echo json_encode($query->result());
  }

  public function getListPekerjaan($id) {
    $this->db->from('list_pekerjaan');
    $this->db->where('progress_id', $id);
    $query = $this->db->get();
    echo json_encode($query->result());
  }

  public function historyRemark($id) {
    $this->db->from('remark_history');
    $this->db->join('users', 'users.user_id = remark_history.remark_by', 'left');
    $this->db->where('remark_history.pengajuan_id', $id);
    $this->db->order_by('remark_history.remark_id', 'desc');
    $query = $this->db->get();
    echo json_encode($query->result());
  }

  public function accPengajuan($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function rejectPengajuan($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function saveCBox($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  // public function checkAll($where, $data) {
  //   $this->db->update('pengajuan', $data, $where);
  //   return $this->db->affected_rows();
  // }

  public function accTerpilih($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function getSubPrinting() {
    $this->db->set('is_printed', 'Y');
    $this->db->set('status_admin_dmt', date('Y-m-d', time()));
    $this->db->where('is_printed', 'N');
    $this->db->where('tanggal_approval !=', NULL);
    $this->db->where('tanggal_approval_akhir !=', NULL);
    $update = $this->db->update('pengajuan');
    if ($update) {
      $this->db->distinct();
      $this->db->select('jenis_pengajuan');
      $this->db->where('tanggal_approval_akhir !=', NULL);
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
            <td style="width:70px;text-align:center"><b>TGL</b></td>
            <td><b>PEKERJAAN</b></td>
            <td style="width:100px;text-align:center"><b>SITE</b></td>
            <td style="width:120px;text-align:center"><b>NAMA SITE</b></td>
            <td style="width:90px;text-align:center"><b>REALISASI</b></td>
            <!--<td style="width:90px;text-align:center"><b>NILAI SPH</b></td>-->
            <td style="width:90px;text-align:center"><b>NILAI CORR / SPH</b></td>
            <td style="width:90px;text-align:center"><b>NILAI PO</b></td>
            <td style="width:90px;text-align:center"><b>PENGAJUAN</b></td>

          </tr>
        </thead>
      ';

      $no = 1;
      $tot_np = 0;
      foreach ($data->result() as $row) {
        $this->db->from('pengajuan');
        $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left outer');
        $this->db->where('pengajuan.jenis_pengajuan', $row->jenis_pengajuan);
        $this->db->where('pengajuan.tanggal_approval !=', NULL);
        $this->db->where('pengajuan.tanggal_approval_akhir !=', NULL);
        $this->db->where('pengajuan.success_print', 'N');
        $this->db->order_by('pengajuan.jenis_pengajuan');
        $data2 = $this->db->get();

        echo '<tbody>
          <tr style="background-color: #ccc;">
            <td valign="middle" colspan="9"><b>'.strtoupper($row->jenis_pengajuan).'</b></td>
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
          $tot_np += $row2->nilai_pengajuan;
          if ($row2->jenis_pengajuan != $current_cat) {
            $current_cat = $row2->jenis_pengajuan;
          }
          echo '
          <tbody>
            <tr>
              <td style="width:20px;">'.$no.'</td>
              <td style="width:70px;text-align:center">'.date('d M Y', strtotime($row2->tanggal_pengajuan)).'</td>
              <td>'.$row2->pengajuan.'</td>
              <td style="width:100px;text-align:center">'.($row2->site_id != "" ? $row2->id_site . ' ' . $row2->id_site_telkom : '').'</td>
              <td style="width:90px;text-align:center">'.($row2->nama_site == "" ? "-" : $row2->nama_site).'</td>
              <td style="width:90px;text-align:center">'.date('d M Y', strtotime($row2->realisasi_pengajuan)).'</td>
              <!--<td style="width:90px;text-align:right">'.($row2->nilai_sph == '0' ? '' : number_format($row2->nilai_sph, '0','.','.')).'</td>-->
              <td style="width:90px;text-align:right">'.($row2->nilai_corr == '0' ? '' : number_format($row2->nilai_corr, '0','.','.')).'</td>
              <td style="width:90px;text-align:right">'.($row2->nilai_po == '0' ? '' : number_format($row2->nilai_po, '0','.','.')).'</td>
              <td style="width:90px;text-align:right">'.($row2->nilai_pengajuan == '0' ? '' : number_format($row2->nilai_pengajuan, '0','.','.')).'</td>

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
          </tr>
        </tbody>';
      }
      echo '
      <tbody>
        <tr style="background-color:#fff;">
          <td colspan="8">Total</td>
          <td style="width:90px;text-align:right"><b>'.($tot_np == '0' ? '' : number_format($tot_np, '0','.','.')).'</b></td>

        </tr>
      </tbody>
      </table>';
      $this->db->set('success_print', 'Y');
      $this->db->where('success_print', 'N');
      $this->db->where('tanggal_approval_akhir !=', NULL);
      $this->db->update('pengajuan');
    } else {
      echo "Something wrong";
    }

  }

  public function getSubPrintingTerpilih() {
    $this->db->distinct();
    $this->db->select('jenis_pengajuan');
    if ($this->uri->segment(2) == "re-print-h") {
      $this->db->where('is_checked_h', 'Y');
      $this->db->where('tanggal_approval_keuangan !=', NULL);
      $this->db->where('tanggal_approval_akhir !=', NULL);
    } else {
      $this->db->where('is_checked', 'Y');
      $this->db->where('tanggal_approval_keuangan', NULL);
      $this->db->where('tanggal_approval_akhir !=', NULL);
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
    <span style="float:left;font-weight: 100"> <i> '.($this->uri->segment(2) == "re-print-h" ? 'Rekap' : 'Lembar Print Ulang Pengajuan Terhold').' </i>  </span>
    <span style="float:right;font-weight: 100"> Diprint pada '.date('d/m/Y', time()).'</span>
    <br><br>
    <table class="print-friendly">
      <thead>
        <tr>
          <td style="width:20px">#</td>
          <td style="width:50px;text-align:center"><b>TGL</b></td>
          <td><b>PEKERJAAN</b></td>
          <td style="width:100px;text-align:center"><b>SITE</b></td>
          <td style="width:120px;text-align:center"><b>NAMA SITE</b></td>
          <td style="width:80px;text-align:center"><b>REALISASI</b></td>
          <!--<td style="width:90px;text-align:center"><b>NILAI SPH</b></td>-->
          <td style="width:90px;text-align:center"><b>NILAI CORR / SPH</b></td>
          <td style="width:90px;text-align:center"><b>NILAI PO</b></td>
          <td style="width:90px;text-align:center"><b>PENGAJUAN</b></td>

        </tr>
      </thead>
    ';

    $no = 1;
    $tot_np = 0;
    foreach ($data->result() as $row) {
      $this->db->from('pengajuan');
      $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left');
      $this->db->where('pengajuan.jenis_pengajuan', $row->jenis_pengajuan);
      $this->db->where('pengajuan.tanggal_approval !=', NULL);
      $this->db->where('pengajuan.tanggal_approval_akhir !=', NULL);
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
          <td valign="middle" colspan="13"><b>'.strtoupper($row->jenis_pengajuan).'</b></td>
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
        $tot_np += $row2->nilai_pengajuan;
        if ($row2->jenis_pengajuan != $current_cat) {
          $current_cat = $row2->jenis_pengajuan;
        }
        echo '
        <tbody>
          <tr>
            <td style="width:20px;">'.$no.'</td>
            <td style="width:70px;text-align:center">'.date('d M Y', strtotime($row2->tanggal_pengajuan)).'</td>
            <td>'.$row2->pengajuan.'</td>
            <td style="width:30px;text-align:center">'.($row2->site_id != "" ? $row2->id_site . ' ' . $row2->id_site_telkom : '').'</td>
            <td style="width:90px;text-align:center">'.($row2->nama_site == "" ? "-" : $row2->nama_site).'</td>
            <td style="width:60px;text-align:center">'.date('d M Y', strtotime($row2->realisasi_pengajuan)).'</td>
            <!--<td style="width:90px;text-align:right">'.($row2->nilai_sph == '0' ? '' : number_format($row2->nilai_sph, '0','.','.')).'</td>-->
            <td style="width:90px;text-align:right">'.($row2->nilai_corr == '0' ? '' : number_format($row2->nilai_corr, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_po == '0' ? '' : number_format($row2->nilai_po, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_pengajuan == '0' ? '' : number_format($row2->nilai_pengajuan, '0','.','.')).'</td>

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

        </tr>
      </tbody>';
    }
    echo '
    <tbody>
      <tr style="background-color:#fff;">
        <td colspan="8">Total</td>
        <td style="width:90px;text-align:right"><b>'.($tot_np == '0' ? '' : number_format($tot_np, '0','.','.')).'</b></td>

      </tr>
    </tbody>
    </table>';
  }

  public function getReSubPrinting() {
    $this->db->distinct();
    $this->db->select('jenis_pengajuan');
    $this->db->where('tanggal_approval_keuangan', NULL);
    $this->db->where('tanggal_approval_akhir !=', NULL);
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
          <td style="width:50px;text-align:center"><b>TGL</b></td>
          <td><b>PEKERJAAN</b></td>
          <td style="width:100px;text-align:center"><b>SITE</b></td>
          <td style="width:120px;text-align:center"><b>NAMA SITE</b></td>
          <td style="width:80px;text-align:center"><b>REALISASI</b></td>
          <!--<td style="width:90px;text-align:center"><b>NILAI SPH</b></td>-->
          <td style="width:90px;text-align:center"><b>NILAI CORR / SPH</b></td>
          <td style="width:90px;text-align:center"><b>NILAI PO</b></td>
          <td style="width:90px;text-align:center"><b>PENGAJUAN</b></td>

        </tr>
      </thead>
    ';

    $no = 1;
    $tot_np = 0;
    foreach ($data->result() as $row) {
      $this->db->select('*');
      $this->db->from('pengajuan');
      $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left outer');
      $this->db->where('pengajuan.jenis_pengajuan', $row->jenis_pengajuan);
      $this->db->where('pengajuan.tanggal_approval !=', NULL);
      $this->db->where('pengajuan.tanggal_approval_akhir !=', NULL);
      $this->db->where('pengajuan.is_printed', 'Y');
      $this->db->where('pengajuan.success_print', 'Y');
      $this->db->where('pengajuan.tanggal_approval_keuangan', NULL);
      $this->db->order_by('pengajuan.jenis_pengajuan');
      $data2 = $this->db->get();
      $dg = $data2->row();

      echo '<tbody>
        <tr style="background-color: #ccc;">
          <td valign="middle" colspan="13"><b>'.strtoupper($row->jenis_pengajuan).'</b></td>
        </tr>
      </tbody>';
      $current_cat = null;
      $nilai_sph = 0;
      $nilai_corr = 0;
      $nilai_po = 0;
      $pengajuan_total = 0;
      foreach ($data2->result() as $row2) {
        $tot_np += $row2->nilai_pengajuan;
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
            <td style="width:70px;text-align:center">'.date('d M Y', strtotime($row2->tanggal_pengajuan)).'</td>
            <td>'.$row2->pengajuan.'</td>
            <td style="width:30px;text-align:center">'.($row2->site_id != "" ? $row2->id_site . ' ' . $row2->id_site_telkom : '').'</td>
            <td style="width:90px;text-align:center">'.($row2->nama_site == "" ? "-" : $row2->nama_site ).'</td>
            <td style="width:60px;text-align:center">'.date('d M Y', strtotime($row2->realisasi_pengajuan)).'</td>
            <!--<td style="width:90px;text-align:right">'.($row2->nilai_sph == '0' ? '' : number_format($row2->nilai_sph, '0','.','.')).'</td>-->
            <td style="width:90px;text-align:right">'.($row2->nilai_corr == '0' ? '' : number_format($row2->nilai_corr, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_po == '0' ? '' : number_format($row2->nilai_po, '0','.','.')).'</td>
            <td style="width:90px;text-align:right">'.($row2->nilai_pengajuan == '0' ? '' : number_format($row2->nilai_pengajuan, '0','.','.')).'</td>

          <tr>
        </tbody>';
        $no++;
        $no = $no++;
      }
      echo '
      <tbody>
        <tr style="background-color:#fff;">
          <td colspan="6"></td>
          <!--<td style="width:90px;text-align:right"><b>'.($nilai_sph == '0' ? '' : number_format($nilai_sph, '0','.','.')).'</b></td>-->
          <td style="width:90px;text-align:right"><b>'.($nilai_corr == '0' ? '' : number_format($nilai_corr, '0','.','.')).'</b></td>
          <td style="width:90px;text-align:right"><b>'.($nilai_po == '0' ? '' : number_format($nilai_po, '0','.','.')).'</b></td>
          <td style="width:90px;text-align:right"><b>'.($pengajuan_total == '0' ? '' : number_format($pengajuan_total, '0','.','.')).'</b></td>

        </tr>
      </tbody>';
    }
    echo '
    <tbody>
      <tr style="background-color:#fff;">
        <td colspan="8">Total</td>
        <td style="width:90px;text-align:right"><b>'.($tot_np == '0' ? '' : number_format($tot_np, '0','.','.')).'</b></td>

      </tr>
    </tbody>
    </table>';
  }

  public function getProjectData() {
    $this->db->from('project');
    return $this->db->get();
  }

  public function getProjectDataforProgress() {
    $this->db->from('project');
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

  public function getNewSiteID($id_site, $id_site_telkom, $nama_site) {
    $this->db->select('site_id');
    $this->db->from('site');
    $this->db->where('id_site', $id_site);
    $this->db->where('id_site_telkom', $id_site_telkom);
    $this->db->where('nama_site', $nama_site);
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
    $update = $this->db->update('progress', $data, $where);
    if ($update) {
      $data_arr = array(
        'progress_id'               => $where['progress_id'],
        'tanggal_bapp'              => $data['tanggal_bapp'],
        'tanggal_bast'              => $data['tanggal_bast'],
        'no_bapp'                   => $data['no_bapp'],
        'no_bast'                   => $data['no_bast'],
        'no_po'                     => $data['no_po'],
        'tanggal_po'                => $data['tanggal_po'],
        'tanggal_bmhd'              => $data['tanggal_bmhd'],
        'tanggal_corr'              => $data['tanggal_corr'],
        'no_corr'                   => $data['no_corr'],
        'tanggal_kontrak'           => $data['tanggal_kontrak'],
        'tanggal_akhir_kontrak'     => $data['tanggal_akhir_kontrak'],
        'deskripsi'                 => $data['deskripsi'],
        'is_invoiced'               => $data['is_invoiced'],
        'is_bayar'                  => $data['is_bayar'],
        'is_bayarclient'            => $data['is_bayarclient'],
        'updated_by'                => $this->session->userdata('useractive_id'),
        'updated_at'                => date('Y-m-d H:i:s', time()),
        'remark'                    => $data['remark']
      );
      $this->db->insert('progress_history', $data_arr);
      return $this->db->affected_rows();
    } else {
      return $this->db->affected_rows();
    }
  }

  public function updatePekerjaan($where, $data) {
    $update = $this->db->update('list_pekerjaan', $data, $where);
    return $this->db->affected_rows();
  }

  public function editProgress($where, $data) {
    $update = $this->db->update('progress', $data, $where);
    if ($update) {
      return $this->db->affected_rows();
    } else {
      return $this->db->affected_rows();
    }
  }

  public function updateService($where, $data) {
    $updateData = array(
      'tgl_service' => $data['tgl_service']
    );
    $update = $this->db->update('kendaraan', $updateData, $where);
    if ($update) {
      $data_arr = array(
        'kendaraan_id'             => $where['kendaraan_id'],
        'tgl_service'              => $data['tgl_service'],
        'keterangan_service'       => $data['keterangan_service']
      );
      $this->db->insert('service_history', $data_arr);
      return $this->db->affected_rows();
    }
  }

  public function approveAll($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function approveTerpilih($where, $data) {
    $this->db->update('pengajuan', $data, $where);
    return $this->db->affected_rows();
  }

  public function addProgress($data, $ket) {
    $this->db->insert('progress', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $data = array();
      for ($i=0; $i < count($ket); $i++) {
        $data[$i] = array(
          'progress_id' => $insert,
          'pekerjaan'   => $ket[$i]
        );
      }
      $this->db->insert_batch('list_pekerjaan', $data);
      // echo "sukses";
      $this->session->set_flashdata('notification', "Progress berhasil dibuat!");
      redirect('/progress');
    } else {
      // echo "gagal";
      $this->session->set_flashdata('notification', "Progress gagal dibuat!");
      redirect('/progress');
    }
  }

  public function addPekerjaan($data, $id) {
    $this->db->insert('list_pekerjaan', $data);
    $insert = $this->db->insert_id();
    if ($insert) {
      $this->session->set_flashdata('notification', "Pekerjaan berhasil dibuat!");
      redirect('/progress/list/'.$id);
    } else {
      // echo "gagal";
      $this->session->set_flashdata('notification', "Pekerjaan gagal dibuat!");
      redirect('/progress/list/'.$id);
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
    $order = array('progress_id' => 'desc');

    $this->db->from($table);
    $this->db->select('project.project_id, project.nama_project, progress.*, site.*');
    $this->db->join('project', 'progress.project_id = project.project_id', 'left outer');
    $this->db->join('site', 'progress.site_id = site.site_id', 'left outer');

    if ($this->input->post('sudah_selesai') != "N") {
      $this->db->where('progress.is_bayarclient !=', NULL);
    } else {

    }

    if ($this->input->post('belum_selesai') != "N") {
      $this->db->where('progress.is_bayarclient', NULL);
    }

    if ($this->input->post('project')) {
      $this->db->where('progress.project_id', $this->input->post('project'));
    }

    if ($this->input->post('tipe_pekerjaan')) {
      $this->db->where('progress.tipe_pekerjaan', $this->input->post('tipe_pekerjaan'));
    }

    if ($this->input->post('site')) {
      $this->db->where('progress.site_id', $this->input->post('site'));
    }

    if ($this->input->post('keterangan')) {
      $this->db->where('progress.keterangan', $this->input->post('keterangan'));
    }

    if ($this->input->post('no_corr')) {
      $this->db->where('progress.no_corr', $this->input->post('no_corr'));
    }

    if ($this->input->post('no_po')) {
      $this->db->where('progress.no_po', $this->input->post('no_po'));
    }

    if ($this->input->post('nilai_corr')) {
      $this->db->where('progress.nilai_corr', $this->input->post('nilai_corr'));
    }

    if ($this->input->post('nilai_progress')) {
      $this->db->where('progress.nilai_progress', $this->input->post('nilai_progress'));
    }

    if ($this->input->post('tanggal_corr')) {
      $this->db->like('tanggal_corr', $this->input->post('tanggal_corr'));
    }

    if ($this->input->post('tanggal_corr_first')) {
      $this->db->where('DATE_FORMAT(tanggal_corr, "%Y-%m-%D") >=', $this->input->post('tanggal_corr_first'));
    }

    if ($this->input->post('tanggal_corr_last')) {
      $this->db->where('DATE_FORMAT(tanggal_corr, "%Y-%m-%D") <=', $this->input->post('tanggal_corr_last'));
    }

    if ($this->input->post('tanggal_po')) {
      $this->db->like('tanggal_po', $this->input->post('tanggal_po'));
    }

    if ($this->input->post('tanggal_po_first')) {
      $this->db->where('DATE_FORMAT(tanggal_po, "%Y-%m-%D") >=', $this->input->post('tanggal_po_first'));
    }

    if ($this->input->post('tanggal_po_last')) {
      $this->db->where('DATE_FORMAT(tanggal_po, "%Y-%m-%D") <=', $this->input->post('tanggal_po_last'));
    }

    if ($this->input->post('no_bast')) {
      $this->db->where('progress.no_bast', $this->input->post('no_bast'));
    }

    if ($this->input->post('no_bapp')) {
      $this->db->where('progress.no_bapp', $this->input->post('no_bapp'));
    }

    if ($this->input->post('tanggal_bast')) {
      $this->db->like('tanggal_bast', $this->input->post('tanggal_bast'));
    }

    if ($this->input->post('tanggal_bast_first')) {
      $this->db->where('DATE_FORMAT(tanggal_bast, "%Y-%m-%D") >=', $this->input->post('tanggal_bast_first'));
    }

    if ($this->input->post('tanggal_bast_last')) {
      $this->db->where('DATE_FORMAT(tanggal_bast, "%Y-%m-%D") <=', $this->input->post('tanggal_bast_last'));
    }

    if ($this->input->post('tanggal_bapp')) {
      $this->db->like('tanggal_bapp', $this->input->post('tanggal_bapp'));
    }

    if ($this->input->post('tanggal_bapp_first')) {
      $this->db->where('DATE_FORMAT(tanggal_bapp, "%Y-%m-%D") >=', $this->input->post('tanggal_bapp_first'));
    }

    if ($this->input->post('tanggal_bapp_last')) {
      $this->db->where('DATE_FORMAT(tanggal_bapp, "%Y-%m-%D") <=', $this->input->post('tanggal_bapp_last'));
    }

    if ($this->input->post('check_invoiced')) {
      $this->db->where('is_invoiced !=', NULL);
    }

    if ($this->input->post('check_bayar')) {
      $this->db->where('is_bayar !=', NULL);
    }

    if ($this->input->post('check_bayarclient')) {
      $this->db->where('is_bayarclient !=', NULL);
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

  // LIST
  public function getListJSON() {
    $this->listJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function listJSON_query() {
    $table = 'list_pekerjaan';
    $column_order = array(null, 'pekerjaan', null);
    $column_search = array('pekerjaan');
    $order = array('pekerjaan_id' => 'desc');

    $this->db->from($table);
    $this->db->where('progress_id', $this->uri->segment(3));

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

  public function countListDataFiltered() {
    $this->listJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countListData() {
    $this->db->from('list_pekerjaan');
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

  public function getApprovalData() {
    $this->db->from('users');
    $this->db->where('permission', 'APPROVAL');
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
    $order = array('site_id' => 'desc');

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

  public function updateKendaraan($where, $data) {
    $this->db->update('kendaraan', $data, $where);
    return $this->db->affected_rows();
  }

  public function updateTeam($where, $data) {
    $this->db->update('team', $data, $where);
    return $this->db->affected_rows();
  }

  // CLUSTER
  // SITE

  public function getAnggota($id) {
    $this->db->from('staff');
    $this->db->where('team_id', $id);
    $evidence_q = $this->db->get()->result();
    $nama = array();
    foreach ($evidence_q as $key => $value) {
      $nama[] = $value->nama;
    }
    return $nama;
  }

  public function getAnggotaTelp($id) {
    $this->db->from('staff');
    $this->db->where('team_id', $id);
    $evidence_q = $this->db->get()->result();
    $telp = array();
    foreach ($evidence_q as $key => $value) {
      $telp[] = $value->telp;
    }
    return $telp;
  }

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
    // $column_order = array(null, 'cluster.homebase', 'cluster.wilayah', 'site.id_site', null);
    // $column_search = array('cluster.homebase', 'cluster.wilayah', 'site.id_site');
    $column_order = array(null, 'cluster.homebase', 'cluster.wilayah', null);
    $column_search = array('cluster.homebase', 'cluster.wilayah');
    $order = array('cluster.cluster_id' => 'desc');

    $this->db->from($table);
    // $this->db->join('site', 'cluster.site_id = site.site_id');

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

    $this->db->select('kendaraan.*, team.team_id');
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
      if ($data['tgl_service'] != "") {
        $this->db->select('kendaraan_id');
        $this->db->from('kendaraan');
        $this->db->where('plat_kendaraan', $data['plat_kendaraan']);
        $data_kid = $this->db->get();
        $value_kid = $data_kid->row();
        $data_h = array(
          'tgl_service'         => $data['tgl_service'],
          'keterangan_service'  => $data['keterangan'],
          'kendaraan_id'        => $value_kid->kendaraan_id
        );
        $this->db->insert('service_history', $data_h);

        $this->session->set_flashdata('notification', "Data kendaraan berhasil disimpan!");
        redirect('/kendaraan');
      } else {
        $this->session->set_flashdata('notification', "Data kendaraan gagal disimpan!");
        redirect('/kendaraan');
      }
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

  public function getVehicleEditbyID($id) {
    $this->db->from('kendaraan');
    $this->db->where('kendaraan_id', $id);
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
    $this->db->from('evidence_transaksi');
    return $this->db->count_all_results();
  }

  // evidence
  public function getSPicJSON() {
    $this->spicJSON_query();
    if ($_POST['length'] != -1) {
      $this->db->limit($_POST['length'], $_POST['start']);
    }
    $query = $this->db->get();
    return $query->result();
  }

  public function spicJSON_query() {
    $table = 'pengajuan';
    $column_order = array(null, 'evidence.url', 'evidence.url', 'evidence.id_evidence', null);
    $column_search = array('evidence.url', 'evidence.url', 'evidence.id_evidence');

    $this->db->from($table);
    $this->db->join('evidence', 'find_in_set(evidence.id_evidence, pengajuan.evidence_id)', 'left outer', false);
    // $this->db->join('pengajuan', 'evidence.pengajuan_id = pengajuan.pengajuan_id', 'left outer', false);
    $this->db->where_in('evidence.extension', array('jpg', 'png', 'gif', 'jpeg'));
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

  public function countSPicDataFiltered() {
    $this->spicJSON_query();
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countSPicData() {
    $this->db->from('evidence_transaksi');
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
      $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
      $this->db->where('id_evidence', $evi);
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row();
    }

    echo "
          <body onload='window.print()'>
          <style>
            @media print{@page {size: landscape}}
            .image {
              display: inline-block;
              margin: 4px;
              background-position: center center;
              background-repeat: no-repeat;
            }
            .image.scale-fit {
              background-size: contain;
            }
            .image.scale-fill {
              background-size: cover;
            }
            .image img {
              display: none;
            }";

            switch (count(array_filter($arr))) {
              case '1':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 100%;
                    height: 90%;
                  }";
                break;
              case '2':
                  echo "
                  .image.size-fluid {
                    width: 48%;
                    height: 70%;
                  }";
                break;
              case '6':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
              default:
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
            }

    echo "</style>
        Evidence untuk pengajuan $data->pengajuan<br>";
    foreach (array_filter($arr) as $key => $value) {
      echo "
            <div class=\"image size-fluid scale-fit\" style=\"background-image: url('".base_url('public/assets/evidence/'.$value->url)."');\"><img src=".base_url('public/assets/evidence/'.$value->url)." alt=\"Orientation: Square\"></div>
           ";
    }

  }

  public function printEvidencesSusulan($id) {
    // $this->db->select('evidence_id','pengajuan');
    $this->db->from('evidence_susulan');
    $this->db->join('pengajuan', 'pengajuan.pengajuan_id = evidence_susulan.pengajuan_id', 'left outer');
    $this->db->where('evidence_susulan.pengajuan_id', $id);
    $this->db->where_in('evidence_susulan.extension', array('jpg', 'png', 'jpeg'));
    $data = $this->db->get();
    $evi_s = $data->result();
    echo "
          <body onload='window.print()'>
          <style>
            @media print{@page {size: landscape}}
            .image {
              display: inline-block;
              margin: 4px;
              background-position: center center;
              background-repeat: no-repeat;
            }
            .image.scale-fit {
              background-size: contain;
            }
            .image.scale-fill {
              background-size: cover;
            }
            .image img {
              display: none;
            }";

            switch ($data->num_rows()) {
              case '1':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 100%;
                    height: 90%;
                  }";
                break;
              case '2':
                  echo "
                  .image.size-fluid {
                    width: 48%;
                    height: 70%;
                  }";
                break;
              case '6':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
              default:
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
            }

    echo "</style>
        Evidence susulan untuk pengajuan ".$data->row()->pengajuan."<br>";
    foreach ($evi_s as $key => $value) {
      echo "
            <div class=\"image size-fluid scale-fit\" style=\"background-image: url('".base_url('public/assets/evidence/'.$value->url)."');\"><img src=".base_url('public/assets/evidence/'.$value->url)." alt=\"Orientation: Square\"></div>
           ";
    }
  }

  public function printEvidencesTransaksi($id) {
    // $this->db->select('evidence_id','pengajuan');
    $this->db->from('evidence_transaksi');
    $this->db->join('pengajuan', 'pengajuan.pengajuan_id = evidence_transaksi.pengajuan_id', 'left outer');
    $this->db->where('evidence_transaksi.pengajuan_id', $id);
    $this->db->where_in('evidence_transaksi.extension', array('jpg', 'png', 'jpeg'));
    $data = $this->db->get();
    $evi_s = $data->result();
    echo "
          <body onload='window.print()'>
          <style>
            @media print{@page {size: landscape}}
            .image {
              display: inline-block;
              margin: 4px;
              background-position: center center;
              background-repeat: no-repeat;
            }
            .image.scale-fit {
              background-size: contain;
            }
            .image.scale-fill {
              background-size: cover;
            }
            .image img {
              display: none;
            }";

            switch ($data->num_rows()) {
              case '1':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 100%;
                    height: 90%;
                  }";
                break;
              case '2':
                  echo "
                  .image.size-fluid {
                    width: 48%;
                    height: 70%;
                  }";
                break;
              case '6':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
              default:
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
            }

    echo "</style>
        Evidence trnsaksi untuk pengajuan ".$data->row()->pengajuan."<br>";
    foreach ($evi_s as $key => $value) {
      echo "
            <div class=\"image size-fluid scale-fit\" style=\"background-image: url('".base_url('public/assets/evidence/transaksi/'.$value->url)."');\"><img src=".base_url('public/assets/evidence/transaksi/'.$value->url)." alt=\"Orientation: Square\"></div>
           ";
    }
  }

  public function printEvidencesBoth($id) {
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
      $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
      $this->db->where('id_evidence', $evi);
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row()->url;
    }


    $this->db->from('evidence_susulan');
    $this->db->where('pengajuan_id', $id);
    $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
    $data2 = $this->db->get();
    $evi_s = $data2->result();
    foreach ($evi_s as $key => $value) {
      $arr[] = $value->url;
    }

    echo "
          <body onload='window.print()'>
          <style>
            @media print{@page {size: landscape}}
            .image {
              display: inline-block;
              margin: 4px;
              background-position: center center;
              background-repeat: no-repeat;
            }
            .image.scale-fit {
              background-size: contain;
            }
            .image.scale-fill {
              background-size: cover;
            }
            .image img {
              display: none;
            }";

            switch (count(array_filter($arr))) {
              case '1':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 100%;
                    height: 90%;
                  }";
                break;
              case '2':
                  echo "
                  .image.size-fluid {
                    width: 48%;
                    height: 70%;
                  }";
                break;
              case '6':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
              default:
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
            }

    echo "</style>
        Evidence untuk pengajuan $data->pengajuan<br>";
    foreach (array_filter($arr) as $key => $value) {
      echo "
            <div class=\"image size-fluid scale-fit\" style=\"background-image: url('".base_url('public/assets/evidence/'.$value)."');\"><img src=".base_url('public/assets/evidence/'.$value)." alt=\"Orientation: Square\"></div>
           ";
    }

  }

  public function printEvidencesSekaligus() {
    $this->db->select("GROUP_CONCAT(evidence_id) as evidence_id");
    $this->db->from('pengajuan');
    // $this->db->where('pengajuan_id', $id);
    $this->db->where('is_printed', 'N');
    $this->db->where('success_print', 'N');
    $this->db->where('status_admin_dmt', NULL);
    $this->db->where('tanggal_approval_keuangan', NULL);
    $query = $this->db->get();
    $data = $query->row();
    $evidence_list = explode(',', $data->evidence_id);

    $arr = array();
    foreach ($evidence_list as $evi) {
      $this->db->from('evidence');
      $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
      $this->db->where('id_evidence', $evi);
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row();
    }


    $this->db->from('evidence_susulan');
    $this->db->join('pengajuan', 'pengajuan.pengajuan_id = evidence_susulan.pengajuan_id', 'left outer');
    $this->db->where('pengajuan.is_printed', 'N');
    $this->db->where('pengajuan.success_print', 'N');
    $this->db->where('pengajuan.status_admin_dmt', NULL);
    $this->db->where('pengajuan.tanggal_approval_keuangan', NULL);
    $this->db->where_in('evidence_susulan.extension', array('jpg', 'png', 'gif', 'jpeg'));
    $data2 = $this->db->get();
    $evi_s = $data2->result();
    foreach ($evi_s as $key => $value) {
      $arr[] = $value;
    }

    echo "
          <body onload='window.print()'>
          <style>
            @media print{@page {size: landscape}}
            .image {
              display: inline-block;
              margin: 4px;
              background-position: center center;
              background-repeat: no-repeat;
            }
            .image.scale-fit {
              background-size: contain;
            }
            .image.scale-fill {
              background-size: cover;
            }
            .image img {
              display: none;
            }";

            switch (count(array_filter($arr))) {
              case '1':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 100%;
                    height: 90%;
                  }";
                break;
              case '2':
                  echo "
                  .image.size-fluid {
                    width: 48%;
                    height: 70%;
                  }";
                break;
              case '3':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 48%;
                    height: 45%;
                  }";
                break;
              case '4':
                  echo "
                  @media print{@page {size: portrait}}
                  .image.size-fluid {
                    width: 48%;
                    height: 45%;
                  }";
                break;
              case '5':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
              case '6':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 45%;
                  }";
                break;
              case '7':
                  echo ".image.size-fluid {
                    width: 32%;
                    height: 30%;
                  }";
                break;
              case '8':
                  echo ".image.size-fluid {
                    width: 23%;
                    height: 45%;
                  }";
                break;
              default:
                  echo ".image.size-fluid {
                    width: 22%;
                    height: 23%;
                  }";
                break;
            }
    echo "</style>";
    foreach (array_filter($arr) as $key => $value) {
      echo "
            <div class=\"image size-fluid scale-fit\" style=\"background-image: url('".base_url('public/assets/evidence/'.$value->url)."');\"><img src=".base_url('public/assets/evidence/'.$value->url)." alt=\"Orientation: Square\">
            <!--<br>
            ".substr($value->url, "14")."--></div>
           ";
    }
  }

  public function checkAll($data) {
    $this->db->where('tanggal_approval !=', NULL);
    $this->db->where('tanggal_approval_akhir !=', NULL);
    $this->db->where('status_admin_dmt !=', NULL);
    // $this->db->where('tanggal_approval_keuangan', NULL);
    $this->db->where('is_printed', 'Y');
    $this->db->where('success_print', 'Y');
    $this->db->update('pengajuan', $data);
    return $this->db->affected_rows();
  }

  public function hCheckAll($data) {
    $this->db->where('tanggal_approval !=', NULL);
    $this->db->where('tanggal_approval_akhir !=', NULL);
    $this->db->where('status_admin_dmt !=', NULL);
    $this->db->where('tanggal_approval_keuangan !=', NULL);
    $this->db->where('is_printed', 'Y');
    $this->db->where('success_print', 'Y');
    $this->db->update('pengajuan', $data);
    return $this->db->affected_rows();
  }

  public function getImages($id) {
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
      $this->db->where_in('extension', array('jpg', 'png', 'gif', 'jpeg'));
      $this->db->where('id_evidence', $evi);
      $queryvi = $this->db->get();
      $arr[] = $queryvi->row();
    }
    foreach (array_filter($arr) as $key => $value) {
      return '<a href="'.base_url('public/assets/evidence/'.$value->url).'" data-ngthumb="'.base_url('public/assets/evidence/'.$value->url).'">Title Image1</a>';
    }
  }

  public function exportExcel($data) {
    $this->load->library('Excel');
    $this->excel->setActiveSheetIndex(0);

    // $this->excel->getActiveSheet()->setTitle('test worksheet');

    $this->db->from('pengajuan');
    // $this->db->join('site', 'pengajuan.site_id = site.site_id', 'left');

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
      $this->db->where('tanggal_approval !=', NULL);
    }

    if ($data['progress_project'] != 'N') {
      $this->db->where('is_printed', 'Y');
      $this->db->where('success_print', 'Y');
      $this->db->where('kategori_pengajuan', 'Project');
      $this->db->where('status_admin_dmt !=', NULL);
      $this->db->where('tanggal_approval_keuangan !=', NULL);
    }

    if ($data['semua_pengajuan'] != 'N') {
    }

    if ($data['belum_diapprove'] != 'N') {
      $this->db->where('tanggal_approval', NULL);
      $this->db->where('is_printed', 'N');
    }

    if ($data['sudah_diapprove'] != 'N') {
      $this->db->where('tanggal_approval !=', NULL);
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

    $this->excel->getActiveSheet()->setCellValue("A1", "No");
    $this->excel->getActiveSheet()->setCellValue("B1", "Tanggal");
    $this->excel->getActiveSheet()->setCellValue("C1", "Keterangan");
    $this->excel->getActiveSheet()->setCellValue("D1", "Nilai");

    $no = 2;
    $angka = 1;
    foreach ($row as $key => $value)
    {
      $this->excel->getActiveSheet()->setCellValue("A$no", $angka)
      ->setCellValue("B$no", ($value->tanggal_pengajuan != NULL ? date('d-m-Y', strtotime($value->tanggal_pengajuan)) : "-"))
      ->setCellValue("C$no", ($value->pengajuan != NULL ? $value->pengajuan : "-"))
      ->setCellValue("D$no", ($value->nilai_pengajuan != NULL ? $value->nilai_pengajuan : "-"));
      $no++;
      $angka++;
    }

    $filename = 'exported_data.xls';
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'.$filename.'"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
    echo "<script>window.close();</script>";
  }

}
