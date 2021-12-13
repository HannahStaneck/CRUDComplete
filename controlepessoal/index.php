<!DOCTYPE html>
<?php 
include "valida.php";
include_once "conf/default.inc.php";
require_once "conf/Conexao.php";
$title = "Inicial";
$id = $_SESSION['id'];
$consulta1 = isset($_POST['consulta1']) ? $_POST['consulta1'] : "";
$procurar1 = isset($_POST['procurar1']) ? $_POST['procurar1'] : "2";
$consulta2 = isset($_POST['consulta2']) ? $_POST['consulta2'] : "";
$procurar2 = isset($_POST['procurar2']) ? $_POST['procurar2'] : "2";
$valor = 0;
$gasto = 0;
?>
?>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <title> <?php echo $title; ?> </title   >
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" type="t" href="">
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
    <br>
    <div class="row">
        <div class="col-2">
            <a href="gastos.php"><button class="btn btn-outline-danger">Adicionar gasto</button></a>
        </div>
        <div class="col-2">
            <a href="valores.php"><button class="btn btn-outline-success">Adicionar valor</button></a>
        </div>
        <div class="col-2">
            <a href="controle.php"><button class="btn btn-outline-info">Controle de caixa</button></a>
        </div>
        <br>
        <div>




            <?php 

            $pdo = Conexao::getInstance(); 
            if ($procurar1 == 1)
                $sql = "SELECT * FROM valores WHERE nome like '$consulta1%' AND usuarios_id = '$id' ORDER BY nome";
            else
                $sql = "SELECT * FROM valores WHERE valor like '$consulta1%' AND usuarios_id = '$id' ORDER BY valor";
            
            $consulta = $pdo->query($sql);
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $valor += $linha['valor'];}



            $pdo = Conexao::getInstance(); 
            if ($procurar2 == 1)
                $sql = "SELECT * FROM gastos WHERE nome like '$consulta2%' AND usuarios_id = '$id' ORDER BY nome";
            else
                $sql = "SELECT * FROM gastos WHERE gasto like '$consulta2%' AND usuarios_id = '$id' ORDER BY gasto";
            
            $consulta = $pdo->query($sql);
            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                $gasto += $linha['gasto'];
                ?>
            <?php } ?> 
            
            
                <br>
                <h5>Saldo atual: <?php echo ($valor - $gasto) >= 0 ? ($valor - $gasto) : '<span class="text-danger">Negativado</span>'; ?></h5>

           



        </div>
    </div>

</div>
</body>
</html>
