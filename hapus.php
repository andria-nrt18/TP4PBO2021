<?php

require 'function.php';

$id = $_GET["id"];

if(hapus($id)>0){
    echo "
        <script>
            alert('berhasil dihapus');
        <script>
    ";
    header('Location:index.php');
}
else{
    echo "
        <script>
            alert('gagal dihapus');
        <script>
    ";
    header('Location:index.php');
}

    


?>