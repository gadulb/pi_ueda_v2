<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    }
?>
<head>
    <title>Listagem de Artigos | UEDA</title>
</head>
<body>
    <br><br>
    <main>
        <div class="margem-lados">
            <?php
                $sql = $pdo->prepare('SELECT * FROM artigo');
                if ($sql->execute()){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
            
                    echo "<center>";
                    echo "<h1>LISTAGEM DE ARTIGOS</h1><br>";
                    echo "<table class='listagens-table'>";
                    echo "<tr>";
                    echo "<th>ID</th>";
                    echo "<th>Título</th>";
                    echo "<th>ID (Etiqueta)</th>";
                    echo "<th>Link</th>";
                    echo "<th>Resumo</th>";
                    echo "<th>Imagem</th>";
                    echo "<th>Introdução</th>";
                    echo "<th>Desenvolvimento</th>";
                    echo "<th>Conclusão</th>";
                    echo "<th>Referências</th>";
                    echo "<th>Alterar</th>";
                    echo "<th>Excluir</th>";
                    echo "</tr>";
                    foreach($info as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['id_art']."</td>";
                        echo "<td>".$value['titulo_art']."</td>";
                        echo "<td>".$value['id_eti']."</td>";
                        echo "<td><a href='".$value['link_art']."'>ACESSE</a></td>";
                        echo "<td>".$value['resumo_art']."</td>";
                        $imagem = $value['img_art'];
                        echo '<td><img width="150" src="data:image/jpg;charset=utf8;base64,'.($imagem).'"/></td>';
                        echo "<td>".$value['intro_art']."</td>";
                        echo "<td>".$value['des_art']."</td>";
                        echo "<td>".$value['con_art']."</td>";
                        echo "<td>".$value['ref_art']."</td>";
                        echo "<td><center><a class='alt' href='adm_alt_art.php?id_art=".$value['id_art']."'>(+)</a></center></td>";
                        echo "<td><center><a class='del' href='adm_del_art.php?id_art=".$value['id_art']."'>(-)</a></center></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                    echo "<br><button><a class='link-branco' href='cad_art.php'>Cadastrar Artigos</a></button>";
                    echo "</center>";
                }
            ?>
            <br>
        </div>
    </main>
<?php require("../template/footer.php");?>