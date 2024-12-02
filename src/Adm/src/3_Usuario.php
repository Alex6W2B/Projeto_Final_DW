<?php
    require_once "1_ConexaoBD.php";

    class Usuario {
        // Função para cadastrar um novo usuário
        function cadastrar($dados) {
            $con = ConexaoBD::getConexao(); // Obtém a conexão PDO
            $senha = md5($dados['senha']);
    
            try {
                // Prepara a query SQL usando placeholders
                $sql = "INSERT INTO usuarios (nome, email, senha, administrador) VALUES (:nome, :email, :senha, :administrador)";
                $stmt = $con->prepare($sql);
    
                // Associa os valores aos placeholders
                $stmt->bindParam(':nome', $dados['nome']);
                $stmt->bindParam(':email', $dados['email']);
                $stmt->bindParam(':senha', $dados['senha']);
                
                // Verifica se o checkbox de administrador foi marcado
                $administrador = isset($dados['administrador']) ? 1 : 0;
                $stmt->bindParam(':administrador', $administrador);
    
                // Executa a query
                $stmt->execute();
    
                echo "<p>Usuário cadastrado com sucesso!</p>";
            } catch (PDOException $e) {
                echo "<p>Erro ao cadastrar usuário: " . $e->getMessage() . "</p>";
            }
        }
        
    
        // Função para consultar todos os usuários
        function consultarUsuarios() {
            $con = ConexaoBD::getConexao();  // Certifique-se de que retorna um objeto PDO
            $sql = "SELECT * FROM usuarios";
            
            try {
                $stmt = $con->query($sql);  // Executa a consulta
                return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna todos os resultados como um array associativo
            } catch (PDOException $e) {
                echo "Erro ao consultar usuários: " . $e->getMessage();
                return [];
            }
        }

        // Função para consultar usuários por uma chave de busca
        function consultarPorChaveUsu($chave) {
            $con = ConexaoBD::getConexao();  // Certifique-se de que retorna um objeto PDO
            $sql = "SELECT * FROM usuarios 
                    WHERE nome LIKE :chave 
                    OR email LIKE :chave";
            
            try {
                $stmt = $con->prepare($sql);  // Prepara a consulta com parâmetros
                $chave = "%$chave%";  // Adiciona os sinais de '%' para a busca
                $stmt->bindParam(':chave', $chave, PDO::PARAM_STR);  // Vincula o parâmetro da consulta
                $stmt->execute();  // Executa a consulta
                return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Retorna os resultados como um array associativo
            } catch (PDOException $e) {
                echo "Erro ao consultar usuários: " . $e->getMessage();
                return [];
            }
        }

    
        // Função para consultar um usuário específico por ID
        public function consultarPorId($id) {
            $con = ConexaoBD::getConexao();
            $sql = "SELECT * FROM usuarios WHERE id_usu = :id_usu";
            $stmt = $con->prepare($sql);
            $stmt->bindParam(':id_usu', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    
        // Função para remover um usuário
        function removerUsuario($id_usu) {
            // Obtém a conexão com PDO
            $con = ConexaoBD::getConexao();
            // Prepara a consulta SQL para excluir o usuário
            $sql = "DELETE FROM usuarios WHERE id_usu = :id_usu";
            // Prepara a declaração
            $stmt = $con->prepare($sql);
            // Vincula o parâmetro :id_usu com o ID do usuário
            $stmt->bindParam(':id_usu', $id_usu, PDO::PARAM_INT);
            // Executa a consulta
            if ($stmt->execute()) {
                echo "<p>Usuário removido com sucesso! Atualize a página</p>";
            } else {
                echo "<p>Erro ao remover usuário: " . $stmt->errorInfo()[2] . "</p>";
            }
        }
    
        // Função para editar os dados de um usuário
        function editarUsuario($dados) {
            $con = ConexaoBD::getConexao();
            
            // Prepara os dados, usando prepared statements (evita SQL Injection)
            $id = $dados['id_usu'];
            $nome = $dados['nome'];
            $email = $dados['email'];
            $senha = $dados['senha'];
            $administrador = isset($dados['administrador']) ? 1 : 0; // Verifica se o checkbox foi marcado
        
            // Prepara a consulta SQL
            $sql = "UPDATE usuarios SET 
                    nome = :nome,
                    email = :email,
                    senha = :senha,
                    administrador = :administrador
                    WHERE id_usu = :id";
        
            // Prepara a declaração
            $stmt = $con->prepare($sql);
        
            // Vincula os parâmetros à consulta
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':administrador', $administrador, PDO::PARAM_INT);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
            // Executa a consulta
            if ($stmt->execute()) {
                echo "<p>Usuário atualizado com sucesso! Volte para a lista de usuários para ver atualizado</p>";
            } else {
                echo "<p>Erro ao atualizar usuário: " . $stmt->errorInfo()[2] . "</p>";
            }
        }
    }
?>