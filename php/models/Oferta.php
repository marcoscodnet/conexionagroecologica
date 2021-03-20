<?php
class Oferta extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('oferta');
		$this->hasColumn('fecha','date');
		$this->hasColumn('id_publicacion','integer');
		$this->hasColumn('id_owner','integer');
		$this->hasColumn('id_estado','integer'); //aceptada - rechazada - pendiente
	}
	
	public function setUp(){
		$this->hasOne('Publicacion as publicacion',array(
			'local'=>'id_publicacion',
			'foreign'=>'id'
		));
		$this->hasOne('Usuario as owner',array(
			'local'=>'id_owner',
			'foreign'=>'id'
		));
		$this->hasOne('Estado as estado',array(
			'local'=>'id_estado',
			'foreign'=>'id'
		));
	}
	
	public function getFecha () {
		$inicio = $this->inicio;
		$inicioArray = explode('-', $inicio);
		$inicioArray = array_reverse($inicioArray);
		return implode('-', $inicioArray);
	}
}
?>