<?php
    include 'topo.php';

    $conexao_bd_path = __DIR__ . '/src/1_ConexaoBD.php';
    if (file_exists($conexao_bd_path)) {
        require_once($conexao_bd_path);
    } else {
        echo "<p>Erro: Conexão com banco falhou.</p>";
    }
    
    $usuario_bd_path = __DIR__ . '/src/3_Usuario.php';
    if (file_exists($usuario_bd_path)) {
        require_once($usuario_bd_path);
    } else {
        echo "<p>Falha ao encontrar o arquivo Usuario.php</p>";
    }

    $usuarioObj = new Usuario();
    $usuarios = $usuarioObj->consultarUsuarios();
    
    if (isset($_GET['busca'])) {
        $usuarios = $usuarioObj->consultarPorChaveUsu($_GET['busca']);
    }

    if (isset($_GET['id_usu'])) {
        $usuarioObj->removerUsuario($_GET['id_usu']);
    }
?>
<div class="mx-5">
    <form action="Lista_Usu.php" class="container my-3 border rounded p-3">
        <div class="mb-2">
            <label class="form-label fw-bold">Buscar usuário</label>
            <input type="text" name="busca" class="form-control" placeholder="Nome ou e-mail">
        </div>
        <div class="mb-2">
            <button type="submit" class="btn btn-dark">Pesquisar</button>
        </div>
    </form>

    <div class="container col-12">
        <table class="table table-striped table-hover">
            <thead class="table-light">    
                <th>ID</th>        
                <th>Nome</th>
                <th>Email</th>
                <th>Administrador</th>
                <th></th>
            </thead>

            <?php
                if (isset($_GET['id_usu'])) {
                    $usuarioObj->removerUsuario($_GET['id_usu']);
                }

                foreach ($usuarios as $usuario):
            ?>

            <tbody>                    
                <td><?=$usuario['id_usu']?></td>
                <td><?=$usuario['nome']?></td>
                <td><?=$usuario['email']?></td>
                <td><?=$usuario['administrador'] == 1 ? 'Sim' : 'Não'?></td>
                <td>
                    <a href="Edita_Usu.php?id=<?=$usuario['id_usu']?>" class="btn btn-dark btn-sm">Editar</a>
                    <a href="Lista_Usu.php?id_usu=<?=$usuario['id_usu']?>" class="btn btn-danger btn-sm" onclick="return confirm('Você tem certeza que deseja remover este usuário?');">Remover</a>
                </td>
            </tbody>

            <?php
                endforeach;
            ?>
        </table>
    </div>
</div>

<?php
    include 'rodape.php';
?>
