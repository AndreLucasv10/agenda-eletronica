<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit();
}

include './conexao.php';

$usuario_id = $_SESSION['usuario_id'];

$query_events = "SELECT evt.id, evt.title, evt.color, evt.start, evt.end, evt.descricao, evt.status, evt.id_usuario, usr.Usuario 
                 FROM events AS evt 
                 INNER JOIN login usr ON usr.id = evt.id_usuario 
                 WHERE evt.id_usuario = :id_usuario";

try {
    $stmt = $pdo->prepare($query_events);
    $stmt->bindParam(':id_usuario', $usuario_id, PDO::PARAM_INT);
    $stmt->execute();
    $eventos = [];

    while ($row_events = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $eventos[] = [
            'id' => $row_events['id'],
            'id_usuario' => $row_events['id_usuario'],
            'title' => $row_events['title'],
            'color' => $row_events['color'],
            'start' => $row_events['start'],
            'end' => $row_events['end'],
            'descricao' => $row_events['descricao'],
            'Usuario' => $row_events['Usuario'],
            'status' => $row_events['status']
        ];
    }

    echo json_encode($eventos);
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
