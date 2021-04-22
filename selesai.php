<?php
require 'function.php';
require 'conf.php';

$id = $_GET["id"];

$data = query("SELECT * FROM tb_to_do WHERE id = $id");
var_dump($data["status_td"]);

if(selesai($id)>0){
    echo "
    <script>
        alert('Telah Selesai');
    <script>
";
header('Location:index.php');
}
else{
    echo "Error";
    // header('Location:index.php');
}

?>