<?php
if(isset($_POST["title"])) 
{
    require '../db_conn.php';

    $title = $_POST["title"];
    
    echo $title;

    if(empty($title)){
        header("Location: ../index.php?mess=error");
    }else {
        //we need to update the id 
        //to do so 
        //we will fetch the database rows
        $todos = $conn->query("SELECT * FROM todos ORDER BY id DESC");
        $todo = $todos->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("INSERT INTO todos(Id, title) VALUE(?,?)");
        $res = $stmt->execute([$todo['Id']+1,$title]);

        if($res){
            header("Location: ../index.php?mess=success");
        }else{
            header("Location: ../index.php");
        }
        $conn = null;
        exit();
    }
}else {
    header("Location: ../index.php?mess=error");
}
