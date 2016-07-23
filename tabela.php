<div class="table">
    <table>
        <tr>
            <th class="tr-title">Tarefas</th>
            <th class="tr-title">Descrição</th>
            <th class="tr-title">Prazo</th>
            <th class="tr-title">Prioridade</th>
            <th class="tr-title">Concluída</th>
            <th class="tr-title">Opções</th>
        </tr>
        <div>
            <?php foreach ($tarefas->tarefas as $tarefas) : ?>
                <tr>
                    <td>
                        <a href="tarefa.php?id=<?php echo $tarefas['id']; ?>"><?php echo $tarefas['nome']; ?></a>
                    </td>
                    <td><?php echo $tarefas['descricao']; ?></td>
                    <td><?php echo traduz_data_para_exibir($tarefas['prazo']); ?></td>
                    <td><?php echo traduz_prioridade($tarefas['prioridade']); ?></td>
                    <td><?php echo traduz_concluida($tarefas['concluida']); ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $tarefas['id']; ?>">Editar</a>
                        <a href="remover.php?id=<?php echo $tarefas['id']; ?>">Remover</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </div>
    </table>
</div>
