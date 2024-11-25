<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

include '../bd.php';
$id = $_GET['id'];

$sql = "DELETE FROM cadastros WHERE id='$id'";
if ($conn->query($sql) === TRUE) {
    header("Location: feed.php");
    exit();
} else {
    echo "Erro: " . $conn->error;
}
?>
