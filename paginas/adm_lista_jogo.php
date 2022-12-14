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
    <title>Listagem de Jogos</title>
</head>
    <main>
        <div class="margem-lados">
            <br><br>
            <?php
                $sql = $pdo->prepare('SELECT * FROM jogos');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE JOGOS</h1><br>";
                    echo "<table width=100%; class='listagens-table'";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Nome</th>";
                    echo "<th>Descrição</th></th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Link</th>";
                    echo "<th>+</th>";
                    echo "<th>-</th>";
                    echo "</tr>";
            
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['cod_jogo']."</td>";
                        echo "<td>".$value['nome_jogo']."</td>";
                        echo "<td>".$value['desc_jogo']."</td>";
                        $imagem = $value['image_jogo'];
                        echo '<td>';
                        if (!empty($imagem)){ 
                            echo '<img width="150" src="data:image/jpg;charset=utf8;base64,'.$imagem.'"/>';
                        } else{
                            echo '<center><i>(Não possui imagem)</i></center>';
                        }
                        echo '</td>';
                        echo "<td class='link-lista'><a href='".$value['link_jogo']."'>ACESSE</a></td>";
                        echo "<td class='exc-alt'><center><a class='alt' href='adm_alt_jogo.php?cod_jogo=".$value['cod_jogo']."'>(+)</a></center></td>";
                        echo "<td class='exc-alt'><center><a class='del' href='adm_del_jogo.php?cod_jogo=".$value['cod_jogo']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
            
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='cad_jogo.php'>Cadastrar novo jogo</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>