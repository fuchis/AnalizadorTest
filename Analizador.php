
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>Analizador</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilo.css">
</head>
<body>

	<div class="row">
		<div class="col-sm">
			<ul class="nav">
				<li class="nav-item">
					<a class="nav-link" href="/analizador_2/">Inicio</a>
				</li>

			</ul>

		</div>

	</div>

<?php
$errores = array();

// Expresiones Regulares:
$ER_ID = "/^(['$']{1})([A-Za-z_])([A-Za-z0-9_])*$/";
$ER_OP = "/^([+\-\*\/\'='])$/";
$ER_NUM = "/^[0-9]+$/";
$ER_DEL = "/^([';'])$/";
$ER_ERROR_ID = "/(['$']{1})([0-9])([A-Za-z0-9_])*$/";
$ER_ID2 = "/\$?([a-z|A-Z])([a-z]|[A-Z]|[0-9]|)*/";

//Obtener informacion del textarea del html
$string = $_POST['area'];

//Separar la cadena del textarea en tokens
$tok = strtok($string, " \n\t");

while($tok){
  $array[] = $tok;
  $tok = strtok(" \n\t");
}


$cadena1 = implode(' ', $array);


$array2 = array();
//Contadores de Tokens
$contID = 1;
$contOP = 1;
$contNum = 1;
$contCHAR = 1;
$contCAE = 1;
$contErrorVar = 1;

//Declaracion de Vectores
$TokenID = array();
$TokenID2 = array();
$TokenOP = array();
$TokenOP2 = array();
$TokenNUM = array();
$TokenNUM2 = array();
$TokenCHAR = array();
$TokenCAE = array();
$TokeCAE2  = array();
$TokenDEL = array();
$TokenDEL2 = array();
$TokenComp = array();
$TokenError = array();
$TokenError2 = array();

//SOLUCIONAR BUG CON EL 0
if(empty($array)){
  echo '<script> alert("No hay nada que analizar, ingresar la expresion"); </script>';
  echo '<script> window.location.replace("index.php"); </script>';


}else{
  //tokenizador - va a convertir los lexemas en tokens(ejemplo: $a + $b = $c -> ID OP ID OP ID)

  for($i = 0; $i<count($array);$i++){

  	if(preg_match($ER_ID, $array[$i])){
  		$array2[$i] = 'ID';
  	}elseif(preg_match($ER_OP, $array[$i])){
  		$array2[$i] = 'OP';
  	}
  	elseif(preg_match($ER_NUM, $array[$i])|| $array[$i]=="cero"){
  		$array2[$i] = 'NUM';
  	}elseif(preg_match($ER_DEL, $array[$i])){
  		$array2[$i] = 'DEL';
  	}elseif(preg_match($ER_ERROR_ID, $array[$i])){
  		$errores[] = "Error, Incorrecta Definicion de una variable";
  		$array2[$i] = 'ErrVar';
  	}else{
  		$array2[$i] = 'CAE';
  	}
  }
}

$arrayNOR = array_unique($array);//Controlar el numero de Tokens Repetidos
$arrayNOR2 = array_values($arrayNOR); //Arregla indices del vector

for($i = 0; $i<count($arrayNOR2);$i++){

	if(preg_match($ER_ID, $arrayNOR2[$i])){
		$TokenID2[] = $arrayNOR2[$i];
		$TokenID[] = "ID".$contID;
		$TokenComp[] = "ID".$contID;
		$contID++;
	}elseif(preg_match($ER_OP, $arrayNOR2[$i])){
		$TokenOP2[] = $arrayNOR2[$i];
		$TokenOP[] = "OP".$contOP;
		$TokenComp[] = "OP".$contOP;
		$contOP++;
	}
	elseif(preg_match($ER_NUM, $arrayNOR2[$i])){
		$TokenNUM2[] = $arrayNOR2[$i];
		$TokenNUM[] = "NUM".$contNum;
		$TokenComp[] = "NUM".$contNum;
		$contNum++;
	}elseif(preg_match($ER_DEL, $arrayNOR2[$i])){
		$TokenDEL2[] = $arrayNOR2[$i];
		$TokenDEL[] = "DEL1";
		$TokenComp[] = "DEL1";

	}elseif(preg_match($ER_ERROR_ID, $arrayNOR2[$i])){
		$TokenError2 = $arrayNOR2[$i];
		$TokenError[] = "ErrVar".$contErrorVar;

		$TokenID2[] = $arrayNOR2[$i];
		$TokenID[] = "ErrVar".$contErrorVar;
		$TokenComp[] = "ErrVar".$contErrorVar;
		$contErrorVar++;
	}else{
		$TokenCAE2[] = $arrayNOR2[$i];
		$TokenCAE[] = "CAE".$contCAE;
		$TokenComp[] = "CAE".$contCAE;
		$contCAE++;
	}
}



$cadena2 = implode(' ',$array2);
$cadena3 = implode(' ',$TokenComp);
$ide = implode(' ', $TokenID);
$token_id = implode(' ', $TokenID2);



?>

<div class="container">
  <br>
  <h1>Analizador Lexico-Sintactico Automatas</h1>
  <br>
  <div class="row">
    <div class="col-sm-6">
      <?php echo "Entrada:</br>".$cadena1.'</br>';?>
      <?php echo implode(' ',$array2); ?>
    </div>

</div>


</div>

<script type="text/javascript" src ="js/jquery-3.3.1.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js">

</script>
</body>
</html>
