<?php
include_once './conexao.php';

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

$query_edit_event = "UPDATE events SET 
                        title = :title, 
                        color = :color, 
                        start = :start, 
                        end = :end, 
                        descricao = :descricao, 
                        status = :status 
                    WHERE id = :id";

$edit_event = $pdo->prepare($query_edit_event);

$edit_event->bindParam(':title', $dados['edit_title']);
$edit_event->bindParam(':color', $dados['edit_color']);
$edit_event->bindParam(':start', $dados['edit_start']);
$edit_event->bindParam(':end', $dados['edit_end']);
$edit_event->bindParam(':descricao', $dados['edit_descricao']);
$edit_event->bindParam(':status', $dados['edit_status']);
$edit_event->bindParam(':id', $dados['edit_id']);

if ($edit_event->execute()) {
    $retorna = [
        'status' => true,
        'msg' => 'Evento editado com sucesso!',
        'id' => $dados['edit_id'],
        'title' => $dados['edit_title'],
        'color' => $dados['edit_color'],
        'start' => $dados['edit_start'],
        'end' => $dados['edit_end'],
        'descricao' => $dados['edit_descricao'],
        'status' => $dados['edit_status']
    ];
} else {
    $retorna = ['status' => false, 'msg' => 'Erro: Evento não editado!'];
}

echo json_encode($retorna);
