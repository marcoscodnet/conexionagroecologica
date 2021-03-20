<?php
class Sugerencia extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('sugerencia');
		$this->hasColumn('precio','float',10);
		$this->hasColumn('id_medida','integer'); //Kgs. - Tons. - Unidades
	}
	
	public function setUp(){
		$this->hasOne('Medida as medida',array(
			'local'=>'id_medida',
			'foreign'=>'id'
		));
	}
	
	public function toString () {
		$html = '$'.$this->precio;
		if ($this->_get('id_medida') != NULL) {
			$html .= ' por '.$this->medida->contenidoSingular;
		} else {
			$html .= ' por el total';
		}
		return $html;
	}
		
}
?>