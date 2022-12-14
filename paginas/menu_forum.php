<?php require("../template/header.php");?>
<head>
    <title>Fórum | UEDA</title>
</head>
    <main>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>FÓRUM</h1>
                <br>
                <h2>Você também gostaria de compartilhar algo em nosso fórum? Publique agora!</h2>
                <br><br>
                <a class="link-branco" href="cad_for.php"><button>PUBLICAR NO FÓRUM</button></a>
                <br><br>
            </center>
                <?php
                    $sql = $pdo->prepare("SELECT * FROM `publica_forum`");
                    if($sql->execute()){
                    $row = $sql->fetchAll(PDO::FETCH_ASSOC);
                        foreach($row as $key => $value){
                            $id_publi = $value['id_publi'];
                            $id_usu = $value['id_usu'];
                            // $nome_usu = $value['nome_usu'];
                            // ("SELECT usuario.nome_usu FROM usuario, publica_forum WHERE usuario.id_usu = publica_forum.id_usu");
                            // $nome_usu = $value['nome_usu']
                            $titulo_publi = $value['titulo_publi'];
                            $text_publi = $value['text_publi'];
                            $img_publi = $value['img_publi'];
                            $sql = $pdo->prepare('SELECT nome_usu FROM usuario WHERE id_usu =?');
                            if($sql->execute(array($id_usu))){
                                $usuario = $sql->fetchAll(PDO::FETCH_ASSOC);
                                $nome_usu = $usuario[0]['nome_usu'];
                            }
                            echo '<div class="foruns">';
                            echo '<a href="vizu_forum.php?id_publi='.$value["id_publi"].'"><h2>'.$titulo_publi.'</h2></a>';
                            echo '<div class="nome-de-usu"><b>Publicado por: <a>@'.$nome_usu.'</a></b></div>';
                            echo '<p>'.$text_publi.'</p>';
                            echo "<br><a href='vizu_forum.php?id_publi=".$id_publi."'>Ver Agora</a>";
                            echo '<br><hr>';
                            echo '</div>';
                            echo '<br>';
                        };
                    };
                ?>
        </div>
    </main>
<?php require("../template/footer.php");?>