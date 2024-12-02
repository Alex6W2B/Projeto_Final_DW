<?php
    include 'topo.php';

    // Caminho para a conexão com o banco de dados
    $conexao_bd_path = __DIR__ . '/src/1_ConexaoBD.php';
    if (file_exists($conexao_bd_path)) {
        require_once($conexao_bd_path);
    } else {
        echo "<p>Erro: De conexão com banco.</p>";
        exit();
    }

    // Caminho para o arquivo de manipulação de usuários
    $conUsuario_bd_path = __DIR__ . '/src/3_Usuario.php';
    if (file_exists($conUsuario_bd_path)) {
        require_once($conUsuario_bd_path); // Inclui o arquivo 3_Usuario.php
    } else {
        echo "<p>Falha ao encontrar o arquivo 3_Usuario.php</p>";
        exit();
    }

    $USUARIO = new Usuario();

    // Verifica se o ID do usuário foi passado via GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $usuario = $USUARIO->consultarPorId($id);  // Método para buscar usuário por ID

        // Caso não encontre o usuário, exibe mensagem de erro
        if (!$usuario) {
            echo "<p>Usuário não encontrado.</p>";
            exit();
        }
    }

    // Verifica se o formulário foi enviado via POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Chama a função editarUsuario passando os dados do formulário
        $USUARIO->editarUsuario($_POST);
    }
?>
    <h2 class="my-3 pb-4 container text-center col align-self-center">Editar Usuário</h2>

    <form method="POST" enctype="multipart/form-data" action="" class="row align-items-start mx-4">
        
        <!-- ID do usuário em um campo oculto -->
        <input type="hidden" name="id_usu" value="<?= htmlspecialchars($id) ?>">

        <div class="col-6">
            <label for="idUsuario" class="form-label">ID:</label>
            <input type="text" class="form-control" name="id_usu" id="idUsuario" value="<?= htmlspecialchars($usuario['id_usu']) ?>" readonly>
        </div>

        <div class="col-6">
            <label for="nomeId" class="form-label">Nome:</label> 
            <input type="text" class="form-control" name="nome" id="nomeId" value="<?= htmlspecialchars($usuario['nome']) ?>">
        </div>

        <div class="col-6">
            <label for="emailUsuario" class="form-label">E-mail:</label>
            <input type="email" class="form-control" name="email" id="emailUsuario" value="<?= htmlspecialchars($usuario['email']) ?>">
        </div>

        <div class="col-6">
            <label for="senhaId" class="form-label">Senha:</label>
            <input type="password" class="form-control" name="senha" id="senhaId" value="<?= htmlspecialchars($usuario['senha']) ?>">
        </div>

        <div class="col-6">
            <label for="administradorId" class="form-label">Administrador:</label>
            <input type="checkbox" name="administrador" id="administradorId" class="form-check-input" 
                value="1" <?= isset($usuario['administrador']) && $usuario['administrador'] == '1' ? 'checked' : '' ?>>
        </div>

        <div class="d-grid pt-4">
            <button type="submit" name="submit" class="btn btn-success">Salvar Alterações</button>
        </div>
    </form>

<?php
    include 'rodape.php';
?>
