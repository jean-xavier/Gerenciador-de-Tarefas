<?php

include('config.php');
include('banco.php');
remover_tarefas($mysqli, $_GET['id']);
header('Location: tarefas.php');

