<!DOCTYPE html>
<?php
include "valida.php";
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$acao = isset($_GET['acao']) ? $_GET['acao'] : "salvar";
$table = isset($_GET['table']) ? $_GET['table'] : '';
$id = isset($_GET['codigo']) ? $_GET['codigo'] : '';

if ($acao == 'editar') {
        $pdo = Conexao::getInstance();
        
        $consulta = $pdo->query("SELECT * FROM gastos WHERE id = '$id'");
        
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $valor = $linha['gasto'];
            $nome = $linha['nome'];
          

        
        }
    } else {
        $valor = '';
        $nome = '';
      
    }
?>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<br>
<br><br>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h4>Bem vindo <?php echo $_SESSION['nome']; ?></h4>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-1">
            <a href="index.php"><button class="btn btn-outline-secondary">Voltar</button></a>
        </div>
    </div>
</div>
<div class="container">
    <form <?php echo 'action="acao.php?table=gastos&acao='.$acao.'&codigo='.$id.'"'; ?> method="post">
        <input readonly  type="hidden" name="codigo" id="codigo"><br>
        <div class="row">
            <div class="col-3">
                <label class="form-label" for="nome">Nome</label>
                <input class="form-control" required=true type="text" name="nome" id="nome" <?php echo 'value="'.$nome.'"'; ?>>
            </div>
        </div>
        <div class="row">
            <div class="col-3">
                <label class="form-label" for="numero">Gasto</label>
                <input class="form-control" required=true type="text" name="numero" id="numero" <?php echo 'value="'.$valor.'"'; ?>>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-2">
               <button class="btn btn-outline-success" type="submit" name="acao" id="acao" >Salvar</button>
            </div>
        </div>
    </form>
</div>
</body>
</html>