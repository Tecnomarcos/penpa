<form class="form-horizontal">
    <fieldset>

        <!-- Form Name -->
        <legend>Tipos de Encomenda</legend>
    
        <div class="btn-toolbar">
            <a href="admin.php?modulo=Tiposencomendas&acao=inserir" class="btn"><i class="icon-plus"></i> <strong>Novo Tipo de Encomenda</strong></a>
        </div>    
    
        <div class="well">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dados as $tipoEncomenda): ?>
                        <tr>
                            <td><?php echo $tipoEncomenda->getId() ?></td>
                            <td><?php echo $tipoEncomenda->getTipo() ?></td>
                            <td>
                                <a href="admin.php?modulo=Tiposencomendas&acao=editar&id=<?php echo $tipoEncomenda->getId() ?>"><i class="icon-edit"></i> <strong>Editar</strong></a>
                                -
                                <a href="admin.php?modulo=Tiposencomendas&acao=excluir&id=<?php echo $tipoEncomenda->getId() ?>"><i class="icon-trash"></i> <strong>Excluir</strong></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
      
        </div>
        
    </fieldset>
</form>
