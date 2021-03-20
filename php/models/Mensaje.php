<?php
class Mensaje extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('mensaje');
		$this->hasColumn('fecha','date');
		$this->hasColumn('asunto','string',256);
		$this->hasColumn('contenido','string',10000);
		$this->hasColumn('id_estado','integer');
		$this->hasColumn('id_emisor','integer');
		$this->hasColumn('id_receptor','integer');
		$this->hasColumn('id_propiedad','integer');
		$this->hasColumn('id_mensaje','integer');
		$this->hasColumn('revisadoPorAdmin','integer', 1, array('default' => 0));
	}
	
	public function setUp(){
		$this->hasOne('Estado as estado',array(
			'local'=>'id_estado',
			'foreign'=>'id'
		));
		$this->hasOne('Usuario as emisor',array(
			'local'=>'id_emisor',
			'foreign'=>'id'
		));
		$this->hasOne('Usuario as receptor',array(
			'local'=>'id_receptor',
			'foreign'=>'id'
		));
		$this->hasOne('Propiedad as propiedad',array(
			'local'=>'id_propiedad',
			'foreign'=>'id'
		));
		$this->hasOne('Mensaje as mensaje',array(
			'local'=>'id_mensaje',
			'foreign'=>'id'
		));
	}
	
	public function getFecha () {
		$inicio = $this->_get('fecha');
		$inicioArray = explode('-', $inicio);
		$inicioArray = array_reverse($inicioArray);
		return implode('-', $inicioArray);
	}
	
	public function getAsunto () {
		return utf8_decode($this->_get('asunto'));
	}
	
	public function setAsunto ($asunto) {
		$this->_set('asunto', utf8_encode($asunto));
	}
	
	public function getContenido () {
		return utf8_decode($this->_get('contenido'));
	}
	
	public function setContenido ($contenido) {
		$this->_set('contenido', utf8_encode($contenido));
	}
	
	public static function noRevisados ($cuantos, $desde) {
		$q = Doctrine_Query::create()
			->select('m.*')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
                        ->where('s.contenido <> "borrada"')
			->andWhere('e.id <> 1 and e.id <> 2')
			->limit($cuantos) //cuantos trae
			->offset($desde); //a partir de donde empieza a traer
		$resultado = $q->execute();
		return $resultado;
	}
	public static function contarNoRevisados () {
		$q = Doctrine_Query::create()
			->select('COUNT(m.id) as total')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
			->where('s.contenido <> "borrada"')
			->andWhere('e.id <> 1 and e.id <> 2');
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	public static function filtrarEstado ($cuantos, $desde, $estado) {
		$filtroEstado = ($estado)?'s.id = '.$estado:'1=1';
		$q = Doctrine_Query::create()
			->select('m.*')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
			->where('s.contenido <> "borrada"')
			->andWhere('e.id <> 1 and e.id <> 2')
			->andWhere($filtroEstado)
			->orderBy('m.fecha desc')
			->limit($cuantos) //cuantos trae
			->offset($desde); //a partir de donde empieza a traer

		$resultado = $q->execute();
		return $resultado;
	}
	public static function contarfiltrarEstado ($estado) {
		$filtroEstado = ($estado)?'s.id = '.$estado:'1=1';
		$q = Doctrine_Query::create()
			->select('COUNT(m.id) as total')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
			->Where('s.contenido <> "borrada"')
			->andWhere('e.id <> 1 and e.id <> 2')
			->andWhere($filtroEstado);
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	
	public static function filtrarPropiedad ($cuantos, $desde, $propiedadId) {
		
		$q = Doctrine_Query::create()
			->select('m.*')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
			->Where('s.id = 1')
			->andWhere('m.id_propiedad = '.$propiedadId)
			->limit($cuantos) //cuantos trae
			->offset($desde); //a partir de donde empieza a traer

		$resultado = $q->execute();
		return $resultado;
	}
	public static function contarfiltrarPropiedad ($propiedadId) {
		$q = Doctrine_Query::create()
			->select('COUNT(m.id) as total')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
			->Where('s.id = 1')
			->andWhere('m.id_propiedad = '.$propiedadId);
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	
	public static function filtrarRespuesta ($mensajeId) {
		
		$q = Doctrine_Query::create()
			->select('m.*')
			->from('Mensaje m')
			->innerJoin('m.emisor e')
			->innerJoin('m.estado s')
			->Where('s.id = 1')
			->andWhere('m.id_mensaje = '.$mensajeId);
			

		$resultado = $q->execute();
		return $resultado;
	}
}

?>