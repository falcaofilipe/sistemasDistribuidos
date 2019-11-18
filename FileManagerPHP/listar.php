<?php

session_start();
include_once './conexao.php';

$consulta = $conn->query("SELECT * FROM imagens");

// var_dump($consulta);die(); 
  
// while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
    // echo "Nome: {$linha['nome']} - Usuário: {$linha['imagem']}<br />";
//}

while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
$ext = pathinfo($linha['imagem'], PATHINFO_EXTENSION);
echo('Nome: '.$linha['nome']);
echo(' Tipo: '.$ext); //EXTENSÃO DO ARQUIVO
// $data=date("d-m-Y");
$data = $linha['data'];
$data = date( "d/m/Y H:i:s", strtotime($data));

echo(' Data: '.$data); //DATA E HORA DA INSERÇÃO

// echo '<img src=" imagens/'.$linha['id'].'/'.$linha['imagem'].'" width=250 height=250 />';
echo '&nbsp';
echo '<a href="downloadDoc.php?d=imagens/'.$linha['id'].'&f='.$linha['imagem'].'" target=_blank title='.$linha['nome'].'>Download</a>';
echo '&nbsp';
echo '<a href="deleta.php?id='.$linha['id'].'">Excluir</a>';
echo '<br>';
echo '<br>';
	
}

// $path = "imagens/";
// $diretorio = dir($path);
 
// echo "Lista de Arquivos do diretório '<strong>".$path."</strong>':<br />";
// while($arquivo = $diretorio -> read()){
// echo "<a href='".$path.$arquivo."'>".$arquivo."</a><br />";
// }
// $diretorio -> close();
//https://www.devmedia.com.br/listando-arquivos-de-pastas-com-php/17716

?>
<input type="button" class="btn btn text-right" id="btn-voltar-secao" value="Voltar" onclick="history.go(-1)">