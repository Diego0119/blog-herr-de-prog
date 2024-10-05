<?php

// lee el archivo
function LeerArchivo()
{
    $database = '../../posts.txt';
    $content = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $content;
}


function SubirArchivo($titulo, $descripcion, $imagen_url)
{
    $database = '../../posts.txt';
    $nuevo_post = $titulo . "|" . $descripcion . "|" . $imagen_url;
    file_put_contents($database, $nuevo_post . PHP_EOL, FILE_APPEND | LOCK_EX);
}

function EliminarPost()
{
    // $database = '../../posts.txt';
    // $post_a_eliminar =

}

