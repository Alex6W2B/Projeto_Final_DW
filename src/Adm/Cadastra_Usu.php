<?php
    include 'topo.php';

    if(isset($_POST['submit'])){
        $conexao_bd_path = __DIR__ . '/src/1_ConexaoBD.php';
        if (file_exists($conexao_bd_path)) {
            require_once($conexao_bd_path);
        } else {
            echo "<p>Erro: Conexão com banco falhou.</p>";
        }
        
        $conUsuario_bd_path = __DIR__ . '/src/3_Usuario.php';
        if (file_exists($conUsuario_bd_path)) {
            require_once($conUsuario_bd_path);
        } else {
            echo "<p>Falha ao encontrar o arquivo Usuario.php</p>";
        }

        $usuarioObj = new Usuario();
        $usuarioObj->cadastrar($_POST);
    }
?>
<h2 class="my-3 pb-4 container text-center col align-self-center">Cadastrar Novo Usuário</h2>

<form method="POST" enctype="multipart/form-data" action="Cadastra_Usu.php" class="row align-items-start mx-4">

    <!-- Campo Nome -->
    <div class="col-12 my-2">
        <label for="nomeId" class="form-label">Nome Completo:</label> 
        <input type="text" class="form-control" name="nome" id="nomeId" placeholder="Ex: João da Silva" required>
    </div>

    <!-- Campo Email -->
    <div class="col-12 my-2">
        <label for="emailId" class="form-label">E-mail:</label>
        <input type="email" class="form-control" name="email" id="emailId" placeholder="exemplo@dominio.com" required>
    </div>

    <!-- Campo Senha -->
    <div class="col-6 my-2">
        <label for="senhaId" class="form-label">Senha:</label>
        <input type="password" class="form-control" name="senha" id="senhaId" placeholder="Crie uma senha segura" required>
    </div>

    <!-- Campo Confirmar Senha -->
    <div class="col-6 my-2">
        <label for="confirmarSenhaId" class="form-label">Confirmar Senha:</label>
        <input type="password" class="form-control" name="confirmar_senha" id="confirmarSenhaId" placeholder="Repita a senha" required>
    </div>

    <!-- Campo Administrador -->
    <div class="col-12 my-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="administrador" id="administradorId" value="1">
            <label class="form-check-label" for="administradorId">
                Administrador
            </label>
        </div>
    </div>

    <!-- Botão de Enviar -->
    <div class="d-grid pt-4">
        <button type="submit" name="submit" class="btn btn-primary">Cadastrar</button>
    </div>

</form>

<?php
    include 'rodape.php';
?>
