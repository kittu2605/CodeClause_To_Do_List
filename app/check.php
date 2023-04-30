<?php

if(isset($_POST['Id'])) 
{
    require '../db_conn.php';

    $id = $_POST['Id'];
    
    if(empty($id)){
        echo 'error';
    }else {
        $todos=$conn->prepare("SELECT Id, checked FROM todos WHERE Id=?");
        $todos->execute([$id]);

        $todo = $todos->fetch();
        $uId = $todo['Id'];
        $checked = $todo['checked'];

        $uChecked=$checked ? 0 : 1;

        $res=$conn->query("UPDATE todos SET checked= $uChecked WHERE Id=$uId");

        if($res){
            echo $checked;
        }else {
            echo "error";
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
