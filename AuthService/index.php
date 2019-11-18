<?php
session_start();

include_once './conexao.php';

$consulta = $conn->query("SELECT * FROM imagens");
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <title>Firebase Login</title>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div id="login_div" class="main-div">
    <h3>Firebase Web Login</h3>
    <input type="email" placeholder="Email..." id="email_field" />
    <input type="password" placeholder="Password..." id="password_field" />

    <button onclick="login()">Login</button>
  </div>

  <div id="user_div" class="loggedin-div">
    <h3 id="bemvindo"></h3>
	
	<!--GERENCIADOR DE ARQUIVOS -->
	<div id="file_manager">
	<h1>Gerenciador de Arquivos</h1>
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
		<!--button name="SendCadImg" onclick="verifica()" type="submit" value="Cadastrar">Cadastrar</button-->
		<button name="SendCadImg" type="submit" value="Cadastrar">Cadastrar</button>
	</form>
	<br>
	<button onclick="myFunction()">Visualizar</button>
	</div>
	
	<script>
	function verifica() {
		
		
		firebase.auth().currentUser.getIdToken(/* forceRefresh */ true).then(function(idToken) {
		// Send token to your backend via HTTPS
		// ...
		//$("#theForm").ajaxSubmit({url: 'server.php', type: 'post'}) //para cadastro
		}).catch(function(error) {
		// Handle error
		});

	}

	function myFunction() {
		
	firebase.auth().currentUser.getIdToken(/* forceRefresh */ true).then(function(idToken) {
	// Send token to your backend via HTTPS
	// ...
		document.getElementById("bemvindo").style.display = "none";
		document.getElementById("file_manager").style.display = "none";
		document.getElementById("file_manager_upload").style.display = "block";
	}).catch(function(error) {
	// Handle error
	});
		
		
	
	}

	function voltar() {
		
		
	firebase.auth().currentUser.getIdToken(/* forceRefresh */ true).then(function(idToken) {
	// Send token to your backend via HTTPS
	// ...
		document.getElementById("bemvindo").style.display = "block";
		document.getElementById("file_manager").style.display = "block";
		document.getElementById("file_manager_upload").style.display = "none";
	}).catch(function(error) {
	// Handle error
	});


	}
	</script>
	
	<!--FILE MANAGER UPLOAD-->
	<div id="file_manager_upload">
		<?php
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
			echo '<a href="downloadDoc.php?d=imagens/'.$linha['id'].'&f='.$linha['imagem'].'" target=_blank onclick="verifica()" title='.$linha['nome'].'>Download</a>';
			echo '&nbsp';
			echo '<a href="deleta.php?id='.$linha['id'].'" onclick="verifica()">Excluir</a>';
			echo '<br>';
			echo '<br>';
			}
		?>
			<button onclick="voltar()">Voltar</button>
	</div>
	<br>
    <button onclick="logout()">Logout</button>
  </div>
  
  

  <script src="https://www.gstatic.com/firebasejs/5.5.7/firebase.js"></script>
<script>
  // Initialize Firebase
  var config = {
    apiKey: "AIzaSyDriLnfEyyn3eKVX2XupJQxTdYfKmEtms0",
    authDomain: "dropbox-e3f83.firebaseapp.com",
    databaseURL: "https://dropbox-e3f83.firebaseio.com",
    projectId: "dropbox-e3f83",
    storageBucket: "dropbox-e3f83.appspot.com",
    messagingSenderId: "931992402447"
  };
  firebase.initializeApp(config);
</script>
  <script src="index.js"></script>

</body>
</html>
