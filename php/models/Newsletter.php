<?php
class Newsletter extends Doctrine_Record {
	public function setTableDefinition() {
		$this->setTableName('newsletter');
		$this->hasColumn('email','string',100);
	}
}
?>