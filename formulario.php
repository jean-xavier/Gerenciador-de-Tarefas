<form method="POST">
    <input type="hidden" name="id" value="<?php echo $tarefa['id']; ?>"/>
    <fieldset>
        <legend>Nova tarefa</legend>
        <label>
            Tarefa:
            <?php if($tem_erros && isset($erros_validacao['nome'])):?>
                <span class="erro">
                    <?php echo $erros_validacao['nome'];?>
                </span>
            <?php endif;?>
            <input type="text" name="nome" value="<?php echo $tarefa['nome'];?>"/>
        </label>
        <label>
            Descrição:
            <textarea name="descricao" rows="8" cols="40"><?php echo $tarefa['descricao']; ?></textarea>
        </label>
        <label>
            Prazo (Opcional):
            <input type="text" name="prazo" value="<?php traduz_data_para_exibir($tarefa['prazo']) ?>"/>
        </label>
        <fieldset>
          <legend>Priodidade:</legend>
          <label>
              <input type="radio" name="prioridade" value="1" 
              <?php echo ($tarefa['prioridade']) == 1 ? 'checked' : '';?>/>
              Baixa
              <input type="radio" name="prioridade" value="2" 
              <?php echo ($tarefa['prioridade']) == 2 ? 'checked' : '';?>/>
              Média
              <input type="radio" name="prioridade" value="3"
              <?php echo ($tarefa['prioridade']) == 3 ? 'checked' : '';?>/>
              Alta
          </label>
        </fieldset>
        <label>
            Tarefa concluída:
            <input type="checkbox" name="concluida" value="1"
            <?php echo ($tarefa['concluida']) == 1 ? 'checked' : '';?>/>
        </label>
        <input type="submit" value="<?php echo ($tarefa['id'] > 0) ? 'Atualizar' : 'Cadastrar';?>"/>
        <?php if($tarefa['id'] > 0): ?>
             <button>Cancelar<a href="./tabela.php"><a/></button>
        <?php endif;?>
    </fieldset>
</form>