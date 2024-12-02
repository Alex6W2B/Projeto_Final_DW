<?php
    class ConexaoBD{
        public  static function getConexao():PDO{
            $conexao = new PDO("mysql:host=localhost:3306;dbname=dw-i_proj_final","root","Batman");
            return $conexao;
        }
    }

    ConexaoBD::getConexao();