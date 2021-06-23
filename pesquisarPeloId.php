<?php

require('config.php');

$id =  filter_input(INPUT_POST,'id',FILTER_SANITIZE_SPECIAL_CHARS);
echo "O id recebido é : $id  <br/><br/>";

$sql = $pdo->query("SELECT * FROM usuarios WHERE id=$id");

$lista=[];
if ($sql->rowCount()>0){
    $lista=$sql->fetchAll(PDO::FETCH_ASSOC);
}

$nome=$lista[0]['nome'];
$email=$lista[0]['email'];
echo "o nome é: $nome e o email é $email";
