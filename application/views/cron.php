<?php


$conn = new mysqli("localhost", "root", "", "ag_pekerjaan");
if ($conn->connect_errno) {
  echo "Something went wrong";
}

$today = date('Y-m-d', time());
$due_date = "1";

$dd_submission = $conn->query("SELECT
                    pengajuan_id
                  , pengajuan
                  , realisasi_pengajuan
                  FROM pengajuan
                  WHERE
                  tanggal_approval is null and
                  realisasi_pengajuan >= CURDATE() and realisasi_pengajuan <= CURDATE()+1");
$message = '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.css">
      <div>
        <img src="http://admaresi.com/img/admaresi.png" style="width:50px;">
      </div>
      <br>
      Pengingat approval Pengajuan, berikut list realisasi pengajuan hari ini :
      <br><br>
      <table class="table" style="width:600px;">
        <thead>
          <th>#</th>
          <th>Pengajuan ID</td>
          <th>Deskripsi</td>
          <th>Tanggal Realiasi Pengajuan</td>
        </thead>
        <tbody>';
$no = 1;
while ($row = $dd_submission->fetch_assoc()) {
  $message .= "<td style='text-align:left'>$no</td>";
  $message .= "<td style='text-align:center'>#ADP".$row['pengajuan_id']."</td>";
  $message .= "<td style='text-align:center'>".$row['pengajuan']."</td>";
  $message .= "<td style='text-align:right'>".$row['realisasi_pengajuan']."</td>";
  $no++;
}
$message .= '</tbody></table>';

$email = "ahmad.uji1902@gmail.com";
$subject = "Approval Reminder";

mail($email, $subject, $message, "From:" . "AdmaresiBOT");


?>
