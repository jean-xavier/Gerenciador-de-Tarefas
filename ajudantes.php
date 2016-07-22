<?php 
    function traduz_prioridade($codigo){
        $prioridade = '';
        switch($codigo){
            case 1:
                $prioridade = 'Baixa';
                break;
            case 2:
                $prioridade = 'Media';
                break;
            case 3:
                $prioridade = 'Alta';
                break;        
        }
        return $prioridade;
    } 
    
    function traduz_data_para_banco($data){
        if($data == ""){
            return "";
        }

        $dados = explode('/', $data);

        if(count($dados)!=3){
            return $data;
        }

        $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";   

        return $data_mysql; 
    }

    function traduz_data_para_exibir($data){
        if($data == "" or $data == "0000-00-00"){
            return "";
        }

        $dados = explode("-", $data);

        if(count($dados) != 3){
            return $data;
        }

        $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";
        
        return $data_exibir;
    }

    function traduz_concluida($concluida){
        if($concluida == 1){
            return "Sim";
        }
        return "Não";
    } 

    function tem_post(){
        if(count($_POST) > 0){
            return true;
        }
        return false;
    }

    function validar_data($data){
        $padrao = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/';
        $resultado = preg_match($padrao, $data);

        if(!$resultado){
            return false;
        }

        $dados = explode('/',$data);

        $dia = $dados[0];
        $mes = $dados[1];
        $ano = $dados[2];

        $resultado = checkdate($mes, $dia, $ano);

        return $resultado;
    }

    function tratar_anexo($anexo){
        $padrao = '/^.+(\.pdf|\.zip)$/';
        $resultado = preg_match($padrao, $anexo['name']);

        if(!$resultado){
            return false;
        }

        move_uploaded_file($anexo['tmp_name'], "anexo/{$anexo['name']}");

        return true;
    }

    function enviar_email($tarefa, $anexos = array()){
        
        $corpo = prepara_corpo_email($tarefa, $anexos);
        
        include "bibliotecas/PHPMailer/PHPMailerAutoload.php";

        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = "smtp.gmail.com";
        $email->Port = 587;
        $email->SMTPSecure = 'tls';
        $email->SMTPAuth = true;
        $email->Username = "user_email";
        $email->Password = "PassWord";
        $email->setFrom("user_email", "Avisador de Tarefas");
        $email->addAddress(EMAIL_NOTIFICACAO);
        $email->Subject = "Aviso de tarefa: {$tarefa['nome']}";
        $email->msgHTML($corpo);

        foreach ($anexos as $anexo) {
            $email->addAttachment("anexo/{$anexo['arquivo']}");
        }

        $email->send();

    }

    function prepara_corpo_email($tarefa, $anexo){
        //Aqui vamos pegar o conteúdo processado pelo template_email.php

        //Falar para o navegador que não é para enviar o processamento para o navegador
        ob_start();

        include "template_email.php";

        //Guardar o conteúdo do arquivo em uma variável
        $corpo = ob_get_contents();

        //Falar para o PHP que ele pode voltar a mandar conteúdos para o navegador
        ob_end_clean();

        return $corpo;
    }
