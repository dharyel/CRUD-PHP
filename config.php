<?php
$dbname = 'test';//nome do banco de dados do projeto(Ex. AmbevTechBD)
$host = 'localhost';
$login = 'root';
$pass = '';

$pdo = new PDO("mysql:dbname=$dbname;host=$host",$login,$pass);