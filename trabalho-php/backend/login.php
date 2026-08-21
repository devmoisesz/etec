<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "site-php";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$email = $_POST['email'];
$senhaDigitada = $_POST['senha'];

if(!empty($email) && !empty($senhaDigitada)) {
    $consulta = $conexao->query("SELECT * FROM usuarios WHERE email = '$email'");

    if($consulta->num_rows === 0) {
        echo "Email ou senha incorretos!";
        exit;
    }

    $usuario = $consulta->fetch_assoc();

    if(password_verify($senhaDigitada, $usuario['senha'])) {
        header("Location: ../frontend/menu.html");
    } else {
        echo "Email ou senha incorretos!";
    }
} else {
    echo "Por favor, preencha todos os campos.";
}
?>