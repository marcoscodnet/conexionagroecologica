<?php
class Codigo extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('codigo');
		$this->hasColumn('contenido','string',32);
	}
}
?>