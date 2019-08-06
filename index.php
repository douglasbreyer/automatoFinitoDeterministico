<?php 
	// Anthony Cassol e Douglas Breyer
?>

<html>
	<head>
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src=bootstrap/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	</head>
	<body style="background-color: #a4c3d8;">
		<?php
			error_reporting(E_ALL);
			ini_set("display_errors", 1);

			include('funcoes.php');

			// Lê um arquivo em um array. 
			$lines = file ('entrada.txt');

			$afnd = array();
			$tabSimb = array();
			$GLOBALS['estados'] = array();
			$GLOBALS['estados']['S'] = 0;
			$GLOBALS['estadoFinal']['S'] = 0;

			$afnd[0][0] = 0;

			$GLOBALS['estado'] = 1;


			// Percorre o array, pegando cada linha da entrada
			foreach ($lines as $line_num => $linha) {
			   $tabSimb = insereSimbolos($tabSimb, $linha);

			   $afnd =  insereAFND($afnd, $linha, $tabSimb);
			}

			echo '<h2> AFND </h2>';
			printaAF($afnd, $tabSimb);

		 	$afnd = transicoesvazias($afnd, $tabSimb);

		 	echo '<h2> AFND - Sem Transições Vazias </h2>';
		 	printaAF($afnd, $tabSimb);

		 	echo '<h2> AFD  </h2>';
		 	$afd = determinizar($afnd, $tabSimb);

			printaAF($afd, $tabSimb);

			$afd = eliminamortos($afd, $tabSimb);

			echo '<h2> AFD - Eliminação de Mortos</h2>';
			printaAF($afd, $tabSimb);

			echo '<h2> Estados Equivalentes </h2>';
			equivalencia($afd, $tabSimb);

		

		?>
	</body>
</html>