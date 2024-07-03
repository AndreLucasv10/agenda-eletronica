<?php
include 'conexao.php';

if (isset($_POST['registrar'])) {
    $usuario = $_POST['novo-usuario'];
    $senha = $_POST['nova-senha'];
    $confirmarSenha = $_POST['confirmar-senha'];
    $senha = md5($senha);
    $confirmarSenha = md5($confirmarSenha);

    $checarUsuario = "SELECT * FROM login WHERE Usuario = ?";
    $stmt = $pdo->prepare($checarUsuario);
    $stmt->execute([$usuario]);
    if ($stmt->rowCount() > 0) {
        echo "Usuário já existe!";
    } elseif ($senha != $confirmarSenha) {
        die("As senhas não coincidem");
    } else {
        $insertQuery = "INSERT INTO login (Usuario, Senha) VALUES (?, ?)";
        $stmt = $pdo->prepare($insertQuery);
        $stmt->execute([$usuario, $senha]);

        if ($stmt) {
            header("location: login.php");
            exit();
        } else {
            echo "Erro ao cadastrar usuário.";
        }
    }
}

if (isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $senha = md5($senha);

    $sql = "SELECT Id, Usuario FROM login WHERE Usuario = ? AND Senha = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$usuario, $senha]);

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        session_start();
        $_SESSION['usuario'] = $user['Usuario'];
        $_SESSION['usuario_id'] = $user['Id'];
        header("location: homepage.php");
        exit();
    } else {
        echo "Usuário ou senha incorretos";
    }
}
