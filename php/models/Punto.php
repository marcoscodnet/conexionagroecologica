<?php
class Punto extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('punto');
		$this->hasColumn('valor','integer',1);
		$this->hasColumn('id_owner','integer');
	}
	
	public function setUp(){
		$this->hasOne('Usuario as owner',array(
			'local'=>'id_owner',
			'foreign'=>'id'
		));
	}
}
?>