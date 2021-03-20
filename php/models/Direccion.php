<?php
class Direccion extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('direccion');
		$this->hasColumn('calle','string',150);
		$this->hasColumn('numero','integer',6);
		$this->hasColumn('id_localidad','integer');
		$this->hasColumn('codigoPostal','integer',6);
	}
	
	public function setUp(){
		$this->hasOne('Localidad as localidad',array(
			'local'=>'id_localidad',
			'foreign'=>'id'
		));
	}
	
	/*public function toString () {
		return $this->localidad->toString().', '. $this->localidad->provincia->toString();
	}*/
	
	public function getCalle () {
		return utf8_decode($this->_get('calle'));
	}
	
	public function setCalle ($calle) {
		$this->_set('calle', utf8_encode($calle));
	}
	
	
	public function toString () {
		return $this->calle.' '.$this->numero.' - '.$this->localidad->toString().', '. $this->localidad->provincia->toString();
	}
	
	public function toStringLocalidad () {
		return $this->localidad->toString().', '. $this->localidad->provincia->toString();
	}
	
	public function toStringMapa () {
		return $this->calle.' '.$this->numero.', '.$this->localidad->toString().', '. $this->localidad->provincia->toString().', Argentina';
	}
	
}
?>