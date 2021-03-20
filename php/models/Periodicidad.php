<?php
class Periodicidad extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('periodicidad');
		$this->hasColumn('contenido','string',80);
	}
	
	static public function mensual() {
		return Doctrine::getTable('periodicidad')->findOneByContenido('mensual');
	}
	
	static public function porUnicaVez() {
		return Doctrine::getTable('periodicidad')->findOneByContenido('por unica vez');
	}
}
?>