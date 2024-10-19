<?php

/**
 * Esta función se encarga de leer la base de datos de los posts, que en este caso es un txt
 * @return array|bool retornara un array de los posts
 */

function LeerArchivo()
{
    $database = '../posts.txt';
    $posts = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return $posts;
}

/**
 * Esta función esta encargada de subir un nuevo post
 * @param mixed $titulo se le debe enviar el titulo del post
 * @param mixed $autor se le debe enviar el id del autor
 * @param mixed $descripcion se le debe enviar el contenido del post
 * @param mixed $imagen se le debe enviar la imagen que tendra el post
 * @return void esta función no retorna nada
 */

function SubirArchivo($titulo, $autor_id, $descripcion, $imagen)
{
    // Aca se mueve la imagen a la carpeta uploads
    $imagen_url = MoverArchivo($imagen);
    $database = '../../../posts.txt';

    if (file_exists($database)) {
        $posts = file($database, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $count = count($posts);
    } else {
        $count = 0;
    }
    $id = $count + 1;
    // Se ordena segun el formato que tienen los posts en el txt
    $nuevo_post = $id . "|" . $titulo . "|" . $autor_id . "|" . $descripcion . "|" . $imagen_url;
    if (file_put_contents($database, $nuevo_post . PHP_EOL, FILE_APPEND | LOCK_EX) == false) {
        echo "Error al escribir en el archivo.";
    }
}

/**
 * Esta función esta encargada de eliminar un post
 * @param mixed $id_post se le debe indicar el id del post a eliminar
 * @return void 
 */

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

/**
 * Esta función se encarga de mover el archivo subido a la carpeta uploads
 * @param mixed $archivo se le debe enviar el archivo, en este caso sera la imagen subida
 * @return bool|string retornara un booleano en el caso de que falle o una ruta mas el nombre del archivo en el caso de que sea exitoso
 */

function MoverArchivo($archivo)
{
    $upload_dir = __DIR__ . 'src/public/uploads/';

    $temp_file_path = $archivo['tmp_name'];

    $nombre_archivo = basename($archivo['name']);
    $destino = $upload_dir . $nombre_archivo;

    if (move_uploaded_file($temp_file_path, $destino)) {
        return 'uploads/' . $nombre_archivo;
    } else {
        echo "Error al mover el archivo.";
        return false;
    }
}


/**
 * Esta función se encarga de agregar un comentario a un post
 * @param mixed $post_id se le debe enviar el post id
 * @param mixed $nickname se le debe enviar el nickname del usuario
 * @param mixed $user_id se le debe enviar el user id
 * @param mixed $comentario_texto se le debe enviar el comentario del post
 * @return void esta función no retorna nada
 */

function AgregarComentario($post_id, $nickname, $user_id, $comentario_texto)
{
    $comentario_file = '../../../comentarios.txt';
    $comentario_id = uniqid();
    //$fecha = Date(d - m - Y);
    $comentario_data = "$comentario_id|$user_id|$nickname|$comentario_texto|$post_id" . PHP_EOL;

    file_put_contents($comentario_file, $comentario_data, FILE_APPEND | LOCK_EX);
}