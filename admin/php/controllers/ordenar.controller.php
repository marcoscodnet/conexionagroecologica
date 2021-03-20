<?php
include_once('../../../php/bootstrap.php');
for ($i=0, $l=count($_POST['orden']); $i<$l; $i++) {
    if ($objeto = Doctrine::getTable($_POST['tabla'])->find($_POST['id'][$i])) {
        $objeto->orden = $_POST['orden'][$i];
        $objeto->save();
    }
}
?>
