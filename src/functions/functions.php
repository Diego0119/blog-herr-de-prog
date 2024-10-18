<?php

// lee el archivo
function LeerArchivo()
{
    $database = '../../posts.txt';
    $content = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $content;
}


function SubirArchivo($titulo, $autor, $descripcion, $imagen_url)
{

    $database = '../../../posts.txt';

    if (file_exists($database)) {
        $posts = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $count = count($posts);
    } else {
        $count = 0;
    }
    $id = $count + 1;
    $nuevo_post = $id . "|" . $titulo . "|" . $autor . "|" . $descripcion . "|" . $imagen_url;
    // una vez armado el archivo 
    if (file_put_contents($database, $nuevo_post . PHP_EOL, FILE_APPEND | LOCK_EX) == false) {
        echo "Error al escribir en el archivo.";
    }
}

function EliminarPost($id_post)
{
    $database = '../../posts.txt';
    $posts = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $posts_filtrados = [];
    foreach ($posts as $post) {
        list($id, $title, $description, $image) = explode("|", $post);
        if ($id != $id_post) {
            $posts_filtrados = $post;
        }

    }
    file_put_contents($database, implode(PHP_EOL, $posts_filtrados) . PHP_EOL);

}

// esta funcion debe mover el archivo dado a la carpeta upload
function MoverArchivo()
{


}

function AgregarComentario($comentario_id, $usuario_id, $comentario_texto, $post_id)
{
    // id_comentario|id_usuario|comentario|id_post|fecha
    $comentario_file = '../../../comentarios.txt';
    $comentario_id = uniqid();
    $fecha = Date(d - m - Y);
    $comentario_data = "$comentario_id|$usuario_id|$comentario_texto|$post_id|$fecha\n";

    file_put_contents($comentario_file, $comentario_data, FILE_APPEND | LOCK_EX);
}