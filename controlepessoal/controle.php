<!DOCTYPE html>
<?php 
include "valida.php";
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$title = "Tabela";
$id = $_SESSION['id'];
$consulta1 = isset($_POST['consulta1']) ? $_POST['consulta1'] : "";
$procurar1 = isset($_POST['procurar1']) ? $_POST['procurar1'] : "2";
$consulta2 = isset($_POST['consulta2']) ? $_POST['consulta2'] : "";
$procurar2 = isset($_POST['procurar2']) ? $_POST['procurar2'] : "2";
$valor = 0;
$gasto = 0;
?>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title   >
    <link rel="stylesheet" href="css/estilo.css">
    <script>
        function excluirRegistro(url) {
            if (confirm("Confirmar Exclusão?"))
                location.href = url; 
        }
    </script>
</head>
<body>
    <br>
<div class="container">
    <div class="row">
        <div class="col-1">
            <a href="acaoLogin.php?acao=logoff"><button class="btn btn-outline-danger">Logoff</button></a>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-12">
            <h4>Bem vindo <?php echo $_SESSION['nome']; ?></h4>

        </div>
    </div>
    <div class="row">
        <div class="col-1">
            <a href="index.php"><button class="btn btn-outline-secondary">Voltar</button></a>
        </div>
    </div>
        
    <br><br>
    <form method="post">
        <div class="row">

            <div class="col-2">
                <input class="form-check-input" type="radio" id="produto" name="procurar1" value="1" <?php if ($procurar1 == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="produto">Nome</label>
            </div>
            <div class="col-2">
                <input class="form-check-input" type="radio" id="validade" name="procurar1" value="2" <?php if ($procurar1 == 2) echo 'checked'; ?>>
                <label class="form-check-label" for="validade">Valor</label>
            </div>

            <div class="col-2 offset-3">
                <input class="form-check-input" type="radio" id="produto" name="procurar2" value="1" <?php if ($procurar2 == 1) echo 'checked'; ?>>
                <label class="form-check-label" for="produto">Nome</label>
            </div>
            <div class="col-2">
                <input class="form-check-input" type="radio" id="validade" name="procurar2" value="2" <?php if ($procurar2 == 2) echo 'checked'; ?>>
                <label class="form-check-label" for="validade">Gasto</label>
            </div>

        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <input class="form-control" type="text" name="consulta1" id="consulta1" value="<?php echo $consulta1; ?>">
            </div>
            <div class="col-4 offset-3">
                <input class="form-control" type="text" name="consulta2" id="consulta2" value="<?php echo $consulta2; ?>">
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-4">
                <input class="btn btn-outline-info" type="submit" value="Pesquisar">
            </div>
            <div class="col-4 offset-3">
                <input class="btn btn-outline-info" type="submit" value="Pesquisar">
            </div>
        </div>
    </form>
</div>
<br>
<div class="container">
    <div class="row">
        <div class="col-6">
            <table class="table table-striped">
               <tr><th>Código</th>
                <th>Nome</th>
                <th>Valor</th>
                <th>Excluir</th> 
                <th>Editar</th>
            </tr>
            <?php 
            $pdo = Conexao::getInstance(); 
            if ($procurar1 == 1)
                $sql = "SELECT * FROM valores WHERE nome like '$consulta1%' AND usuarios_id = '$id' ORDER BY nome";
            else
                $sql = "SELECT * FROM valores WHERE valor like '$consulta1%' AND usuarios_id = '$id' ORDER BY valor";
            
            $consulta = $pdo->query($sql);
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $valor += $linha['valor'];
                ?>
                <tr><td><?php echo $linha['id'];?></td>
                    <td><?php echo $linha['nome'];?></td>
                    <td>R$<?php echo $linha['valor'];?></td>
                    <td><a href="acao.php?acao=excluir&codigo=<?php echo $linha['id'];?>&table=valores">Excluir</a></td>
                    <td><a href='valores.php?acao=editar&codigo=<?php echo $linha['id'];?>&table=valores'>Editar</a></td>
                </tr>

            <?php } ?>       
            </table>
        </div>

        <div class="col-6">
            <table class="table table-striped">
               <tr><th>Código</th>
                <th>Nome</th>
                <th>Gasto</th>
                <th>Excluir</th> 
                 <th>Editar</th>
            </tr>
            <?php 
            $pdo = Conexao::getInstance(); 
            if ($procurar2 == 1)
                $sql = "SELECT * FROM gastos WHERE nome like '$consulta2%' AND usuarios_id = '$id' ORDER BY nome";
            else
                $sql = "SELECT * FROM gastos WHERE gasto like '$consulta2%' AND usuarios_id = '$id' ORDER BY gasto";
            
            $consulta = $pdo->query($sql);
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $gasto += $linha['gasto'];
                ?>
                <tr><td><?php echo $linha['id'];?></td>
                    <td><?php echo $linha['nome'];?></td>
                    <td>R$<?php echo $linha['gasto'];?></td>
                    <td><a href="acao.php?acao=excluir&codigo=<?php echo $linha['id'];?>&table=gastos">Excluir</a></td>
                    <td><a href='gastos.php?acao=editar&codigo=<?php echo $linha['id'];?>&table=gastos'>Editar</a></td>
                </tr>
            <?php } ?>       
            </table>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <h5>Entrada: <?php echo $valor; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h5>Saída: <?php echo $gasto; ?></h5>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <h5>Saldo atual: <?php echo ($valor - $gasto) >= 0 ? ($valor - $gasto) : '<span class="text-danger">Negativado</span>'; ?></h5>
            </div>
        </div>
    </div>
</div>
</body>
</html>
