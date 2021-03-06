<?php
header('Content-Type: application/json'); 
$ruta="G:/ejemplo";
//Variable para almacenar nombres de las carpetas
//Variable to store folder names
$nombreCarpeta="";
//Contador del arreglo
//Array counter
$i = 0;
//varibale almacenar los arreglos
//varibale stored array
$fic;

function unArchivoAleatorioDeCadaCarpeta($ruta,$nombreCarpeta){
    $GLOBALS["pila"] = array();
    //ruta actual
    // current path
    $directorio = opendir($ruta); 
    //obtenemos un archivo y luego otro sucesivamente
    //we get a file and then another one successively
    while ($archivo = readdir($directorio)) 
    {
        //verificamos si es o no un directorio
        // check whether or not it is a directory
        if (is_dir($ruta."/".$archivo))
        {
            if ($archivo != "." && $archivo != "..") {
                //Es un directorio, buscamos archivos dentro del mismo
                // It is a directory, we look for files within it
                unArchivoAleatorioDeCadaCarpeta($ruta."/".$archivo,$archivo);
            }
        }else{
            //almacena el nombre de los archivos en un array temporalmente
            // store the name of the files in an array temporarily
            array_push($GLOBALS["pila"], $archivo);
        }
        
    }
    //escojemos un archivo al azar con el nombre de su respectiva carpeta
    // let's choose a file at random with the name of its respective folder
    $GLOBALS["fic"][$GLOBALS["i"]] = 
    array(
        "breed" => $nombreCarpeta,
        "image" => $GLOBALS["pila"] [array_rand($GLOBALS["pila"])]
    );
    $GLOBALS["i"]++;
}
//Llamamos a la funcion e imprimimos el JSON
// We call the function and print the JSON
unArchivoAleatorioDeCadaCarpeta($ruta,$nombreCarpeta);
    //borramos el directorio "" ya que no nos sirve
    // delete the "" directory since it does not work for us
    unset($fic[$i-1]);
print_r(json_encode($fic,JSON_PRETTY_PRINT)); 
