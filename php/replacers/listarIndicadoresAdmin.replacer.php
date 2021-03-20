<?php
$html = $template;
//Cantidad de usuarios.
$q_u = Doctrine_Query::create()
	->select('u.id')
	->from('Usuario u')
	->where('u.email IS NOT NULL');
	
	$usuarios = $q_u->execute();
	$html = str_replace('<!--{contenidoindicadores}-->', '<div class="descripcion"><p style="color:#C63;"><strong>CANTIDAD DE USUARIOS: </strong>'.$usuarios->count().'</p></div>', $html);

//Cantidad de publicaciones.
	$html .= $template;
	$html = str_replace('<!--{contenidoindicadores}-->', '<div class="descripcion"><p style="color:#C63;"><strong>CANTIDAD DE PUBLICACIONES POR CATEGOR&Iacute;A: </strong></p></div>', $html);
	
$q_c = Doctrine_Query::create()
	->select('c.*')
	->from('Categoria c');

	$categorias = $q_c->execute();
	foreach ($categorias as $categoria) {
		$idCategoria = $categoria->id;
		$contenido = $categoria->contenido;
		
		$q_p = Doctrine_Query::create()
			->select('pu.*')
			->from('Publicacion pu')
			->innerJoin('pu.producto p')
			->innerJoin('p.subcategoria s')
			->innerJoin('s.categoria c')
			->where('pu.id_estado = 1')
			->andWhere('c.id = '.$categoria->id);
			
		$publicacion = $q_p->execute();
	
		$cantidad_public = $publicacion->count();
		if($cantidad_public > 0){
			$html .= $template;
			$html = str_replace('<!--{contenidoindicadores}-->', '<div class="descripcion"><p style="color:#000;">Categor&iacute;a:&nbsp;&nbsp;'.htmlentities($contenido).' - cantidad: '.$cantidad_public.'</p></div>', $html);
		}
	}
	$html .= $template;
	$html = str_replace('<!--{contenidoindicadores}-->', '<div class="descripcion"><p style="color:#C63;"><strong>CANTIDAD DE CONEXIONES POR CATEGOR&Iacute;A: </strong></p></div>', $html);
	//Cantidad de conexiones.
	foreach ($categorias as $categoria) {
		$idCategoria = $categoria->id;
		$contenido = $categoria->contenido;
		
		$q_t = Doctrine_Query::create()
			->select('pu.*, t.*')
			->from('transaccion t, Publicacion pu')
			->innerJoin('pu.producto p')
			->innerJoin('p.subcategoria s')
			->innerJoin('s.categoria c')
			->where('pu.id_estado = 1')
			->andWhere('t.id_publicacion = pu.id')
			->andWhere('c.id = '.$categoria->id);
			
			//echo $q_t->getSqlQuery();
		$transaccion = $q_t->execute();
	
		$cantidad_conexiones = $transaccion->count();
		if($cantidad_conexiones > 0){
			$html .= $template;
			$html = str_replace('<!--{contenidoindicadores}-->', '<div class="descripcion"><p style="color:#C63;">CONEXIONES: Categor&iacute;a:&nbsp;&nbsp;'.htmlentities($contenido).' - cantidad: '.$cantidad_conexiones.'</p></div>', $html);
		}
	}
	
	//Cantidad de publicaciones a la fecha
	$html .= $template;
	$q = Doctrine_Query::create()
	->select('pu.id')
	->from('publicacion pu')
	->where('pu.id_estado = 1 or pu.id_estado = 6 or pu.id_estado = 8');
	
	$publhoy = $q->execute();
	$html = str_replace('<!--{contenidoindicadores}-->', '<div class="descripcion"><p style="color:#C63;"><strong>CANTIDAD DE PUBLICACIONES HASTA LA FECHA: </strong>'.$publhoy->count().'</p></div>', $html);
	
?>