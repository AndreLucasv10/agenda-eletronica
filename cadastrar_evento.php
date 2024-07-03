<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("location: login.php");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
include_once './conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_cad_event = "INSERT INTO events (title, color, start, end, descricao, id_usuario) VALUES (:title, :color, :start, :end, :descricao, :id_usuario)";

$cad_event = $pdo->prepare($query_cad_event);

$cad_event->bindParam(':title', $dados['cad_title']);
$cad_event->bindParam(':color', $dados['cad_color']);
$cad_event->bindParam(':start', $dados['cad_start']);
$cad_event->bindParam(':end', $dados['cad_end']);
$cad_event->bindParam(':descricao', $dados['cad_descricao']);
$cad_event->bindParam(':id_usuario', $usuario_id);

if ($cad_event->execute()) {
    $retorna = [
        'status' => true,
        'msg' => 'Evento cadastrado com sucesso!',
        'id' => $pdo->lastInsertId(),
        'title' => $dados['cad_title'],
        'color' => $dados['cad_color'],
        'start' => $dados['cad_start'],
        'end' => $dados['cad_end'],
        'descricao' => $dados['cad_descricao'],
        'id_usuario' => $usuario_id
    ];
} else {
    $retorna = ['status' => false, 'msg' => 'Erro: Evento não cadastrado!'];
}

echo json_encode($retorna);
