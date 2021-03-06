<?php 

session_start();

include('config.php');
include('banco.php');
include('ajudantes.php');
include('classes/Tarefas.php');

$tarefas = new Tarefas($mysqli);

$exibir_tabela = false;
$tem_erros = false;
$erros_validacao = array();

if(tem_post()){

    include('./validar.php');
    
    $tarefa['id'] = $_POST['id'];
    
    if(!$tem_erros){
        $tarefas->editar_tarefa($tarefa);

        if(isset($_POST['lembrete']) && $_POST['lembrete'] == 1){
            $anexo = buscar_anexos($mysqli, $tarefa['id']);

            enviar_email($tarefa, $anexo);
        }

        header('Location: tarefas.php');
        die();
    }
}

$tarefas->buscar_tarefa($_GET['id']);
$tarefa = $tarefas->tarefa;

$tarefa['nome'] = (isset($_POST['nome'])) ? $_POST['nome'] : $tarefa['nome'];
$tarefa['descricao'] = (isset($_POST['descricao'])) ? $_POST['descricao'] : $tarefa['descricao'];
$tarefa['prazo'] = (isset($_POST['prazo'])) ? $_POST['prazo'] : $tarefa['prazo'];
$tarefa['prioridade'] = (isset($_POST['prioridade'])) ? $_POST['prioridade']: $tarefa['prioridade'];
$tarefa['concluida'] = (isset($_POST['concluida'])) ? $_POST['concluida'] : $tarefa['concluida'];

include('template.php');
