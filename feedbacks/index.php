<style>
    .corpo {
    font-family: 'Arial', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 70vh;
}
/* Container do formulário */
form {
    background-color: white;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    text-align: center;
}

/* Título do formulário */
h2 {
    color: #333;
    margin-bottom: 20px;
}

/* Estilo dos campos de entrada */
input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 16px;
}

/* Estilo do botão de envio */
button {
    width: 100%;
    padding: 12px;
    background-color: #20B2AA;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Efeito de hover no botão */
button:hover {
    background-color: #0056b3;
}


/* Responsividade para telas menores */
@media (max-width: 600px) {
    form {
        width: 90%;
        padding: 20px;
    }
}
</style>



<?php
session_start();
include './bd.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuario = $_POST['usuario'];
    $senha = md5($_POST['senha']); // Senha encriptada com MD5

    $sql = "SELECT * FROM USUARIOS WHERE USUARIO = '$usuario' AND SENHA = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ./views/feed.php");
        exit();
    } else {
        $erro = "Usuário ou senha inválidos!";
    }
}
?>


<?php include './views/header.php'; ?>


<div class="corpo">
<form method="POST" action="index.php">
    <h2>Login</h2>
    <input type="text" name="usuario" placeholder="Usuário" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
    <?php if (isset($erro)) echo "<p>$erro</p>"; ?>
</form>
</div>


<?php include './views/footer.php'; ?>
