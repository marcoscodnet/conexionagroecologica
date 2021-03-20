<?php 

$q = Doctrine_Query::create()
	->select('p.*')
	->from('Popup p')
	->where('p.id = '.$_GET['id']);

$popup = $q->execute();

$q = Doctrine_Query::create()
	->select('p.*')
	->from('Imagen p')
	->where('p.id_popup = '.$_GET['id']);

$img = $q->execute();
?>
<a href="<?php echo $popup[0]->ruta;?>" target=_blank onclick="self.close();"> <img src="content/popups-conexion/<?php echo $img[0]->ruta;?>" width="600" height="600"> </a>