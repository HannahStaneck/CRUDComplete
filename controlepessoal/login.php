<!DOCTYPE html>
<?php 
    session_start();
    if (isset($_SESSION['user']))
        header("location:index.php");

    $msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>
<html lang="pt-br">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    <br>
    <div class="container">
        <div class="row">
            <div class="col-1"><h2>Login</h2></div>
        </div>
        <p>(admin : admin)</p>
        <p>(user: user)</p>
        <form action="acaoLogin.php" method="post">
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="user">Usuário</label>
                <input class="form-control" required=true type="text" name="user" id="user">
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <label class="form-label" for="pass">Senha</label>
                <input class="form-control" required=true type="password" name="pass" id="pass">
            </div>
        </div>
        <div class="row">
            <div class="col-12"><h1 style="color:red"><?php echo $msg ?></h1></div>
        </div>
        <br><button class="btn btn-outline-success" type="submit" name="acao" id="acao" value="login">Salvar</button>
        </form>
        <br><br>
    </div>
</body>
</html>