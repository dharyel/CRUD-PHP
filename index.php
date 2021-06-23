<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<?php
require('config.php');

$itens_por_pagina = 4; //quantidade máxima de itens que aparecerá na página
$itens_por_linha = 2; //quantidade máxima de itens na linha(um ao lado de outro)
$paginaAtual = 0;//variável para guardar a página atual

if (isset($_GET['pagina'])) $paginaAtual = intval($_GET['pagina']);

$dadoInicial = $itens_por_pagina;
if ($dadoInicial>0) $dadoInicial = $itens_por_pagina * $paginaAtual;

$lista = [];
$sql = $pdo->query("select id,nome,email,foto from usuarios LIMIT $dadoInicial, $itens_por_pagina");//SELECT * FROM usuarios");

if ($sql->rowCount()>0){
    $lista=$sql->fetchAll(PDO::FETCH_ASSOC);
}

$total_num = 0;
$sql = $pdo->query("SELECT id FROM usuarios");
if ($sql->rowCount()>0){
    $total_num = ($sql->rowCount())-1;
} 

$total_paginas = ceil($total_num/$itens_por_pagina);

$x = $itens_por_linha;

for ($i=0;$i<$itens_por_pagina;$i++)
{
    if ($i <= (count($lista)-1)){//verificação para evitar que seja buscado um index inexistente
        $foto = $lista[$i]['foto'];
        $id = $lista[$i]['id'];
        $nome = $lista[$i]['nome'];
       
        ?>
        <style>
            .imgBook{width:150px; height:200px; object-fit:cover; border:3px solid black;cursor:pointer;}

            form div{display:flex;flex-direction: column;justify-content:center;align-items:center;
            }

            form{display:inline-flex;}
        </style>
        
        <form method='POST' action='pesquisarPeloId.php'>
        <div>
                <button class="btn"  value=<?=$nome?> >
                <input hidden name="id" value=<?=$id?> >
                    <img src=<?=$foto?> class="imgBook" title="NOME: <?=$nome?>"> 
                    </img>
                </input>
                </button>
        </div>
        </form>
        
        
        <?php

        
        while ($x-1 <= $i)
        {
            $x+=$itens_por_linha;
            echo "<br/>";
        }
       
    }
}

if (isset($_POST['id'])) $idSelecionado =  $_POST['id'];

if (isset($idSelecionado)) echo "<br/><br/> O id selecionado é : $idSelecionado";

?>

<nav aria-label="Navegação de página exemplo">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="index.php?pagina=<?php if($paginaAtual-1 >=0) echo $paginaAtual-1; else echo '0';  ?>">Anterior</a></li>

    <?php for ($i=0;$i<$total_paginas;$i++){
        $classe = '';
        
        if ($paginaAtual == $i) $classe = 'page-item active';
    ?>
        <li class="<?=$classe?>" ><a class="page-link" href="index.php?pagina=<?= $i ?>" ><?= $i ?></a></li>
    <?php } ?>

    <li class="page-item"><a class="page-link" href="index.php?pagina=<?php if($paginaAtual+1 < $total_paginas) echo $paginaAtual+1; else echo $total_paginas-1; ?>">Próximo</a></li>
  </ul>
</nav>

<a href='adicionar.php'>ADICIONAR USUÁRIO</a>

<table border='1' width='100%'>
    <tr>
        <th>ID</th>
        <th>NOME</th>
        <th>E-MAIL</th>
        <th>AÇÕES</th>
    </tr>

    <?php
        foreach ($lista as $usuario): ?>
        <tr>
            <td><?php echo $usuario['id'];?></td>
            <td><?php echo $usuario['nome'];?></td>
            <td><?php echo $usuario['email'];?></td>
            <td>
                <a href="editar.php?id=<?php echo $usuario['id']?>" >(EDITAR)</a>
                <a href="excluir.php?id=<?php echo $usuario['id']?>" onclick="return confirm('deseja realmente excluir?');">(EXCLUIR)</a>
            </td>
        </tr>
    <?php endforeach;?>
</table>

