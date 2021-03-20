<?php

session_start();
include_once('../bootstrap.php');
include_once('../includes/defined.php');


/* VALIDACIONES */
if (!isset($_SESSION['log']) || $_SESSION['log'] != 'usuarioValido') {
    session_destroy();
    header('location: ' . RUTA);
    exit();
}

if (isset($_GET['id'])) {
    $propiedad = Doctrine::getTable('propiedad')->find($_GET['id']);
    if ($propiedad && $propiedad->publicacion->owner->codigo != $_SESSION['codigoUsuario'] && Usuario::admin()->codigo != $_SESSION['codigoUsuario']) {
        session_destroy();
        header('location: ' . RUTA);
        exit();
    }
}

if (isset($_POST['propiedadId']) && $_POST['propiedadId'] != 0) {
    $propiedad = Doctrine::getTable('propiedad')->find($_POST['propiedadId']);
    if ($propiedad && $propiedad->publicacion->owner->codigo != $_SESSION['codigoUsuario'] && Usuario::admin()->codigo != $_SESSION['codigoUsuario']) {
        session_destroy();
        header('location: ' . RUTA);
        exit();
    }
}
/* FIN VALIDACIONES */

error_reporting(E_ALL | E_STRICT);

class UploadHandler {

    private $options;

    function __construct($options = null) {
        $this->options = array(
            'script_url' => $_SERVER['PHP_SELF'],
            'upload_dir' => RUTA_IMAGENES,
            'upload_url' => RUTA . '/images/propiedades/',
            'param_name' => 'files',
            // The php.ini settings upload_max_filesize and post_max_size
            // take precedence over the following max_file_size setting:
            'max_file_size' => 2000000,
            'min_file_size' => 1,
            'accept_file_types' => '/(\.|\/)(gif|jpe?g|png)$/i',
            'max_number_of_files' => null,
            'discard_aborted_uploads' => false,
            'image_versions' => array(
                // Uncomment the following version to restrict the size of
                // uploaded images. You can also add additional versions with
                // their own upload directories:

                'normal' => array(
                    'upload_dir' => RUTA_IMAGENES,
                    'upload_url' => RUTA . '/images/propiedades/',
                    'max_width' => 900,
                    'max_height' => 550
                ),
                'large' => array(
                    'upload_dir' => RUTA_IMAGENES . 'gr/',
                    'upload_url' => RUTA . '/images/propiedades/gr/',
                    'max_width' => 160,
                    'max_height' => 160
                ),
                'thumbnail' => array(
                    'upload_dir' => RUTA_IMAGENES . 'ch/',
                    'upload_url' => RUTA . '/images/propiedades/ch/',
                    'max_width' => 70,
                    'max_height' => 70
                )
            )
        );
        if ($options) {
            $this->options = array_merge_recursive($this->options, $options);
        }
    }

    private function get_file_object($file_name) {
        $file_path = $this->options['upload_dir'] . $file_name;
        if (is_file($file_path) && $file_name[0] !== '.') {
            $file = new stdClass();
            $file->name = $file_name;
            $file->size = filesize($file_path);
            $file->url = $this->options['upload_url'] . rawurlencode($file->name);
            foreach ($this->options['image_versions'] as $version => $options) {
                if (is_file($options['upload_dir'] . $file_name)) {
                    $file->{$version . '_url'} = $options['upload_url']
                            . rawurlencode($file->name);
                }
            }
            $file->delete_url = $this->options['script_url']
                    . '?file=' . rawurlencode($file->name);
            $file->delete_type = 'DELETE';
            return $file;
        }
        return null;
    }

    private function get_file_objects() {
        if (!isset($_GET['id'])) {
            return array();
        }
        $propiedad = Doctrine::getTable('propiedad')->find($_GET['id']);
        $arrayImagenes = array();
        if ($propiedad->imagenes) {
            foreach ($propiedad->imagenes as $imagen) {
                $file = new stdClass();
                $file->name = $imagen->ruta;
                $file->size = filesize(RUTA_IMAGENES . 'gr/' . $imagen->ruta);
                $file->url = $this->options['upload_url'] . rawurlencode($file->name);
                foreach ($this->options['image_versions'] as $version => $options) {
                    if (is_file($options['upload_dir'] . $imagen->ruta)) {
                        $file->{$version . '_url'} = $options['upload_url']
                                . rawurlencode($file->name);
                    }
                }
                $file->delete_url = $this->options['script_url']
                        . '?file=' . rawurlencode($file->name);
                $file->delete_type = 'DELETE';
                $arrayImagenes[] = $file;
            }
        }
        return $arrayImagenes;
    }

    private function create_scaled_image($file_name, $options) {
        $file_path = $this->options['upload_dir'] . $file_name;
        $new_file_path = $options['upload_dir'] . $file_name;

        switch (strtolower(substr(strrchr($file_name, '.'), 1))) {
            case 'jpg':
            case 'jpeg':
                $src_img = @imagecreatefromjpeg($file_path);
                $write_image = 'imagejpeg';
                break;
            case 'gif':
                $src_img = @imagecreatefromgif($file_path);
                $write_image = 'imagegif';
                break;
            case 'png':
                $src_img = @imagecreatefrompng($file_path);
                $write_image = 'imagepng';
                break;
            default:
                $src_img = $image_method = null;
        }

        if ($options['max_width'] != $options['max_height']) {
            list($img_width, $img_height) = @getimagesize($file_path);
            if (!$img_width || !$img_height) {
                return false;
            }
            $scale = min(
                    $options['max_width'] / $img_width, $options['max_height'] / $img_height
            );
            if ($scale > 1) {
                $scale = 1;
            }
            $new_width = $img_width * $scale;
            $new_height = $img_height * $scale;

            $new_img = @imagecreatetruecolor($new_width, $new_height);
            $success = $src_img && @imagecopyresampled(
                            $new_img, $src_img, 0, 0, 0, 0, $new_width, $new_height, $img_width, $img_height
                    ) && $write_image($new_img, $new_file_path);
        } else {
            $new_img = @imagecreatetruecolor($options['max_width'], $options['max_width']);
            list($img_width, $img_height) = @getimagesize($file_path);
            if ($img_width > $img_height) {
                $dstAncho = round($img_width / ($img_height / $options['max_width']));
                $dstAlto = $options['max_width'];
                $dstX = (($dstAncho - $options['max_width']) / 2) * -1;
                $dstY = 0;
            } else {
                $dstAncho = $options['max_width'];
                $dstAlto = round($img_height / ($img_width / $options['max_width']));
                $dstX = 0;
                $dstY = (($dstAlto - $options['max_width']) / 2) * -1;
            }

            $success = $src_img && imagecopyresampled(
                            $new_img, $src_img, $dstX, $dstY, 0, 0, $dstAncho, $dstAlto, $img_width, $img_height
                    ) && $write_image($new_img, $new_file_path);
        }
        @imagedestroy($src_img);
        @imagedestroy($new_img);
        return $success;
    }

    private function has_error($uploaded_file, $file, $error) {
        if ($error) {
            return $error;
        }
        if (!preg_match($this->options['accept_file_types'], $file->name)) {
            return 'acceptFileTypes';
        }
        if ($uploaded_file && is_uploaded_file($uploaded_file)) {
            $file_size = filesize($uploaded_file);
        } else {
            $file_size = $_SERVER['CONTENT_LENGTH'];
        }
        if ($this->options['max_file_size'] && (
                $file_size > $this->options['max_file_size'] ||
                $file->size > $this->options['max_file_size'])
        ) {
            return 'maxFileSize';
        }
        if ($this->options['min_file_size'] &&
                $file_size < $this->options['min_file_size']) {
            return 'minFileSize';
        }
        if (is_int($this->options['max_number_of_files']) && (
                count($this->get_file_objects()) >= $this->options['max_number_of_files'])
        ) {
            return 'maxNumberOfFiles';
        }
        return $error;
    }

    private function handle_file_upload($uploaded_file, $name, $size, $type, $error) {
        $file = new stdClass();
        $file->name = basename(stripslashes($name));
        $file->size = intval($size);
        $file->type = $type;
        $error = $this->has_error($uploaded_file, $file, $error);
        if (!$error && $file->name) {
            if ($file->name[0] === '.') {
                $file->name = substr($file->name, 1);
            }
            $file_path = $this->options['upload_dir'] . $file->name;
            $append_file = is_file($file_path) && $file->size > filesize($file_path);
            clearstatcache();
            if ($uploaded_file && is_uploaded_file($uploaded_file)) {
                // multipart/formdata uploads (POST method uploads)
                if ($append_file) {
                    file_put_contents(
                            $file_path, fopen($uploaded_file, 'r'), FILE_APPEND
                    );
                } else {
                    move_uploaded_file($uploaded_file, $file_path);
                }
            } else {
                // Non-multipart uploads (PUT method support)
                file_put_contents(
                        $file_path, fopen('php://input', 'r'), $append_file ? FILE_APPEND : 0
                );
            }
            $file_size = filesize($file_path);
            if ($file_size === $file->size) {
                $file->url = $this->options['upload_url'] . rawurlencode($file->name);
                $modelImaen = new Imagen();
                $modelImaen->ruta = $file->name;
                $modelImaen->save();
                foreach ($this->options['image_versions'] as $version => $options) {
                    if ($this->create_scaled_image($file->name, $options)) {
                        $file->{$version . '_url'} = $options['upload_url']
                                . rawurlencode($file->name) . '?i=' . time();
                    }
                }
            } else if ($this->options['discard_aborted_uploads']) {
                unlink($file_path);
                $file->error = 'abort';
            }
            $file->size = $file_size;
            $file->delete_url = $this->options['script_url']
                    . '?file=' . rawurlencode($file->name);
            $file->delete_type = 'DELETE';
        } else {
            $file->error = $error;
        }
        return $file;
    }

    public function get() {
        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        if ($file_name) {
            $info = $this->get_file_object($file_name);
        } else {
            $info = $this->get_file_objects();
        }
        $this->borrarSobrantes();
        header('Pragma: no-cache');
        header('Cache-Control: private, no-cache');
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        header('Content-type: application/json');
        echo json_encode($info);
    }

    public function post() {
        $upload = isset($_FILES[$this->options['param_name']]) ?
                $_FILES[$this->options['param_name']] : array(
            'tmp_name' => null,
            'name' => null,
            'size' => null,
            'type' => null,
            'error' => null
                );
        $nombre = $this->determinarNombre($upload['type'][0]);
        $info = array();
        if (is_array($upload['tmp_name'])) {
            foreach ($upload['tmp_name'] as $index => $value) {
                $info[] = $this->handle_file_upload(
                        $upload['tmp_name'][$index], $nombre, isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                                $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'][$index], isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                                $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'][$index], $upload['error'][$index]
                );
            }
        } else {
            $info[] = $this->handle_file_upload(
                    $upload['tmp_name'], $nombre, isset($_SERVER['HTTP_X_FILE_SIZE']) ?
                            $_SERVER['HTTP_X_FILE_SIZE'] : $upload['size'], isset($_SERVER['HTTP_X_FILE_TYPE']) ?
                            $_SERVER['HTTP_X_FILE_TYPE'] : $upload['type'], $upload['error']
            );
        }
        header('Vary: Accept');
        header('Pragma: no-cache');
        header('Cache-Control: private, no-cache');
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        if (isset($_SERVER['HTTP_ACCEPT']) &&
                (strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false)) {
            header('Content-type: application/json');
        } else {
            header('Content-type: text/plain');
        }
        echo json_encode($info);
    }

    public function delete() {
        $file_name = isset($_REQUEST['file']) ?
                basename(stripslashes($_REQUEST['file'])) : null;
        $file_path = $this->options['upload_dir'] . $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
        if ($imagen = Doctrine::getTable('imagen')->findOneByRuta($file_name)) {
            $imagen->delete();
        }
        if ($success) {
            foreach ($this->options['image_versions'] as $version => $options) {
                $file = $options['upload_dir'] . $file_name;
                if (is_file($file)) {
                    unlink($file);
                }
            }
        }
        header('Content-type: application/json');
        header('Pragma: no-cache');
        header('Cache-Control: private, no-cache');
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        echo json_encode($success);
    }

    private function determinarNombre($type) {
        $extArray = explode("/", $type);
        $ext = $extArray[1];
        $id = (isset($_POST['propiedadId']) && $_POST['propiedadId'] != 0) ? $_POST['propiedadId'] : $_SESSION['codigoUsuario'];
        //$id = $_SESSION['codigoUsuario'];
        $nombre = 'propiedad' . $id;
        $i = 0;
        do {
            $i++;
            $devolver = $nombre . '.' . $i . '.' . $ext;
        } while (is_file($this->options['upload_dir'] . $nombre . '.' . $i . '.' . $ext));
        return $devolver;
    }

    private function borrarSobrantes() {
        //$id = Propiedad::ultimoId()+1;
        $id = $_SESSION['codigoUsuario'];
        Doctrine_Query::create()->delete('Imagen')->where('ruta like ?', 'propiedad'.$_SESSION['codigoUsuario'].'%')->execute();
        for ($i = 1; $i <= 4; $i++) {
            $rutaJpg = 'propiedad' . $id . '.' . $i . '.jpeg';
            $rutaGif = 'propiedad' . $id . '.' . $i . '.gif';
            $rutaPng = 'propiedad' . $id . '.' . $i . '.png';
            if (is_file(RUTA_IMAGENES . 'gr/' . $rutaJpg)) {
                unlink(RUTA_IMAGENES . 'gr/' . $rutaJpg);
                unlink(RUTA_IMAGENES . 'ch/' . $rutaJpg);
                unlink(RUTA_IMAGENES . $rutaJpg);
            }
            if (is_file(RUTA_IMAGENES . 'gr/' . $rutaGif)) {
                unlink(RUTA_IMAGENES . 'gr/' . $rutaGif);
                unlink(RUTA_IMAGENES . 'ch/' . $rutaGif);
                unlink(RUTA_IMAGENES . $rutaGif);
            }
            if (is_file(RUTA_IMAGENES . 'gr/' . $rutaPng)) {
                unlink(RUTA_IMAGENES . 'gr/' . $rutaPng);
                unlink(RUTA_IMAGENES . 'ch/' . $rutaPng);
                unlink(RUTA_IMAGENES . $rutaPng);
            }
        }
    }

}

$upload_handler = new UploadHandler();

header('Pragma: no-cache');
header('Cache-Control: private, no-cache');
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
header('Content-Disposition: inline; filename="files.json"');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'HEAD':
    case 'GET':
        $upload_handler->get();
        break;
    case 'POST':
        $upload_handler->post();
        break;
    case 'DELETE':
        $upload_handler->delete();
        break;
    default:
        header('HTTP/1.0 405 Method Not Allowed');
}
?>