<?php

if(isset($_POST['Id'])) 
{
    require '../db_conn.php';

    $id = $_POST['Id'];
    
    //echo $title;

    if(empty($id)){
        echo 0;
    }else {
        $stmt = $conn->prepare("DELETE FROM todos WHERE Id=?");
        $res = $stmt->execute([$id]);

        if($res){
            echo 1;
        }else{
            echo 0;
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
