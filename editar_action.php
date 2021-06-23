<?php
require 'config.php';

$id = filter_input(INPUT_POST,'id');
$name=$_POST['nome'];
$email=$_POST['email'];

$id_filtered=filter_var($id,FILTER_SANITIZE_SPECIAL_CHARS);
$name_filtered=filter_var($name,FILTER_SANITIZE_SPECIAL_CHARS);
$email_filtered=filter_var($email,FILTER_SANITIZE_SPECIAL_CHARS);

if ($id_filtered && $name_filtered && $email_filtered){
    $sql = $pdo->prepare("UPDATE usuarios SET nome = :name , email = :email WHERE id = :id");
    
    $sql->bindValue(':name',$name_filtered);
    $sql->bindValue(':email',$email_filtered);
    $sql->bindValue(':id',$id_filtered);
    
    
    $sql->execute();

    header("Location:index.php");
    exit;
}
else{
    header("Location:editar.php");
    exit;
}