<style>
    

/* Título do formulário */
h2 {
    text-align: center;
    color: #20B2AA;
    margin-bottom: 20px;
}

/* Estilo dos campos de entrada */
input[type="text"],
input[type="email"],
select {
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
    width: 10%;
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

/* Estilo do rótulo (label) */
label {
    font-size: 16px;
    font-weight: bold;
    margin-bottom: 5px;
    color: #20B2AA;
}

/* Estilo das opções do select */
select {
    font-size: 16px;
}

/* Estilos para garantir que os campos fiquem bem distribuídos */
form > * {
    margin-bottom: 15px;
}

</style>

<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include '../bd.php';
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $feedback = $_POST['feedback'];
    $email = $_POST['email'];


    $sql = "UPDATE cadastros SET nome='$nome', feedback='$feedback',  email='$email' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        header("Location: feed.php");
        exit();
    } else {
        echo "Erro: " . $conn->error;
    }
} else {
    $sql = "SELECT * FROM cadastros WHERE id='$id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<?php include 'header.php'; ?>

<h2>Editar Feedback</h2>
<form method="POST" action="edita_feed.php?id=<?= $id ?>">
    <input type="text" name="nome" value="<?= $row['nome'] ?>" required>
    <input type="text" name="feedback" value="<?= $row['feedback'] ?>" required>
    <input type="email" name="email" value="<?= $row['email'] ?>" required>
    <button type="submit">Salvar</button>
</form>

<?php include 'footer.php'; ?>
