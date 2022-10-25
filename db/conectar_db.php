<?php
function conectarDB(){
    $db = mysqli_connect('localhost', 'root', 'ROOT', 'prueba_winpax');
    if(!$db){
        echo 'Error, no se pudo conectar';
        exit;
    }
    return $db;
}