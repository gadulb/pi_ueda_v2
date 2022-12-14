<?php
session_start();
include_once "../include/MySql.php";
include_once "../include/functions.php";

    if(!array_key_exists("id_usu",$_SESSION) || $_SESSION['id_usu'] == ""){
        header("location:n_adm_msg.php");
        die;
    } else{
        if($_SESSION['adm'] != 1){
            header("location:n_adm_msg.php");
            die;
        } else{
            require("../template/header_s_php.php");
        }
    }
?>
<head>
    <title>Cadastre Forum | UEDA</title>
</head>
    <main>
        <br><br>
        <center>
            <h1>PÁGINA DE ADMNISTRAÇÃO</h1>
        </center>
        <br>
        <div class="margem-lados2">
            <h2>Cadastros</h2>
            <button><a class="link-branco" href="cad_usu.php">Usuários</a></button>
            <button><a class="link-branco" href="cad_art.php">Artigos</a></button>
            <button><a class="link-branco" href="cad_eti.php">Etiquetas</a></button>
            <button><a class="link-branco" href="bug.php">Reporte de Bugs</a></button>
            <button><a class="link-branco" href="cad_for.php">Fórum</a></button>
            <button><a class="link-branco" href="cad_jogo.php">Jogos</a></button>
            <br><br><hr><br>
            <h2>Listagens</h2>
            <button><a class="link-branco" href="adm_lista_usu.php">Usuários</a></button>
            <button><a class="link-branco" href="adm_lista_art.php">Artigos</a></button>
            <button><a class="link-branco" href="adm_lista_eti.php">Etiquetas</a></button>
            <button><a class="link-branco" href="adm_lista_bug.php">Reporte de Bugs</a></button>
            <button><a class="link-branco" href="adm_lista_forum.php">Fórum</a></button>
            <button><a class="link-branco" href="adm_lista_jogo.php">Jogos</a></button>
            <br><br><hr><br>
        </div> 
    </main>

<?php require("../template/footer.php");?>