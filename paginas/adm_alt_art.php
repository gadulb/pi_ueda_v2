<?php
    /* 
    - NÃO ENVIA ALTERAÇÕES
    - SELEÇÃO NÃO FUNCIONA BEM
    */
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
            $id_art  = $titulo_art = $id_eti = $link_art = $resumo_art = $img_art = $image_art = $intro_art = $des_art = $con_art = $ref_art = $imgContent = "";
            $id_artErr  = $titulo_artErr = $id_etiErr = $link_artErr = $resumo_artErr = $img_artErr = $image_artErr = $intro_artErr = $des_artErr = $con_artErr = $ref_artErr = $msgErr = "";

            if (isset($_GET['id_art'])){
                $id_art = $_GET['id_art'];
                $sql = $pdo->prepare('SELECT * FROM artigo WHERE id_art =?');
                if ($sql->execute(array($id_art))){
                    $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                    foreach($info as $key => $value){
                        $id_art = $value['id_art'];
                        $titulo_art = $value['titulo_art'];
                        $id_eti = $value['id_eti'];
                        $link_art = $value['link_art'];
                        $resumo_art = $value['resumo_art'];
                        $intro_art = $value['intro_art'];
                        $des_art = $value['des_art'];
                        $con_art = $value['con_art'];
                        $ref_art = $value['ref_art'];
                        $imgContent = $value['img_art'];
                    }
                }
            }

            // echo "<pre>";
            // var_dump([
            //     "get" => $_GET,
            //     "isset tituloErro" => isset($_GET['titulo_artErr']) && !empty($_GET['titulo_artErr']) 
            // ]);
            // echo "</pre>";

            // die();

            if(isset($_GET['titulo_artErr']) && !empty($_GET['titulo_artErr'])){
                $titulo_artErr = $_GET['titulo_artErr'];
                $titulo_art = "";
            }
            if(isset($_GET['id_etiErr']) && !empty($_GET['id_etiErr'])){
                $id_etiErr = $_GET['id_etiErr'];
                $id_eti = "";
            }
            if(isset($_GET['link_artErr']) && !empty($_GET['link_artErr'])){
                $link_artErr = $_GET['link_artErr'];
                $link_art = "";
            }
            if(isset($_GET['resumo_artErr']) && !empty($_GET['resumo_artErr'])){
                $resumo_artErr = $_GET['resumo_artErr'];
                $resumo_art = "";
            }
            if(isset($_GET['image_artErr']) && !empty($_GET['image_artErr'])){
                $image_artErr = $_GET['image_artErr'];
                $image_art = "";
            }
            if(isset($_GET['intro_artErr']) && !empty($_GET['intro_artErr'])){
                $intro_artErr = $_GET['intro_artErr'];
                $intro_art = "";
            }
            if(isset($_GET['des_artErr']) && !empty($_GET['des_artErr'])){
                $des_artErr = $_GET['des_artErr'];
                $des_art = "";
            }
            if(isset($_GET['con_artErr']) && !empty($_GET['con_artErr'])){
                $con_artErr = $_GET['con_artErr'];
                $con_art = "";
            }
            if(isset($_GET['ref_artErr']) && !empty($_GET['ref_artErr'])){
                $ref_artErr = $_GET['ref_artErr'];
                $ref_art = "";
            }
            require("../template/header_s_php.php");
        }
    }  
?>
<head>
    <title>Alterar Publicação do Artigo</title>
</head>
    <main>
        <div class="atencao">
            <center><h4>ATENÇÃO: Se você deixar algum input vazio e clicar em 'ALTERAR', o dado permanecerá como antes de ser enviado vazio.</h4></center>
        </div>
        <br><br>
        <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR ARTIGO</h1>
                <br>
                <form action="adm_alt_art_controler.php" method="post" enctype="multipart/form-data">
                    <label>Etiquetas: </label>
                    <select name="id_eti" id="id_eti" onchange="altera_form(this)"> <!-- Implementação futura: Etiquetas em foreach atualizadas com o banco de dados para serem cadastradas -->
                        <option value="">Selecione</option>
                        <option value="1" <?php if ($id_eti == 1){ ?> selected <?php } ?>>Notícia</option>
                        <option value="2" <?php if ($id_eti == 2){ ?> selected <?php } ?>>Art. Científico</option>
                        <option value="3" <?php if ($id_eti == 3){ ?> selected <?php } ?>>Art. de site </option>
                    </select>
                    <span id="id_etiErr" class="obrigatorio"><?php echo '<br>'.$id_etiErr ?></span>
                    <br><br>
                    <input id="id_art" type="text" name="id_art" value="<?php echo $id_art?>" readonly>
                    <br><br>
                    <input id="titulo_art" class="input-text" name="titulo_art" maxlength="255" value="<?php echo $titulo_art?>" type="text" placeholder="Título do Artigo">
                    <span id="titulo_artErr" class="obrigatorio"><?php echo '<br>'.$titulo_artErr ?></span>
                    <br><br>
                    
                        <input id="link_art" class="input-text" name="link_art" value="<?php echo $link_art?>" type="text" placeholder="Link do Artigo (FORA DO SITE UEDA)" <?php echo in_array($id_eti, [3,2]) ? 'style="display:none;"':''; ?>></textarea>
                        <span id="link_artErr" class="obrigatorio" <?php echo in_array($id_eti, [3,2]) ? 'style="display:none;"':''; ?>><?php echo '<br>'.$link_artErr ?></span>
                        <br><br>
   
                    <textarea id="resumo_art" name="resumo_art" maxlength="2000" type="text" placeholder="Resumo do Texto"><?php echo $resumo_art?></textarea>
                    <span id="resumo_artErr" class="obrigatorio"><?php echo '<br>'.$resumo_artErr ?></span>
                    <br><br>
                  
                        <textarea id="intro_art" name="intro_art" maxlength="2000" type="text" placeholder="Introdução do Texto"><?php echo $intro_art?></textarea>
                        <span id="intro_artErr" class="obrigatorio"><?php echo '<br>'.$intro_artErr ?></span>
                        <br><br>
                        <textarea id="des_art" name="des_art" maxlength="2000" type="text" placeholder="Desenvolvimento do Texto"><?php echo $des_art?></textarea>
                        <span id="des_artErr" class="obrigatorio"><?php echo '<br>'.$des_artErr ?></span>
                        <br><br>
                        <textarea id="con_art" name="con_art" maxlength="2000" type="text" placeholder="Conclusão do Texto"><?php echo $con_art?></textarea>
                        <span id="con_artErr" class="obrigatorio"><?php echo '<br>'.$con_artErr ?></span>
                        <br><br>
                        <textarea id="ref_art" name="ref_art" maxlength="1000" type="text" placeholder="Referências do Texto"><?php echo $ref_art?></textarea>
                        <span id="ref_artErr" class="obrigatorio"><?php echo '<br>'.$ref_artErr ?></span>
                        <br><br>
                        <a>Imagem Atual:</a>
                        <br>
                        <?php 
                        if (!empty($imgContent)){ 
                            echo '<img width="150" src="data:image/jpg;charset=utf8;base64,'.($imgContent).'"/>';
                        } else{
                            echo '<center><i>(Não possui imagem)</i></center>';
                        } 
                        ?>
                        <br><br>
                        <div id="image_art" class="escolha-imagem">
                            <label for="image">Selecione uma imagem</label>
                            <input type="file" id='image' name="image"/><br><br>
                            <span id="image_artErr" class="obrigatorio"><?php echo $image_artErr ?></span> <br> 
                        </div>
                        <br>
        
                    <div class="botoes-alt">
                    <button type="submit" name="submit">ALTERAR</button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
    <script>
    const altera_form = function(element){
        const valor = element.value;
        console.log(valor);
        if(valor == 1){
            document.getElementById('titulo_art').style.display='block'; // aparece -> block
            document.getElementById('link_art').style.display='block';
            document.getElementById('resumo_art').style.display='block';
            document.getElementById('intro_art').style.display='none'; //   não aparece -> none
            document.getElementById('des_art').style.display='none';
            document.getElementById('con_art').style.display='none';
            document.getElementById('ref_art').style.display='none'; 
            document.getElementById('image_art').style.display='none';

            document.getElementById('titulo_artErr').style.display='block'; // aparece -> block
            document.getElementById('link_artErr').style.display='block';
            document.getElementById('resumo_artErr').style.display='block';
            document.getElementById('ref_artErr').style.display='none'; //     não aparece -> none
            document.getElementById('con_artErr').style.display='none';
            document.getElementById('des_artErr').style.display='none';
            document.getElementById('intro_artErr').style.display='none';
            document.getElementById('image_artErr').style.display='none';
        } else if ((valor == 2) || (valor == 3)){
            document.getElementById('titulo_art').style.display='block'; // aparece -> block
            document.getElementById('link_art').style.display='none'; //    não aparece -> none
            document.getElementById('resumo_art').style.display='block';
            document.getElementById('intro_art').style.display='block';
            document.getElementById('des_art').style.display='block';
            document.getElementById('con_art').style.display='block';
            document.getElementById('ref_art').style.display='block';
            document.getElementById('image_art').style.display='block';

            document.getElementById('titulo_artErr').style.display='block'; // aparece -> block
            document.getElementById('link_artErr').style.display='none'; //    não aparece -> none
            document.getElementById('resumo_art').style.display='block';
            document.getElementById('intro_artErr').style.display='block';
            document.getElementById('des_artErr').style.display='block';
            document.getElementById('con_artErr').style.display='block';
            document.getElementById('ref_artErr').style.display='block';
            document.getElementById('image_artErr').style.display='block';
        } else{
            document.getElementById('titulo_art').style.display='block'; // aparece -> block
            document.getElementById('link_art').style.display='block';
            document.getElementById('resumo_art').style.display='block';
            document.getElementById('intro_art').style.display='block';
            document.getElementById('des_art').style.display='block';
            document.getElementById('con_art').style.display='block';
            document.getElementById('ref_art').style.display='block';
            document.getElementById('image_art').style.display='block';

            document.getElementById('titulo_artErr').style.display='block'; // aparece -> block
            document.getElementById('link_artErr').style.display='block';
            document.getElementById('resumo_art').style.display='block';
            document.getElementById('intro_artErr').style.display='block';
            document.getElementById('des_artErr').style.display='block';
            document.getElementById('con_artErr').style.display='block';
            document.getElementById('ref_artErr').style.display='block';
            document.getElementById('image_artErr').style.display='block';
        }
    };
    </script>
<?php require("../template/footer.php");?>