<?php

$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "site-php";

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

if(!empty($nome) && !empty($email) && !empty($senha)) {
    $esseUsuarioJaExiste = $conexao->query("SELECT * FROM usuarios WHERE email = '$email'");

    if($esseUsuarioJaExiste->num_rows > 0) {
        echo "Inválido!";
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $cadastro = "INSERT INTO usuarios (nome, email, senha) VALUES ('$nome', '$email', '$senhaHash')";
    
    if ($conexao->query($cadastro) === TRUE) {
        header("Location: ../frontend/menu.html");
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
} else {
    echo "Por favor, preencha todos os campos.";
}
?>