<?php

    class Tarefas{
        
        public $mysqli;
        public $tarefas = array();
        public $tarefa;

        public function __construct($nova_mysqli){
            $this->mysqli = $nova_mysqli;
        } 

        public function  buscar_tarefas(){
            $sqlBusca = 'SELECT * FROM tarefas';
            $resultado = $this->mysqli->query($sqlBusca);
            
            $this->tarefas = array();

            while($tarefa = mysqli_fetch_assoc($resultado)){
               $this->tarefas[] = $tarefa;
            }
        }

        public function buscar_tarefa($id){
            
            $sqlBusca = 'SELECT * FROM tarefas WHERE id='.$id;
            $resultado = $this->mysqli->query($sqlBusca);
            
            $this->tarefa = mysqli_fetch_assoc($resultado);
        }

        public function gravar_tarefa($tarefa){
            
            $nome = $this->mysqli->escape_string($tarefa['nome']);
            $descricao = $this->mysqli->escape_string($tarefa['descricao']);;
            $prazo = $this->mysqli->escape_string($tarefa['prazo']);

            $sqlGravar = "
                INSERT INTO tarefas(nome, descricao, prioridade, prazo, concluida) 
                VALUES
                (
                    '{$nome}',
                    '{$descricao}',
                    '{$tarefa['prioridade']}',
                    '{$prazo}',
                    '{$tarefa['concluida']}'    
                )
            ";

            $this->mysqli->query($sqlGravar);
        }
        
        public function editar_tarefa($tarefa){
            
            $sqlEditar = "
                UPDATE tarefas SET
                    nome = '{$tarefa['nome']}',
                    descricao = '{$tarefa['descricao']}',
                    prioridade = '{$tarefa['prioridade']}',
                    prazo = '{$tarefa['prazo']}',
                    concluida = '{$tarefa['concluida']}'
                WHERE id = {$tarefa['id']}    
            ";
            
            $this->mysqli->query($sqlEditar);
        }

    }
