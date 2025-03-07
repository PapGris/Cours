<?php

try {
    $db=new PDO("mysql:host=localhost;dbname=ajax;charset=utf8","root","");
} catch (Exception $e) {
    die($e->getMessage());
}

$result=["status"=>"fail","data"=>""];
if(isset($_POST['pseudo'])){
    $stmt=$db->prepare("SELECT*FROM table_user WHERE user_pseudo = :pseudo");
    $stmt->bindValue("pseudo",$_POST['pseudo']);
    $stmt->execute();
    if($row=$stmt->fetch()){
        $result["data"]=$row;
        $result["status"]="succes";
    }
}
echo json_encode($result,JSON_PRETTY_PRINT);
