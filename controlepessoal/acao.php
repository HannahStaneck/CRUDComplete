<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    $table = isset($_GET['table']) ? $_GET['table'] : '';
    $codigo = isset($_GET['codigo']) ? $_GET['codigo'] : 0;

    echo $acao;
    echo $table;
    echo $codigo;

    if ($acao == "excluir"){
        
        excluir($codigo, $table);
    }

    if ($acao == "salvar"){
        inserir($table);
    }

    if ($acao == 'editar') {
        editar($codigo, $table);
    }

    function inserir($table){
        $dados = dadosForm();
        session_start();
        $id = $_SESSION['id'];
        $pdo = Conexao::getInstance();
        $numero = $table == 'gastos' ? 'gasto' : 'valor';
        $stmt = $pdo->prepare('INSERT INTO '.$table.' (nome, '.$numero.', usuarios_id) VALUES(:nome, :'.$numero.', :usuarios_id)');
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $nome = $dados['nome'];
        $stmt->bindParam(':'.$numero.'', $numero1, PDO::PARAM_STR);
        $numero1 = $dados['numero'];
        $stmt->bindParam(':usuarios_id', $id, PDO::PARAM_INT);
        $stmt->execute();
        header("location:".$table.".php");
        
    }










    function editar($codigo, $table) {

        session_start();
        $id = $_SESSION['id'];
        $dados = dadosForm();
        $pdo = Conexao::getInstance();
        $nome = $dados['nome'];
        $numero1 = $dados['numero'];
        $numero = $table == 'gastos' ? 'gasto' : 'valor';
        $sql = "UPDATE ".$table." SET nome='$nome', ".$numero."='$numero1' WHERE id = '$codigo'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header("location:".$table.".php");



       // $pdo = Conexao::getInstance();
       // $descricao = $_POST['descricao'];
       // $qnt_ingressos = $_POST['qnt_ingressos'];
        //$data = $_POST['data'];
        //$local = $_POST['local'];
        //$preco = $_POST['preco'];
       // $sql = "UPDATE shows SET descricao='$descricao', qnt_ingressos='$qnt_ingressos', local='$local', preco='$preco' WHERE id = '$id'";
       // $stmt = $pdo->prepare($sql);
       // $stmt->execute();
        //header('location:organizador.php');













    }

    function excluir($codigo, $table){
        $pdo = Conexao::getInstance();
        $stmt = $pdo->prepare('DELETE from '.$table .' WHERE id = :codigo');
        $stmt->bindParam(':codigo', $codigoD, PDO::PARAM_INT);
        $codigoD = $codigo;
        $stmt->execute();
        header("location:controle.php");

    }

    // Busca as informações digitadas no form
    function dadosForm(){
        $dados = array();
        $dados['nome'] = $_POST['nome'];
        $dados['numero'] = $_POST['numero'];
        return $dados;
    }

?>