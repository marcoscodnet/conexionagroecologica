<?php
class Cantidad extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('cantidad');
		$this->hasColumn('valor','integer',6);
		$this->hasColumn('id_medida','integer'); //Kgs.- Tons. - Unidades
	}
	
	public function setUp(){
		$this->hasOne('Medida as medida',array(
			'local'=>'id_medida',
			'foreign'=>'id'
		));
	}
	
	public function toString () {
		$html = $this->valor.' ';
		$html .= $this->medida->contenido;
		return $html;
	}
}
?>