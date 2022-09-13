<?php
    include "./include/functions.php";
    include "./include/MySql.php";

    $msgErro = "";
    $nome_jogo = $desc_jogo = $link_jogo = "";

    if (isset($_POST["submit"])){
        if (!empty($_FILES["image_jogo"]["name"])){
            //Pegar informações
            $fileName = basename($_FILES["image_jogo"]["name"]);
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);
            //Permitir somente alguns formatos
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            if (in_array($fileType, $allowTypes)){
                $image_jogo = $_FILES['image_jogo']['tmp_name'];
                $imgContent = file_get_contents($image_jogo);

                if (isset($_POST['nome_jogo'])){
                    $nome_jogo = $_POST['nome_jogo'];
                } else {
                    $nome_jogo = "";
                }
                if (isset($_POST['desc_jogo'])){
                    $desc_jogo = $_POST['desc_jogo'];
                } else {
                    $desc_jogo = "";
                }
                if (isset($_POST['link_jogo'])){
                    $link_jogo = $_POST['link_jogo'];
                } else {
                    $link_jogo = "";
                }

                //Gravar no banco
                $sql = $pdo->prepare("INSERT INTO jogos (codJogo, nome_jogo, desc_jogo, link_jogo, image_jogo)
                                      VALUES (null, ?,?,?,?)");
                if ($sql->execute(array($nome_jogo, $desc_jogo, $link_jogo, $imgContent))){
                    $msgErro = "Dados cadastrados com sucesso!";
                    header('location:Jooj.php');
                } else {
                    $msgErro = "Dados não cadastrados!";
                }

            } else {
                $msgErro = "Desculpe, mas somente arquivos JPG, JPEG, PNG e GIF são permitidos";
            }
        } else {
            $msgErro = "Selecione uma imagem para upload";
        }
    }


?>
<?php require("./template/header1.php");?>
<head>
    <link rel="stylesheet" href="./css/style.css">
    <title>Cadastro de jogos | UEDA</title>
</head>
<div class="margem-lados">
            <center>
                <br><br>
                <h1>PUBLIQUE SEU JOGO:</h1>
                <br>
                <form action="" method="post">
                    <input name="nome_jogo" value="<?php echo $nome_jogo?>" type="text" placeholder="Nome do jogo">
                    <span class="obrigatorio">* <?php  echo '<br>'.$msgErro ?></span>
                    <br><br>
                    <input name="desc_jogo" value="<?php  echo $desc_jogo?>" type="text" placeholder="Descrição do jogo">
                    <span class="obrigatorio">* <?php  echo '<br>'.$msgErro ?></span>
                    <br><br>
                    <input name="link_jogo" value="<?php  echo $link_jogo?>" type="text" placeholder="Link do jogo">
                    <span class="obrigatorio">* <?php  echo '<br>'.$msgErro ?></span>
                    <br><br>
                    <div class="escolha-imagem">
                        <label for="file">Selecione uma imagem</label>
                        <input type="file" id='file' name="image_jogo"/><br> <br>
                        <span class="obrigatorio">* <?php echo $msgErro ?></span> <br>   
                    </div>
                    
                    <div class="final-cad">
                        <div class="final-cad-jogo">
                            <button href="jogos.php">Salvar</button>
                        </div>
                    </div>
                    <div class="clear"></div>
                </form>
                <br><br>
            </center>
        </div>
        <?php require("./template/footer2.php");?>
</body>
</html>
</body>
</html>