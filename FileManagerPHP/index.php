<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Upload de Arquivos</title>
    </head>
    <body>
        <h1>Upload de Arquivos</h1>
        <?php
        if(isset($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
        ?>
        <form method="POST" action="proc_cad_img.php" enctype="multipart/form-data">
            <label>Nome:</label>
            <input type="text" name="nome" placeholder="Digitar o nome"><br><br>
            
            <label>Arquivo</label>
            <input type="file" name="imagem"><br><br>
            
            <input name="SendCadImg" type="submit" value="Cadastrar">
        </form>
		
		<!--a href="listar.php">Visualizar</a-->
		<br>
		<button onclick="window.location.href='/upload/listar.php'">Visualizar</button>
    </body>
</html>
