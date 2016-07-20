<?php
    include('banco.php');
    remover_tarefas($conexao, $_GET['id']);
    header('Location: tarefas.php');
