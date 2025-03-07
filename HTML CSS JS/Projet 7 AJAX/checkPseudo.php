<?php

try {
    $db=new PDO("mysql:host=localhost;dbname=ajax;charset=utf8","root","");
} catch (Exception $e) {
    die($e->getMessage());
}

$result="oui";
if(isset($_POST['pseudo'])){
    $stmt=$db->prepare("SELECT user_pseudo FROM table_user WHERE user_pseudo = :pseudo");
    $stmt->bindValue("pseudo",$_POST['pseudo']);
    $stmt->execute();
    if($stmt->fetch()){
        $result="non";
    }
}
echo $result;