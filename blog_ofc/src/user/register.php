<?php
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Estabelece conexão com o banco de dados
    include ("../config/database.php");

    // Obtém os dados do formulário
    $name = trim($_POST['name']);
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Consulta SQL para verificar se o usuário já existe
    $query_check_user = "SELECT * FROM tb_login WHERE usuario = :username";

    // Consulta SQL para inserir um novo usuário
    $query_insert_user = "INSERT INTO tb_login (nome, usuario, senha) VALUES (:name, :username, :password)";

    try {
        // Verifica se o usuário já existe
        $stmt_check_user = $conexao->prepare($query_check_user);
        $stmt_check_user->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt_check_user->execute();
        $user_exists = $stmt_check_user->fetch(PDO::FETCH_ASSOC);

        if ($user_exists) {
            // Se o usuário já existir, exibe uma mensagem de erro
            echo '<div class="alert alert-danger">
                      <strong>Erro ao cadastrar!</strong> O usuário já existe.
                </div>';
        } else {
            // Se o usuário não existir, executa a consulta para inserir o novo usuário
            $stmt_insert_user = $conexao->prepare($query_insert_user);
            $stmt_insert_user->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt_insert_user->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt_insert_user->bindParam(':password', $password, PDO::PARAM_STR);

            if ($stmt_insert_user->execute()) {
                header("Location: login.php");  
                exit;
            } else {
                echo '<div class="alert alert-danger">
                          <strong>Erro ao cadastrar!</strong> Por favor, tente novamente.
                    </div>';
            }
        }
    } catch (PDOException $e) {
        // Se ocorrer uma exceção durante a execução da consulta, exibe uma mensagem de erro
        echo "Erro: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/adm-estilo.css">
</head>

<body>

    <div class="register-container">
        <h1>Cadastro</h1>
        <form action="#" method="post">
            <input type="text" name="name" placeholder="Nome" required>
            <input type="text" name="username" placeholder="Usuário" required>
            <input type="password" name="password" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>
        </form>
    </div>

</body>

</html>