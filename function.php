<?php

include ("conf.php");

function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM tb_to_do WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function selesai($id){
    global $data;
    global $conn;
    $id = $data[0]["id"];
    $tname = $data[0]["name_td"];
    $tdetails = $data[0]["details_td"];
    $tsubject = $data[0]["subject_td"];
    $tpriority = $data[0]["priority_td"];
    $tdeadline = $data[0]["deadline_td"];
    $tstatus = "Sudah";

    $query = "UPDATE tb_to_do SET
                name_td = '$tname',
                details_td = '$tdetails',
                subject_td = '$tsubject',
                priority_td = '$tpriority',
                deadline_td = '$tdeadline',
                status_td = '$tstatus'
                WHERE id = $id
            ";

    mysqli_query($conn, $query);
    
    return mysqli_affected_rows($conn);
}

?>