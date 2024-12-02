<?php

class ConexaoBD{
    public  static function getConexao():PDO{
        
        $servername = "alexandre-db";
        $username = "root";
        $password = "Batman";
        $dbname = "dw-i_proj_final";


        $conexao = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        return $conexao;
    }
}

ConexaoBD::getConexao();