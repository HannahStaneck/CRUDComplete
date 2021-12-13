<?php

    include_once "conf/default.inc.php";
    require_once "conf/Conexao.php";

    $acao = isset($_GET['acao']) ? $_GET['acao'] : "";
    if ($acao == "logoff"){
        session_start();
		session_destroy();
		header("location:login.php");	
	}

    $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
    if ($acao == "login"){
        $user = isset($_POST['user']) ? $_POST['user'] : "";
        $pass = isset($_POST['pass']) ? $_POST['pass'] : "";
        login($user, $pass);
    }

    function login($user, $pass){
        $pdo = Conexao::getInstance();
        $consulta = $pdo->query("SELECT * FROM usuarios WHERE user = '$user'");
        $nome = '';
        $pass_bd = '';
        while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $nome = $linha['nome'];
            $pass_bd = $linha['pass'];
            $id = $linha['id'];
        }
        if (sha1($pass) == $pass_bd){
            session_start();
			$_SESSION['user'] = $user;
			$_SESSION['nome'] = $nome;
            $_SESSION['id'] = $id;
			header("location:index.php");	
		}else 
            header("location:login.php?msg=Login Incorreto!");
    }

?>