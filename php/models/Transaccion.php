<?php
class Transaccion extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('transaccion');
		$this->hasColumn('fecha','date');
		$this->hasColumn('aceptadaPorElVendedor','boolean', 1, array('default' => 0));
		$this->hasColumn('aceptadaPorElComprador','boolean', 1, array('default' => 0));
		$this->hasColumn('aprobada','boolean', array('default' => 'false'));
		$this->hasColumn('id_estado','integer');
		$this->hasColumn('id_publicacion','integer');
		$this->hasColumn('id_comprador','integer');
		$this->hasColumn('id_vendedor','integer');
	}
	
	public function setUp(){
		$this->hasOne('Estado as estado',array(
			'local'=>'id_estado',
			'foreign'=>'id'
		));
		$this->hasOne('Publicacion as publicacion',array(
			'local'=>'id_publicacion',
			'foreign'=>'id'
		));
		$this->hasOne('Usuario as comprador',array(
			'local'=>'id_comprador',
			'foreign'=>'id'
		));
		$this->hasOne('Usuario as vendedor',array(
			'local'=>'id_vendedor',
			'foreign'=>'id'
		));
	}
	
	public function getFecha () {
		$inicio = $this->_get('fecha');
		$inicioArray = explode('-', $inicio);
		$inicioArray = array_reverse($inicioArray);
		return implode('-', $inicioArray);
	}
	
	public static function pendientes ($cuantos, $desde) {
		$q = Doctrine_Query::create()
			->select('t.*')
			->from('Transaccion t')
			->innerJoin('t.estado e')
			->where('e.contenido = "pendiente"')
			->limit($cuantos) //cuantos trae
			->offset($desde); //a partir de donde empieza a traer
		$resultado = $q->execute();
		return $resultado;
	}
	public static function contarPendientes () {
		$q = Doctrine_Query::create()
			->select('COUNT(t.id) as total')
			->from('Transaccion t')
			->innerJoin('t.estado e')
			->where('e.contenido = "pendiente"')
			->groupBy('e.id');
		$total = $q->execute();
		return ($total->count())?$total[0]->total:0;
	}
	
	//con esta funcion determinamos cuanto tiempo va a estar una publicacion con
	//el cartelito vendido antes de darla de baja
	public function isVencida() {
		$dias = 5;
		$fin = $this->_get('fecha');
		$vencimiento = date("Y-m-d", strtotime("$fin + $dias days"));
		return date('Y-m-d') > $vencimiento;
	}
	
	public function mostrar ($usuario) {
		if ($usuario->id == Usuario::admin()->id) {return true;}
		if ($this->estado->id == Estado::aceptada()->id) {
			if ($this->comprador->id == $usuario->id || $this->vendedor->id == $usuario->id) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}
}
















?>
