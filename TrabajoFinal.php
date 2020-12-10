<?php
/**************
*Completar:
* 
Balmaceda Ramiro - FAI-2508
Urrutia Franco   - FAI-3111
**************/
// links de los repositorios GIT
// https://github.com/ramiro434/TPfinal.IP.git
/**
* genera un arreglo de palabras para jugar
* @return array
*/
function cargarPalabras(){
  $coleccionPalabras = array();
  $coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>7);
  $coleccionPalabras[1]= array("palabra"=> "hepatitis" , "pista" => "enfermedad que inflama el higado", "puntosPalabra"=> 7);
  $coleccionPalabras[2]= array("palabra"=> "volkswagen" , "pista" => "marca de vehiculo", "puntosPalabra"=> 10);
  $coleccionPalabras[3]= array("palabra"=> "teclado", "pista" => "Conjunto de teclas de un instrumento musical o de una máquina o mecanismo", "puntosPalabra"=> 8  );
  $coleccionPalabras[4]= array("palabra"=> "astronauta", "pista" => "Persona que forma parte de la tripulación de una nave espacial o que está entrenada y preparada para hacerlo", "puntosPalabra"=> 10  );
  $coleccionPalabras[5]= array("palabra"=> "banana", "pista" => "Comestible, de forma alargada y algo curvada, pulpa de color blanquecina y piel lisa de color amarillo que se desprende con facilidad.", "puntosPalabra"=> 7  );
  $coleccionPalabras[6]= array("palabra"=> "alcohol", "pista" => "Compuesto de carbono, hidrógeno y oxígeno", "puntosPalabra"=> 8  );
  $coleccionPalabras[7]= array("palabra"=> "alberto", "pista" => "Nombre de presidente argentino", "puntosPalabra"=> 7  );
  $coleccionPalabras[8]= array("palabra"=> "fisica", "pista" => "ciencia que estudia la energía, la materia, el tiempo y el espacio", "puntosPalabra"=> 7  );
  $coleccionPalabras[9]= array("palabra"=> "computadora", "pista" => "Máquina electrónica capaz de almacenar información y automatizarla mediante operaciones matemáticas y lógicas controladas por programas informáticos", "puntosPalabra"=> 10  );
  
return $coleccionPalabras;
}

/**
* Indica los juegos realizados y el puntuaje obtenido
* 
*/
function cargarJuegos(){
        $coleccionJuegos = array();
        $coleccionJuegos[0] = array("puntos"=> 0, "indicePalabra" => 1);
        $coleccionJuegos[1] = array("puntos"=> 10,"indicePalabra" => 2);
        $coleccionJuegos[2] = array("puntos"=> 0, "indicePalabra" => 1);
        $coleccionJuegos[3] = array("puntos"=> 8, "indicePalabra" => 0);
        $coleccionJuegos[4] = array("puntos"=> 9, "indicePalabra" => 3 );
        $coleccionJuegos[5] = array("puntos"=> 12, "indicePalabra" => 6);
        $coleccionJuegos[6] = array("puntos"=> 11, "indicePalabra" => 5 );
        $coleccionJuegos[7] = array("puntos"=> 0, "indicePalabra" => 7 );
 
return $coleccionJuegos;
}


/** Esta funcion se encarga de dividir a las palabras en letras
* @param string $palabra
* @return array
*/
function dividirPalabraEnLetras($palabra){
    $coleccionLetras=[];
    for ($i=0; $i<strlen($palabra); $i++){//divide un string en caracteres esta funcion
        $coleccionLetras[$i]["letra"]=$palabra[$i];
        $coleccionLetras[$i]["descubierta"] = false;
}

return $coleccionLetras;
}


/**
* muestra y obtiene una opcion de menú **válida**
* @return int
*/
function seleccionarOpcion(){
//int $opcion

    echo "--------------------------------------------------------------\n";
        echo "\n ( 1 ) Jugar con una palabra aleatoria"; 
        echo "\n ( 2 ) Jugar  con una palabra elegida" ;
        echo "\n ( 3 ) Agregar una palabra al listado" ;
        echo "\n ( 4 ) Mostrar la información completa de un número de juego" ;
        echo "\n ( 5 ) Mostrar la información completa del primer juego con más puntaje. " ;
        echo "\n ( 6 ) Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario " ;
        echo "\n ( 7 ) Mostrar la lista de palabras ordenada por orden alfabético." ;
        echo "\n ( 8 ) Salir del juego \n";

        echo "Indique una opcion valida: ";
        $opcion = trim(fgets(STDIN)) ;
    
        while ($opcion > 8 || $opcion < 1) {
            echo "Indique una opcion valida: ";
            $opcion = trim(fgets(STDIN)) ;
        }
            
    
return $opcion;
}

/**
* Verifica si una palabra existe en el arreglo de palabras
* @param array $coleccionPalabras
* @param string $palabra
* @return boolean
*/
function existePalabra($coleccionPalabras,$palabra){
//$i , $n INT
//$existe Boolean
$existe = false;
$i=0;
$n=count($coleccionPalabras);
    while (($i < $n && !$existe)){//Recorrido parcial, apenas encuentra una palabra igual corta el recorrido
        if ($coleccionPalabras[$i]["palabra"] == $palabra){
        //es igual a la del arreglo
            $existe= true;
        }
        $i++;
    }
return $existe;
}



/**
* Determina si una letra existe en el arreglo de letras
* @param array $coleccionLetras
* @param string $letra
* @return boolean
*/
function existeLetra($coleccionLetras, $letra ){
    //bolean $existe
    //int $cantLetras
    $i = 0 ;
    $cantLetras = count($coleccionLetras) ;
    $existe = false ;
    while ($i < $cantLetras && !$existe){
        $existe = $coleccionLetras[$i]["letra"] == $letra ;
        $i++ ;
    }
return $existe ;
}

/**
* Solicita los datos correspondientes a un elemento de la coleccion de palabras: palabra, pista y puntaje. 
* Internamente la función también verifica que la palabra ingresada por el usuario no exista en la colección de palabras.
* @param array $coleccionPalabras
* @return array  colección de palabras modificada con la nueva palabra.
*/
function agregarPalabra($coleccionPalabras){
$existe = true ;
$cantPalabras = count($coleccionPalabras) ;

do {
    echo "Ingrese la palabra: " ;
    $palabra = strtolower(trim(fgets(STDIN))) ;     

    $existe = existePalabra($coleccionPalabras,$palabra) ;

    if ($existe == false){ 
        echo "\n Ingrese pista:  ";
        $pista = trim(fgets(STDIN));
        echo "\n Ingrese el puntaje: " ;
        $puntaje = trim(fgets(STDIN)) ;
    } else {
        echo "\n La palabra ya existe " ;
    }
} while ($existe == true ) ; 

 $coleccionPalabras[$cantPalabras]["palabra"] = $palabra ;
 $coleccionPalabras[$cantPalabras]["pista"] = $pista ;
 $coleccionPalabras[$cantPalabras]["puntosPalabra"] = $puntaje ;

return $coleccionPalabras ;
}


/**
* Obtener indice aleatorio
* Esta funcion se ejecuta cuando el usuario pide jugar con una palabra aleatoria
* @param int $min
* @param int $max
* @return int
*/
function indiceAleatorioEntre($min,$max){
    $i = rand($min,$max); // />>> rand devuelve un entero pseudoaleatorio entre $min y $max <<</
    return $i;
}

/**
* solicitar un valor entre min y max
* @param int $min
* @param int $max
* @return int
*/
function solicitarIndiceEntre($min,$max){ 
    do{
        echo "Seleccione un valor entre $min y $max: ";
        $i = trim(fgets(STDIN));
    }while(!($i>=$min && $i<=$max));
    
return $i;
}



/**
* Determinar si la palabra fue descubierta, es decir, todas las letras fueron descubiertas
* @param array $coleccionLetras
* @return boolean
*/
function palabraDescubierta($coleccionLetras){
//$palabradescubierta BOOLEAN
//$i INT
$palabraDescubierta=true;
for ($i = 0; $i < count($coleccionLetras); $i++) {//Recorrido exhaustivo
    if(!($coleccionLetras[$i]["descubierta"])){//La key "descubierta" almacena un valor booleano
        $palabraDescubierta=false;
    }
}
return $palabraDescubierta;
}

/**
* /Esta funcion solicita una letra y controla de que se ingrese solo 1 letra.
* @return string
*/
function solicitarLetra(){
$letraCorrecta = false;
    do{
        echo "Ingrese una letra: ";
        $letra = strtolower(trim(fgets(STDIN)));
        if(strlen($letra)!=1){
            echo "Debe ingresar 1 letra!\n";
        }else{
            $letraCorrecta = true;
        }
        
    }while(!$letraCorrecta);
    
return $letra;
}

/**
* Descubre todas las letras de la colección de letras iguales a la letra ingresada.
* Devuelve la coleccionLetras modificada, con las letras descubiertas
* @param array $coleccionLetras
* @param string $letra
* @return array colección de letras modificada.
*/
function destaparLetra($coleccionLetras, $letra){
// $i INT

for ($i = 0; $i < count($coleccionLetras); $i++){//Recorrido exhaustivo para verificar cada letra del arreglo
    if($coleccionLetras[$i]["letra"]==$letra){
        $coleccionLetras[$i]["descubierta"]=true;
    }
}
return $coleccionLetras;
}


/**
* obtiene la palabra con las letras descubiertas y * . Ejemplo: he**t*t*s
* @param array $coleccionLetras
* @return string Ejemplo: "he**t*t*s"
*/
function stringLetrasDescubiertas($coleccionLetras){
//$pal STRING
//$i INT
$pal = "";
for ($i=0; $i< count($coleccionLetras); $i++){//Recorrido exhaustivo para ir construyendo la palabra
    if ( $coleccionLetras[$i]["descubierta"]) {
        $pal = $pal. $coleccionLetras[$i]["letra"];
    }else{
        $pal= $pal."*";
    }
}
return $pal;
}


/**
* Desarrolla el juego y retorna el puntaje obtenido
* @param array $coleccionPalabras
* @param int $indicePalabra
* @param int $cantIntentos
* @return int puntaje obtenido
*/
function jugar($coleccionPalabras, $indicePalabra, $cantIntentos){
//$pal ARRAY
//$puntaje INT
//$palabraFueDescubierta BOOLEAN
$pal = $coleccionPalabras[$indicePalabra]["palabra"];
$coleccionLetras = dividirPalabraEnLetras($pal);
$puntaje = 0;
$palabraFueDescubierta=false;//bandera

//Mostrar pista:
echo "Pista ".$coleccionPalabras[$indicePalabra]["pista"]."\n";
echo "Palabra a descubir: ".stringLetrasDescubiertas($coleccionLetras)."\n";
//solicitar letras mientras haya intentos y la palabra no haya sido descubierta:
do{
    $pedirLetra=solicitarLetra();
    $verificaLetra=existeLetra($coleccionLetras, $pedirLetra);//devuelve booleano V o F
    if($verificaLetra){
        echo "existe la letra \n";
        $coleccionLetrasmodificado = destaparLetra($coleccionLetras,$pedirLetra);
        $coleccionLetras = $coleccionLetrasmodificado;
        $palabraFueDescubierta=palabraDescubierta($coleccionLetras);
    }else{
        $cantIntentos=$cantIntentos-1;
        echo "La letra ". $pedirLetra." no se encuentra en la palabra. Quedan ".$cantIntentos." intentos \n";
        munieco($cantIntentos);
    }
    echo "Palabra a descubrir: ".stringLetrasDescubiertas($coleccionLetras)."\n";

}while(!$palabraFueDescubierta && $cantIntentos>0);

If($palabraFueDescubierta){
    $puntaje=$coleccionPalabras[$indicePalabra]["puntosPalabra"]+$cantIntentos;
    echo "\n¡¡¡¡¡¡GANASTE ".$puntaje." puntos!!!!!!\n";
}else{
    echo "\n¡¡¡¡¡¡AHORCADO AHORCADO!!!!!!\n";
    echo " ┌─────┐ \n";
    echo " │  O    \n";
    echo " │ ┌┼┘   \n";
    echo " │ ┌┴┐   \n";
    echo " │ │ │   \n";
    echo " │ \n";
    echo " └───────── \n";
}
return $puntaje;
}


/**
* Agrega un nuevo juego al arreglo de juegos
* @param array $coleccionJuegos
* @param int $ptos
* @param int $indicePalabra
* @return array coleccion de juegos modificada
*/
function agregarJuego($coleccionJuegos,$puntos,$indicePalabra){
$coleccionJuegos[] = array("puntos"=> $puntos, "indicePalabra" => $indicePalabra);    
return $coleccionJuegos;
}

/**
* Muestra los datos completos de un registro en la colección de palabras
* @param array $coleccionPalabras
* @param int $indicePalabra
*/
function mostrarPalabra($coleccionPalabras,$indicePalabra){
    //$coleccionPalabras[0]= array("palabra"=> "papa" , "pista" => "se cultiva bajo tierra", "puntosPalabra"=>7);
    
    echo "La palabra es:" . $coleccionPalabras[$indicePalabra]["palabra"]."\n";
    echo "La pista es:" . $coleccionPalabras[$indicePalabra]["pista"]."\n";
    echo "Puntaje:" . $coleccionPalabras[$indicePalabra]["puntosPalabra"]."\n";
     
}


/**
* Muestra los datos completos de un juego
* @param array $coleccionJuegos
* @param array $coleccionPalabras
* @param int $indiceJuego
*/
function mostrarJuego($coleccionJuegos,$coleccionPalabras,$indiceJuego){
    //array("puntos"=> 8, "indicePalabra" => 1)
    echo "\n\n";
    echo "<-<-< Juego ".$indiceJuego." >->->\n";
    echo "  Puntos ganados: ".$coleccionJuegos[$indiceJuego]["puntos"]."\n";
    echo "  Información de la palabra:\n";
    mostrarPalabra($coleccionPalabras,$coleccionJuegos[$indiceJuego]["indicePalabra"]);
    echo "\n";
}


/** Esta funcion retorna el índice de la partida con mayor puntaje
 * @param array $coleccionJuegos
 * @return int
 */
function juegoConMasPuntaje($coleccionJuegos) {
    // int $mayorPuntaje, $indiceMayorPuntaje
    $mayorPuntaje = 0 ;
    $indiceMayorPuntaje = 0 ;
    
        for ($i = 0; $i < count($coleccionJuegos) ; $i++) {
            if ($mayorPuntaje < $coleccionJuegos[$i]["puntos"]) {
                $mayorPuntaje = $coleccionJuegos[$i]["puntos"] ;
                $indiceMayorPuntaje = $i ;
            }
        }
    
   return $indiceMayorPuntaje ;
    }


 
 /** Esta funcion retorna el primer juego que supere el puntaje indicado  
 * @param array $coleccionJuegos
 * @param int $puntosUsuario
 * @return int ;
 * */
function primerJuegoConMasPuntaje($coleccionJuegos,$puntosUsuario) {
    // int $indicePrimerJuego, $n, $i
    // boleean $juegoEncontrado
    $juegoEncontrado = false ; //condicion de corte cuando se vuelve true
    $i = 0 ;
    $n = count($coleccionJuegos) ;
    while ($i < $n &&  $juegoEncontrado == false ){
        if ($puntosUsuario < $coleccionJuegos[$i]["puntos"]){
            $indicePrimerJuego = $i ;    
            $juegoEncontrado = true ;
        }else {
            $indicePrimerJuego = -1 ;
        }
        $i++ ;
    }
    return $indicePrimerJuego ;
    }




/** Muestra las palabras odenadas por orden alfabetico */ 
function mostrarPalabrasOrdenadas ($coleccionPalabras){
//$i INT
//$palabrasOrdenadas ARRAY
$palabrasOrdenadas = $coleccionPalabras;
rsort($palabrasOrdenadas);// sort para ordenar el arreglo
echo "\n Palabras Ordenadas por Orden Alfabetico\n";
print_r($palabrasOrdenadas); //print_r nos muestra los elementos del arreglo

}

/**Grafica al cuerpo del munieco dentro del juego
* @param $cantIntentos 
*/
function munieco ($cantIntentos){
switch ($cantIntentos) {
case 5:
echo " ┌─────┐ \n";
echo " │ O \n";
echo " │ \n";
echo " │ \n";
echo " │ \n";
echo " │ \n";
echo " └───────── \n";
break;
case 4:
echo " ┌─────┐ \n";
echo " │ O \n";
echo " │ ┼ \n";
echo " │ \n";
echo " │ \n";
echo " │ \n";
echo " └───────── \n";
break;
case 3:
echo " ┌─────┐ \n";
echo " │  O \n";
echo " │ ┌┼ \n";
echo " │ ┴ \n";
echo " │ \n";
echo " │ \n";
echo " └───────── \n";
break;
case 2:
echo " ┌─────┐ \n";
echo " │  O \n";
echo " │ ┌┼┘ \n";
echo " │ ┌┴ \n";
echo " │ \n";
echo " │ \n";
echo " └───────── \n";
break;
case 1:
echo " ┌─────┐ \n";
echo " │  O \n";
echo " │ ┌┼┘ \n";
echo " │ ┌┴ \n";
echo " │ │ \n";
echo " │ \n";
echo " └───────── \n";
break;
}
}


/**************/
/***** PROGRAMA PRINCIAL ****/
/**************/
//$opcion, $min, $maximo, $indiceAleatorioPrincipal $jugarPrincipal,$indiceJuegoPrincipal, $puntosUsuarioPrincipal, $primerJuego INT
//$coleccionJuegosPrincipal, $coleccionPalabrasPrincipal ARRAY
echo "hola" ;
define("CANT_INTENTOS", 6); //cantidad de intentos que tendrá el jugador para adivinar la palabra.
$coleccionPalabrasPrincipal=cargarPalabras();
$coleccionJuegosPrincipal=cargarJuegos();

do{
$opcion = seleccionarOpcion();
switch ($opcion) {
case 1: //Jugar con una palabra aleatoria
$cantIntentos=CANT_INTENTOS;
$min=0;
$maximo=count($coleccionPalabrasPrincipal)-1;
$indiceAleatorioPrincipal=indiceAleatorioEntre($min,$maximo);
$jugarPrincipal=jugar($coleccionPalabrasPrincipal, $indiceAleatorioPrincipal, $cantIntentos);
$coleccionJuegosPrincipal = agregarJuego($coleccionJuegosPrincipal,$Principal,$indiceAleatorioPrincipal);

break;
case 2: //Jugar con una palabra elegida
$cantIntentos=CANT_INTENTOS;
$min=0;
$maximo=count($coleccionPalabrasPrincipal)-1;
$indiceJuegoPrincipal = solicitarIndiceEntre($min, $maximo);
$jugarPrincipal=jugar($coleccionPalabrasPrincipal, $indiceJuegoPrincipal, $cantIntentos);
$coleccionJuegosPrincipal = agregarJuego($coleccionJuegosPrincipal,$jugarPrincipal,$indiceJuegoPrincipal);

break;
case 3: //Agregar una palabra al listado
$coleccionPalabrasPrincipal=agregarPalabra($coleccionPalabrasPrincipal);

break;
case 4: //Mostrar la información completa de un número de juego
$min=0;
$maximo=count($coleccionJuegosPrincipal)-1;
echo "Mostrar informacion de Juego";
$indiceJuegoPrincipal= solicitarIndiceEntre($min,$maximo);
mostrarJuego($coleccionJuegosPrincipal,$coleccionPalabrasPrincipal,$indiceJuegoPrincipal);

break;
case 5: //Mostrar la información completa del primer juego con más puntaje
echo "Primer Juego con mas Puntaje";
$indiceJuegoPrincipal= juegoConMasPuntaje($coleccionJuegosPrincipal);
mostrarJuego($coleccionJuegosPrincipal,$coleccionPalabrasPrincipal,$indiceJuegoPrincipal);

break;
case 6: //Mostrar la información completa del primer juego que supere un puntaje indicado por el usuario
echo "Ingrese un puntaje \n" ;
$puntosUsuarioPrincipal = trim(fgets(STDIN)) ;
$primerJuego = primerJuegoConMasPuntaje($coleccionJuegosPrincipal,$puntosUsuarioPrincipal);
if ($primerJuego > -1){
echo "el Juego con mas Puntaje que: ".$puntosUsuarioPrincipal."\n";
mostrarJuego($coleccionJuegosPrincipal,$coleccionPalabrasPrincipal,$primerJuego);
}else{
echo "No existe un juego que tenga mas de".$puntosUsuarioPrincipal."\n";
echo "Segun enunciado retorno ".$primerJuego."\n";
}

break;
case 7: //Mostrar la lista de palabras ordenadas de manera alfabetica
mostrarPalabrasOrdenadas($coleccionPalabrasPrincipal);

break;
}

}while($opcion != 8) ;


?>
