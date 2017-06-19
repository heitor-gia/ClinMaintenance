<?php 
	$user = 'root';
	$password = '';


	$conn = (new mysqli('localhost',$user,$password))->query('CREATE SCHEMA IF NOT EXISTS `clinica` DEFAULT CHARACTER SET utf8 ');
	///////////////////////////////////////////////////////////////////////////////

	$conn = new mysqli('localhost',$user,$password,'clinica');//CONEXÂO COM O DATABASE
	if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);
	$conn->set_charset("utf8");

	////////////// CREATES ////////////////////////////
	/*Abertura do diretório dos SQLs*/
	$creates =opendir("../dbfiles/creates/");
	while (($file = readdir($creates))!="") {
		if ($file!='.' && $file!='..' && $file!='Thumbs.db' && $file!='01database.sql') {
			
			$files[] = $file;
			
		}
	}
	sort($files);
	
	foreach ($files as $file) {
		$sql[] = file_get_contents("../dbfiles/creates/".$file);
	}

	
	for($i=0;$i<count($sql);$i++) {
		
		$conn->query($sql[$i]);

		if ($conn->error!= NULL) {
			$errors[] = $conn->error;
		}
	}

	$insertsdir = opendir("../dbfiles/inserts/");
	
	while (($file = readdir($insertsdir))!="") {
		if ($file!='.' && $file!='..' && $file!='Thumbs.db') {
			
			$dir[] = $file;
			
		}
	}
	
	sort($dir);

	foreach ($dir as $file) {
		$inserts[] = file_get_contents("../dbfiles/inserts/".$file);
	}

	for ($i=0;$i<count($inserts);$i++) {
		
		$conn->query($inserts[$i]);
		if ($conn->error!= NULL) {
			$errors[] = $conn->error;
		}
	}

	
	?> 
	<html>
	<head>
		<meta charset="UTF-8">
		<title>Install</title>

		<style>
			.box{
				margin: auto;
				max-width: 30vw;
				text-align: center;
				background: #CCC;
				border-radius: 10px;
				padding: 14vh;
				margin-top: 25vh;
			}

		</style>
	</head>
	<body>
		<div class="box">
			<h1>Instalação</h1>
			<div>
				<?php 
					if(isset($errors)){
						foreach ($errors as $error) {
						?>
						<p><?php echo $error; ?></p>
						
						<?php
						}	 
					} else echo "A Instalação ocorreu sem erros";
				?>
			</div>

		</div>

	</body>
	</html>