<?php
//
// function tokenizer($var) {
//   $tok = strtok($var,' \n\t');
//   while($tok) {
//     $array[] = $tok;
//     $tok = strtok(" \n\t");
//   }
//   return $array;
// }
//
// $tokens_general = tokenizer($_POST['area']);
//
// print_r($tokens_general);

$errores = array();

// Expresiones Regulares:
$ER_ID = "/^(['$']{1})([A-Za-z_])([A-Za-z0-9_])*$/";
$ER_OP = "/^([+\-\*\/\'='])$/";
$ER_NUM = '/^[0-9]+$/';
$ER_DEL = "/^([';'])$/";
$ER_ERROR_ID = "/(['$']{1})([0-9])([A-Za-z0-9_])*$/";
$ER_ID2 = '/\$?([a-z|A-Z])([a-z]|[A-Z]|[0-9]|)*/';

//Obtener informacion del textarea del html
$string = $_POST['area'];

//Separar la cadena del textarea en tokens
$tok = strtok($string, " \n\t");

while($tok){
  $array[] = $tok;
  $tok = strtok(" \n\t");
}


$cadena1 = implode(' ', $array);

echo "Entrada:</br>".$cadena1.'</br>';

$array2 = array();
$arrayNOR = array_unique($array);//Controlar el numero de Tokens Repetidos

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

tokenizador

//tokenizador - va a convertir los lexemas en tokens(ejemplo: $a + $b = $c -> ID OP ID OP ID)
for($i = 0; $i<count($array);$i++){

	if(preg_match($ER_ID, $array[$i])){
		$array2[$i] = 'ID';
	}elseif(preg_match($ER_OP, $array[$i])){
		$array2[$i] = 'OP';
	}
	elseif(preg_match($ER_NUM, $array[$i])){
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

echo implode(' ',$array);
echo "<br><br>";
echo implode(' ', $array2);

// $asociativo = array('ID' => $ER_ID,
//                     'OP' => $ER_OP,
//                     'NUM' => $ED_NUM,
//                     'DEL' => $ER_DEL,
//                     'ErrVar' => $ER_ERROR_ID,
//                     'CAE' => $ER_ID2);
//
// for ($i=0; $i < count($array) ; $i++) {
//   foreach($asociativo as $key => $ERG){
//     if(preg_match($ERG, $array[$i])){
//       $array2[$i]=$key;
//     }
//   }
// }


?>
