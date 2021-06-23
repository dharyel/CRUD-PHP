<?php
require 'config.php';

$name=$_POST['nome'];
$email=$_POST['email'];

$name_filtered=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
$email_filtered=filter_var($email,FILTER_SANITIZE_SPECIAL_CHARS);

if ($name && $email){
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE email =:email");
    $sql->bindValue(":email",$email);
    $sql->execute();
    
    if ($sql->rowCount() === 0){
        $sql = $pdo->prepare("INSERT INTO usuarios (nome,email) VALUES (:name, :email)");
        $sql->bindValue(":name",$name);
        $sql->bindValue(":email",$email);
        $sql->execute();

        header("Location:index.php");
        exit;
    } else{
        header("Location:adicionar.php");
        exit;
    }
    
}
else{
    header("Location:adicionar.php");
    exit;
}