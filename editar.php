<?php
require('config.php');

$info = [];
$id=filter_input(INPUT_GET,'id');

if ($id)
{
    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
    $sql->bindValue(":id", $id);
    $sql->execute();

    if ($sql->rowCount()>0){
        $info = $sql->fetch(PDO::FETCH_ASSOC);
        //FETCH pega o único item
    }else{
        header("Location: index.php");
    }
}else{
    header("Location: index.php");
}
?>

<h1>Editar usuário</h1>

<form method='POST' action="editar_action.php">

<input type='hidden' name='id' value="<?php echo $info['id'] ?>" />

<label>
        Nome:<br />
        <input type='text' name='nome' placeholder="Insira o nome..." value="<?php echo $info['nome'] ?>"/>
    </label>

    <br/><br/>

    <label>
        E-mail:<br />
        <input type='text' name='email' placeholder="Insira o e-mail..." value="<?php echo $info['email'] ?>"/>
    </label>

    <input type='submit' value="Editar usuário" />
</form>