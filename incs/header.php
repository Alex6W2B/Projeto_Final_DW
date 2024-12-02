<?php
    //session_start();
    //require_once "admin/src/ProdutoDAO.php";

    //$produtoDAO = new ProdutoDAO();
    //$produtoDAO = $produtoDAO->consultar();

    //if (isset($_GET['chave'])) {
        //$produto = $produtoDAO->consultarPorChave($_GET['chave']);
    //}
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="../js/bootstrap.bundle.min.js">
        <link rel="stylesheet" href="../Css/bootstrap.min.css">
        <link rel="stylesheet" href="../Css/Principal.css">
        <link rel="stylesheet" href="../Css/Style.css">
        <link rel="stylesheet" href="../Css/Molde_Cardapio.css">
        <link rel="stylesheet" href="../Css/Semana.css">
        <link rel="shortcut icon" href="../Img/2.png">
        <title>Página Inicial</title>
    </head>
    <header>
        <div class="container d-flex justify-content-between py-2 pe-0">
            
            <div>
                <a href="Pg_Principal.php"><img src="../Img/1.png" width="110px" alt="Imagem Logo"></a>
            </div>

            <!--Lado direito-->
            <div class="d-inline-flex">
                <a href="meuperfil.html" class="d-flex mx-2 b"><img src="../Img/person-circle.svg" width="30px" alt=""></a>
            </div>
        </div>
    </header>
