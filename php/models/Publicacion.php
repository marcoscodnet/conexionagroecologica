<?php
class Publicacion extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('publicacion');
		$this->hasColumn('inicio','date');
		$this->hasColumn('finalizacion','date'); //subasta (Dejar en blanco si se desea que la publicaci�n contin�e abierta hasta que una oferta sea aceptada. El per�odo m�nimo de publicaci�n de la subasta es de 7 d�as corridos)
		$this->hasColumn('visitas','integer', 6, array('default'=>0)); //cantidad de veces que alguien entra a ver la publiacion
		$this->hasColumn('favorito_id','integer'); //favoritos (many to many)
		$this->hasColumn('id_propiedad','integer');
		$this->hasColumn('id_estado','integer');
		$this->hasColumn('id_owner','integer');
		$this->hasColumn('id_seguidor','integer');
	}
	
	public function setUp(){
		$this->hasOne('Estado as estado',array(
			'local'=>'id_estado',
			'foreign'=>'id'
		));
		$this->hasOne('Propiedad as propiedad',array(
			'local'=>'id_propiedad',
			'foreign'=>'id'
		));
		$this->hasMany('Usuario as seguidores', array(
        	'local' => 'favorito_id',
            'foreign' => 'user_id',
            'refClass' => 'Favorito'
        ));
		$this->hasOne('Usuario as owner',array(
			'local'=>'id_owner',
			'foreign'=>'id'
		));
		$this->hasMany('Oferta as ofertas',array(
			'local'=>'id',
			'foreign'=>'id_publicacion'
		));
	}
	
	public function getInicio () {
		$inicio = $this->_get('inicio');
		$inicioArray = explode('-', $inicio);
		$inicioArray = array_reverse($inicioArray);
		return implode('-', $inicioArray);
	}
	
	public function getFinalizacion () {
		$fin = $this->_get('finalizacion');
		$finArray = explode('-', $fin);
		$finArray = array_reverse($finArray);
		return implode('-', $finArray);
	}
	
	public function setFinalizacion ($fin) {
		if ($fin == FALSE) {
			$this->_set('finalizacion', '2050-01-01');
		} else {
			$hoy = date('Y-m-d');
			$fin = date("Y-m-d", strtotime("$hoy + $fin days"));
			$this->_set('finalizacion', $fin);
		}
	}
	
	public function getTiempoRestante () {
		if ($this->_get('finalizacion') == '2050-01-01') {
			return 'hasta completar la venta';
		}
		$fechaInicio = explode('-',$this->inicio);
		$fechaFin = explode('-',$this->finalizacion);
		$inicio = mktime(0,0,0,$fechaInicio[1], $fechaInicio[0], $fechaInicio[2]);
    	$fin = mktime(0,0,0,$fechaFin[1], $fechaFin[0], $fechaFin[2]);
		$dias = round(($fin - $inicio) / (60 * 60 * 24));
		if ($dias>=1) {
			return ($dias==1)?'Último día':$dias.' días';
		} else {
			return 'publicación vencida';
		}
	}
	
	public function getTransaccion () {
		$q = Doctrine_Query::create()
			->select('t.*')
			->from('Transaccion t')
			->innerJoin('t.publicacion p')
			->where('p.id = '.$this->id);
		$resultado = $q->execute();
		return $resultado[0];
	}
	
	//la funcion recibe un usuario y devuelve true si este se encuentra entre los seguidores de esta publicacion
	public function inSeguidores ($usuario) {
		$q = Doctrine_Query::create()
			->select('f.*')
			->from('Favorito f')
			->where('f.user_id = '.$usuario->id)
			->andWhere('f.favorito_id = '.$this->id);
		$resultado = $q->execute();
		return $resultado->count();
	}
	
	//listar es una funcion especial, porque junta en un mismo query la consulta de los propiedads y su paginado
	static public function listar ($parametros) {
		$defualt = array('posibleUsoSuelo'=>'%', 'hectareasMenor'=>0, 'hectareasMayor'=>1000000, 'periodicidad'=>'%', 'provincia'=>'%', 'localidad'=>'%', 'orderBy'=>'pb.inicio', 'sentido'=>'desc', 'cuantos'=>2, 'desde'=>0);
		$options = $parametros + $defualt;
		$q = Doctrine_Query::create()
			->select('p.*')
			->from('Propiedad p')
			->innerJoin('p.posibleUsoSuelo s')
			->innerJoin('p.publicacion pb')
			->innerJoin('pb.estado e')
			->innerJoin('p.direccion d')
			->innerJoin('d.localidad l')
			->where('1=1')
			->andWhere('pb.finalizacion >= "'.date('Y-m-d').'"')
			->andWhere('p.hectareas >= '.$options['hectareasMenor'].' and p.hectareas <= '.$options['hectareasMayor'])
			->andWhere('r.id like ?', array($options['periodicidad']))
			->andWhere('e.contenido = "aceptada" or e.contenido = "comprada"')
			->andWhere('l.provincia.id like ?', array($options['provincia']))
			->andWhere('l.id like ?', array($options['localidad']))
			->orderBy($options['orderBy'].' '.$options['sentido'])
			->limit($options['cuantos']) //cuantos trae
			->offset($options['desde']); //a partir de donde empieza a traer
		$resultado = $q->execute();
		return $resultado;
		return $q->getSqlQuery();
        }
	
	static public function contar ($parametros) {
		$defualt = array('posibleUsoSuelo'=>'%', 'hectareasMenor'=>0, 'hectareasMayor'=>1000000, 'periodicidad'=>'%', 'provincia'=>'%', 'localidad'=>'%', 'orderBy'=>'pb.inicio', 'sentido'=>'desc', 'cuantos'=>2, 'desde'=>0);
		$options = $parametros + $defualt;
		$q = Doctrine_Query::create()
			->select('COUNT(p.id) as total')
			->from('Propiedad p')
			->innerJoin('p.posibleUsoSuelo s')
			->innerJoin('p.publicacion pb')
			->innerJoin('pb.estado e')
			->innerJoin('p.direccion d')
			->innerJoin('d.localidad l')
			->where('1=1')
			->andWhere('pb.finalizacion >= "'.date('Y-m-d').'"')
			->andWhere('p.hectareas >= '.$options['hectareasMenor'].' and p.hectareas <= '.$options['hectareasMayor'])
			->andWhere('r.id like ?', array($options['periodicidad']))
			->andWhere('e.contenido = "aceptada" or e.contenido = "comprada"')
			->andWhere('l.provincia.id like ?', array($options['provincia']))
			->andWhere('l.id like ?', array($options['localidad']));
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	
	//validaciones
	public function isVencida () {
		return date('Y-m-d') > $this->_get('finalizacion');
	}
	
	public static function listarPendientes ($cuantos, $desde) {
		$q = Doctrine_Query::create()
			->select('p.*')
			->from('Publicacion p')
			->innerJoin('p.estado e')
			->where('e.contenido = "pendiente"')
			->limit($cuantos) //cuantos trae
			->offset($desde); //a partir de donde empieza a traer
		$resultado = $q->execute();
		return $resultado;
	}
	public static function contarPendientes () {
		$q = Doctrine_Query::create()
			->select('COUNT(p.id) as total')
			->from('Publicacion p')
			->innerJoin('p.estado e')
			->where('e.contenido = "pendiente"')
			->groupBy('e.id');
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	
	public static function filtrarEstado ($cuantos, $desde, $estado) {
		$filtroEstado = ($estado)?'e.id = '.$estado:'1=1';
		$q = Doctrine_Query::create()
			->select('p.*')
			->from('Publicacion p')
			->innerJoin('p.estado e')
			//->where('e.contenido = "pendiente"')
			->where($filtroEstado)
			->limit($cuantos) //cuantos trae
			->offset($desde); //a partir de donde empieza a traer
		$resultado = $q->execute();
		return $resultado;
	}
	public static function contarFiltrarEstado($estado) {
		$filtroEstado = ($estado)?'e.id = '.$estado:'1=1';
		$q = Doctrine_Query::create()
			->select('COUNT(p.id) as total')
			->from('Publicacion p')
			->innerJoin('p.estado e')
			//->where('e.contenido = "pendiente"')
			->where($filtroEstado)
			->groupBy('e.id');
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	
	
	
	public function mostrar ($usuario = false) {
		$respuesta = true;
		if ($this->estado->id == Estado::borrada()->id){return false;}
		if ($usuario) {
			if ($this->isVencida()) {
				if ($this->estado->id == Estado::pendiente() && $usuario->id == Usuario::admin()->id) {
					return true;
				} else if ($this->estado->id == Estado::aceptada() && $usuario->id == $this->owner->id) {
					return true;
				} else {
					$respuesta = false;
				}
			}
			if ($this->estado->id == Estado::comprada()->id || $this->estado->id == Estado::finalizada()->id) {
				if ($this->transaccion->comprador->id == $this->id || $this->transaccion->vendedor->id == $this->id || $this->transaccion->comprador->id == $usuario->id || $this->transaccion->vendedor->id == $usuario->id || $usuario->id == Usuario::admin()->id) {
					return true;
				} else {
					return false;
				}
			}
			if ($this->estado->id == Estado::pendiente()->id) {
				if ($this->owner->id == $usuario->id || $usuario->id == Usuario::admin()->id) {
					return true;
				} else {
					return false;
				}
			}
			return $respuesta;
		} else {
			if (!$this->isVencida() && $this->estado->id != Estado::pendiente()->id) {
				return true;
			} else {
				return false;
			}
		}
	}
}















?>