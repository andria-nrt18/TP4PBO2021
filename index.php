<?php

include("conf.php");
include("function.php");
include("includes/Template.class.php");
include("includes/DB.class.php");
include("includes/Task.class.php");

// $otask = mysqli_otask$otaskect("localhost", "root", "", "db_task");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method getTask di kelas Task
$otask->getTask();

// Proses mengisi tabel dengan data
$data = null;
$no = 1;


while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='hapus.php?id=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success'><a href='selesai.php?id=" . $id .  "' style='color: white; font-weight: bold;' >Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

if(isset($_POST["add"])){
	$tname = $_POST["tname"];
	$tdetails = $_POST["tdetails"];
	$tsubject = $_POST["tsubject"];
	$tpriority = $_POST["tpriority"];
	$tdeadline = $_POST["tdeadline"];

	$query = "INSERT INTO tb_to_do VALUES 
	('', '$tname', '$tdetails', '$tsubject', '$tpriority', '$tdeadline', 'Sudah')";

	mysqli_query($conn, $query);
	header('Location:index.php');
}



// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();