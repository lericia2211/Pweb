<style>
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 8px;
    text-align: left;
}

a {
    color: #333;
    text-decoration: none;
}

button {
    background-color: #20B2AA;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #555;
}

input {
    padding: 10px;
    margin: 10px 0;
    width: 100%;
    box-sizing: border-box;
}

/* Alinha o formulário de pesquisa à direita */
.search-form {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    padding: 10px;
}

/* Estilo do campo de pesquisa */
.search-form input[type="text"] {
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 25px;
    width: 250px; /* Ajuste o tamanho da barra de pesquisa */
    margin-right: 10px;
}

/* Estilo do botão de pesquisa */
.search-btn {
    background-color: transparent;
    border: none;
    cursor: pointer;
    padding: 5px;
}

/* Ícone de lupa */
.search-icon {
    width: 40px;
    height: 40px;
}
</style>


<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include '../bd.php';

// Definindo o valor padrão para o limite de exibição e a pesquisa
$limite = isset($_GET['limite']) ? $_GET['limite'] : 10;
$busca = isset($_GET['busca']) ? $_GET['busca'] : '';

// Consulta para buscar os participantes com base no filtro de pesquisa
$sql = "SELECT * FROM cadastros WHERE nome LIKE '%$busca%' LIMIT $limite";
$result = $conn->query($sql);
?>

<?php include 'header.php'; ?>

<a href="cadastra_feed.php"><button>Cadastrar Novo Feedback</button></a>

<!-- Formulário de pesquisa -->
<form method="GET" action="" class="search-form">
    <input type="text" name="busca" id="busca" value="<?= $busca ?>" placeholder="Buscar clientes...">
    <button type="submit" class="search-btn">
        <img src="img/lupinha.png" class="search-icon">
    </button>
</form>


<!-- Seleção de quantos itens exibir -->
<form method="GET" action="">
    <label for="limite">Exibir:</label>
    <select name="limite" id="limite" onchange="this.form.submit()">
        <option value="10" <?= $limite == 10 ? 'selected' : '' ?>>10</option>
        <option value="30" <?= $limite == 30 ? 'selected' : '' ?>>30</option>
        <option value="80" <?= $limite == 80 ? 'selected' : '' ?>>80</option>
    </select>
</form>

<!-- Tabela de participantes -->
<table>
    <tr>
        <th>Clientes </th>
        <th>Feedback</th>
        <th>Email</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['nome'] ?></td>
        <td><?= $row['feedback'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
            <a href="edita_feed.php?id=<?= $row['id'] ?>">Editar</a>
            <a href="deleta_feed.php?id=<?= $row['id'] ?>">Deletar</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

<?php include './footer.php'; ?>
