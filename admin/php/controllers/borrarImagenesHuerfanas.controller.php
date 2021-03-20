<?php
if (defined(INC)) include('../includes/definer.php') ;
$ahora = time();

//borrar temporales
foreach(glob(INC.'../content/tmp/especies/*') as $image) {
    if (($ahora-filemtime($image))>3600) @unlink($image);
}
foreach(glob(INC.'../content/tmp/especies/thumb/*') as $image) {
     if (($ahora-filemtime($image))>3600) @unlink($image);
}
?>
