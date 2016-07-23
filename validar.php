<?php

$tarefa = array();
    
if(isset($_POST['nome']) && strlen($_POST['nome']) > 0){
    $tarefa['nome'] = $_POST['nome'];        
}else{
    $tem_erros = true;
    $erros_validacao['nome'] = "O nome da tarefa é obrigatorio!";
}

if(isset($_POST['descricao'])){
    $tarefa['descricao'] = $_POST['descricao'];
}else{
    $tarefa['descricao'] = '';
}

if(isset($_POST['prazo']) && strlen($_POST['prazo']) > 0){
    if(validar_data($_POST['prazo'])){
        $tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);            
    }else{
        $tem_erros = true;
        $erros_validacao['prazo'] = 'O prazo não é uma data válida';
    }
}else{
    $tarefa['prazo'] = '';
}

$tarefa['prioridade'] = $_POST['prioridade'];

if(isset($_POST['concluida'])){
    $tarefa['concluida'] = 1;
}else{
    $tarefa['concluida'] = 0;
}
