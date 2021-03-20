<?php
include_once('../bootstrap.php');
include_once('../clases/Archivo.php');
include_once('../clases/Texto.php');

$usuario = Doctrine::getTable('usuario')->findOneByCodigo($_POST['codigo']);
$q = Doctrine_Query::create()
        ->select('s.*')
        ->from('Subcategoria s')     
        ->innerJoin('s.categoria c')
        ->innerJoin('s.usuario_intereses u')
        ->where('u.id_usuario = '.$usuario->id);
       

$subcategorias = $q->execute();

$q = Doctrine_Query::create()
        ->select('s.*')
        ->from('Localidad s')     
        ->innerJoin('s.provincia c')
        ->innerJoin('s.usuario_intereses u')
        ->where('u.id_usuario = '.$usuario->id)
		->orderBy('s.id_provincia');
       

$localidades = $q->execute();

// Mostrar resultado
$template = Archivo::leer('../../tpl/listarSubcategorias.php');
$html = '';
include_once('../replacers/listarSubcategorias.replacer.php');
$htmlSubcategorias = $html;

$template = Archivo::leer('../../tpl/listarLocalidades.php');
$html = '';
include_once('../replacers/listarLocalidades.replacer.php');
$htmlLocalidades = $html;

$html ='<table>
  
  <tr>
    <td>'.$htmlSubcategorias.'  </td>
    <td>'.$htmlLocalidades.'</td>
  </tr>
</table>';
echo ($html);
?>