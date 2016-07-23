<?php

session_start();

include('config.php');
include('banco.php');
include('ajudantes.php');
include('classes/Tarefas.php');

$tarefas = new Tarefas($mysqli);

$exibir_tabela = true;
$tem_erros = false;
$erros_validacao = array();

if(tem_post()){

    include('./validar.php');
    
    if(!$tem_erros){
        $tarefas->gravar_tarefa($tarefa);

        if(isset($_POST['lembrete']) && $_POST['lembrete'] == 1){
            enviar_email($tarefa);
        }

        header('Location: tarefas.php');
        die();
    }
    
}

$tarefas->buscar_tarefas();

$tarefa = array('id' => 0,
                'nome' => (isset($_POST['nome'])) ? $_POST['nome'] : '',
                'descricao' => (isset($_POST['descricao'])) ? $_POST['descricao'] : '',
                'prazo' => (isset($_POST['prazo'])) ? traduz_data_para_banco($_POST['prazo']) : '',
                'prioridade' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : 1,
                'concluida' => (isset($_POST['concluida'])) ? $_POST['concluida'] : ''
            );

include('template.php');
