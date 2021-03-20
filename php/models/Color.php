<?php
class Color extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('color');
		$this->hasColumn('contenido','string',150);
	}
}
?>