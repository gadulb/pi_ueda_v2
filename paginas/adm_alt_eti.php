<?php require("../template/header.php");?>
<?php
    if($_SESSION['adm'] != 1){
        header("location:n_adm_msg.php");
        die;
    } else {
        $id_eti = $nome_eti = "";
        $id_etiErr = $nome_etiErr = $msgErr = "";

        if (isset($_GET['id_eti'])){
            $id_eti = $_GET['id_eti'];
            $sql = $pdo->prepare('SELECT * FROM etiqueta_art WHERE id_eti =?');
            if ($sql->execute(array($id_eti))){
                $info = $sql->fetchAll(PDO::FETCH_ASSOC);
                foreach($info as $key => $value){
                    $id_eti = $value['id_eti'];
                    $nome_eti = $value['nome_eti'];
                }
            }
        }
        
    }               
?>
<head>
    <title>Alterar Informações da Etiqueta</title>
</head>
    <main>
    <div class="margem-lados">
            <center>
                <br><br>
                <h1>ALTERAR ETIQUETA</h1>
                <br>
                <form action="adm_alt_eti_controler.php" method="post">
                    <input type="text" name="id_eti" value="<?php echo $id_eti?>" readonly>
                    <br><br>
                    <input name="nome_eti" value="<?php echo $nome_eti?>" type="text" placeholder="Nome da etiqueta">
                    <span class="obrigatorio"><?php echo '<br>'.$nome_etiErr ?></span>
                    <br><br>
                    <div class="botoes-alt">
                        <button><a class="link-branco" href="adm_lista_eti.php">VOLTAR</a></button>
                        <button type="submit" name="cadastro">ALTERAR</button>
                    </div>
                </form>
                <br><br>
            </center>
        </div>
    </main>
<?php require("../template/footer.php");?>