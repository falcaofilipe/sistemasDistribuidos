<?php

session_start();
include_once './conexao.php';

$id = $_GET['id'];

try {
  // $pdo = new PDO('mysql:host=localhost;dbname=meuBancoDeDados', $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
  $stmt = $conn->prepare('DELETE FROM imagens WHERE id = :id');
  $stmt->bindParam(':id', $id); 
  $stmt->execute();
     
  // echo $stmt->rowCount();
  
  /*Function PHP para apagar diretório
  http://php.net/manual/en/function.rmdir.php#110489*/
  function delTree($dir) { 
      $files = array_diff(scandir($dir), array('.','..')); 
      foreach ($files as $file) { 
        (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
      } 
      return rmdir($dir); 
    }

    delTree("imagens/$id");
	// die();
  
  echo "<script>alert('Registro excluido com sucesso!');location.href=\"listar.php\"</script>";
  
} catch(PDOException $e) {
  echo 'Error: ' . $e->getMessage();
}
?>
<input type="button" class="btn btn text-right" id="btn-voltar-secao" value="Voltar" onclick="history.go(-1)">